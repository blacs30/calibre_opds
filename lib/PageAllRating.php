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

class PageAllRating extends Page
{
    public function InitializeContent ()
    {
        $this->title = localize("ratings.title");
        $this->entryArray = Rating::getAllRatings();
        $this->idPage = Rating::ALL_RATING_ID;
    }
}
