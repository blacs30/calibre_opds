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

class PageAllPublishers extends Page {
    public function InitializeContent() {
        $this->title = localize("publishers.title");
        $this->entryArray = Publisher::getAllPublishers();
        $this->idPage = Publisher::ALL_PUBLISHERS_ID;
    }
}
