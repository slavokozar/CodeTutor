@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Schools\SchoolController@index', 'label' => trans('users.schools.link') ],
            [ 'label' => $schoolObj->name ]
        ])
    !!}


    <h1>{{ $schoolObj->name }}</h1>

    {!!
        ContentNav::render([
            'left' => [
                ['label' => trans('users.admins.link'), 'action' => 'Users\Schools\AdminController@index', 'params' => [$schoolObj->code] ],
                ['label' => trans('users.teachers.link'), 'action' => 'Users\Schools\TeacherController@index', 'params' => [$schoolObj->code] ],
                ['label' => trans('users.students.link'), 'action' => 'Users\Schools\StudentController@index', 'params' => [$schoolObj->code] ],

            ],
            'right' => [
                ['label' => trans('general.buttons.edit'), 'action' => 'Users\Schools\SchoolController@edit', 'params' => [$schoolObj->code] ],
                ['label' => trans('general.buttons.delete'), 'modal' => true, 'action' => 'Users\Schools\SchoolController@create', 'params' => [$schoolObj->code]]
            ]
        ])
     !!}


    <section id="basic">
        {!!
            DataRender::render([
                ['label'=>'#', 'value'=>$schoolObj->code],
                ['label'=>trans('users.schools.labels.address'), 'value'=>$schoolObj->address],
                ['label'=>trans('users.schools.labels.url'), 'value'=>$schoolObj->url],
            ])
        !!}
    </section>


@endsection