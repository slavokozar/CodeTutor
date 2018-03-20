@extends('layouts.main')

@section('content-main')
    {!!
         BreadCrumb::render([
             [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
             [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
             [ 'action' => 'Users\Schools\SchoolController@index', 'label' => trans('users.schools.link') ],
             [ 'action' => 'Users\Schools\SchoolController@show', 'params' => [$schoolObj->code], 'label' => $schoolObj->name ],
             [ 'action' => 'Users\Schools\TeacherController@index', 'params' => [$schoolObj->code],'label' => trans('users.admins.link') ],
             [ 'action' => 'Users\Schools\TeacherController@show', 'params' => [$schoolObj->code], 'label' => $userObj->name],
             [ 'label' => $userObj->id ? $userObj->name : trans('users.teachers.create') ]
         ])
    !!}

    @if($userObj->id)
        <h1>{{ $userObj->name }}</h1>
    @else
        <h1>{{ trans('users.teachers.create') }}</h1>
    @endif

    @php
        if($userObj->id == null){
            $_form_action = 'Users\Schools\TeacherController@create';
            $_form_params = [$schoolObj->code];
            $_form_method = 'post';
        }else{
            $_form_action = 'Users\Schools\TeacherController@update';
            $_form_params = [$schoolObj->code, $userObj->code];
            $_form_method = 'put';
        }
    @endphp

    @include('users.partials.edit')

@endsection