App.modules.upload = {
    init : function(){

        var self = this;

        $('#submit-upload .btn').click(function (e) {
            e.stopPropagation();
            e.preventDefault();

            $(this).closest('form').find('input[type="file"]').click();
        });

        $('#submit-upload').fileupload({
            dataType: 'json',
            autoUpload: true,
            acceptFileTypes: /(\.|\/)(zip)$/i,
            singleFileUploads: true,
            maxChunkSize: 2000000,
            method: "POST",

            sequentialUploads: true,
            add: function (e, data) {
                var name = data.files[0].name;
                var type = data.files[0].type;

                data.process().done(function () {
                    data.submit();
                });

                self.reset();
                self.progress();
                self.filename(name, type);

                $('#upload-error').remove();

            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);

                self.updateProgress(progress);
            },
            done: function (e, data) {
                console.log(e, data);

                var files = data.result.files;

                self.files.show(files);

                if(typeof(data.result.test) !== undefined && data.result.test!= null && data.result.test!= 0){
                    App.modules.tester.start(data.result.test);
                }else{
                    App.modules.tester.notRunning();
                }
            },
            error: function(xhr){
                if(xhr.status == 406){
                    $('#submit-solution').after(
                        '<div id="upload-error">'+
                        '<div class="alert alert-danger">Odovzdané riešenie neobsahuje požadované súbory.<br/>Požiadavky na riešenie nájdete v pravidlách.</div>'+
                        '</div>'
                    );

                }

            }
        });
    },

    reset : function (){
        $('#submit-solution').empty();
        $('#submit-test').empty();
    },


    filename : function (name, type){
        var self = this;

        var $filename = $('<span id="submit-file" style="">' + self.files.icon(type) + ' ' + name + '</span>');

        if($('#submit-file').length > 0){
            $('#submit-file').replaceWith($filename);
        }else{
            $('#submit-solution').prepend($filename);
        }
    },

    progress : function (){
        var self = this;

        var $progress = $(
            '<div id="submit-upload-progress" class="progress">'+
            '   <div class="progress-bar progress-bar-primary" role="progressbar" style="width:0%">0%</div>'+
            '</div>'
        );

        if($('#submit-upload-progress').length > 0){
            $('#submit-upload-progress').replaceWith($progress);
        }else{
            $('#submit-upload').after($progress);
        }
    },

    updateProgress : function (progress){
        $('#submit-upload-progress .progress-bar').css('width', progress + '%').text(progress + '%');
    },

    files : {
        show : function (files){
            var self = this;

            var contents =
                '<h4>Odovzdané súbory</h4>'+
                '<div id="submit-files" class="minimized">'+
                self.render(files)+
                '</div>'+
                '<button id="submit-files-minimize" class="hidden"><i class="fa fa-angle-double-up" aria-hidden="true"></i></button>'+
                '<button id="submit-files-maximize"><i class="fa fa-angle-double-down" aria-hidden="true"></i></button>';

            $('#submit-solution').append(contents);

            if($('#submit-files').outerHeight() < 100){
                $('#submit-files-minimize').addClass('hidden');
                $('#submit-files-maximize').addClass('hidden');
            }
        },

        render : function(files){
            var self = this;
            var result = '<ul>\n';

            for(var i = 0; i < files.length; i++){
                result += '<li>';
                if(files[i].files) {
                    result += '<i class="fa fa-folder-open-o" aria-hidden="true"></i>&nbsp;';
                }else{
                    result += '<i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;';
                }
                result += files[i].name;
                if(files[i].files){
                    result += self.render(files[i].files);
                }
                result += '</li>\n';
            }

            result += '</ul>\n';

            return result;
        },
        icon : function (type){
            var self = this;
            var icon = ""

            switch(type) {
                case 'application/zip':
                    icon = '<i class="fa fa-file-archive-o"></i>';
                    break;
                default:
                    icon = '<i class="fa fa-file-o"></i>'
            }

            return icon;
        },

    },
}

$(function () {
    'use strict';
    App.modules.upload.init();
});