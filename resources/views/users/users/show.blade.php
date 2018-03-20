@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'label' => $userObj->id ? $userObj->name : trans('users.users.create') ]
        ])
    !!}


    <h1>{{ $userObj->name }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.edit'), 'action' => 'Users\UserController@edit', 'params' => [$userObj->code] ],
                ['label' => trans('general.buttons.delete'), 'modal' => true, 'action' => 'Users\UserController@create', 'params' => [$userObj->code]]
            ]
        ])
     !!}

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
@endsection