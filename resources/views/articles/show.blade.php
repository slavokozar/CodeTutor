@extends('layout_full')

@section('sidebar')
@endsection

@section('content')
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        <li><a href="{{action('Articles\ArticleController@index')}}">Články</a></li>
        <li class="active">{{$articleObj->name}}</li>
    </ol>

    <h1>{!! $articleObj->is_public ? '' : 'profile' !!}{{$articleObj->name}}</h1>

    <div class="row">
        <div class="col-md-60">
            <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
                <li role="presentation">
                    <a href="{{action('Articles\ArticleController@edit',[$articleObj->code])}}">Upraviť</a>
                </li>
                <li role="presentation">
                    <a href="{{action('Articles\ArticleController@delete',[$articleObj->code])}}">Vymazať</a>
                </li>
            </ul>
        </div>
    </div>


    <section id="assignments">
        {!! $content !!}
    </section>


    <section id="comments">
        <h2>Komentáre</h2>
        <?php $objectObj = $articleObj; ?>

        @include('comments.comments')

        @if(count($comments) > 0)
            <p class="text-center">
                <a href="{{action('CommentController@index',[$articleObj->commentRoute(), $articleObj->code])}}">všetky komentáre</a>
            </p>
        @endif
    </section>
@endsection


@section('scripts')
    <script src="{{asset('js/comments.js')}}"></script>
@endsection
