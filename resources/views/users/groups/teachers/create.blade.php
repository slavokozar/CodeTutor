@extends('layouts.main')

@section('content-main')
    @php
        $breadcrumb = [
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
             [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],

             [ 'action' => 'Users\Groups\GroupController@index', 'label' => trans('users.groups.link') ],
             [ 'action' => 'Users\Groups\GroupController@show', 'params' => [$groupObj->code], 'label' => $groupObj->name ],
             [ 'label' => trans('users.teachers.create') ],
        ];
    @endphp

    {!! BreadCrumb::render($breadcrumb)!!}

    <h1>{{ trans('users.students.create') }}</h1>

    @php
        $_form_action = 'Users\Schools\TeacherController@store';
        $_form_params = [$groupObj->code];
        $_form_method = 'post';

        $userObj = new \App\Models\Users\User();
    @endphp

    @include('users.partials.edit')

@endsection