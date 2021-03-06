@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],

            [ 'action' => 'Users\Groups\GroupController@index', 'label' => trans('users.groups.link') ],
            [ 'action' => 'Users\Groups\GroupController@show', 'params' => [$groupObj->code], 'label' => $groupObj->name ],
            [ 'label' => trans('users.students.link') ]
        ])
    !!}

    <h1>{{ trans('users.students.heading') }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.add'), 'action' => 'Users\Groups\StudentController@add', 'params' => [$groupObj->code], 'modal' => true]
            ]
        ])
    !!}

    @php
        $_table_skip['school'] = true;
        $_table_skip['groups'] = true;
        $_table_action = function($userObj) use ($groupObj){
            return action('Users\Groups\StudentController@show', [$groupObj->code, $userObj->code]);
        };

        $_table_actions = [
            [
                'action' => function($userObj) use ($groupObj){
                    return action('Users\Groups\StudentController@deleteModal', [$groupObj->code, $userObj->code]);
                },
                'label' => trans('general.remove'),
                'icon' => 'fa-trash',
                'modal' => true
            ]
        ]
    @endphp

    @if(count($users) > 0)
        @include('users.partials.index')
    @else
        <p class="text-center text-warning">
            <i class="fa fa-5x fa-frown-o" aria-hidden="true"></i>
            <br/>
            {{ trans('users.groups.no-students') }}
        </p>
    @endif

@endsection