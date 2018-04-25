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

            <div class="col-md-30">
                <h4>Odovzdávanie</h4>
                <div class="form-group{{$errors->has('start') ? ' has-error' : ''}}">
                    <label class="col-lg-20" for="assignmentStart">od:</label>
                    <div class="col-lg-40">
                        <input class="form-control" id="assignmentStart" type="date" name="start"
                               value="{{ old('start') }}">
                    </div>
                    @if ($errors->has('start'))
                        <div class="col-lg-60">
                            @foreach($errors->get('start') as $error)
                                <span class="help-block">{{$error}}</span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="form-group{{$errors->has('deadline') ? ' has-error' : ''}}">
                    <label class="col-lg-20" for="assignmentDeadline">do</label>
                    <div class="col-lg-40">
                        <input class="form-control" id="assignmentDeadline" type="date"
                               name="deadline"
                               value="{{ old('deadline') }}">
                    </div>

                    @if ($errors->has('deadline'))
                        <div class="col-lg-60">
                            @foreach($errors->get('deadline') as $error)
                                <span class="help-block">{{$error}}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
                <h5>Povolené jazyky</h5>
                <div style="qdisplay:flex; justify-content: space-around">
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
<script src="{{asset('js/assignment.js')}}"></script>
@endsection