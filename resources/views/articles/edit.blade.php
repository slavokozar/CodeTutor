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


            {{-- Popis, ktorý sa zobrazí vo výpise článkov..." --}}

            <div class="form-group{{$errors->has('description') ? ' has-error' : ''}}">
                <label class="col-md-20" for="articleDescription">{{ trans('articles.labels.description') }}</label>
                <div class="col-md-40">
                    <div class="checkbox">
                        <label>
                            <input id="articleNoDescription" name="no-description" type="checkbox" {{ old('no-description', !$articleObj->id) ? 'checked' : '' }}>{{ trans('articles.labels.description-same-as-article') }}
                        </label>
                    </div>

                    <textarea id="articleDescription" class="form-control" name="description" rows="3"
                              placeholder="{{ trans('articles.labels.description') }}" {{ $articleObj->id ? '' : 'disabled' }}>{{ old('description', $articleObj->description) }}</textarea>
                    @if( $errors->has('description') )
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>
            </div>

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
    <script>
        var $content = $("#articleContent");
        var $noDescCheck = $('#articleNoDescription');
        var $descText = $('#articleDescription');
        var descLength = 10;

        var simplemde = new SimpleMDE({
            element: $content[0],
            spellChecker: false,
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
            } else {
                $('#content-navigation').removeAttr('style');
            }
        });

        simplemde.codemirror.on("change", function(){
            if($noDescCheck.is(':checked')){
                $descText.val(simplemde.value().substring(0, descLength));
            }
        });


        $noDescCheck.change(function(){
            if($noDescCheck.is(':checked')){
                $descText.attr('disabled', true)

                $descText.val(simplemde.value().substring(0, descLength));

            }else{
                $descText.removeAttr('disabled', true);
            }
        });
    </script>
@endsection