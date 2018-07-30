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

class PageRecentBooks extends Page {
    public function InitializeContent() {
        $this->title = localize("recent.title");
        $this->entryArray = Book::getAllRecentBooks();
        $this->idPage = Book::ALL_RECENT_BOOKS_ID;
    }
}
