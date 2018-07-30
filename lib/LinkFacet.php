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

class LinkFacet extends Link {
    public function __construct($phref, $ptitle = NULL, $pfacetGroup = NULL, $pactiveFacet = FALSE) {
        parent::__construct($phref, Link::OPDS_PAGING_TYPE, "http://opds-spec.org/facet", $ptitle, $pfacetGroup, $pactiveFacet);
        if (!is_null(GetUrlParam(DB))) {
            $this->href = addURLParameter($this->href, DB, GetUrlParam(DB));
        }

        $this->href = $this->href;
    }
}
