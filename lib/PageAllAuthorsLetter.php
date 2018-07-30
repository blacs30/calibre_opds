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

class PageAllAuthorsLetter extends Page {
    public function InitializeContent() {
        $this->idPage = Author::getEntryIdByLetter($this->idGet);
        $this->entryArray = Author::getAuthorsByStartingLetter($this->idGet);
        $this->title = str_format(localize("splitByLetter.letter"), str_format(localize("authorword", count($this->entryArray)), count($this->entryArray)), $this->idGet);
    }
}
