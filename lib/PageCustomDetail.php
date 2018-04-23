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

class PageCustomDetail extends Page
{
    public function InitializeContent ()
    {
        $customId = getURLParam ("custom", NULL);
        $this->idPage = $custom->getEntryId ();
        $this->title = $custom->value;
        list ($this->entryArray, $this->totalNumber) = Book::getBooksByCustom ($custom, $this->idGet, $this->n);
    }
}
