@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Groups\GroupController@index', 'label' => trans('users.groups.link') ],
            [ 'label' => $groupObj->name ]
        ])
    !!}

    @if($groupObj->id)
        <h1>{{ $groupObj->name }}</h1>
    @else
        <h1>{{ trans('users.groups.create') }}</h1>
    @endif

    <form class="form-horizontal"
          action="{{ $groupObj->id == null ? action('Users\Groups\GroupController@store') : action('Users\Groups\GroupController@update', $groupObj->code)}}"
          method="post">
        {!! csrf_field() !!}
        @if($groupObj->id != null)
            <input type="hidden" name="_method" value="put">
        @endif

        {!! ContentNav::submit(['label' => trans('general.buttons.save')]) !!}

        <main role="main">
            <section id="basic">

                @if($groupObj->id != null)
                    <div class="row">
                        <div class="col-md-20">
                            <label for="">#</label>
                        </div>
                        <div class="col-md-40">
                            {{$groupObj->code}}
                        </div>
                    </div>
                @endif
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-md-20" for="">{{ trans('users.labels.name') }}</label>
                    <div class="col-md-40">
                        <input class="form-control" type="text" name="name"
                               value="{{ old('name', $groupObj->name) }}"/>
                        @if( $errors->has('name') )
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>

                    <div class="form-group{{ $errors->has('school_id') ? ' has-error' : '' }}">
                        <label class="col-md-20" for="">{{ trans('users.labels.school') }}</label>
                        <div class="col-md-40">

                            <select class="form-control" name="school_id">
                                @foreach($groups as $groupObj)
                                    <option value="{{ $groupObj->id }}"{{ old('school_id', $groupObj->school_id) == $groupObj->id ? ' selected' : '' }}>{{$groupObj->name}}</option>
                                @endforeach
                            </select>
                                   {{--value="{{ old('school_id', $groupObj->name) }}"/>--}}
                            @if( $errors->has('school_id') )
                                <span class="help-block">{{ $errors->first('school_id') }}</span>
                            @endif
                        </div>
                    </div>


            </section>
        </main>


    </form>


@endsection