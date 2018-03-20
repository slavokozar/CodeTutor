@extends('layouts.main')

@section('content-main')
    {!!
         BreadCrumb::render([
             [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
             [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
             [ 'action' => 'Users\Schools\SchoolController@index', 'label' => trans('users.schools.link') ],
             [ 'action' => 'Users\Schools\SchoolController@show', 'params' => [$schoolObj->code], 'label' => $schoolObj->name ],
             [ 'action' => 'Users\Schools\TeacherController@index', 'params' => [$schoolObj->code],'label' => trans('users.admins.link') ],
             [ 'label' => $userObj->name]
         ])
    !!}

    <h1>{{ $userObj->name }}</h1>


@endsection