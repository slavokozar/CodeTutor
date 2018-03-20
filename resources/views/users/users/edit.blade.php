@extends('layouts.main')

@section('content-main')
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

    @php
        if($userObj->id == null){
            $_form_action = 'Users\UserController@create';
            $_form_params = '';
            $_form_method = 'post';
        }else{
            $_form_action = 'Users\UserController@update';
            $_form_params = [$userObj->code];
            $_form_method = 'put';
        }
    @endphp

    @include('users.partials.edit')

@endsection