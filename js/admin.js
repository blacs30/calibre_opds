$(document).ready(function(){
	// save settings
        var opdsAdminMiscSettings = {
                save : function() {
                        var data = {
                                concosAbsoluteDataPath : $('#concos-absolute-data-path').val(),
                                concosCoverX : $('#concos-cover-x').val(),
                                concosCoverY : $('#concos-cover-y').val(),
                                concosThumbX : $('#concos-thumb-x').val(),
                                concosThumbY : $('#concos-thumb-y').val(),
				                concosFeedSubtitle : $('#concos-feed-subtitle').val(),
                                concosAuthorName : $('#concos-author-name').val(),
                                concosAuthorUri : $('#concos-author-uri').val(),
                                concosAuthorEmail : $('#concos-author-email').val(),
                        };
                        OC.msg.startSaving('#opds-admin .msg');
                        $.post(OC.filePath('concos', 'ajax', 'admin.php'), data, opdsAdminMiscSettings.afterSave);
                },
                afterSave : function(data){
                        OC.msg.finishedSaving('#opds-admin .msg', data);
                }
        };

        $('#concos-cover-x,#concos-cover-y,#concos-thumb-x,#concos-thumb-y,#concos-feed-subtitle,#concos-absolute-data-path,#concos-author-name,#concos-author-uri,#concos-author-email').blur(opdsAdminMiscSettings.save);
        $('#concos-cover-x,#concos-cover-y,#concos-thumb-x,#concos-thumb-y,#concos-feed-subtitle,#concos-absolute-data-path,#concos-author-name,#concos-author-uri,#concos-author-email').keypress(function( event ) {
                                                if (event.which == 13) {
                                                  event.preventDefault();
                                                  opdsAdminMiscSettings.save();
                                                }
        });

});

