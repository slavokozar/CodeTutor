@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('articles.link') ]
        ])
    !!}


    <h1>{{ trans('articles.heading') }}</h1>

    @if(Auth::check() && Auth::user()->isAuthor())
    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Articles\ArticleController@create']
            ]
        ])
     !!}
    @endif

    <section id="activities-list">

        @if(count($articles) == 0)
            <p class="text-center text-danger">{!! trans('articles.no-articles') !!}</p>
        @else
            @foreach($articles as $articleObj)
                @include('articles.activity')
            @endforeach
                {!! $articles->render() !!}
        @endif
    </section>

@endsection