@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('users.users.link') ]
        ])
    !!}

    <h1>{{ trans('users.users.heading') }}</h1>

    @php
        $left = [];

        if(Gate::allows('schools-view'))
            $left[] = ['label' => trans('users.schools.heading'), 'action' => 'Users\Schools\SchoolController@index'];

        if(Gate::allows('groups-view'))
            $left[] = ['label' => trans('users.groups.heading'), 'action' => 'Users\Groups\GroupController@index'];

        $right = [];
        $right[] = ['label' => trans('general.create'), 'action' => 'Users\UserController@create'];
    @endphp

    {!! ContentNav::render(['left' => $left,'right' => $right]); !!}
       
    @php
        $_table_action = function($userObj){
            return action('Users\UserController@show', [$userObj->code]);
        };
    @endphp
    <section id="list">
        @include('users.partials.index')
    </section>


@endsection