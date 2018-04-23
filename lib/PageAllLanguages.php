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

class PageAllLanguages extends Page
{
    public function InitializeContent ()
    {
        $this->title = localize("languages.title");
        $this->entryArray = Language::getAllLanguages();
        $this->idPage = Language::ALL_LANGUAGES_ID;
    }
}
