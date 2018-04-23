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

class PageBookDetail extends Page
{
    public function InitializeContent ()
    {
        $this->book = Book::getBookById ($this->idGet);
        $this->title = $this->book->title;
    }
}
