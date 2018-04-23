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

$l = \OC::$server->getL10N('concos');

\OCP\Util::addScript('concos', 'admin');
\OCP\Util::addStyle('concos', 'settings');
$defaults = new \OC_Defaults();

$tmpl = new \OCP\Template('concos', 'admin');
$tmpl->assign('feedSubtitle', Config::getApp('feed-subtitle', $l->t("%s OPDS catalog", $defaults->getName())));
$tmpl->assign('concosAbsoluteDataPath', Config::getApp('concos_absolute_data_path', '/var/www/html/data'));
$tmpl->assign('concosCoverX', Config::getApp('concos_cover_x', '200'));
$tmpl->assign('concosCoverY', Config::getApp('concos_cover_y', '200'));
$tmpl->assign('concosThumbX', Config::getApp('concos_thumb_x', '36'));
$tmpl->assign('concosThumbY', Config::getApp('concos_thumb_y', '36'));
$tmpl->assign('concosAuthorName', Config::getApp('concos_author_name', 'Claas Lisowski' ));
$tmpl->assign('concosAuthorUri', Config::getApp('concos_author_uri', 'https://github.com/blacs30/nextcloud-calibre-opds' ));
$tmpl->assign('concosAuthorEmail', Config::getApp('concos_author_email', 'github@lisowski-development.com' ));

return $tmpl->fetchPage();
