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

use OCP\Util;

$l = \OC::$server->getL10N('calibre_opds');

$tmpl = new \OCP\Template('calibre_opds', 'personal');
$concosEnable = Config::get('enable', false);
$tmpl->assign('concosEnable-checked', ($concosEnable === 'true') ? 'checked="checked"' : '');
$tmpl->assign('concosEnable-value', ($concosEnable === 'true') ? '1' : '0');
$concosShowIcons = Config::get('concos_show_icons', false);
$tmpl->assign('concosShowIcons-checked', ($concosShowIcons === 'true') ? 'checked="checked"' : '');
$tmpl->assign('concosShowIcons-value', ($concosEnable === 'true') ? '1' : '0');
$concosProvideKepub = Config::get('concos_provide_kepub', false);
$tmpl->assign('concosProvideKepub-checked', ($concosProvideKepub === 'true') ? 'checked="checked"' : '');
$tmpl->assign('concosProvideKepub-value', ($concosProvideKepub === 'true') ? '1' : '0');
$concosGenerateInvalidOpdsStream = Config::get('concos_generate_invalid_opds_stream', false);
$tmpl->assign('concosGenerateInvalidOpdsStream-checked', ($concosGenerateInvalidOpdsStream === 'true') ? 'checked="checked"' : '');
$tmpl->assign('concosGenerateInvalidOpdsStream-value', ($concosGenerateInvalidOpdsStream === 'true') ? '1' : '0');
$concosAuthorSplitFirstLetter = Config::get('concos_author_split_first_letter', false);
$tmpl->assign('concosAuthorSplitFirstLetter-checked', ($concosAuthorSplitFirstLetter === 'true') ? 'checked="checked"' : '');
$tmpl->assign('concosAuthorSplitFirstLetter-value', ($concosAuthorSplitFirstLetter === 'true') ? '1' : '0');
$concosTitleSplitFirstLetter = Config::get('concos_titles_split_first_letter', false);
$tmpl->assign('concosTitleSplitFirstLetter-checked', ($concosTitleSplitFirstLetter === 'true') ? 'checked="checked"' : '');
$tmpl->assign('concosTitleSplitFirstLetter-value', ($concosTitleSplitFirstLetter === 'true') ? '1' : '0');
$tmpl->assign('concosIgnoredCategories', Config::get('concos_ignored_categories', ''));
$tmpl->assign('concosFullUrl', Config::get('concos_full_url', ''));

$tmpl->assign('concosUserCalibrePath', Config::get('concos_user_calibre_path', '/Library'));
$tmpl->assign('concosLanguage', Config::get('concos_language', 'en'));
$tmpl->assign('concosMaxItemPerPage', Config::get('concos_max_item_per_page', '-1'));
$tmpl->assign('concosRecentBooksLimit', Config::get('concos_recentbooks_limit', '50'));
$tmpl->assign('concosFeedTitle', Config::get('concos_feed_title', $l->t("%s's Library", \OCP\User::getDisplayName())));
$tmpl->assign('concosFeedUrl', Util::linkToAbsolute('', 'index.php') . '/apps/calibre_opds/index.php');

return $tmpl->fetchPage();
