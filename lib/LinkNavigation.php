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

class LinkNavigation extends Link {
    public function __construct($phref, $prel = NULL, $ptitle = NULL) {
        parent::__construct($phref, Link::OPDS_NAVIGATION_TYPE, $prel, $ptitle);
        if (!is_null(GetUrlParam(DB))) {
            $this->href = addURLParameter($this->href, DB, GetUrlParam(DB));
        }

        if (!preg_match("#^\?(.*)#", $this->href) && !empty($this->href)) {
            $this->href = "?" . $this->href;
        }

        if (preg_match("/(bookdetail|getJSON).php/", parent::getScriptName())) {
            $this->href = "index.php" . $this->href;
        } else {
            $this->href = parent::getScriptName() . $this->href;
        }
    }
}
