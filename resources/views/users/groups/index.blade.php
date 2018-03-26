@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'label' => trans('users.groups.link') ]
        ])
    !!}

    <h1>{{ trans('users.groups.heading') }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.create'), 'action' => 'Users\Groups\GroupController@create']
            ]
        ])
     !!}


    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('users.groups.labels.name') }}</th>
            <th>{{ trans('users.groups.labels.school') }}</th>
            <th>{{ trans('users.groups.labels.public') }}</th>
            <th><i class="fa fa-user" data-toggle="tooltip"
                   title="{{ trans('users.groups.labels.teachers') }}" aria-hidden="true"></i></th>
            <th><i class="fa fa-graduation-cap" data-toggle="tooltip"
                   title="{{ trans('users.groups.labels.students') }}" aria-hidden="true"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach($groups as $groupObj)
            <tr>
                <th scope="row">
                    <a href="{{ action('Users\Groups\GroupController@show', [$groupObj->code]) }}">{{$groupObj->code}}</a>
                </th>
                <td>
                    <a href="{{ action('Users\Groups\GroupController@show', [$groupObj->code]) }}">{{$groupObj->name}}</a>
                </td>
                <td>{{$groupObj->school ? $groupObj->school->name : ''}}</td>
                <td>{!! $groupObj->is_public ? '<i class="fa fa-check" aria-hidden="true"></i>' : '' !!}</td>
                <td>
                    {{ $groupObj->teachers()->count() }}
                </td>
                <td>
                    {{ $groupObj->students()->count() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection