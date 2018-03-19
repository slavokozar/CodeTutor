@extends('layout_full')

@section('content')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'label' => $userObj->id ? $userObj->name : trans('users.users.create') ]
        ])
    !!}

    @if($userObj->id)
        <h1>{{ $userObj->name }}</h1>
    @else
        <h1>{{ trans('users.users.create') }}</h1>
    @endif

    <form class="form-horizontal"
          action="{{ $userObj->id == null ? action('Users\UserController@store') : action('Users\UserController@update', $userObj->code)}}"
          method="post">
        {!! csrf_field() !!}
        @if($userObj->id != null)
            <input type="hidden" name="_method" value="put">
        @endif

        {!! ContentNav::submit(['label' => trans('general.buttons.save')]) !!}

        <main role="main">
            <section id="basic">


                @if($userObj->id != null)
                    <div class="row">
                        <div class="col-md-20">
                            <label for="">#</label>
                        </div>
                        <div class="col-md-40">
                            {{$userObj->code}}
                        </div>
                    </div>
                @endif
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label class="col-md-20" for="">{{ trans('users.labels.title') }}</label>
                    <div class="col-md-40">
                        <input class="form-control" type="text" name="title"
                               value="{{ old('title', $userObj->title) }}"/>
                        @if( $errors->has('title') )
                            <span class="help-block">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-md-20" for="">{{ trans('users.labels.name') }}</label>
                    <div class="col-md-40">
                        <input class="form-control" type="text" name="name" value="{{ old('name', $userObj->name) }}"/>
                        @if( $errors->has('name') )
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                    <label class="col-md-20" for="">{{ trans('users.labels.surname') }}</label>
                    <div class="col-md-40">
                        <input class="form-control" type="text" name="surname"
                               value="{{ old('surname', $userObj->surname) }}"/>
                        @if( $errors->has('surname') )
                            <span class="help-block">{{ $errors->first('surname') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-md-20" for="">{{ trans('users.labels.email') }}</label>
                    <div class="col-md-40">
                        <input class="form-control" type="email" name="email"
                               value="{{ old('email', $userObj->email) }}"/>
                        @if( $errors->has('email') )
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                    <label class="col-md-20" for="">{{ trans('users.labels.birthdate') }}</label>
                    <div class="col-md-40">
                        <input class="form-control" type="date" name="birthdate"
                               value="{{ old('birthdate', $userObj->birthdate) }}"/>
                        @if( $errors->has('birthdate') )
                            <span class="help-block">{{ $errors->first('birthdate') }}</span>
                        @endif
                    </div>
                </div>
            </section>
        </main>


    </form>


@endsection