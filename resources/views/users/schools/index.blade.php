@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'label' => trans('users.schools.link') ]
        ])
    !!}

    <h1>{{ trans('users.schools.heading') }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.create'), 'action' => 'Users\Schools\SchoolController@create']
            ]
        ])
    !!}

    <section id="list">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('users.schools.labels.name') }}</th>
                <th>{{ trans('users.schools.labels.address') }}</th>
                <th>{{ trans('users.schools.labels.url') }}</th>
                <th><i class="fa fa-wrench" aria-hidden="true"></i></th>
                <th><i class="fa fa-user" data-toggle="tooltip" title="{{ trans('users.schools.labels.teachers') }}"
                       aria-hidden="true"></i></th>
                <th><i class="fa fa-graduation-cap" data-toggle="tooltip"
                       title="{{ trans('users.schools.labels.students') }}" aria-hidden="true"></i></th>

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
    </section>

@endsection