@extends('layout_full')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        <li class="active">{{ trans('users.users.link') }}</li>
    </ol>

    <h1>{{ trans('users.users.heading') }}</h1>

    <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
        <li role="presentation">
            <a href="{{ action('Users\Schools\SchoolController@index') }}" class="btn">{{ trans('users.schools.link') }}</a>
        </li>
        <li role="presentation">
            <a href="{{ action('Users\GroupController@index') }}" class="btn">{{ trans('users.groups.link') }}</a>
        </li>
    </ul>

    @include('users.partials.index')

@endsection