$(document).ready(function(){

	// save settings
        var opdsSettings = {
                save : function() {
            var concosEnable = document.getElementById('concos-enable').checked ? 'true' : 'false';
            var concosAuthorSplitFirstLetter = document.getElementById('concos-author-split-first-letter').checked ? 'true' : 'false';
            var concosTitleSplitFirstLetter = document.getElementById('concos-title-split-first-letter').checked ? 'true' : 'false';
            var concosShowIcons = document.getElementById('concos-show-icons').checked ? 'true' : 'false';
            var concosProvideKepub = document.getElementById('concos-provide-kepub').checked ? 'true' : 'false';
			var concosGenerateInvalidOpdsStream = document.getElementById('concos-generate-invalid-opds-stream').checked ? 'true' : 'false';
                        var data = {
                                concosEnable : concosEnable,
                                concosGenerateInvalidOpdsStream : concosGenerateInvalidOpdsStream,
                                concosAuthorSplitFirstLetter : concosAuthorSplitFirstLetter,
                                concosTitleSplitFirstLetter : concosTitleSplitFirstLetter,
                                concosShowIcons : concosShowIcons,
                                concosProvideKepub : concosProvideKepub,
                                concosUserCalibrePath : $('#concos-user-calibre-path').val(),
                                concosIgnoredCategories : $('#concos-ignored-categories').val(),
                                concosFullUrl : $('#concos-opds-full-url').val(),
                                concosBooksFilter : $('#concos-books-filter').val(),
                                concosMaxItemPerPage : $('#concos-max-item-per-page').val(),
                                concosRecentBooksLimit : $('#concos-recentbooks-limit').val(),
                                concosLanguage : $('#concos-language').val(),
                                concosFeedTitle : $('#concos-feed-title').val()
                        };
                        OC.msg.startSaving('#concos-personal .msg');
                        $.post(OC.filePath('calibre_opds', 'ajax', 'personal.php'), data, opdsSettings.afterSave);
                },
                afterSave : function(data){
                        OC.msg.finishedSaving('#concos-personal .msg', data);
                }
        };
        $('#concos-user-calibre-path,#concos-feed-title,#concos-max-item-per-page,#concos-recentbooks-limit,#concos-opds-full-url,#concos-books-filter,#concos-ignored-categories,#concos-language').blur(opdsSettings.save);
        $('#concos-user-calibre-path,#concos-feed-title,#concos-max-item-per-page,#concos-recentbooks-limit,#concos-opds-full-url,#concos-books-filter,#concos-ignored-categories,#concos-language').keypress(function( event ) {
                                                if (event.which == 13) {
                                                  event.preventDefault();
                                                  opdsSettings.save();
                                                }
        });
        $('#concos-enable,#concos-title-split-first-letter,#concos-author-split-first-letter,#concos-generate-invalid-opds-stream,#concos-provide-kepub,#concos-show-icons').on("change", opdsSettings.save);
});

