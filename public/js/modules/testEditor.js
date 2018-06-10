$(function() {
    /*******************
     * textarea
    ********************/
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

    /*******************
     *
     * tests
     *
     ********************/
    $(document).on('click', '.btn-test-add', function(e){
        e.preventDefault();

        var $link = $(e.target).closest('a');
        var href = $link.attr('href');

        var $tests = $('.test-test');
        var tasksCount = null;
        if($tests.length > 0){
            var tasksCount = $tests.first().find('.test-task').length;
        }

        $.ajax({
            url: href,
            method: 'get',
            data: {
                'tasks' : tasksCount
            }
        }).done(function (data){
            var $data = $(data);

            if($tests.length > 0){
                $tests.last().after($data);
            }else{
                $('#test-tests .notest').replaceWith($data);
            }

            $data.find('.selectpicker').selectpicker({
                style: 'form-control',
                size : 4
            });

        });
    });

    $(document).on('click', '.btn-test-remove', function(e){
        e.preventDefault();

        var $test = $(e.target).closest('.test-test');
        $test.remove();

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

    /*******************
     *
     * tasks
     *
     ********************/
    $(document).on('click', '.btn-task-add', function(e){
        e.preventDefault();

        var $link = $(e.target);
        var href = $link.attr('href');

        console.log('ferko', href);
        $.ajax({
            url: href,
            method: 'get'
        }).done(function (message){
            var $wrappers = $('.test-tasks');
            var $data = $(message);

            $wrappers.each(function(){
                var $tasks = $(this).find('.test-task');

                if($tasks.length > 0){
                    $tasks.last().after($data);
                }else{
                    $(this).find('.test-notask').replaceWith($data);
                }

                $data.find('.selectpicker').selectpicker({
                    style: 'form-control',
                    size : 4
                });
            });

            recountTasks();
        });
    });
    $(document).on('click', '.btn-task-remove', function(e){
        e.preventDefault();

        var index = $(e.target).closest('.test-task').prevAll('.test-task').length;



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
                    $('.test-tasks').each(function(){
                        var $tasks = $(this).find('.test-task');
                        var $task = $tasks.eq(index);

                        if($tasks.length == 1){
                            $task.replaceWith('<p class="test-notask text-center text-danger">K tomuto testu zatiaľ neexistujú úlohy.</p>');
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

        $('.test-tasks').each(function(){
            $(this).find('.test-task').each(function(index, element){
                var $heading = $(element).find('h4');
                var text = $heading.text().replace(/[0-9]/g, '');
                $heading.text(text + (index + 1));
            });
        });

    }

    /*******************
     *
     * lines
     *
     ********************/
    $(document).on('click', '.btn-line-add', function(e){
        e.preventDefault();

        var $link = $(e.target);
        var href = $link.attr('href');

        $.ajax({
            url: href,
            method: 'get'
        }).done(function (data){
            var $data = $(data);

            var $wrapper = $link.closest('.test-task').find('.test-lines');
            var $lines = $wrapper.find('.test-line');

            if($lines.length > 0){
                $lines.last().after($data);
            }else{
                $wrapper.find('.test-noline').replaceWith($data);
            }

            $data.find('.selectpicker').selectpicker({
                style: 'form-control',
                size : 4
            });

        });
    });
    $(document).on('click', '.btn-line-remove', function(e){
        e.preventDefault();

        var $line = $(e.target).closest('.test-line');
        var $wrapper = $line.closest('.test-lines');
        $line.remove();

        if($wrapper.find('.test-line').length == 0){
            $wrapper.append('<p class="test-noline text-center text-danger">K tomuto zadaniu zatiaľ neexistujú výstupy.</p>');
        }
    });


    /*******************
     *
     * saving
     *
     ********************/
    $('#test-form').submit(function(e){
        $('#test-value').val(JSON.stringify(serializeTest($('#tests'))));
    });

    function serializeTest($wrapper){
        var $tests = $('.test-test');

        var tests = {
            'compilation': {
                'languages': []
            },
            'testsCount': $tests.length,
            'tests': []
        };

        $tests.each(function(){
            var $tasks = $(this).find('.test-task');
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
                var $lines = $(this).find('.test-lines').find('.test-line');
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

