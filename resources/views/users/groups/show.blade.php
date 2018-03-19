@extends('layout_full')

@section('content')
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


    <main role="main">
        <div class="row">
            <div class="col-md-20">
                <label for="">{{trans('users.schools.labels.address')}}</label>
            </div>
            <div class="col-md-40">
                {{ $schoolObj->address }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-20">
                <label for="">{{trans('users.schools.labels.url')}}</label>
            </div>
            <div class="col-md-40">
                <a href="{{ $schoolObj->url }}" target="_blank">{{ $schoolObj->url }}</a>
            </div>
        </div>

    </main>


@endsection