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

namespace OCA\Concos;

require_once 'base.php';

Util::authenticateUser();

/* Refuse access if user disabled opds support */
if (Config::get('enable', 'false') === 'false') {
    Util::changeHttpStatus(403);
    exit();
}

    $expires = 60*60*24*14;
    header('Pragma: public');
    header('Cache-Control: max-age=' . $expires);
    header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');
    $bookId   = getURLParam('id', NULL);
    $type     = getURLParam('type', 'jpg');
    $idData   = getURLParam('data', NULL);
    $viewOnly = getURLParam('view', FALSE);

    if (is_null($bookId)) {
        $book = Book::getBookByDataId($idData);
    } else {
        $book = Book::getBookById($bookId);
    }

    if (!$book) {
        notFound ();
        return;
    }

    if ($book && ($type == 'jpg' || empty (Config::get('concos_user_calibre_path', '/Library')))) {
        if ($type == 'jpg') {
            $file = $book->getFilePath($type);
        } else {
            $file = $book->getFilePath($type, $idData);
        }
        if (is_null($file) || !file_exists($file)) {
            notFound();
            return;
        }
    }

    switch ($type)
    {
        case 'jpg':
            header('Content-Type: image/jpeg');
            //by default, we don't cache
            $thumbnailCacheFullpath = null;

            if ($book->getThumbnail (getURLParam('width'), getURLParam('height'), $thumbnailCacheFullpath)) {
                //if we don't cache the thumbnail, imagejpeg() in $book->getThumbnail() already return the image data
                // The cover has to be resized
                return;
            }
            break;
        default:
            $data = $book->getDataById($idData);
            header('Content-Type: ' . $data->getMimeType());
            break;
    }
    $file = $book->getFilePath($type, $idData, true);
    if ($type == 'jpg') {
        header('Content-Disposition: filename="' . basename($file) . '"');
    } elseif ($viewOnly) {
        header('Content-Disposition: inline');
    } else {
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    }

    $dir = \OC\Files\Filesystem::normalizePath(Config::get('concos_user_calibre_path', '/Library'));
    if (empty(Config::get('concos_user_calibre_path', '/Library'))) {
        $dir = \OC\Files\Filesystem::normalizePath(Base::getDbDirectory());
    }

    /*
    * Wich header to use when downloading books outside the web directory
    * Possible values are :
    *   X-Accel-Redirect   : For Nginx
    *   X-Sendfile         : For Lightttpd or Apache (with mod_xsendfile)
    *   No value (default) : Let PHP handle the download
    */
    // if (empty(Config::getApp('cops_x_accel_redirect_accel_redirect', ''))) {

        $filename = \OC\Files\Filesystem::normalizePath($dir . '/' . $file);
        $fp = \OC\Files\Filesystem::fopen($filename, 'rb');
        header('Content-Length: ' . \OC\Files\Filesystem::filesize($filename));
        fpassthru($fp);
    // } else {
        // header(Config::getApp('cops_x_accel_redirect', '') . ': ' . $dir . $file);
    // }
