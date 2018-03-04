App.modules.submit = {
    init : function(){
        $(document).on('click', '#submit-files-minimize', function(){
            $(this).addClass('hidden');
            $('#submit-files-maximize').removeClass('hidden');

            $('#submit-files').addClass('minimized');
        });

        $(document).on('click', '#submit-files-maximize', function() {
            $(this).addClass('hidden');
            $('#submit-files-minimize').removeClass('hidden');

            $('#submit-files').removeClass('minimized');
        });

        if($('#submit-files').outerHeight() < 100){
            $('#submit-files-minimize').addClass('hidden');
            $('#submit-files-maximize').addClass('hidden');
        }

    },

};

$(function () {
    'use strict';
    App.modules.submit.init();
});