@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('links.link') ]
        ])
    !!}


    <h1>{{ trans('links.heading') }}</h1>

    @if(Auth::check() && Auth::user()->isAuthor())
    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Links\LinkController@create']
            ]
        ])
     !!}
    @endif

    <section id="activities-list">

        @if(count($links) == 0)
            <p class="text-center text-danger">{!! trans('links.no-links') !!}</p>
        @else
            @foreach($links as $linkObj)
                @include('links.activity')
            @endforeach
            {!! $links->render() !!}
        @endif
    </section>
@endsection
