@extends('layouts.main')

@section('content-main')
    @php
        $breadcrumb = [
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('articles.link'), 'action' => 'Articles\ArticleController@index' ],
        ];

        if($articleObj->id){
            $breadcrumb[] = [ 'action' => 'Articles\ArticleController@show', 'params' => [$articleObj->code], 'label' => $articleObj->name];
            $breadcrumb[] = [ 'label' => trans('articles.edit') ];
        }else{
            $breadcrumb[] = [ 'label' => trans('articles.create') ];
        }
    @endphp

    {!! BreadCrumb::render($breadcrumb) !!}

    @if($articleObj->id)
        <h1>{{ $articleObj->name }}</h1>
    @else
        <h1>{{ trans('articles.create') }}</h1>
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

        {!! ContentNav::submit(['label' => trans('general.save')]) !!}

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

            <div class="form-group{{$errors->has('is_public') ? ' has-error' : ''}}">
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


                    <textarea id="articleContent" class="md-editor form-control" name="text" rows="10"
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
    <script>
        var $content = $("#articleContent");
        var $noDescCheck = $('#articleNoDescription');
        var $descText = $('#articleDescription');
        var descLength = 10;

        var imagesModalUrl = '{{action('Assignments\ImageController@index', [$articleObj->id == null ? 'null' : $articleObj->code])}}'
        var imageModalThumb = '{{ action('Files\ImageController@modalThumb', '?') }}';
        var imageArticleThumb = '{{ action('Files\ImageController@articleThumb', '?') }}';
    </script>
@endsection