@extends('layouts.main')

@section('content-main')
    @php
        $breadcrumb = [
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
        ];

        if($assignmentObj->id){
            $breadcrumb[] = [ 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code], 'label' => $assignmentObj->name];
            $breadcrumb[] = [ 'label' => trans('general.edit') ];
        }else{
            $breadcrumb[] = [ 'label' => trans('general.create') ];
        }
    @endphp

    {!! BreadCrumb::render($breadcrumb) !!}

    @if($assignmentObj->id)
        <h1>{{ $assignmentObj->name }}</h1>
    @else
        <h1>{{ trans('assignments.create') }}</h1>
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

    <form class="form-horizontal" action="{{ action($_form_action, $_form_params)}}" method="post">
        {!! csrf_field() !!}
        @if($_form_method != 'post')
            <input type="hidden" name="_method" value="{{$_form_method}}">
        @endif

        {!! ContentNav::submit(['label' => trans('general.save')]) !!}

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
                <label class="col-md-20" for="assignmentName">{{ trans('assignments.labels.name') }}</label>
                <div class="col-md-40">
                    <input id="assignmentName" type="text" class="form-control" name="name"
                           value="{{ old('name', $assignmentObj->name) }}">
                    @if( $errors->has('name') )
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            @php $sharedObject = $assignmentObj @endphp
            <div class="form-group{{$errors->has('share') ? ' has-error' : ''}}">
                <label class="col-md-20" for="assignmentShare">{{ trans('assignments.labels.share') }}</label>
                <div class="col-md-40">
                    <select name="share[]" id="assignmentShare" class="js-select" multiple>
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
                            <input class="form-control datepicker" id="assignmentStart" type="text" name="start"
                                   value="{{ old('start', date('d.m.Y', strtotime($assignmentObj->start_at))) }}">
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
                            <input class="form-control datepicker" id="assignmentDeadline" type="text" name="deadline"
                                   value="{{ old('deadline',  date('d.m.Y', strtotime($assignmentObj->deadline_at))) }}">
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

            <div class="form-group{{$errors->has('languages') ? ' has-error' : ''}}">
                <label class="col-md-20" for="assignmentDescription">Povolené jazyky</label>
                <div class="col-md-40">
                    @foreach($languages as $languageObj)
                        <div class="checkbox">
                            <label>
                                <input name="languages[]" type="checkbox" value="{{ $languageObj->id }}"
                                        {{ in_array($languageObj->id, old('languages', $assignmentObj->programmingLanguages()->pluck('programming_languages.id')->toArray())) ? 'checked' : '' }}>
                                {{ $languageObj->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group{{$errors->has('tasks') ? ' has-error' : ''}}">
                <label class="col-md-20" for="assignmentTasks">Počet úloh</label>
                <div class="col-md-40">
                    <input id="assignmentTasks" type="number" name="tasks" class="form-control" value="{{ old('tasks', $assignmentObj->tasks) }}">
                </div>
            </div>

            <div class="form-group{{$errors->has('description') ? ' has-error' : ''}}">
                <label class="col-md-20" for="assignmentDescription">{{ trans('assignments.labels.description') }}</label>
                <div class="col-md-40">
                    <div class="checkbox">
                        <label>

                            <input id="assignmentNoDescription" name="no-description"
                                   type="checkbox" {{ old('no-description', $assignmentObj->id == null) ? 'checked' : '' }}>{{ trans('assignments.labels.description-same-as-assignment') }}
                        </label>
                    </div>

                    <textarea id="assignmentDescription" class="form-control" name="description" rows="3"
                              placeholder="{{ trans('assignments.labels.description') }}" {{ $assignmentObj->id ? '' : 'disabled' }}>{{ old('description', $assignmentObj->description) }}</textarea>

                    @if( $errors->has('description') )
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>
            </div>

            @if($assignmentObj->id != null)
                <div class="form-group">
                    <label class="col-md-20" for="assignmentImages">{{ trans('assignments.labels.images') }}</label>
                    <div id="assignmentImages" class="col-md-40">
                        <div id="assignmentImages-empty"
                             class="{{ (count($assignmentObj->images) > 0) ? 'hidden' : '' }}">
                            {{ trans('assignments.labels.no-images')  }}
                        </div>
                        <ul>
                            @foreach($assignmentObj->images as $imageObj)
                                @include('files.images.editor-thumb')
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-20"
                           for="assignmentAttachments">{{ trans('assignments.labels.attachments') }}</label>
                    <div id="assignmentAttachments" class="col-md-40">
                        <div id="assignmentAttachments-empty"
                             class="{{ (count($assignmentObj->attachments) > 0) ? 'hidden' : '' }}">
                            {{ trans('assignments.labels.no-attachments')  }}
                        </div>
                        <ul>
                            @foreach($assignmentObj->attachments as $attachmentObj)
                                @include('files.attachment.editor-thumb')
                            @endforeach
                        </ul>
                    </div>
                </div>
            @else
                {{--<div class="form-group">--}}
                {{--<label class="col-md-20" for="assignmentImages">{{ trans('assignments.labels.images') }}</label>--}}
                {{--<div id="assignmentImages" class="col-md-40">--}}
                {{--<div id="assignmentImages-empty"--}}
                {{--class="{{ (count(Session::get('assignment_images')) > 0) ? 'hidden' : '' }}">--}}
                {{--{{ trans('assignments.labels.no-images')  }}--}}
                {{--</div>--}}
                {{--<ul>--}}
                {{--@foreach(Session::get('assignment_images') as $imageId)--}}
                {{--@php $imageObj = \App\Models\Files\Image::find($imageId) @endphp--}}
                {{--@include('files.images.assignment-thumb')--}}
                {{--@endforeach--}}
                {{--</ul>--}}
                {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}
                {{--<label class="col-md-20" for="assignmentImages">{{ trans('assignments.labels.attachments') }}</label>--}}
                {{--<div id="assignmentAttachments" class="col-md-40">--}}
                {{--<div id="assignmentAttachments-empty"--}}
                {{--class="{{ (count(Session::get('assignment_attachments')) > 0) ? 'hidden' : '' }}">--}}
                {{--{{ trans('assignments.labels.no-attachments')  }}--}}
                {{--</div>--}}
                {{--<ul>--}}
                {{--@foreach(Session::get('assignment_attachments') as $imageId)--}}
                {{--@php $imageObj = \App\Models\Files\Image::find($imageId) @endphp--}}
                {{--@include('files.images.assignment-thumb')--}}
                {{--@endforeach--}}
                {{--</ul>--}}
                {{--</div>--}}
                {{--</div>--}}
            @endif

            <div class="form-group{{$errors->has('text') ? ' has-error' : ''}}">
                <label class="col-md-60" for="assignmentContent">{{ trans('assignments.labels.content') }}</label>
                <div class="col-md-60">


                    <textarea id="assignmentContent" class="md-editor form-control" name="text" rows="10"
                              placeholder="{{ trans('assignments.labels.content') }}">{{ old('text', $assignmentObj->text) }}</textarea>
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
        var $content = $("#assignmentContent");
        var $noDescCheck = $('#assignmentNoDescription');
        var $descText = $('#assignmentDescription');
        var descLength = 10;

        var imagesModalUrl = '{{action('Assignments\ImageController@index', [$assignmentObj->id == null ? 'null' : $assignmentObj->code])}}'
        var imageModalThumb = '{{ action('Files\ImageController@modalThumb', '?') }}';
        var imageArticleThumb = '{{ action('Files\ImageController@articleThumb', '?') }}';
    </script>
@endsection