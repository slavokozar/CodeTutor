@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Groups\GroupController@index', 'label' => trans('users.groups.link') ],
            [ 'label' => $groupObj->name ]
        ])
    !!}


    <h1>{{ $groupObj->name }}</h1>

    {!!
        ContentNav::render([
            'left' => [
                ['label' => trans('users.teachers.link'), 'action' => 'Users\Groups\TeacherController@index', 'params' => [$groupObj->code] ],
                ['label' => trans('users.students.link'), 'action' => 'Users\Groups\StudentController@index', 'params' => [$groupObj->code] ],

            ],
            'right' => [
                ['label' => trans('general.buttons.edit'), 'action' => 'Users\Groups\GroupController@edit', 'params' => [$groupObj->code] ],
                ['label' => trans('general.buttons.delete'), 'modal' => true, 'action' => 'Users\Groups\GroupController@create', 'params' => [$groupObj->code]]
            ]
        ])
     !!}


    <section id="basic">
        {!!
            DataRender::render([
                [ 'label' => trans('users.groups.labels.name'), 'value' => $groupObj->name ],
                [ 'label' => trans('users.groups.labels.school'), 'value' => $groupObj->school ? $groupObj->school->name : '' ],
            ])
         !!}
    </section>


@endsection