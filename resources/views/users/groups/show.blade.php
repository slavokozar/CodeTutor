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
                ['label' => trans('general.edit'), 'action' => 'Users\Groups\GroupController@edit', 'params' => [$groupObj->code] ],
                ['label' => trans('general.delete'), 'modal' => true, 'action' => 'Users\Groups\GroupController@create', 'params' => [$groupObj->code]]
            ]
        ])
     !!}


    <section id="basic" class="show-section">
        <h2>{{trans('general.basic-info')}}</h2>
        {!!
            DataRender::render([
                [ 'label' => trans('users.groups.labels.name'), 'value' => $groupObj->name ],
                [ 'label' => trans('users.groups.labels.school'), 'value' => $groupObj->school ? $groupObj->school->name : '' ],
            ])
         !!}
    </section>

    <section id="teachers" class="show-section">
        <h2>{{trans('users.teachers.heading')}}</h2>

        @if($groupObj->teachers->count() > 0)
            <ul class="list-group">
                @foreach($groupObj->teachers as $teacherObj)
                    <li class="list-group-item">
                        <a href="{{ action('Users\Groups\TeacherController@show', [$groupObj->code, $teacherObj->code]) }}">
                        {{ $teacherObj->fullName() }}
                        </a>
                        {{--({{ trans('users.schools.roles')[$teacherObj->pivot->role] }})--}}
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-info" role="alert">{{ trans('users.groups.no-teachers') }}</div>
        @endif

        <div class="text-center">
            <a class="btn btn-sm btn-danger btn-modal" href="{{ action('Users\Groups\TeacherController@add', [$groupObj->code]) }}">
                {{ trans('users.teachers.add') }}
            </a>
        </div>
    </section>


    <section id="students" class="show-section">
        <h2>{{trans('users.students.heading')}}</h2>

        @if($groupObj->students->count() > 0)
            <ul class="list-group">
                @foreach($groupObj->students as $studentObj)
                    <li class="list-group-item">
                        <a href="{{ action('Users\Groups\StudentController@show', [$groupObj->code, $teacherObj->code]) }}">
                        {{ $studentObj->fullName() }}
{{--                        ({{ trans('users.groups.roles')[$groupObj->pivot->role] }})--}}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-info text-center" role="alert">{{ trans('users.groups.no-students') }}</div>
        @endif

        <div class="text-center">
            <a class="btn btn-sm btn-danger btn-modal" href="{{ action('Users\Groups\StudentController@add', [$groupObj->code]) }}">
                {{ trans('users.students.add') }}
            </a>
        </div>
    </section>


@endsection