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

class PagePublisherDetail extends Page {
    public function InitializeContent() {
        $publisher = Publisher::getPublisherById($this->idGet);
        $this->title = $publisher->name;
        list($this->entryArray, $this->totalNumber) = Book::getBooksByPublisher($this->idGet, $this->n);
        $this->idPage = $publisher->getEntryId();
    }
}
