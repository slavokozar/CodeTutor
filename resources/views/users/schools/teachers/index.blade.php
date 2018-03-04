@extends('layout_full')

@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        </li>
        <li>
            <a href="{{ action('Users\UserController@index') }}">{{ trans('users.users.link') }}</a>
        </li>
        <li>
            <a href="{{ action('Users\Schools\SchoolController@index') }}">{{ trans('users.schools.link') }}</a>
        </li>
        <li>
            <a href="{{ action('Users\Schools\SchoolController@show', [$schoolObj]) }}">{{ $schoolObj->name }}</a>
        </li>
        <li class="active">{{ trans('users.admins.link') }}</li>
    </ol>

    <h1>{{ trans('users.admins.heading') }}</h1>

    @php
        $_table_skip['school'] = true;
        $_table_action = function($userObj) use ($schoolObj){
            return action('Users\Schools\TeacherController@show', [$schoolObj->code, $userObj->code]);
        };
    @endphp
    @include('users.partials.index')

@endsection