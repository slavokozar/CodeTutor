@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('articles.articles.link') ]
        ])
    !!}


    <h1>{{ trans('articles.articles.heading') }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.create'), 'action' => 'Articles\ArticleController@create']
            ]
        ])
     !!}

    <section id="activities-list">
        @if(count($articles) == 0)
            <p class="text-center text-danger">{!! trans('articles.articles.no-articles') !!}</p>
        @else
            @foreach($articles as $articleObj)
                <div class="activity {{ $articleObj->is_public ? '' : 'private'}}">

                    <div class="activity-image">
                        <span class="fa fa-newspaper-o" aria-hidden="true"></span>
                    </div>
                    <div class="activity-content">
                        <a href="{{action('Articles\ArticleController@show',[$articleObj->code])}}">
                            <h2>{{$articleObj->name}}</h2>
                        </a>
                        <div class="activity-details">
                            <span class="activity-author">{{ trans('activities.from-user') }} {{$articleObj->author->name}}</span>
                            <span class="activity-date">{{$articleObj->updated_at}}</span>
                        </div>
                        <p class="activity-description">
                            {!! $articleObj->description !!}
                            <a class="read-more" href="{{action('Articles\ArticleController@show',[$articleObj->code])}}">{{ trans('articles.articles.read-more') }}</a>
                        </p>
                    </div>
                </div>
                </div>
            @endforeach
        @endif
    </section>

@endsection