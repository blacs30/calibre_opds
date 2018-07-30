<?php
/**
 * Concos - Calibre on Nextcloud OPDS Server
 *
 * @author Claas Lisowski
 * @copyright 2018 Claas Lisowski
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 */

namespace OCA\Calibre_opds;
use OC\Files\Filesystem;

class Data extends Base {
    public $id;
    public $name;
    public $format;
    public $realFormat;
    public $extension;
    public $book;

    public static $mimetypes = array(
        'aac' => 'audio/aac',
        'azw' => 'application/x-mobipocket-ebook',
        'azw1' => 'application/x-topaz-ebook',
        'azw2' => 'application/x-kindle-application',
        'azw3' => 'application/x-mobi8-ebook',
        'cbz' => 'application/x-cbz',
        'cbr' => 'application/x-cbr',
        'djv' => 'image/vnd.djvu',
        'djvu' => 'image/vnd.djvu',
        'doc' => 'application/msword',
        'epub' => 'application/epub+zip',
        'fb2' => 'text/fb2+xml',
        'ibooks' => 'application/x-ibooks+zip',
        'kepub' => 'application/epub+zip',
        'kobo' => 'application/x-koboreader-ebook',
        'm4a' => 'audio/mp4',
        'mobi' => 'application/x-mobipocket-ebook',
        'mp3' => 'audio/mpeg',
        'lit' => 'application/x-ms-reader',
        'lrs' => 'text/x-sony-bbeb+xml',
        'lrf' => 'application/x-sony-bbeb',
        'lrx' => 'application/x-sony-bbeb',
        'ncx' => 'application/x-dtbncx+xml',
        'opf' => 'application/oebps-package+xml',
        'otf' => 'application/x-font-opentype',
        'pdb' => 'application/vnd.palm',
        'pdf' => 'application/pdf',
        'prc' => 'application/x-mobipocket-ebook',
        'rtf' => 'application/rtf',
        'svg' => 'image/svg+xml',
        'ttf' => 'application/x-font-truetype',
        'tpz' => 'application/x-topaz-ebook',
        'wav' => 'audio/wav',
        'wmf' => 'image/wmf',
        'xhtml' => 'application/xhtml+xml',
        'xpgt' => 'application/adobe-page-template+xml',
        'zip' => 'application/zip',
    );

    public function __construct($post, $book = null) {
        $this->id = $post->id;
        $this->name = $post->name;
        $this->format = $post->format;
        $this->realFormat = str_replace("ORIGINAL_", "", $post->format);
        $this->extension = strtolower($this->realFormat);
        $this->book = $book;
    }

    public function isKnownType() {
        return array_key_exists($this->extension, self::$mimetypes);
    }

    public function getMimeType() {
        $result = "application/octet-stream";
        if ($this->isKnownType()) {
            return self::$mimetypes[$this->extension];
        } elseif (function_exists('finfo_open') === true) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);

            if (is_resource($finfo) === true) {
                $result = finfo_file($finfo, $this->getLocalPath());
            }

            finfo_close($finfo);

        }
        return $result;
    }

    public function isEpubValidOnKobo() {
        return $this->format == "EPUB" || $this->format == "KEPUB";
    }

    public function getFilename() {
        return $this->name . "." . strtolower($this->format);
    }

    public function getUpdatedFilename() {
        return $this->book->getAuthorsSort() . " - " . $this->book->title;
    }

    public function getUpdatedFilenameEpub() {
        return $this->getUpdatedFilename() . ".epub";
    }

    public function getUpdatedFilenameKepub() {
        $str = $this->getUpdatedFilename() . ".kepub.epub";
        return str_replace(array(':', '#', '&'),
            array('-', '-', ' '), $str);
    }

    public function getDataLink($rel, $title = NULL) {
        return self::getLink($this->book, $this->extension, $this->getMimeType(), $rel, $this->getFilename(), $this->id, $title);
    }

    public function getHtmlLink() {
        return $this->getDataLink(Link::OPDS_ACQUISITION_TYPE)->href;
    }

    public function getLocalPath() {
        $root = Filesystem::getRoot();
        return Config::getApp('concos_absolute_data_path', '') . $root . $this->book->path . "/" . $this->getFilename();

    }

    public function getHtmlLinkWithRewriting($title = NULL) {

        $database = "";
        if (!is_null(GetUrlParam(DB))) {
            $database = GetUrlParam(DB) . "/";
        }

        $href = "download/" . $this->id . "/" . $database;

        if (Config::get('concos_provide_kepub', 'false') === 'false' &&
            $this->isEpubValidOnKobo() &&
            preg_match("/Kobo/", $_SERVER['HTTP_USER_AGENT'])) {
            $href .= rawurlencode($this->getUpdatedFilenameKepub());
        } else {
            $href .= rawurlencode($this->getFilename());
        }
        return new Link($href, $this->getMimeType(), Link::OPDS_ACQUISITION_TYPE, $title);
    }

    public static function getDataByBook($book) {
        $out = array();
        $result = parent::getDb()->prepare('select id, format, name
                                             from data where book = ?');
        $result->execute(array($book->id));

        while ($post = $result->fetchObject()) {
            array_push($out, new Data($post, $book));
        }
        return $out;
    }

    public static function handleThumbnailLink($urlParam, $height) {

        if (is_null($height)) {
            if (preg_match('/index.php/', $_SERVER["SCRIPT_NAME"])) {
                $height = Config::getApp('concos_thumb_y', '36');
            } else {
                $height = Config::getApp('concos_cover_y', '200');
            }
        }
        $urlParam = addURLParameter($urlParam, "height", $height);

        return $urlParam;
    }

    public static function getLink($book, $type, $mime, $rel, $filename, $idData, $title = NULL, $height = NULL) {

        $urlParam = addURLParameter("", "data", $idData);

        if (Base::useAbsolutePath() ||
            $rel == Link::OPDS_THUMBNAIL_TYPE) {
            if ($type != "jpg") {
                $urlParam = addURLParameter($urlParam, "type", $type);
            }

            if ($rel == Link::OPDS_THUMBNAIL_TYPE) {
                $urlParam = self::handleThumbnailLink($urlParam, $height);
            }
            $urlParam = addURLParameter($urlParam, "id", $book->id);
            if (!is_null(GetUrlParam(DB))) {
                $urlParam = addURLParameter($urlParam, DB, GetUrlParam(DB));
            }

            return new Link("fetch.php?" . $urlParam, $mime, $rel, $title);
        } else {
            return new Link(str_replace('%2F', '/', rawurlencode($book->path . "/" . $filename)), $mime, $rel, $title);
        }
    }
}
