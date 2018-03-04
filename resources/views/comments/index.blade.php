@extends('layout_full')

@section('sidebar')
@endsection

@section('content')
    @if ($object instanceof App\Models\Article)
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
            <li><a href="{{action('Articles\ArticleController@index')}}">Články</a></li>
            <li><a href="{{action('Articles\ArticleController@show',[$objectObj->code])}}">{{$objectObj->name}}</a></li>
            <li class="active">Komentáre</li>
        </ol>
    @elseif($object instanceof App\Models\Assignment)
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



