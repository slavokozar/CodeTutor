@extends('layout_full')

@section('content')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Schools\SchoolController@index', 'label' => trans('users.schools.link') ],
            [ 'label' => $groupObj->name ]
        ])
    !!}


    <h1>{{ $groupObj->name }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.edit'), 'action' => 'Users\Groups\GroupController@edit', 'params' => [$groupObj->code] ],
                ['label' => trans('general.buttons.delete'), 'modal' => true, 'action' => 'Users\Groups\GroupController@create', 'params' => [$groupObj->code]]
            ]
        ])
     !!}


    <main role="main">
        <div class="row">
            <div class="col-md-20">
                <label for="">{{trans('users.groups.labels.name')}}</label>
            </div>
            <div class="col-md-40">
                {{ $groupObj->name }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-20">
                <label for="">{{trans('users.groups.labels.school')}}</label>
            </div>
            <div class="col-md-40">
                {{ $groupObj->school->name }}
            </div>
        </div>

    </main>


@endsection