@extends('layout_full')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        <li><a href="{{action('Articles\ArticleController@index')}}">Články</a></li>
        <li><a href="{{action('Articles\ArticleController@show',[$articleObj->code])}}">{{$articleObj->name}}</a></li>
        <li class="active">{{ $articleObj->id != null ? 'Úprava' : 'Nové' }}</li>
    </ol>


    @if($articleObj->id != null)
        <h1>Úprava {{$articleObj->name}}</h1>
        <form class="form" method="post"
              action="{{action('Articles\ArticleController@update',[$articleObj->code])}}">
    @else
        <h1>Vytvorenie zadania</h1>
        <form class="form form-horizontal" method="post"
              action="{{action('Articles\ArticleController@store')}}">
    @endif
    {!! csrf_field() !!}

    <div class="row">
        <div class="col-md-60">
            <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
                <li role="presentation">
                    @if($articleObj->id != null)
                        <a href="{{action('Articles\ArticleController@show',[$articleObj->code])}}">Zrušiť</a>
                    @else
                        <a href="{{action('Articles\ArticleController@index')}}">Zrušiť</a>
                    @endif
                </li>
                <li role="presentation">
                    <button type="submit" class="btn btn-danger">
                        @if($articleObj->id != null) Upraviť @else Vytvoriť @endif
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <section id="assignments">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-lg-30">
                <div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">
                    <label for="articleName">Názov</label>
                    <input id="articleName" type="text" class="form-control" name="name" placeholder="Názov článku"
                           value="{{old('name') != null ? old('name') : $articleObj->name}}">
                    @if ($errors->has('name'))
                        @foreach($errors->get('name') as $error)
                            <span class="help-block">{{$error}}</span>
                        @endforeach
                    @endif
                </div>

                <div class="checkbox">
                    <label>
                        <input name="is_public" type="checkbox" @if((old('is_public') !== null && old('is_public')) || $articleObj->is_public) checked @endif> Verejný článok
                    </label>
                </div>

            </div>
            <div class="col-lg-30">
                <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                    <label for="assignmentGroup">Skupina</label>
                    <select id="assignmentGroup" name="group" class="form-control">
                        <option value="">Vyberte skupinu...</option>
                        @foreach($groups as $group)
                            <option value="{{$group->id}}"
                                    @if((old('group') !== null && old('group') == $group->id) || $articleObj->group_id == $group->id) selected @endif>{{$group->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('group'))
                        @foreach($errors->get('description') as $error)
                            <span class="help-block">{{$error}}</span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>


        <div class="form-group{{$errors->has('description') ? ' has-error' : ''}}">
            <label for="articleDescription">Popis</label>
            <textarea id="articleDescription" class="form-control" name="description" rows="3"
                      placeholder="Popis, ktorý sa zobrazí vo výpise článkov...">{{old('description') != null ? old('description') : $articleObj->description}}</textarea>
            @if ($errors->has('description'))
                @foreach($errors->get('description') as $error)
                    <span class="help-block">{{$error}}</span>
                @endforeach
            @endif
        </div>

        <div class="form-group{{$errors->has('text') ? ' has-error' : ''}}">
            <label for="articleContent">Content</label>
            <textarea id="articleContent" class="form-control" name="text" rows="10"
                      placeholder="Obsah článku">{{old('text') != null ? old('text') : $articleObj->text}}</textarea>
            @if ($errors->has('text'))
                @foreach($errors->get('text') as $error)
                    <span class="help-block">{{$error}}</span>
                @endforeach
            @endif
        </div>
    </section>

</form>
@endsection

@section('scripts')
    <script src="{{asset('js/simplemde.min.js')}}"></script>
    <script>
        var simplemde = new SimpleMDE({
            element: $("#articleContent")[0],
            spellChecker: false
        });

        simplemde.codemirror.on('refresh', function(){
            if($(simplemde.element).closest('.form-group').find('.CodeMirror').hasClass('CodeMirror-fullscreen')){
                ContentNavTabs.makeFixed();
            }else{
                ContentNavTabs.makeRelative();
            }
        });
    </script>
@endsection