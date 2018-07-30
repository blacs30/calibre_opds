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

\OCP\JSON::callCheck();
\OCP\JSON::checkLoggedIn();

$l = \OC::$server->getL10N('calibre_opds');

$concosEnable = isset($_POST['concosEnable']) ? $_POST['concosEnable'] : 'false';
$concosProvideKepub = isset($_POST['concosProvideKepub']) ? $_POST['concosProvideKepub'] : 'false';
$concosShowIcons = isset($_POST['concosShowIcons']) ? $_POST['concosShowIcons'] : 'false';
$concosGenerateInvalidOpdsStream = isset($_POST['concosGenerateInvalidOpdsStream']) ? $_POST['concosGenerateInvalidOpdsStream'] : 'false';
$concosAuthorSplitFirstLetter = isset($_POST['concosAuthorSplitFirstLetter']) ? $_POST['concosAuthorSplitFirstLetter'] : 'false';
$concosTitleSplitFirstLetter = isset($_POST['concosTitleSplitFirstLetter']) ? $_POST['concosTitleSplitFirstLetter'] : 'false';
$concosUserCalibrePath = isset($_POST['concosUserCalibrePath']) ? $_POST['concosUserCalibrePath'] : '/Library';
$concosFullUrl = isset($_POST['concosFullUrl']) ? $_POST['concosFullUrl'] : '';
$concosBooksFilter = isset($_POST['concosBooksFilter']) ? $_POST['concosBooksFilter'] : '';
$concosIgnoredCategories = isset($_POST['concosIgnoredCategories']) ? $_POST['concosIgnoredCategories'] : '';
$concosMaxItemPerPage = isset($_POST['concosMaxItemPerPage']) ? $_POST['concosMaxItemPerPage'] : '-1';
$concosRecentBooksLimit = isset($_POST['concosRecentBooksLimit']) ? $_POST['concosRecentBooksLimit'] : '50';
$concosLanguage = isset($_POST['concosLanguage']) ? $_POST['concosLanguage'] : '';
$concosFeedTitle = isset($_POST['concosFeedTitle']) ? $_POST['concosFeedTitle'] : $l->t("%s's Library", \OCP\User::getDisplayName());

if (!strlen($concosUserCalibrePath) ||
    \OC\Files\Filesystem::isValidPath($concosUserCalibrePath . '/metadata.db') === false ||
    \OC\Files\Filesystem::file_exists($concosUserCalibrePath . '/metadata.db') === false) {
    \OCP\JSON::error(
        array(
            'data' => array('message' => $l->t('Directory does not exist or doesn not contain a Calibre library (metadata.db)!')),
        )
    );
} else {
    Config::set('concos_show_icons', $concosShowIcons);
    Config::set('concos_user_calibre_path', $concosUserCalibrePath);
    Config::set('concos_generate_invalid_opds_stream', $concosGenerateInvalidOpdsStream);
    Config::set('enable', $concosEnable);
    Config::set('concos_provide_kepub', $concosProvideKepub);
    Config::set('concos_books_filter', $concosBooksFilter);
    Config::set('concos_language', $concosLanguage);
    Config::set('concos_ignored_categories', $concosIgnoredCategories);
    Config::set('concos_full_url', $concosFullUrl);
    Config::set('concos_feed_title', $concosFeedTitle);
    Config::set('concos_author_split_first_letter', $concosAuthorSplitFirstLetter);
    Config::set('concos_titles_split_first_letter', $concosTitleSplitFirstLetter);
    Config::set('concos_max_item_per_page', $concosMaxItemPerPage);
    Config::set('concos_recentbooks_limit', $concosRecentBooksLimit);
    Config::set('id', Util::genUuid());

    \OCP\JSON::success(
        array(
            'data' => array('message' => $l->t('Settings updated successfully.')),
        )
    );
}

exit();
