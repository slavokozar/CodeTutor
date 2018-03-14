@extends('layout_full')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        <li><a href="{{action('Assignments\AssignmentController@index')}}">Zadania</a></li>
        <li><a href="{{action('Assignments\AssignmentController@show',[$assignmentObj->code])}}">{{$assignmentObj->name}}</a></li>
        <li class="active">Úprava</li>
    </ol>


    <h1>Úprava {{$assignmentObj->name}}</h1>
    <form class="form" method="post"
          action="{{action('Assignments\AssignmentController@update',[$assignmentObj->code])}}">
    {!! csrf_field() !!}

    <div class="row">
        <div class="col-md-60">
            <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
                <li role="presentation">
                    <a href="{{action('Assignments\AssignmentController@show',[$assignmentObj->code])}}">Zrušiť</a>
                </li>
                <li class="active" role="presentation">
                    <button type="submit" class="btn btn-link">Upraviť</button>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-30">
            <div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">
                <label class="col-md-20" for="assignmentName">Názov</label>
                <div class="col-md-40">
                    <input id="assignmentName" type="text" class="form-control" name="name"
                           placeholder="Názov zadania"
                           value="{{ old('name', $assignmentObj->name) }}">
                </div>
                @if ($errors->has('name'))
                    @foreach($errors->get('name') as $error)
                        <span class="help-block">{{$error}}</span>
                    @endforeach
                @endif
            </div>

            <div class="form-group">
                <div class="col-md-40 col-md-offset-20">
                    <div class="checkbox">
                        <label>
                            <input name="is_public" type="checkbox"
                                   {{ old('is_public', $assignmentObj->is_public) ? 'checked' : '' }}>
                            Verejné zadanie
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                <label class="col-md-20" for="assignmentGroup">Skupina</label>

                <div class="col-md-40">
                    <select id="assignmentGroup" name="group" class="form-control">
                        <option value="">Vyberte skupinu...</option>
                        @foreach($groups as $group)
                            <option value="{{$group->id}}" {{ old('group', $assignmentObj->group_id) == $group->id ? 'selected' : ''}}>
                                {{$group->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->has('group'))
                    @foreach($errors->get('description') as $error)
                        <span class="help-block">{{$error}}</span>
                    @endforeach
                @endif
            </div>

        </div>
        <div class="col-md-30">
            <h4>Odovzdávanie</h4>
            <div class="form-group{{$errors->has('start') ? ' has-error' : ''}}">
                <label class="col-lg-20" for="assignmentStart">od:</label>
                <div class="col-lg-40">
                    <input class="form-control" id="assignmentStart" type="date" name="start"
                           value="{{ old('start', date('Y-m-d', strtotime($assignmentObj->start_at))) }}">
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
                           value="{{ old('deadline', date('Y-m-d', strtotime($assignmentObj->deadline_at))) }}">
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
            @php $assignmentLanguages = $assignmentObj->programmingLanguages()->pluck('programming_language_id')->toArray() @endphp
            @foreach($languages as $languageObj)
                <div class="checkbox">
                    <label>
                        <input name="languages[]" type="checkbox" value="{{ $languageObj->id }}" {{ in_array( $languageObj->id, $assignmentLanguages) ? 'checked' : '' }}>
                        {{ $languageObj->name }}
                    </label>
                </div>
            @endforeach


        </div>
        <div class="col-md-60">
            <div class="form-group{{$errors->has('description') ? ' has-error' : ''}}">
                <div class="col-md-60">
                    <label for="assignmentDescription">Popis</label>

                    <textarea id="assignmentDescription" class="form-control" name="description"
                              rows="3"
                              placeholder="Popis, ktorý sa zobrazí vo výpise zadaní...">{{ old('description', $assignmentObj->description) }}</textarea>


                    @if ($errors->has('description'))
                        @foreach($errors->get('description') as $error)
                            <span class="help-block">{{$error}}</span>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="form-group{{$errors->has('text') ? ' has-error' : ''}}">
                <div class="col-md-60">
                    <label for="assignmentContent">Content</label>
                    <textarea id="assignmentContent" class="form-control" name="text" rows="10"
                              placeholder="Text zadania">{{ old('text', $assignmentObj->text) }}</textarea>
                    @if ($errors->has('text'))
                        @foreach($errors->get('text') as $error)
                            <span class="help-block">{{$error}}</span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script src="{{asset('js/simplemde.min.js')}}"></script>
<script src="{{asset('js/assignment.js')}}"></script>
@endsection