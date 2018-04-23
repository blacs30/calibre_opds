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

class PageRatingDetail extends Page
{
    public function InitializeContent ()
    {
        $rating = Rating::getRatingById ($this->idGet);
        $this->idPage = $rating->getEntryId ();
        $this->title =str_format (localize ("ratingword", $rating->name/2), $rating->name/2);
        list ($this->entryArray, $this->totalNumber) = Book::getBooksByRating ($this->idGet, $this->n);
    }
}
