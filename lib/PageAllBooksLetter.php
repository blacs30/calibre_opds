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

class PageAllBooksLetter extends Page {
    public function InitializeContent() {
        list($this->entryArray, $this->totalNumber) = Book::getBooksByStartingLetter($this->idGet, $this->n);
        $this->idPage = Book::getEntryIdByLetter($this->idGet);

        $count = $this->totalNumber;
        if ($count == -1) {
            $count = count($this->entryArray);
        }

        $this->title = str_format(localize("splitByLetter.letter"), str_format(localize("bookword", $count), $count), $this->idGet);
    }
}
