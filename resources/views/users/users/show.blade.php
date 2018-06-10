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
                ['label' => trans('general.edit'), 'action' => 'Users\UserController@edit', 'params' => [$userObj->code] ],
                ['label' => trans('general.delete'), 'modal' => true, 'action' => 'Users\UserController@deleteModal', 'params' => [$userObj->code]]
            ]
        ])
    !!}

    @include('users.partials.show')

@endsection