@extends('layouts.main')

@section('content-main')
    {!!
         BreadCrumb::render([
             [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
             [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],

             [ 'action' => 'Users\Groups\GroupController@index', 'label' => trans('users.groups.link') ],
             [ 'action' => 'Users\Groups\GroupController@show', 'params' => [$groupObj->code], 'label' => $groupObj->name ],
             [ 'action' => 'Users\Groups\StudentController@index', 'params' => [$groupObj->code],'label' => trans('users.students.link') ],
             [ 'label' => $userObj->name]
         ])
    !!}

    <h1>{{ $userObj->name }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.edit'), 'action' => 'Users\Groups\StudentController@edit', 'params' => [$groupObj->code, $userObj->code] ],
                ['label' => trans('general.delete'), 'modal' => true, 'action' => 'Users\Groups\StudentController@deleteModal', 'params' => [$groupObj->code, $userObj->code]]
            ]
        ])
    !!}

    @include('users.partials.show')

@endsection