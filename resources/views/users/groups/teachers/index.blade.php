@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Groups\GroupController@index', 'label' => trans('users.groups.link') ],
            [ 'action' => 'Users\Groups\GroupController@show', 'params' => [$groupObj->code], 'label' => $groupObj->name ],
            [ 'label' => trans('users.teachers.link') ]
        ])
    !!}

    <h1>{{ trans('users.teachers.heading') }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.add'), 'action' => 'Users\Groups\TeacherController@add', 'params' => [$groupObj->code], 'modal' => true]
            ]
        ])
    !!}

    @php
        $_table_skip['school'] = true;
        $_table_skip['groups'] = true;
        $_table_action = function($userObj) use ($groupObj){
            return action('Users\Groups\TeacherController@show', [$groupObj->code, $userObj->code]);
        };

        $_table_actions = [
            [
                'action' => function($userObj) use ($groupObj){
                    return action('Users\Groups\TeacherController@deleteModal', [$groupObj->code, $userObj->code]);
                },
                'label' => trans('general.detach'),
                'icon' => 'fa-times',
                'modal' => true
            ]
        ]
    @endphp

    @if(count($users) > 0)

        <form method="post" action="{{ action('Users\Groups\TeacherController@global', [$groupObj->code]) }}">
            {!! csrf_field() !!}

            <div id="global-actions">
                <div class="inner">
                    <label>
                        {{ trans('general.global-actions') }}
                    </label>
                    <div class="actions">
                        <button class="btn btn-sm btn-danger" type="submit" name="action" value="delete">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            {{ trans('general.detach') }}
                        </button>
                    </div>
                </div>
            </div>

            @include('users.partials.index')

        </form>

    @else
        <p class="text-center text-warning">
            <i class="fa fa-5x fa-frown-o" aria-hidden="true"></i>
            <br/>
            {{ trans('users.groups.no-teachers') }}
        </p>
    @endif

@endsection