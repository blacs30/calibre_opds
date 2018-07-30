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

class PageLanguageDetail extends Page {
    public function InitializeContent() {
        $language = Language::getLanguageById($this->idGet);
        $this->idPage = $language->getEntryId();
        $this->title = $language->lang_code;
        list($this->entryArray, $this->totalNumber) = Book::getBooksByLanguage($this->idGet, $this->n);
    }
}
