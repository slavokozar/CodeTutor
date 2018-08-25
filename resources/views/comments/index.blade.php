@extends('layouts.main')

@section('content-main')
    @if ($objectObj instanceof App\Models\Articles\Article)
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
            <li><a href="{{action('Articles\ArticleController@index')}}">Články</a></li>
            <li><a href="{{action('Articles\ArticleController@show',[$objectObj->code])}}">{{$objectObj->name}}</a></li>
            <li class="active">Komentáre</li>
        </ol>
    @elseif($objectObj instanceof App\Models\Assignments\Assignment)
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
            <li><a href="{{action('Assignments\AssignmentController@index')}}">Zadania</a></li>
            <li><a href="{{action('Assignments\AssignmentController@show',[$objectObj->code])}}">{{$objectObj->name}}</a></li>
            <li class="active">Komentáre</li>
        </ol>
    @endif
    <section id="comments">
        @include('comments.comments')
    </section>

@endsection



