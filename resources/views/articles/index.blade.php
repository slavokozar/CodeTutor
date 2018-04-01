@extends('layouts.main')


@section('content-main')
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        <li class="active">Články</li>
    </ol>

    <h1>Články</h1>

    @if(Auth::check() && Auth::user()->isArticleAuthor())
        <div class="row">
            <div class="col-md-60">
                <ul id="content-nav-tabs" class="nav nav-tabs">
                    <li role="presentation">
                        <a href="{{action('Articles\ArticleController@create')}}" class="btn">Vytvoriť nový</a>
                    </li>
                </ul>
            </div>
        </div>
    @endif

    @if(count($articles) == 0)
        <p class="text-center text-danger">
            Práve tu nie su žiadne články.<br/>
            <i class="fa fa-4x fa-meh-o" aria-hidden="true"></i><br/>
            Ľutujeme, ak si myslíte, že články by tu mali byť, neváhajte <a href="/#contact">kontaktovať</a> správcov.
        </p>
    @else
        @foreach($articles as $articleObj)
            <div class="article {{ $articleObj->is_public ? '' : 'private'}}">
                <a href="{{action('Articles\ArticleController@show',[$articleObj->code])}}">
                    <h2 class="article-name">{{$articleObj->name}}</h2>
                </a>
                {{--<p class="assignment-author">{{$articleObj->author->name}} | {{$articleObj->created_at}}</p>--}}
                <p>{!! $articleObj->description !!}</p>
                <a href="{{action('Articles\ArticleController@show',[$articleObj->code])}}">Viac...</a>
            </div>
        @endforeach
    @endif

@endsection