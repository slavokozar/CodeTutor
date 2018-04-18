@extends('layouts.main')

@section('content-main')
    @php

        $breadcrumb = [
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('articles.articles.link'), 'action' => 'Articles\ArticleController@index' ],
        ];

        if($articleObj->id){
            $breadcrumb[] = [ 'action' => 'Articles\ArticleController@show', 'params' => [$articleObj->code], 'label' => $articleObj->name];
            $breadcrumb[] = [ 'label' => trans('articles.articles.edit') ];
        }else{
            $breadcrumb[] = [ 'label' => trans('articles.articles.create') ];
        }

    @endphp

    {!! BreadCrumb::render($breadcrumb) !!}

    @if($articleObj->id)
        <h1>{{ $articleObj->name }}</h1>
    @else
        <h1>{{ trans('articles.articles.create') }}</h1>
    @endif

    @php
        if($articleObj->id == null){
            $_form_action = 'Articles\ArticleController@store';
            $_form_params = [$articleObj->code];
            $_form_method = 'post';
        }else{
            $_form_action = 'Articles\ArticleController@update';
            $_form_params = [$articleObj->code];
            $_form_method = 'put';
        }
    @endphp

    <form class="form-horizontal" action="{{ action($_form_action, $_form_params)}}" method="post">
        {!! csrf_field() !!}
        @if($_form_method != 'post')
            <input type="hidden" name="_method" value="{{$_form_method}}">
        @endif

        {!! ContentNav::submit(['label' => trans('general.buttons.save')]) !!}

        <section id="basic">

            @if($articleObj->id != null)
                <div class="row">
                    <div class="col-md-20">
                        <label for="">#</label>
                    </div>
                    <div class="col-md-40">
                        {{$articleObj->code}}
                    </div>
                </div>
            @endif

            <div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">
                <label class="col-md-20" for="articleName">{{ trans('articles.labels.name') }}</label>
                <div class="col-md-40">
                    <input id="articleName" type="text" class="form-control" name="name"
                           value="{{ old('name', $articleObj->name) }}">
                    @if( $errors->has('name') )
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">
                <div class="col-md-40 col-md-offset-20">
                    <div class="checkbox">
                        <label>
                            <input name="is_public" type="checkbox"
                                   @if((old('is_public') !== null && old('is_public'))) checked @endif> Verejný článok
                        </label>
                    </div>
                </div>
            </div>

            @php $sharedObject = $articleObj @endphp
            <div class="form-group{{$errors->has('share') ? ' has-error' : ''}}">
                <label class="col-md-20" for="articleShare">{{ trans('articles.labels.share') }}</label>
                <div class="col-md-40">
                    <select name="share[]" id="articleShare" class="js-select" multiple>
                        @foreach($groups['public_groups'] as $groupObj)
                            <option value="{{ $groupObj->id }}"
                                {{ $articleObj->sharingsGroups()->where('group_id', $groupObj->id)->exists() ? 'selected' : '' }}
                            >
                                {{ $groupObj->name }}
                            </option>
                        @endforeach
                        @foreach($groups['schools'] as $school)
                            @php $schoolObj = $school['school'] @endphp
                            <optgroup label="{{ $schoolObj->name }}">
                                <option value="school_{{ $schoolObj->id }}"
                                    {{ $articleObj->sharingsSchools()->where('school_id', $schoolObj->id)->exists() ? 'selected' : '' }}
                                >
                                    {{ trans('users.schools.share') }}
                                    {{ $schoolObj->name }}
                                </option>
                                @foreach($school['groups'] as $groupObj)
                                    <option value="{{ $groupObj->id }}"
                                        {{ $articleObj->sharingsGroups()->where('group_id', $groupObj->id)->exists() ? 'selected' : '' }}
                                    >
                                        {{ trans('users.labels.group') }}
                                        {{ $groupObj->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>

                    @if( $errors->has('share') )
                        <span class="help-block">{{ $errors->first('share') }}</span>
                    @endif
                </div>
            </div>


            <div class="form-group{{$errors->has('description') ? ' has-error' : ''}}">
                <label class="col-md-20" for="articleDescription">{{ trans('articles.labels.description') }}</label>
                <div class="col-md-40">
                    <div class="checkbox">
                        <label>

                            <input id="articleNoDescription" name="no-description"
                                   type="checkbox" {{ old('no-description', $articleObj->id == null) ? 'checked' : '' }}>{{ trans('articles.labels.description-same-as-article') }}
                        </label>
                    </div>

                    <textarea id="articleDescription" class="form-control" name="description" rows="3"
                              placeholder="{{ trans('articles.labels.description') }}" {{ $articleObj->id ? '' : 'disabled' }}>{{ old('description', $articleObj->description) }}</textarea>

                    @if( $errors->has('description') )
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>
            </div>

            @if($articleObj->id != null)
                <div class="form-group">
                    <label class="col-md-20" for="articleImages">{{ trans('articles.labels.images') }}</label>
                    <div id="articleImages" class="col-md-40">
                        <div id="articleImages-empty"
                             class="{{ (count($articleObj->images) > 0) ? 'hidden' : '' }}">
                            {{ trans('articles.labels.no-images')  }}
                        </div>
                        <ul>
                            @foreach($articleObj->images as $imageObj)
                                @include('files.images.article-thumb')
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-20" for="articleAttachments">{{ trans('articles.labels.attachments') }}</label>
                    <div id="articleAttachments" class="col-md-40">
                        <div id="articleAttachments-empty"
                             class="{{ (count($articleObj->attachments) > 0) ? 'hidden' : '' }}">
                            {{ trans('articles.labels.no-attachments')  }}
                        </div>
                        <ul>
                            @foreach($articleObj->attachments as $attachmentObj)
                                @include('files.attachment.article-thumb')
                            @endforeach
                        </ul>
                    </div>
                </div>
            @else
                {{--<div class="form-group">--}}
                    {{--<label class="col-md-20" for="articleImages">{{ trans('articles.labels.images') }}</label>--}}
                    {{--<div id="articleImages" class="col-md-40">--}}
                        {{--<div id="articleImages-empty"--}}
                             {{--class="{{ (count(Session::get('article_images')) > 0) ? 'hidden' : '' }}">--}}
                            {{--{{ trans('articles.labels.no-images')  }}--}}
                        {{--</div>--}}
                        {{--<ul>--}}
                            {{--@foreach(Session::get('article_images') as $imageId)--}}
                                {{--@php $imageObj = \App\Models\Files\Image::find($imageId) @endphp--}}
                                {{--@include('files.images.article-thumb')--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}
                    {{--<label class="col-md-20" for="articleImages">{{ trans('articles.labels.attachments') }}</label>--}}
                    {{--<div id="articleAttachments" class="col-md-40">--}}
                        {{--<div id="articleAttachments-empty"--}}
                             {{--class="{{ (count(Session::get('article_attachments')) > 0) ? 'hidden' : '' }}">--}}
                            {{--{{ trans('articles.labels.no-attachments')  }}--}}
                        {{--</div>--}}
                        {{--<ul>--}}
                            {{--@foreach(Session::get('article_attachments') as $imageId)--}}
                                {{--@php $imageObj = \App\Models\Files\Image::find($imageId) @endphp--}}
                                {{--@include('files.images.article-thumb')--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            @endif

            <div class="form-group{{$errors->has('text') ? ' has-error' : ''}}">
                <label class="col-md-60" for="articleContent">{{ trans('articles.labels.content') }}</label>
                <div class="col-md-60">


                    <textarea id="articleContent" class="form-control" name="text" rows="10"
                              placeholder="{{ trans('articles.labels.text') }}">{{ old('text', $articleObj->text) }}</textarea>
                    @if( $errors->has('text') )
                        <span class="help-block">{{ $errors->first('text') }}</span>
                    @endif
                </div>
            </div>


        </section>
    </form>

@endsection

@section('scripts')
    <script src="{{asset('js/simplemde.min.js')}}"></script>
    <script src="{{asset('js/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('js/jquery.fileupload.js')}}"></script>

    <script>
        var $content = $("#articleContent");
        var $noDescCheck = $('#articleNoDescription');
        var $descText = $('#articleDescription');
        var descLength = 10;

        var simplemde = new SimpleMDE({
            element: $content[0],
            spellChecker: false,
            imagesModalUrl: '{{action('Articles\ImageController@index', [$articleObj->id == null ? 'null' : $articleObj->code])}}',
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
                        var modalUrl = '{{ action('Files\ImageController@modalThumb', '?') }}'.replace('?', data.result.code);
                        var articleUrl = '{{ action('Files\ImageController@articleThumb', '?') }}'.replace('?', data.result.code);

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

            console.log('ferko');

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
    </script>


@endsection