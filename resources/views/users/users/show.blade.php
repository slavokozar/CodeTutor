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

    <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
        <li role="presentation">
            <a href="{{ action('Users\UserController@edit', [$userObj->code]) }}" class="btn">{{ trans('general.buttons.edit') }}</a>
        </li>
        <li role="presentation">
            <a href="{{ action('Users\UserController@deleteModal', [$userObj->code]) }}" class="btn btn-modal">{{ trans('general.buttons.delete') }}</a>
        </li>
    </ul>




    @include('users.partials.show')



@endsection