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

class Link
{
    const OPDS_THUMBNAIL_TYPE = "http://opds-spec.org/image/thumbnail";
    const OPDS_IMAGE_TYPE = "http://opds-spec.org/image";
    const OPDS_ACQUISITION_TYPE = "http://opds-spec.org/acquisition";
    const OPDS_NAVIGATION_TYPE = "application/atom+xml;profile=opds-catalog;kind=navigation";
    const OPDS_PAGING_TYPE = "application/atom+xml;profile=opds-catalog;kind=acquisition";

    public $href;
    public $type;
    public $rel;
    public $title;
    public $facetGroup;
    public $activeFacet;

    public function __construct($phref, $ptype, $prel = NULL, $ptitle = NULL, $pfacetGroup = NULL, $pactiveFacet = FALSE) {
        $this->href = $phref;
        $this->type = $ptype;
        $this->rel = $prel;
        $this->title = $ptitle;
        $this->facetGroup = $pfacetGroup;
        $this->activeFacet = $pactiveFacet;
    }

    public function hrefXhtml () {
        return $this->href;
    }

    public function getScriptName() {
        $parts = explode('/', $_SERVER["SCRIPT_NAME"]);
        return $parts[count($parts) - 1];
    }
}
