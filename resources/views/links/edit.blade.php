@extends('layouts.main')

@section('content-main')
    @php
        $breadcrumb = [
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('links.link'), 'action' => 'Links\LinkController@index' ],
        ];

        if($linkObj->id){
            $breadcrumb[] = [ 'action' => 'Links\LinkController@show', 'params' => [$linkObj->code], 'label' => $linkObj->name];
            $breadcrumb[] = [ 'label' => trans('general.edit') ];
        }else{
            $breadcrumb[] = [ 'label' => trans('general.create') ];
        }
    @endphp

    {!! BreadCrumb::render($breadcrumb) !!}

    @if($linkObj->id)
        <h1>{{ $linkObj->name }}</h1>
    @else
        <h1>{{ trans('links.create') }}</h1>
    @endif

    @php
        if($linkObj->id == null){
            $_form_action = 'Links\LinkController@store';
            $_form_params = [$linkObj->code];
            $_form_method = 'post';
        }else{
            $_form_action = 'Links\LinkController@update';
            $_form_params = [$linkObj->code];
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

            @if($linkObj->id != null)
                <div class="row">
                    <div class="col-md-20">
                        <label for="">#</label>
                    </div>
                    <div class="col-md-40">
                        {{$linkObj->code}}
                    </div>
                </div>
            @endif

            <div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">
                <label class="col-md-20" for="assignmentName">{{ trans('links.labels.name') }}</label>
                <div class="col-md-40">
                    <input id="assignmentName" type="text" class="form-control" name="name"
                           value="{{ old('name', $linkObj->name) }}">
                    @if( $errors->has('name') )
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            @php $sharedObject = $linkObj @endphp
            <div class="form-group{{$errors->has('share') ? ' has-error' : ''}}">
                <label class="col-md-20" for="assignmentShare">{{ trans('links.labels.share') }}</label>
                <div class="col-md-40">
                    <select name="share[]" id="assignmentShare" class="js-select" multiple>
                        @foreach($groups['public_groups'] as $groupObj)
                            <option value="{{ $groupObj->id }}"
                                    {{ $linkObj->sharingsGroups()->where('group_id', $groupObj->id)->exists() ? 'selected' : '' }}
                            >
                                {{ $groupObj->name }}
                            </option>
                        @endforeach
                        @foreach($groups['schools'] as $school)
                            @php $schoolObj = $school['school'] @endphp
                            <optgroup label="{{ $schoolObj->name }}">
                                <option value="school_{{ $schoolObj->id }}"
                                        {{ $linkObj->sharingsSchools()->where('school_id', $schoolObj->id)->exists() ? 'selected' : '' }}
                                >
                                    {{ trans('users.schools.share') }}
                                    {{ $schoolObj->name }}
                                </option>
                                @foreach($school['groups'] as $groupObj)
                                    <option value="{{ $groupObj->id }}"
                                            {{ $linkObj->sharingsGroups()->where('group_id', $groupObj->id)->exists() ? 'selected' : '' }}
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
                <label class="col-md-20" for="assignmentDescription">{{ trans('links.labels.description') }}</label>
                <div class="col-md-40">
                    <textarea id="assignmentDescription" class="form-control" name="description" rows="3"
                              placeholder="{{ trans('links.labels.description') }}" {{ $linkObj->id ? '' : 'disabled' }}>{{ old('description', $linkObj->description) }}</textarea>

                    @if( $errors->has('description') )
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>
            </div>



        </section>
    </form>
@endsection

@section('scripts')
@endsection