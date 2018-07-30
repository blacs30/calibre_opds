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

class Serie extends Base {
    const ALL_SERIES_ID = "cops:series";
    const SERIES_COLUMNS = "series.id as id, series.name as name, series.sort as sort, count(*) as count";
    const SQL_ALL_SERIES = "select {0} from series, books_series_link where series.id = series group by series.id, series.name, series.sort order by series.sort";
    const SQL_SERIES_FOR_SEARCH = "select {0} from series, books_series_link where series.id = series and upper (series.name) like ? group by series.id, series.name, series.sort order by series.sort";

    public $id;
    public $name;

    public function __construct($post) {
        $this->id = $post->id;
        $this->name = $post->name;
    }

    public function getUri() {
        return "?page=" . parent::PAGE_SERIE_DETAIL . "&id=$this->id";
    }

    public function getEntryId() {
        return self::ALL_SERIES_ID . ":" . $this->id;
    }

    public static function getCount() {
        // str_format (localize("series.alphabetical", count(array))
        return parent::getCountGeneric("series", self::ALL_SERIES_ID, parent::PAGE_ALL_SERIES);
    }

    public static function getSerieByBookId($bookId) {
        $result = parent::getDb()->prepare('select  series.id as id, name
from books_series_link, series
where series.id = series and book = ?');
        $result->execute(array($bookId));
        if ($post = $result->fetchObject()) {
            return new Serie($post);
        }
        return NULL;
    }

    public static function getSerieById($serieId) {
        $result = parent::getDb()->prepare('select id, name  from series where id = ?');
        $result->execute(array($serieId));
        if ($post = $result->fetchObject()) {
            return new Serie($post);
        }
        return NULL;
    }

    public static function getAllSeries() {
        return Base::getEntryArrayWithBookNumber(self::SQL_ALL_SERIES, self::SERIES_COLUMNS, array(), "OCA\Calibre_opds\Serie");
    }

    public static function getAllSeriesByQuery($query) {
        return Base::getEntryArrayWithBookNumber(self::SQL_SERIES_FOR_SEARCH, self::SERIES_COLUMNS, array('%' . $query . '%'), "OCA\Calibre_opds\Serie");
    }
}
