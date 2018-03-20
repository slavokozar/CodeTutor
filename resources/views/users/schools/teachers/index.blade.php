@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Schools\SchoolController@index', 'label' => trans('users.schools.link') ],
            [ 'action' => 'Users\Schools\SchoolController@show', 'params' => [$schoolObj->code], 'label' => $schoolObj->name ],
            [ 'label' => trans('users.teachers.link') ]
        ])
    !!}

    <h1>{{ trans('users.teachers.heading') }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.create'), 'action' => 'Users\Schools\TeacherController@create', 'params' => [$schoolObj->code]]
            ]
        ])
    !!}

    @php
        $_table_skip['school'] = true;
        $_table_action = function($userObj) use ($schoolObj){
            return action('Users\Schools\TeacherController@show', [$schoolObj->code, $userObj->code]);
        };
    @endphp
    @include('users.partials.index')

@endsection