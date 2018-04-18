@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => Auth::user()->fullName() ],
            [ 'label' => trans('profile.articles.link') ]
        ])
    !!}

    <h1>{{ trans('profile.articles.link') }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.create'), 'action' => 'Articles\ArticleController@create']
            ]
        ])
     !!}

    <section class="table-list">
        @if(count($articles) == 0)
            <p class="text-center text-danger">{!! trans('profile.articles.no-articles') !!}</p>
        @else
            @foreach($articles as $articleObj)
                <div class="table-row">
                    <div class="table-row-content">
                        <div class="table-column-name">
                            <a href="{{action('Articles\ArticleController@show',[$articleObj->code])}}">
                                {{$articleObj->name}}
                            </a>
                        </div>
                        <div class="table-column-date">{{$articleObj->updated_at}}</div>
                    </div>
                    <div class="table-row-description">
                        {{ $articleObj->description }}
                    </div>
                </div>
            @endforeach
        @endif
    </section>

@endsection