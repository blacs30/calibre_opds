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

class PageAllTags extends Page
{
    public function InitializeContent ()
    {
        $this->title = localize("tags.title");
        $this->entryArray = Tag::getAllTags();
        $this->idPage = Tag::ALL_TAGS_ID;
    }
}
