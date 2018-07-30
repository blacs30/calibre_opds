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

script('calibre_opds', 'personal');
style('calibre_opds', 'settings');

?>

<div class="section" id="concos-personal">
        <table>
        <tr>
                <td><h2><?php p($l->t('Concos'));?></h2></td><td>&nbsp;<span class="msg"></span></td>
        </tr>
        </table>
        <div>
		<input id="concos-enable" name="concos-enable" value="<?php p($_['concosEnable-value'])?>" <?php p($_['concosEnable-checked'])?> type="checkbox" class="checkbox">
                <label for="concos-enable"><?php p($l->t('enable Concos (Calibre on Nextcloud OPDS Server'))?></label>
	</div>
        <br>
        <div>
                <input id="concos-author-split-first-letter" name="concos-author-split-first-letter" value="<?php p($_['concosAuthorSplitFirstLetter-value'])?>" <?php p($_['concosAuthorSplitFirstLetter-checked'])?> type="checkbox" class="checkbox">
                <label for="concos-author-split-first-letter"><?php p($l->t('Split authors by firstname'))?></label>
        </div>
        <div>
                <input id="concos-title-split-first-letter" name="concos-title-split-first-letter" value="<?php p($_['concosTitleSplitFirstLetter-value'])?>" <?php p($_['concosTitleSplitFirstLetter-checked'])?> type="checkbox" class="checkbox">
                <label for="concos-title-split-first-letter"><?php p($l->t('Split titles by firstname'))?></label>
        </div>
        <div>
                <input id="concos-show-icons" name="concos-show-icons" value="<?php p($_['concosShowIcons-value'])?>" <?php p($_['concosShowIcons-checked'])?> type="checkbox" class="checkbox">
                <label for="concos-show-icons"><?php p($l->t('Show icons'))?></label>
        </div>
        <div>
                <input id="concos-generate-invalid-opds-stream" name="concos-generate-invalid-opds-stream" value="<?php p($_['concosGenerateInvalidOpdsStream-value'])?>" <?php p($_['concosGenerateInvalidOpdsStream-checked'])?> type="checkbox" class="checkbox">
                <label for="concos-generate-invalid-opds-stream"><?php p($l->t('Generate invalid OPDS stream'))?></label>
        </div>
        <div>
                <input id="concos-provide-kepub" name="concos-provide-kepub" value="<?php p($_['concosProvideKepub-value'])?>" <?php p($_['concosProvideKepub-checked'])?> type="checkbox" class="checkbox">
                <label for="concos-provide-kepub"><?php p($l->t('Provide EPubs for Kobo'))?></label>
        </div>
	<br>
	<table>
        <tr>
                <td><label for="concos-feed-title"><?php p($l->t('Feed title:'))?></label></td>
                <td><input type="text" id="concos-feed-title" title="<?php p($l->t("Enter title for OPDS catalog."));?>" value="<?php p($_['concosFeedTitle'])?>" /></td>
        </tr>
        <tr>
                <td><label for="concos-user-calibre-path"><?php p($l->t('User Calibre Library Path:'))?></label></td>
                <td><input type="text" id="concos-user-calibre-path" title="<?php p($l->t("Enter root directory for OPDS catalog."));?>" value="<?php p($_['concosUserCalibrePath'])?>" /></td>
        </tr>
        <tr>
                <td><label for="concos-max-item-per-page"><?php p($l->t('Max items per page:'))?></label></td>
                <td><input type="text" id="concos-max-item-per-page" title="<?php p($l->t("Enter the number of maximum items per page."));?>" value="<?php p($_['concosMaxItemPerPage'])?>" /></td>
        </tr>
        <tr>
                <td><label for="concos-recentbooks-limit"><?php p($l->t('Recent book additions limit:'))?></label></td>
                <td><input type="text" id="concos-recentbooks-limit" title="<?php p($l->t("Enter the number of maximum recent books to list."));?>" value="<?php p($_['concosRecentBooksLimit'])?>" /></td>
        </tr>
        <tr>
                <td><label for="concos-opds-full-url"><?php p($l->t('Full URL with trailing / - for some readers required:'))?></label></td>
                <td><input type="text" id="concos-opds-full-url" title="<?php p($l->t("For example Mantano, Aldiko and Marvin require it. - leave empty to not use it."));?>" value="<?php p($_['concosFullUrl'])?>" /></td>
        </tr>
        <tr>
                <td><label for="concos-language"><?php p($l->t('Language: '))?></label></td>
                <td><input type="text" id="concos-language" title="<?php p($l->t("Valid: en,da,de..."));?>" value="<?php p($_['concosLanguage'])?>" /></td>
        </tr>
        <tr>
                <td><label for="concos-ignored-categories"><?php p($l->t('Ignored categories:'))?></label></td>
                <td><input type="text" id="concos-ignored-categories" title="<?php p($l->t("Specify the ignored categories for the home screen and with search. Meaning that if you do not want to search in publishers or tags just add them from the list. Only accepted values: author,book,series,tag,publisher,rating,language - leave empty to not use it."));?>" value="<?php p($_['concosIgnoredCategories'])?>" /></td>
        </tr>
<!--  	<tr>
                <td><label for="concos-books-filter"><?php p($l->t('List tags to filter for:'))?></label></td>
                <td><input type="text" id="concos-books-filter" title="<?php p($l->t("Enter list of comma-separated tag list - leave empty to not use it."));?>" value="<?php p($_['concosBooksFilter'])?>" /></td>
        </tr> -->
	</table>
	<br>
	<div>
		<span><?php p($l->t("OPDS URL"));?>:</span>
		<code><?php p($_['concosFeedUrl']);?></code>
		<div><?php p($l->t("Use your Nextcloud username and password/application password."));?></div>
	</div>
</div>

