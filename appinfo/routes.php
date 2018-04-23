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
        ->actionInclude('concos/index.php');
$this->create('opds_catalog_index', '/index.php')
        ->actionInclude('concos/index.php');
$this->create('opds_catalog_fetch', '/fetch.php')
        ->actionInclude('concos/fetch.php');
$this->create('opds_checkconfig', '/checkconfig.php')
        ->actionInclude('concos/checkconfig.php');
$this->create('opds_catalog_admin_settings', 'ajax/admin.php')
        ->actionInclude('concos/ajax/admin.php');
$this->create('opds_catalog_personal_settings', 'ajax/personal.php')
        ->actionInclude('concos/ajax/personal.php');
