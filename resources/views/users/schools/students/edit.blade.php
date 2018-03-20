@extends('layouts.main')

@section('content-main')
    {!!
         BreadCrumb::render([
             [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
             [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
             [ 'action' => 'Users\Schools\SchoolController@index', 'label' => trans('users.schools.link') ],
             [ 'action' => 'Users\Schools\SchoolController@show', 'params' => [$schoolObj->code], 'label' => $schoolObj->name ],
             [ 'action' => 'Users\Schools\StudentController@index', 'params' => [$schoolObj->code],'label' => trans('users.admins.link') ],
             [ 'action' => 'Users\Schools\StudentController@show', 'params' => [$schoolObj->code], 'label' => $userObj->name],
             [ 'label' => $userObj->id ? $userObj->name : trans('users.students.create') ]
         ])
    !!}

    @if($userObj->id)
        <h1>{{ $userObj->name }}</h1>
    @else
        <h1>{{ trans('users.students.create') }}</h1>
    @endif

    @php
        if($userObj->id == null){
            $_form_action = 'Users\Schools\StudentController@create';
            $_form_params = [$schoolObj->code];
            $_form_method = 'post';
        }else{
            $_form_action = 'Users\Schools\StudentController@update';
            $_form_params = [$schoolObj->code, $userObj->code];
            $_form_method = 'put';
        }
    @endphp

    @include('users.partials.edit')

@endsection