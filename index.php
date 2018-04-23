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

require_once 'base.php';

Util::authenticateUser();

/* Refuse access if user disabled opds support */
if (Config::get('enable', 'false') === 'false') {
    Util::changeHttpStatus(403);
    exit();
}

header('Content-Type:application/xml');
$page = getURLParam('page', Base::PAGE_INDEX);
$query = getURLParam('query');
$n = getURLParam('n', '1');
if ($query) {
    $page = Base::PAGE_OPENSEARCH_QUERY;
}
$qid = getURLParam('id');

/* id defaults to 'root' (meaning 'serve root feed') */
$id = isset($_GET['id']) ? $_GET['id'] : 'root';

/* if either pid or tid is set, serve preview image for id */
if (isset($_GET['pid'])) {
    $id = (int) $_GET['pid'];
    $type = 'cover';
}

if (isset($_GET['tid'])) {
    $id = (int) $_GET['tid'];
    $type = 'thumbnail';
}

$OPDSRender = new OPDSRenderer();

switch ($page) {
    case Base::PAGE_OPENSEARCH :
        echo $OPDSRender->getOpenSearch();
        return;
    default:
        $currentPage = Page::getPage($page, $qid, $query, $n);
        $currentPage->InitializeContent();
        echo $OPDSRender->render($currentPage);
        return;
}
