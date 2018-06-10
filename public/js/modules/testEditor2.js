$(function() {

    $(document).on('keyup change','textarea.form-control', function(e){
        resizeTextarea($(e.target).closest('textarea.form-control'));
    }).on('paste','textarea.form-control', function(e){
        var pasteData = e.originalEvent.clipboardData.getData('text')

        var rows = $(e.target).closest('textarea.form-control').attr('rows');
        var lines = pasteData.split(/\r*\n/).length;

        if(rows < (lines + 1) || rows > (lines + 1)){
            $textarea.attr('rows', Math.max(lines + 1, 3));
        }
    });

    function resizeTextarea($textarea){
        var rows = $textarea.attr('rows');
        var lines = $textarea.val().split(/\r*\n/).length;

        if(rows < (lines + 1) || rows > (lines + 1)){
            $textarea.attr('rows', Math.max(lines + 1, 3));
        }
    }

    $(document).on('click', '.btn-test-add', function(e){
        e.preventDefault();

        var $link = $(e.target);
        var href = $link.attr('href');

        var tasksCount = 1;
        var $tests = $('.test-wrapper');
        if($tests.length > 0){
            tasksCount = $tests.first().find('.task-wrapper').length;
        }

        $.ajax({
            url: href+'?tasks='+tasksCount,
            method: 'get'
        }).done(function (message){

            var $testLinks = $('.test-link');
            var $tests = $('.test-wrapper');
            var testNo = $testLinks.length + 1;

            var newLink =
                '<li class="test-link">'+
                    '<a class="btn btn-test-link" href="#test-test' + testNo + '" role="tab" data-toggle="tab">'+
                        '<span class="btn-test-caption">Test ' + testNo + '</span>'+
                        '<span class="btn-test-remove"><i class="fa fa-times"></i></span>'+
                    '</a>'+
                '</li>';

            if($testLinks.length > 0)
                $testLinks.last().after(newLink);
            else{
                $('.test-link-settings').after(newLink)
            }
            var $test = $(message);
            $test.attr('id','test-test'+testNo);
            $test.find('h3').append(' '+testNo);
            $test.find('[name="description"]').val(testNo);
            if($tests.length > 0)
                $tests.last().after($test);
            else{
                $('#test-settings').after($test)
            }


            testsCount++;
        });
    });
    $(document).on('click', '.btn-test-remove', function(e){
        e.preventDefault();

        var $link = $(e.target).closest('.test-link');
        var $tab = $($link.find('.btn-test-link').attr('href'));

        if($link.hasClass('active')){
            $link.prev().addClass('active');
            $tab.prev().addClass('active');
        }

        $tab.remove();
        $link.remove();

        recountTests();
    });
    function recountTests(){
        $('.btn-test-link').each(function(index, element){
            $(element).find('.btn-test-caption').text('Test ' + (index + 1));
            $(element).attr('href','#test-test' + (index + 1));
        });

        $('.test-wrapper').each(function(index, element){
            $(element).find('h3').text('Test ' + (index + 1));
            $(element).attr('id','#test-test' + (index + 1));
        });
    }

    $(document).on('click', '.btn-task-add', function(e){
        e.preventDefault();

        var $link = $(e.target);
        var href = $link.attr('href');

        $.ajax({
            url: href,
            method: 'get'
        }).done(function (message){
            var $wrappers = $('.test-wrapper');

            $wrappers.each(function(){
                var $tasks = $(this).find('.task-wrapper');

                if($tasks.length > 0){
                    $tasks.last().after(message);
                }else{
                    $(this).find('.notask').replaceWith(message);
                }

            });

            recountTasks();
        });
    });
    $(document).on('click', '.btn-task-remove', function(e){
        e.preventDefault();

        var index = $(e.target).closest('.task-wrapper').prevAll('.task-wrapper').length;

        alert({
            'title': 'Vymazanie úlohy ' + (index + 1),
            'body': 'Naozaj chcete zmazať túto úlohu?<br/>Táto úloha bude odstránená zo všetkých testov!',
            'cancel': {
                'class': 'default',
                'title': 'zrušiť'
            },
            'success': {
                'class': 'danger',
                'title': 'vymazať',
                'callback': function(){
                    $('.test-wrapper').each(function(){
                        var $tasks = $(this).find('.task-wrapper');
                        var $task = $tasks.eq(index);

                        if($tasks.length == 1){
                            $task.replaceWith('<p class="notask text-center text-danger">K tomuto testu zatiaľ neexistujú úlohy.</p>');
                        }else{
                            $task.remove();
                        }
                    });

                    recountTasks();
                }
            }
        });
    });
    function recountTasks(){

        $('.test-wrapper').each(function(){
            $(this).find('.task-wrapper').each(function(index, element){
                var $heading = $(element).find('h4');
                var text = $heading.text().replace(/[0-9]/g, '');
                $heading.text(text + (index + 1));
            });
        });

    }

    $(document).on('click', '.btn-line-add', function(e){
        e.preventDefault();

        var $link = $(e.target);
        var href = $link.attr('href');

        $.ajax({
            url: href,
            method: 'get'
        }).done(function (message){
            var $wrapper = $link.closest('.task-wrapper');
            var $lines = $wrapper.find('.line-wrapper');
            if($lines.length > 0){
                $lines.last().after(message);
            }else{
                $wrapper.find('.noline').replaceWith(message);
            }

        });
    });
    $(document).on('click', '.btn-line-remove', function(e){
        e.preventDefault();

        var $line = $(e.target).closest('.line-wrapper');
        var $lines = $(e.target).closest('.lines-wrapper').find('.line-wrapper');

        if($lines.length == 1){
            $line.replaceWith('<div class="row"><div class="col-sm-12"><p class="noline text-center text-danger">K tomuto zadaniu zatiaľ neexistujú výstupy.</p></div></div>');
        }else{
            $line.remove();
        }
    });

    $('#test-form').submit(function(e){
        $('#test-value').val(JSON.stringify(serializeTest($('#tests'))));
    });

    function serializeTest($wrapper){
        var $tests = $('.test-wrapper');

        var tests = {
            'compilation': {
                'languages': []
            },
            'testsCount': $tests.length,
            'tests': []
        };

        $('.language-wrapper').each(function(){
            if($(this).find('[name="enable"]').is(':checked')){

                var language = {
                    'language': $(this).find('[name="language"]').val()
                };

                var timeout = $(this).find('[name="timeout"]').val();
                if(timeout != null){
                    language.timeout = parseInt(timeout);
                }

                var basicOptions = $(this).find('[name="options-basic"]').val();
                var extendedOptions = $(this).find('[name="options-extended"]').val();
                if(basicOptions != null || extendedOptions != null){
                    language.options = {
                        'basic': basicOptions,
                        'extended': extendedOptions
                    }
                }

                tests.compilation.languages.push(language);
            }

        });

        $tests.each(function(){
            var $tasks = $(this).find('.task-wrapper');
            var input = $(this).find('[name="input"]').val().replace(/\r\n/g,'\n').trim('\n').split('\n');
            var test = {
                'timeout': parseInt($(this).find('[name="timeout"]').val()),
                'description': $(this).find('[name="description"]').val(),
                'input':{
                    'count': input.length,
                    'inputs': input
                },
                'output':{
                    'tasksCount': $tasks.length,
                    'tasks': []
                }
            };

            $tasks.each(function(){
                var $lines = $(this).find('.line-wrapper');
                var task = {
                    'linesCount': $lines.length,
                    'lines': []
                };

                $lines.each(function(){
                    var line = {};
                    $(this).find('input, select').each(function(){
                        if($(this).attr('type') == 'number') {
                            line[$(this).attr('name')] = parseFloat($(this).val());
                        }else{
                            line[$(this).attr('name')] = $(this).val();
                        }

                    })
                    task.lines.push(line);
                });
                test.output.tasks.push(task);

            });
            tests.tests.push(test);
        });

        return tests;
    }
});

