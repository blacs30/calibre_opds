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

class Page
{
    public $title;
    public $subtitle = "";
    public $authorName = "";
    public $authorUri = "";
    public $authorEmail = "";
    public $idPage;
    public $idGet;
    public $query;
    public $n;
    public $book;
    public $totalNumber = -1;

    /* @var Entry[] */
    public $entryArray = array();

    public static function getPage ($pageId, $id, $query, $n)
    {
        switch ($pageId) {
            case Base::PAGE_ALL_AUTHORS :
                return new PageAllAuthors ($id, $query, $n);
            case Base::PAGE_AUTHORS_FIRST_LETTER :
                return new PageAllAuthorsLetter ($id, $query, $n);
            case Base::PAGE_AUTHOR_DETAIL :
                return new PageAuthorDetail ($id, $query, $n);
            case Base::PAGE_ALL_TAGS :
                return new PageAllTags ($id, $query, $n);
            case Base::PAGE_TAG_DETAIL :
                return new PageTagDetail ($id, $query, $n);
            case Base::PAGE_ALL_LANGUAGES :
                return new PageAllLanguages ($id, $query, $n);
            case Base::PAGE_LANGUAGE_DETAIL :
                return new PageLanguageDetail ($id, $query, $n);
            case Base::PAGE_ALL_RATINGS :
                return new PageAllRating ($id, $query, $n);
            case Base::PAGE_RATING_DETAIL :
                return new PageRatingDetail ($id, $query, $n);
            case Base::PAGE_ALL_SERIES :
                return new PageAllSeries ($id, $query, $n);
            case Base::PAGE_ALL_BOOKS :
                return new PageAllBooks ($id, $query, $n);
            case Base::PAGE_ALL_BOOKS_LETTER:
                return new PageAllBooksLetter ($id, $query, $n);
            case Base::PAGE_ALL_RECENT_BOOKS :
                return new PageRecentBooks ($id, $query, $n);
            case Base::PAGE_SERIE_DETAIL :
                return new PageSerieDetail ($id, $query, $n);
            case Base::PAGE_OPENSEARCH_QUERY :
                return new PageQueryResult ($id, $query, $n);
            case Base::PAGE_BOOK_DETAIL :
                return new PageBookDetail ($id, $query, $n);
            case Base::PAGE_ALL_PUBLISHERS:
                return new PageAllPublishers ($id, $query, $n);
            case Base::PAGE_PUBLISHER_DETAIL :
                return new PagePublisherDetail ($id, $query, $n);
            case Base::PAGE_ABOUT :
                return new PageAbout ($id, $query, $n);
            case Base::PAGE_CUSTOMIZE :
                return new PageCustomize ($id, $query, $n);
            default:
                $page = new Page ($id, $query, $n);
                $page->idPage = "cops:catalog";
                return $page;
        }
    }

    public function __construct($pid, $pquery, $pn) {
        $this->idGet = $pid;
        $this->query = $pquery;
        $this->n = $pn;
        $this->authorName = Config::getApp('concos_author_name', '');
        $this->authorUri = Config::getApp('concos_author_uri', '');
        $this->authorEmail = Config::getApp('concos_author_email', '');
    }

    public function InitializeContent ()
    {
        $this->title = Config::get('concos_feed_title', '');
        $this->subtitle = Config::getApp('concos_feed_subtitle', '');
        if (Base::noDatabaseSelected ()) {
            $i = 0;
            foreach (Base::getDbNameList () as $key) {
                $nBooks = Book::getBookCount ($i);
                // echo $nBooks;
                array_push ($this->entryArray, new Entry ($key, "cops:{$i}:catalog",
                                        str_format (localize ("bookword", $nBooks), $nBooks), "text",
                                        array ( new LinkNavigation ("?" . DB . "={$i}")), "", $nBooks));
                $i++;
                Base::clearDb ();
            }
        } else {
            $ignored_categories = array_filter(explode(',', Config::get('concos_ignored_categories', '')));
            if (!in_array (PageQueryResult::SCOPE_AUTHOR, $ignored_categories)) {
                array_push ($this->entryArray, Author::getCount());
            }
            if (!in_array (PageQueryResult::SCOPE_SERIES, $ignored_categories)) {
                $series = Serie::getCount();
                if (!is_null ($series)) array_push ($this->entryArray, $series);
            }
            if (!in_array (PageQueryResult::SCOPE_PUBLISHER, $ignored_categories)) {
                $publisher = Publisher::getCount();
                if (!is_null ($publisher)) array_push ($this->entryArray, $publisher);
            }
            if (!in_array (PageQueryResult::SCOPE_TAG, $ignored_categories)) {
                $tags = Tag::getCount();
                if (!is_null ($tags)) array_push ($this->entryArray, $tags);
            }
            if (!in_array (PageQueryResult::SCOPE_RATING, $ignored_categories)) {
                $rating = Rating::getCount();
                if (!is_null ($rating)) array_push ($this->entryArray, $rating);
            }
            if (!in_array ("language", $ignored_categories)) {
                $languages = Language::getCount();
                if (!is_null ($languages)) array_push ($this->entryArray, $languages);
            }

            $this->entryArray = array_merge ($this->entryArray, Book::getCount());

            if (Base::isMultipleDatabaseEnabled ()) $this->title =  Base::getDbName ();
        }
    }

    public function isPaginated ()
    {
        return (Config::get('concos_max_item_per_page','-1') != -1 &&
                $this->totalNumber != -1 &&
                $this->totalNumber > Config::get('concos_max_item_per_page','-1'));
    }

    public function getNextLink ()
    {
        $currentUrl = preg_replace ("/\&n=.*?$/", "", "?" . getQueryString ());
        if (($this->n) * Config::get('concos_max_item_per_page','-1') < $this->totalNumber) {
            return new LinkNavigation ($currentUrl . "&n=" . ($this->n + 1), "next", localize ("paging.next.alternate"));
        }
        return NULL;
    }

    public function getPrevLink ()
    {
        $currentUrl = preg_replace ("/\&n=.*?$/", "", "?" . getQueryString ());
        if ($this->n > 1) {
            return new LinkNavigation ($currentUrl . "&n=" . ($this->n - 1), "previous", localize ("paging.previous.alternate"));
        }
        return NULL;
    }

    public function getMaxPage ()
    {
        return ceil ($this->totalNumber / Config::get('concos_max_item_per_page','-1'));
    }

    public function containsBook ()
    {
        if (count ($this->entryArray) == 0) return false;
        if (get_class ($this->entryArray [0]) == "OCA\Concos\EntryBook") return true;
        return false;
    }
}
