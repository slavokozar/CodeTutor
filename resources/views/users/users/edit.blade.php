@extends('layout_full')

@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        </li>
        <li>
            <a href="{{ action('Users\UserController@index') }}">{{ trans('users.users.link') }}</a>
        </li>
        <li class="active">{{ $userObj->name }}</li>
    </ol>

    <h1>{{ $userObj->name }}</h1>

    <form class="form-horizontal" action="{{action('Users\UserController@update', $userObj->code)}}" method="post">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="put">

        <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
            <li role="presentation">
                <button class="btn btn-danger" type="submit">{{ trans('general.buttons.save') }}</button>
            </li>
        </ul>

        <main role="main">
            <div class="row">
                <div class="col-md-20">
                    <label for="">#</label>
                </div>
                <div class="col-md-40">
                    {{$userObj->code}}
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
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-md-20" for="">{{ trans('users.labels.email') }}</label>
                <div class="col-md-40">
                    <input class="form-control" type="email" name="email" value="{{ old('email', $userObj->email) }}"/>
                    @if( $errors->has('email') )
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                <label class="col-md-20" for="">{{ trans('users.labels.birthdate') }}</label>
                <div class="col-md-40">
                    <input class="form-control" type="date" name="birthdate" value="{{ old('birthdate', $userObj->birthdate) }}"/>
                    @if( $errors->has('birthdate') )
                        <span class="help-block">{{ $errors->first('birthdate') }}</span>
                    @endif
                </div>
            </div>

        </main>


    </form>


@endsection