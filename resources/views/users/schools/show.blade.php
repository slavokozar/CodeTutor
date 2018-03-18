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

    <div class="subnavigation clearfix">
        <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
            <li role="presentation">
                <a href="{{ action('Users\Schools\AdminController@index', [$schoolObj->code]) }}"
                   class="btn">{{ trans('users.admins.link') }}</a>
            </li>
            <li role="presentation">
                <a href="{{ action('Users\Schools\TeacherController@index', [$schoolObj->code]) }}"
                   class="btn">{{ trans('users.teachers.link') }}</a>
            </li>
            <li role="presentation">
                <a href="{{ action('Users\Schools\StudentController@index', [$schoolObj->code]) }}"
                   class="btn">{{ trans('users.students.link') }}</a>
            </li>
            <li role="presentation">
                <a href="{{ action('Users\Schools\SchoolController@edit', [$schoolObj->code]) }}"
                   class="btn">{{ trans('general.buttons.edit') }}</a>
            </li>
            <li role="presentation">
                <a href="{{ action('Users\Schools\SchoolController@deleteModal', [$schoolObj->code]) }}"
                   class="btn btn-modal">{{ trans('general.buttons.delete') }}</a>
            </li>
        </ul>
    </div>

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