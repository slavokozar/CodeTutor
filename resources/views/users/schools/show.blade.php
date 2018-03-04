@extends('layout_full')

@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        </li>
        <li>
            <a href="{{ action('Users\UserController@index') }}">{{ trans('users.users.link') }}</a>
        </li>
        <li>
            <a href="{{ action('Users\Schools\SchoolController@index') }}">{{ trans('users.schools.link') }}</a>
        </li>
        <li class="active">{{ $schoolObj->name }}</li>
    </ol>

    <h1>{{ $schoolObj->name }}</h1>

    <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
        <li role="presentation">
            <a href="{{ action('Users\Schools\AdminController@index', [$schoolObj->code]) }}" class="btn">{{ trans('users.admins.link') }}</a>
        </li>
        <li role="presentation">
            <a href="{{ action('Users\Schools\TeacherController@index', [$schoolObj->code]) }}" class="btn">{{ trans('users.teachers.link') }}</a>
        </li>
        <li role="presentation">
            <a href="{{ action('Users\Schools\StudentController@index', [$schoolObj->code]) }}" class="btn">{{ trans('users.students.link') }}</a>
        </li>
    </ul>


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

{{--    @include('users.navbar')--}}

    {{--<table class="table">--}}
        {{--<caption>{{ trans('users.users.registered') }}</caption>--}}
        {{--<thead>--}}
        {{--<tr>--}}
            {{--<th>#</th>--}}
            {{--<th>{{ trans('users.name') }}</th>--}}
            {{--<th>{{ trans('users.email') }}</th>--}}
            {{--<th>{{ trans('users.roles') }}</th>--}}
            {{--<th>{{ trans('users.school') }}</th>--}}
            {{--<th>{{ trans('users.groups') }}</th>--}}
        {{--</tr>--}}
        {{--</thead>--}}
        {{--<tbody>--}}
        {{--@foreach($users as $userObj)--}}
            {{--<tr>--}}
                {{--<th scope="row">{{$userObj->code}}</th>--}}
                {{--<td>{{$userObj->name}}</td>--}}
                {{--<td>{{$userObj->email}}</td>--}}
                {{--<td>{{$userObj->role}}</td>--}}
                {{--<td>--}}
                    {{--@foreach($userObj->schools as $schoolObj)--}}
                        {{--{{$schoolObj->name}}--}}
                    {{--@endforeach--}}
                {{--</td>--}}
                {{--<td>--}}
                    {{--@foreach($userObj->groups as $groupObj)--}}
                        {{--{{$groupObj->name}}--}}
                    {{--@endforeach--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
        {{--</tbody>--}}
    {{--</table>--}}

@endsection