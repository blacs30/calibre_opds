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

$l = \OC::$server->getL10N('calibre_opds');

// function checkBox($format) {
//     foreach($format as $name => $enabled) {
//         echo '<input type="checkbox" class="checkbox" id="opds-preview-' . $name . '" name="opds-preview-' . $name . '" ' . ($enabled == 1 ? 'checked >' : '>');
//         echo '<label for="opds-preview-' . $name . '">' . $name . '</label>';
//     }
// }

?>

<div class="section" id="opds-admin">
	<table>
	<tr>
                <td><h2><?php p($l->t('Concos'));?></h2></td><td>&nbsp;<span class="msg"></span></td>
	</tr>
	</table>
	<table>
        <tr>
                <td><label for="concos-feed-subtitle"><?php p($l->t('Feed subtitle:'))?></label></td>
                <td><input type="text" id="concos-feed-subtitle" title="<?php p($l->t("Enter subtitle for OPDS catalog."));?>" value="<?php p($_['feedSubtitle'])?>" /></td>
        </tr>
        <tr>
                <td><label for="concos-author-name"><?php p($l->t('Concos author Name:'))?></label></td>
                <td><input type="text" id="concos-author-name" title="<?php p($l->t("Enter the name for the OPDS author."));?>" value="<?php p($_['concosAuthorName'])?>" /></td>
        </tr>
        <tr>
                <td><label for="concos-author-uri"><?php p($l->t('Concos author URI:'))?></label></td>
                <td><input type="text" id="concos-author-uri" title="<?php p($l->t("Enter the URI for the author of concos."));?>" value="<?php p($_['concosAuthorUri'])?>" /></td>
        </tr>
        <tr>
                <td><label for="concos-author-email"><?php p($l->t('Concos author email:'))?></label></td>
                <td><input type="text" id="concos-author-email" title="<?php p($l->t("Enter the email for the author of concos."));?>" value="<?php p($_['concosAuthorEmail'])?>" /></td>
        </tr>
        <tr>
                <td><label for="concos-absolute-data-path"><?php p($l->t('Absolute Nextcloud data path:'))?></label></td>
                <td><input type="text" id="concos-absolute-data-path" title="<?php p($l->t("Absolute Nextcloud data path without trailing directory separator."));?>" value="<?php p($_['concosAbsoluteDataPath'])?>" /></td>
        </tr>
	</table>
        <div>
		<p><?php p($l->t('Cover size'));?></p>
                <label for="concos-cover-x"><?php p($l->t('width'))?></label>
                <input type="text" id="concos-cover-x" title="<?php p($l->t("Enter cover image width in pixels"));?>" value="<?php p($_['concosCoverX'])?>" />
                <label for="concos-cover-y"><?php p($l->t('height'))?></label>
                <input type="text" id="concos-cover-y" title="<?php p($l->t("Enter cover image height in pixels"));?>" value="<?php p($_['concosCoverY'])?>" />
        </div>
        <div>
		<p><?php p($l->t('Cover thumbnail size'));?></p>
                <label for="concos-thumb-x"><?php p($l->t('width'))?></label>
                <input type="text" id="concos-thumb-x" title="<?php p($l->t("Enter thumbnail width in pixels"));?>" value="<?php p($_['concosThumbX'])?>" />
                <label for="concos-thumb-y"><?php p($l->t('height'))?></label>
                <input type="text" id="concos-thumb-y" title="<?php p($l->t("Enter thumbnail height in pixels"));?>" value="<?php p($_['concosThumbY'])?>" />
        </div>
</div>

