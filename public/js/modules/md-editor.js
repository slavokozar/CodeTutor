$(function() {

    if($('.md-editor').length == 0) return;

    var simplemde = new SimpleMDE({
        element: $content[0],
        spellChecker: false,
        imagesModalUrl: imagesModalUrl,
        imagesModalInit: function () {
            $('#images-upload a').click(function () {
                // console.log('klik upload');
                $(this).parent().find('input').click();
            });

            $('#images-row > div').not('#images-empty').each(function (index, element) {

                initImageSelector($(element));

            });

            $('#images-upload').fileupload({

                // This element will accept file drag/drop uploading
                // dropZone: $('#upload-drop'),
                dataType: 'json',
                autoUpload: true,
                maxChunkSize: 1000000,
                method: "POST",
                sequentialUploads: true,
                loader: false,

                // This function is called when a file is added to the queue;
                // either via the browse button, or via drag/drop:
                start: function (e, data) {
                    e.stopPropagation();
                    e.preventDefault();


                    var progress =
                        '<div id="images-progress-bar" class="progress">' +
                        '<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">' +
                        '<span class="sr-only">0%</span>' +
                        '</div>' +
                        '</div>' +
                        '<div id="images-progress-val">0%</div>';

                    $('#images-upload').after(progress);
                },

                add: function (e, data) {

                    var jqXHR = data.submit();
                },

                fail: function (e, data) {
                    console.log(e);

                    return;
                },

                done: function (e, data) {
                    var modalUrl = imageModalThumb.replace('?', data.result.code);
                    var articleUrl = imageArticleThumb.replace('?', data.result.code);

                    $.ajax({
                        url: modalUrl
                    }).done(function (data) {
                        $element = $(data);
                        $('.media-file-loader').last().replaceWith($element);

                        $('#images-empty').remove();
                        $('#images-row').append($element);

                        initImageSelector($element);
                    }).error(function (msg) {
                        console.log("chyba pocas zobrazovanie uploadnuteho suboru");
                    })

                    $.ajax({
                        url: articleUrl
                    }).done(function (data) {
                        $element = $(data);
                        $('#articleImages ul').append($element);


                    }).error(function (msg) {
                        console.log("chyba pocas zobrazovanie uploadnuteho suboru");
                    })
                },

                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);

                    $progressBar = $('#images-progress-bar');
                    $progressVal = $('#images-progress-val');

                    $progressBar.css({width: progress + '%'}).find('.sr-only').html(progress + '%');
                    $progressVal.html(progress + '%');

                    if (progress == 100) {
                        $progressBar.addClass('progress-bar-success');
                        window.setTimeout(function () {
                            $progressBar.remove();
                            $progressVal.remove();
                        }, 3000);
                    }
                }
            });

            // Prevent the default action when a file is dropped on the window
            $(document).on('drop dragover', function (e) {
                e.preventDefault();
            });
        },
        attachmentsModalUrl: attachmentsModalUrl,
        attachmentsModalInit: function () {
            $('#images-upload a').click(function () {
                // console.log('klik upload');
                $(this).parent().find('input').click();
            });

            $('#images-row > div').not('#images-empty').each(function (index, element) {

                initImageSelector($(element));

            });

            $('#images-upload').fileupload({

                // This element will accept file drag/drop uploading
                // dropZone: $('#upload-drop'),
                dataType: 'json',
                autoUpload: true,
                maxChunkSize: 1000000,
                method: "POST",
                sequentialUploads: true,
                loader: false,

                // This function is called when a file is added to the queue;
                // either via the browse button, or via drag/drop:
                start: function (e, data) {
                    e.stopPropagation();
                    e.preventDefault();


                    var progress =
                        '<div id="images-progress-bar" class="progress">' +
                        '<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">' +
                        '<span class="sr-only">0%</span>' +
                        '</div>' +
                        '</div>' +
                        '<div id="images-progress-val">0%</div>';

                    $('#images-upload').after(progress);
                },

                add: function (e, data) {

                    var jqXHR = data.submit();
                },

                fail: function (e, data) {
                    console.log(e);

                    return;
                },

                done: function (e, data) {
                    var modalUrl = imageModalThumb.replace('?', data.result.code);
                    var articleUrl = imageArticleThumb.replace('?', data.result.code);

                    $.ajax({
                        url: modalUrl
                    }).done(function (data) {
                        $element = $(data);
                        $('.media-file-loader').last().replaceWith($element);

                        $('#images-empty').remove();
                        $('#images-row').append($element);

                        initImageSelector($element);
                    }).error(function (msg) {
                        console.log("chyba pocas zobrazovanie uploadnuteho suboru");
                    })

                    $.ajax({
                        url: articleUrl
                    }).done(function (data) {
                        $element = $(data);
                        $('#articleImages ul').append($element);


                    }).error(function (msg) {
                        console.log("chyba pocas zobrazovanie uploadnuteho suboru");
                    })
                },

                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);

                    $progressBar = $('#images-progress-bar');
                    $progressVal = $('#images-progress-val');

                    $progressBar.css({width: progress + '%'}).find('.sr-only').html(progress + '%');
                    $progressVal.html(progress + '%');

                    if (progress == 100) {
                        $progressBar.addClass('progress-bar-success');
                        window.setTimeout(function () {
                            $progressBar.remove();
                            $progressVal.remove();
                        }, 3000);
                    }
                }
            });

            // Prevent the default action when a file is dropped on the window
            $(document).on('drop dragover', function (e) {
                e.preventDefault();
            });
        },

    });

    simplemde.codemirror.on('refresh', function () {
        if ($(simplemde.element).closest('.form-group').find('.CodeMirror').hasClass('CodeMirror-fullscreen')) {
            var width = $('#content-navigation').width();
            $('#content-navigation').css({
                'position': 'fixed',
                'top': '90px',
                'width': width + 'px',
                'margin': 0
            });

            $('.navbar').addClass('navbar-bg');

        } else {
            $('#content-navigation').removeAttr('style');

            if ($(window).scrollTop() > 20) {
                $('.navbar').addClass('navbar-bg');
            }
            else {
                $('.navbar').removeClass('navbar-bg');
            }
        }
    });

    simplemde.codemirror.on("change", function () {
        if ($noDescCheck.is(':checked')) {
            $descText.val(simplemde.value().substring(0, descLength));
        }
    });

    $noDescCheck.change(function () {

        if ($noDescCheck.is(':checked')) {
            console.log('checked');
            $descText.attr('disabled', true)

            $descText.val(simplemde.value().trim().substring(0, descLength));

        } else {
            console.log('not checked');
            $descText.removeAttr('disabled');
        }
    });

    function initImageSelector($element) {
        $element.find('.images-square').click(function () {
            $image = $(this);

            $image.closest('#images-row').find('.images-square').removeClass('selected');

            $image.addClass('selected');
        });
    }

    $(document).on('click', '.image-delete', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var $link = $(this);

        $.ajax({
            url: $link.attr('href'),
            method: 'delete'
        }).done(function (data) {
            console.log(data);
            $link.closest('li').remove();

        }).error(function (jqXHR) {
            console.log(jqXHR);
        })


    })


});