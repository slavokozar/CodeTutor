@extends('layouts.main')

@section('content-main')
    @php
        $breadcrumb = [
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
        ];

        if($assignmentObj->id){
            $breadcrumb[] = [ 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code], 'label' => $assignmentObj->name];
            $breadcrumb[] = [ 'label' => trans('assignments.assignments.edit') ];
        }else{
            $breadcrumb[] = [ 'label' => trans('assignments.assignments.create') ];
        }
    @endphp

    {!! BreadCrumb::render($breadcrumb) !!}

    @if($assignmentObj->id)
        <h1>{{ $assignmentObj->name }}</h1>
    @else
        <h1>{{ trans('assignments.assignments.create') }}</h1>
    @endif

    @php
        if($assignmentObj->id == null){
            $_form_action = 'Assignments\AssignmentController@store';
            $_form_params = [$assignmentObj->code];
            $_form_method = 'post';
        }else{
            $_form_action = 'Assignments\AssignmentController@update';
            $_form_params = [$assignmentObj->code];
            $_form_method = 'put';
        }
    @endphp

    @if ($errors->any())

        @php
        print_r($errors)
        @endphp
        <div class="alert alert-danger">
            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form class="form-horizontal" action="{{ action($_form_action, $_form_params)}}" method="post">
        {!! csrf_field() !!}
        @if($_form_method != 'post')
            <input type="hidden" name="_method" value="{{$_form_method}}">
        @endif

        {!! ContentNav::submit(['label' => trans('general.buttons.save')]) !!}

        <section id="basic">

            @if($assignmentObj->id != null)
                <div class="row">
                    <div class="col-md-20">
                        <label for="">#</label>
                    </div>
                    <div class="col-md-40">
                        {{$assignmentObj->code}}
                    </div>
                </div>
            @endif

            <div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">
                <label class="col-md-20" for="articleName">{{ trans('articles.labels.name') }}</label>
                <div class="col-md-40">
                    <input id="articleName" type="text" class="form-control" name="name"
                           value="{{ old('name', $assignmentObj->name) }}">
                    @if( $errors->has('name') )
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            @php $sharedObject = $assignmentObj @endphp
            <div class="form-group{{$errors->has('share') ? ' has-error' : ''}}">
                <label class="col-md-20" for="articleShare">{{ trans('articles.labels.share') }}</label>
                <div class="col-md-40">
                    <select name="share[]" id="articleShare" class="js-select" multiple>
                        @foreach($groups['public_groups'] as $groupObj)
                            <option value="{{ $groupObj->id }}"
                                    {{ $assignmentObj->sharingsGroups()->where('group_id', $groupObj->id)->exists() ? 'selected' : '' }}
                            >
                                {{ $groupObj->name }}
                            </option>
                        @endforeach
                        @foreach($groups['schools'] as $school)
                            @php $schoolObj = $school['school'] @endphp
                            <optgroup label="{{ $schoolObj->name }}">
                                <option value="school_{{ $schoolObj->id }}"
                                        {{ $assignmentObj->sharingsSchools()->where('school_id', $schoolObj->id)->exists() ? 'selected' : '' }}
                                >
                                    {{ trans('users.schools.share') }}
                                    {{ $schoolObj->name }}
                                </option>
                                @foreach($school['groups'] as $groupObj)
                                    <option value="{{ $groupObj->id }}"
                                            {{ $assignmentObj->sharingsGroups()->where('group_id', $groupObj->id)->exists() ? 'selected' : '' }}
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



            <div class="row">
                <label for="" class="col-lg-20">Odovzdávanie</label>
                <div class="col-md-20">
                    <div class="form-group{{$errors->has('start') ? ' has-error' : ''}}">
                        <label class="col-lg-10" for="assignmentStart">od:</label>
                        <div class="col-lg-50">
                            <input class="form-control" id="assignmentStart" type="date" name="start"
                                   value="{{ old('start', $assignmentObj->start_at) }}">
                        </div>
                        @if ($errors->has('start'))
                            <div class="col-lg-60">
                                @foreach($errors->get('start') as $error)
                                    <span class="help-block">{{$error}}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-20">
                    <div class="form-group{{$errors->has('deadline') ? ' has-error' : ''}}">
                        <label class="col-lg-10" for="assignmentDeadline">do</label>
                        <div class="col-lg-50">
                            <input class="form-control" id="assignmentDeadline" type="date"
                                   name="deadline"
                                   value="{{ old('deadline', $assignmentObj->deadline_at) }}">
                        </div>

                        @if ($errors->has('deadline'))
                            <div class="col-lg-60">
                                @foreach($errors->get('deadline') as $error)
                                    <span class="help-block">{{$error}}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>


            <div class="form-group{{$errors->has('description') ? ' has-error' : ''}}">
                <label class="col-md-20" for="articleDescription">Povolené jazyky</label>
                <div class="col-md-40">
                    @foreach($languages as $languageObj)
                        <div class="checkbox">
                            <label>
                                <input name="languages[]" type="checkbox" value="{{ $languageObj->id }}">
                                {{ $languageObj->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="form-group{{$errors->has('description') ? ' has-error' : ''}}">
                <label class="col-md-20" for="articleDescription">{{ trans('articles.labels.description') }}</label>
                <div class="col-md-40">
                    <div class="checkbox">
                        <label>

                            <input id="articleNoDescription" name="no-description"
                                   type="checkbox" {{ old('no-description', $assignmentObj->id == null) ? 'checked' : '' }}>{{ trans('articles.labels.description-same-as-article') }}
                        </label>
                    </div>

                    <textarea id="articleDescription" class="form-control" name="description" rows="3"
                              placeholder="{{ trans('articles.labels.description') }}" {{ $assignmentObj->id ? '' : 'disabled' }}>{{ old('description', $assignmentObj->description) }}</textarea>

                    @if( $errors->has('description') )
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>
            </div>

            @if($assignmentObj->id != null)
                <div class="form-group">
                    <label class="col-md-20" for="articleImages">{{ trans('articles.labels.images') }}</label>
                    <div id="articleImages" class="col-md-40">
                        <div id="articleImages-empty"
                             class="{{ (count($assignmentObj->images) > 0) ? 'hidden' : '' }}">
                            {{ trans('articles.labels.no-images')  }}
                        </div>
                        <ul>
                            @foreach($assignmentObj->images as $imageObj)
                                @include('files.images.article-thumb')
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-20"
                           for="articleAttachments">{{ trans('articles.labels.attachments') }}</label>
                    <div id="articleAttachments" class="col-md-40">
                        <div id="articleAttachments-empty"
                             class="{{ (count($assignmentObj->attachments) > 0) ? 'hidden' : '' }}">
                            {{ trans('articles.labels.no-attachments')  }}
                        </div>
                        <ul>
                            @foreach($assignmentObj->attachments as $attachmentObj)
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
                              placeholder="{{ trans('articles.labels.text') }}">{{ old('text', $assignmentObj->text) }}</textarea>
                    @if( $errors->has('text') )
                        <span class="help-block">{{ $errors->first('text') }}</span>
                    @endif
                </div>
            </div>


        </section>
    </form>
    {{--<div class="row">--}}
    {{--<div class="col-md-30">--}}
    {{--<div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">--}}
    {{--<label class="col-md-20" for="assignmentName">Názov</label>--}}
    {{--<div class="col-md-40">--}}
    {{--<input id="assignmentName" type="text" class="form-control" name="name"--}}
    {{--placeholder="Názov zadania"--}}
    {{--value="{{ old('name') }}">--}}
    {{--</div>--}}
    {{--@if ($errors->has('name'))--}}
    {{--@foreach($errors->get('name') as $error)--}}
    {{--<span class="help-block">{{$error}}</span>--}}
    {{--@endforeach--}}
    {{--@endif--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<div class="col-md-40 col-md-offset-20">--}}
    {{--<div class="checkbox">--}}
    {{--<label>--}}
    {{--<input name="is_public" type="checkbox"--}}
    {{--{{ old('is_public') ? 'checked' : '' }}>--}}
    {{--Verejné zadanie--}}
    {{--</label>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">--}}
    {{--<label class="col-md-20" for="assignmentGroup">Skupina</label>--}}

    {{--<div class="col-md-40">--}}
    {{--<select id="assignmentGroup" name="group" class="form-control">--}}
    {{--<option value="">Vyberte skupinu...</option>--}}
    {{--@foreach($groups as $group)--}}
    {{--<option value="{{$group->id}}" {{ old('group') == $group->id ? 'selected' : ''}}>--}}
    {{--{{$group->name}}--}}
    {{--</option>--}}
    {{--@endforeach--}}
    {{--</select>--}}
    {{--</div>--}}
    {{--@if ($errors->has('group'))--}}
    {{--@foreach($errors->get('description') as $error)--}}
    {{--<span class="help-block">{{$error}}</span>--}}
    {{--@endforeach--}}
    {{--@endif--}}
    {{--</div>--}}

    {{--</div>--}}




    {{--</div>--}}
    {{--<div class="col-md-60">--}}
    {{--<div class="form-group{{$errors->has('description') ? ' has-error' : ''}}">--}}
    {{--<div class="col-md-60">--}}
    {{--<label for="assignmentDescription">Popis</label>--}}

    {{--<textarea id="assignmentDescription" class="form-control" name="description" rows="3"--}}
    {{--placeholder="Popis, ktorý sa zobrazí vo výpise zadaní...">{{ old('description') }}</textarea>--}}
    {{--@if ($errors->has('description'))--}}
    {{--@foreach($errors->get('description') as $error)--}}
    {{--<span class="help-block">{{$error}}</span>--}}
    {{--@endforeach--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group{{$errors->has('text') ? ' has-error' : ''}}">--}}
    {{--<div class="col-md-60">--}}
    {{--<label for="assignmentContent">Content</label>--}}
    {{--<textarea id="assignmentContent" class="form-control" name="text" rows="10"--}}
    {{--placeholder="Text zadania">{{ old('text') }}</textarea>--}}
    {{--@if ($errors->has('text'))--}}
    {{--@foreach($errors->get('text') as $error)--}}
    {{--<span class="help-block">{{$error}}</span>--}}
    {{--@endforeach--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</form>--}}
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

        var imagesModalUrl = '{{action('Articles\ImageController@index', [$assignmentObj->id == null ? 'null' : $assignmentObj->code])}}'
        var imageModalThumb = '{{ action('Files\ImageController@modalThumb', '?') }}';
        var imageArticleThumb = '{{ action('Files\ImageController@articleThumb', '?') }}';
    </script>
    <script src="{{asset('js/modules/md-editor.js')}}"></script>
@endsection