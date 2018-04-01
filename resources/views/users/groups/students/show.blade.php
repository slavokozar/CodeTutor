@extends('layouts.main')

@section('content-main')
    {!!
         BreadCrumb::render([
             [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
             [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
             [ 'action' => 'Users\Schools\SchoolController@index', 'label' => trans('users.schools.link') ],
             [ 'action' => 'Users\Schools\SchoolController@show', 'params' => [$schoolObj->code], 'label' => $schoolObj->name ],
             [ 'action' => 'Users\Schools\StudentController@index', 'params' => [$schoolObj->code],'label' => trans('users.students.link') ],
             [ 'label' => $userObj->name]
         ])
    !!}

    <h1>{{ $userObj->name }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.edit'), 'action' => 'Users\Schools\StudentController@edit', 'params' => [$schoolObj->code, $userObj->code] ],
                ['label' => trans('general.buttons.delete'), 'modal' => true, 'action' => 'Users\Schools\StudentController@deleteModal', 'params' => [$schoolObj->code, $userObj->code]]
            ]
        ])
    !!}

    @include('users.partials.show')

@endsection