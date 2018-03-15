@extends('layout_full')

@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        </li>
        <li>
            <a href="{{ action('Users\UserController@index') }}">{{ trans('users.users.link') }}</a>
        </li>
        <li class="active">{{ trans('users.schools.link') }}</li>
    </ol>

    <h1>{{ trans('users.schools.heading') }}</h1>

    <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
        <li role="presentation">
            <a href="{{ action('Users\Schools\SchoolController@create') }}" class="btn">{{ trans('general.buttons.create') }}</a>
        </li>
        {{--<li role="presentation">--}}
        {{--<a href="{{ action('Users\GroupController@index') }}" class="btn">{{ trans('users.groups.link') }}</a>--}}
        {{--</li>--}}
    </ul>


    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('users.schools.labels.name') }}</th>
            <th>{{ trans('users.schools.labels.address') }}</th>
            <th>{{ trans('users.schools.labels.url') }}</th>
            <th><i class="fa fa-wrench" aria-hidden="true"></i></th>
            <th><i class="fa fa-user" data-toggle="tooltip" title="{{ trans('users.schools.labels.teachers') }}" aria-hidden="true"></i></th>
            <th><i class="fa fa-graduation-cap" data-toggle="tooltip" title="{{ trans('users.schools.labels.students') }}" aria-hidden="true"></i></th>

        </tr>
        </thead>
        <tbody>
        @foreach($schools as $schoolObj)
            <tr>
                <th scope="row">
                    <a href="{{ action('Users\Schools\SchoolController@show', [$schoolObj->code]) }}">{{$schoolObj->code}}</a>
                </th>
                <td>
                    <a href="{{ action('Users\Schools\SchoolController@show', [$schoolObj->code]) }}">{{$schoolObj->name}}</a>
                </td>
                <td>{{$schoolObj->address}}</td>
                <td>
                    <a href="{{ $schoolObj->url }}" target="_blank">{{$schoolObj->url}}</a>
                </td>
                <td>
                    {{ $schoolObj->admins()->count() }}
                </td>
                <td>
                    {{ $schoolObj->teachers()->count() }}
                </td>
                <td>
                    {{ $schoolObj->students()->count() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection