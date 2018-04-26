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

\OCP\JSON::callCheck();
\OCP\JSON::checkLoggedIn();
$defaults = new \OC_Defaults();

$l = \OC::$server->getL10N('concos');

	// set dimensions, using sane defaults just in case
	$concosAbsoluteDataPath = isset($_POST['concosAbsoluteDataPath']) ? $_POST['concosAbsoluteDataPath'] : '/var/www/html/data';
	$concosCoverX = isset($_POST['concosCoverX']) ? (int) $_POST['concosCoverX'] : 200;
	$concosCoverY = isset($_POST['concosCoverY']) ? (int) $_POST['concosCoverY'] : 200;
	$concosThumbX = isset($_POST['concosThumbX']) ? (int) $_POST['concosThumbX'] : 36;
	$concosThumbY = isset($_POST['concosThumbY']) ? (int) $_POST['concosThumbY'] : 36;
	$concosFeedSubtitle = isset($_POST['concosFeedSubtitle']) ? $_POST['concosFeedSubtitle'] : $l->t("%s OPDS catalog", $defaults->getName());
	$concosAuthorName = isset($_POST['concosAuthorName']) ? $_POST['concosAuthorName'] : 'Claas Lisowski';
	$concosAuthorUri = isset($_POST['concosAuthorUri']) ? $_POST['concosAuthorUri'] : 'https://github.com/blacs30/concos';
	$concosAuthorEmail = isset($_POST['concosAuthorEmail']) ? $_POST['concosAuthorEmail'] : 'github@lisowski-developent.com';

	Config::setApp('concos_absolute_data_path', $concosAbsoluteDataPath);
	Config::setApp('concos_cover_x', $concosCoverX);
	Config::setApp('concos_cover_y', $concosCoverY);
	Config::setApp('concos_thumb_x', $concosThumbX);
	Config::setApp('concos_thumb_y', $concosThumbX);
	Config::setApp('concos_feed_subtitle', $concosFeedSubtitle);
    Config::setApp('concos_author_name', $concosAuthorName);
    Config::setApp('concos_author_uri', $concosAuthorUri);
    Config::setApp('concos_author_email', $concosAuthorEmail);


\OCP\JSON::success(
array(
	'data' => array('message'=> $l->t('Settings updated successfully.'))
	)
);

exit();

