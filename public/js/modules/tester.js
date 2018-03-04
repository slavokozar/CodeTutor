App.modules.tester = {
    init : function(){
        var self = this;

        $(document).on('click', '#submit-test-start', function(e) {
            e.preventDefault();
            e.stopPropagation();

            $.ajax({
                url: $(e.target).closest('a').attr('href')
            }).done(function(data) {
                self.start(data);
            })
        });

        $(document).on('click', '#submit-test-results', function(e){
            e.preventDefault();
            e.stopPropagation();

            $link = $(e.target).closest('a');
            self.showResult($link.attr('href'));

        });
    },

    start : function(testId){
        var self = this;
        $('#submit-test').empty();

        var $status = (
            '<div id="submit-test">'+
                '<h4>Automatický test</h4>'+
                '<div class="progress">'+
                    '<div class="progress-bar" role="progressbar" style="width: 0%;">0%</div>'+
                '</div>'+
                '<div class="test-steps">'+
                    '<ol>'+
                    '</ol>'+
                '</div>'+
            '</div>'
        );

        $('#submit-test').html($status);
        self.status(testId);
    },

    notRunning : function(){
        $('#submit-test').html(
            '<div id="submit-test">'+
                '<h3>Automatický test</h3>'+
                '<div class="alert alert-danger">Teste nebol spustený, skúste to neskôr.</div>'+
                '<a href="test" id="start-test" class="btn btn-primary">Spustiť test</a>'+
            '</div>'
        );
    },

    status : function (testId){
        var self = this;
        if(testId == '0'){
            return;
        }

        $.ajax({
            url:'status',
            method:'get',
            data: {
                test : testId
            }
        }).done(function(data){
            $('#submit-test .progress-bar').css('width', data.progress + '%').text(data.progress + '%');

            var $statuses = $('#submit-test ol');

            $statuses.empty();
            for(var i = 0; i < data.public.length; i++){
                $statuses.append('<li>'+data.public[i]+'</li>')
            }

            if(data.status == 'ERROR' || data.status == 'FINISHED'){
                clearTimeout(timeout);

                if(data.status == 'ERROR'){
                    $('#submit-result').remove();
                    $('#submit-test').append(
                        '<div id="submit-result">'+
                        '<div class="alert alert-danger">Spustenie testu skončilo chybou, administrátori systému boli upozornení.</div>'+
                        '<a href="test" id="submit-test-start" class="btn btn-primary">Spustiť znova test</a>'+
                        '</div>'
                    );
                }

                if(data.status == 'FINISHED'){
                    $('#submit-result').remove();
                    $('#submit-test').append(
                        '<div id="submit-result">'+
                        '<a id="submit-test-results" href="result" class="btn btn-info">Výsledok automatického testu</a>'+
                        '</div>'
                    );
                    self.showResult('result');
                }
            }



        }).error(function(err){

        });

        var timeout = setTimeout(function(){ self.status(testId)}, 1000);
    },

    showResult: function (href){
        $.ajax({
            url : href
        }).done(function (data) {
            var $modal = $(data);

            $('body').append($modal);
            $modal.modal();

            $modal.find('.btn.cancel').click(function(){
                if (typeof (options.cancel.callback) === 'function') {
                    options.cancel.callback();
                };

            });

            $modal.find('.btn.success').click(function(){
                if (typeof (options.success.callback) === 'function') {
                    options.success.callback();
                };
                $modal.modal('hide');
            });

            $modal.on('hidden.bs.modal', function (e) {
                $modal.remove();
                $('.modal-backdrop').remove();
            })
        }).error(function () {

        });
    }
}

$(function () {
    'use strict';
    App.modules.tester.init();
});