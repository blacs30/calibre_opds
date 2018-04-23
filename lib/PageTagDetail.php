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

class PageTagDetail extends Page
{
    public function InitializeContent ()
    {
        $tag = Tag::getTagById ($this->idGet);
        $this->idPage = $tag->getEntryId ();
        $this->title = $tag->name;
        list ($this->entryArray, $this->totalNumber) = Book::getBooksByTag ($this->idGet, $this->n);
    }
}
