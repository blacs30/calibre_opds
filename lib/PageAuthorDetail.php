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

class PageAuthorDetail extends Page {
    public function InitializeContent() {
        $author = Author::getAuthorById($this->idGet);
        $this->idPage = $author->getEntryId();
        $this->title = $author->name;
        list($this->entryArray, $this->totalNumber) = Book::getBooksByAuthor($this->idGet, $this->n);
    }
}
