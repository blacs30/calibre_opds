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

class PageAllBooks extends Page
{
    public function InitializeContent ()
    {
        $this->title = localize ("allbooks.title");
        if (Config::get('concos_titles_split_first_letter', 'false') === 'true') {
            $this->entryArray = Book::getAllBooks();
        }
        else {
            list ($this->entryArray, $this->totalNumber) = Book::getBooks ($this->n);
        }
        $this->idPage = Book::ALL_BOOKS_ID;
    }
}
