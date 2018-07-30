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

/** @var $this \OCP\Route\IRouter */
// Settings pages
$this->create('opds_catalog', '/')
    ->actionInclude('calibre_opds/index.php');
$this->create('opds_catalog_index', '/index.php')
    ->actionInclude('calibre_opds/index.php');
$this->create('opds_catalog_fetch', '/fetch.php')
    ->actionInclude('calibre_opds/fetch.php');
$this->create('opds_checkconfig', '/checkconfig.php')
    ->actionInclude('calibre_opds/checkconfig.php');
$this->create('opds_catalog_admin_settings', 'ajax/admin.php')
    ->actionInclude('calibre_opds/ajax/admin.php');
$this->create('opds_catalog_personal_settings', 'ajax/personal.php')
    ->actionInclude('calibre_opds/ajax/personal.php');
