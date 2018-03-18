@extends('layout_full')

@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        </li>
        <li>
            <a href="{{ action('Users\UserController@index') }}">{{ trans('users.users.link') }}</a>
        </li>
        <li class="active">{{ $userObj->name }}</li>
    </ol>

    <h1>{{ $userObj->name }}</h1>

    <div class="subnavigation clearfix">
        <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
            <li role="presentation">
                <a href="{{ action('Users\UserController@edit', [$userObj->code]) }}"
                   class="btn">{{ trans('general.buttons.edit') }}</a>
            </li>
            <li role="presentation">
                <a href="{{ action('Users\UserController@deleteModal', [$userObj->code]) }}"
                   class="btn btn-modal">{{ trans('general.buttons.delete') }}</a>
            </li>
        </ul>
    </div>

    <main role="main">

        @include('users.partials.show')

        <section id="schools">
            <h3>{{trans('users.schools.heading')}}</h3>

            @php $schools = $userObj->schools @endphp
            @if($schools->count() > 0)
                <ul class="list-group">
                    @foreach($schools as $schoolObj)
                        <li class="list-group-item">{{ $schoolObj->name }}
                            ({{ trans('users.schools.roles')[$schoolObj->pivot->role] }})
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="alert alert-info" role="alert">{{ trans('users.users.no-schools') }}</div>
            @endif
        </section>

        <section id="groups">
            <h3>{{trans('users.groups.heading')}}</h3>

            @php $groups = $userObj->groups @endphp
            @if($groups->count() > 0)
                <ul class="list-group">
                    @foreach($groups as $groupObj)
                        <li class="list-group-item">{{ $groupObj->name }}
                            ({{ trans('users.groups.roles')[$groupObj->pivot->role] }})
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="alert alert-info" role="alert">{{ trans('users.users.no-groups') }}</div>
            @endif
        </section>
    </main>
@endsection