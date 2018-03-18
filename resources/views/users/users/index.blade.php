@extends('layout_full')


    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        <li class="active">{{ trans('users.users.link') }}</li>
    </ol>

    <h1>{{ trans('users.users.heading') }}</h1>



    <div class="subnavigation clearfix">
        <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">


            <li role="presentation">
                <a href="{{ action('Users\Schools\SchoolController@index') }}"
                   class="btn">{{ trans('users.schools.link') }}</a>
            </li>
            .btn-modal
            {{--<li role="presentation">--}}
            {{--<a href="{{ action('Users\GroupController@index') }}" class="btn">{{ trans('users.groups.link') }}</a>--}}
            {{--</li>--}}
        </ul>
    </div>

       
    @php
        $_table_action = function($userObj){
            return action('Users\UserController@show', [$userObj->code]);
        };
    @endphp
    @include('users.partials.index')

@endsection