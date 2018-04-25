@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('articles.articles.link'), 'action' => 'Articles\ArticleController@index' ],
            [ 'label' => $articleObj->name]
        ])
    !!}


    <h1>{{ $articleObj->name }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.buttons.edit'), 'action' => 'Articles\ArticleController@edit', 'params' => [$articleObj->code]],
                ['label' => trans('general.buttons.delete'), 'action' => 'Articles\ArticleController@deleteModal', 'params' => [$articleObj->code], 'modal' => true]
            ]
        ])
     !!}

    <section id="sharing">
        <p>
            Tento clanok je zdielany v skupinach:
        <ul>
            @foreach($articleObj->sharingsGroups as $sharingObj)
                <li>{{$sharingObj->group->name}}</li>
            @endforeach
        </ul>
        </p>

        <p>
            Tento clanok je zdielany v skolach:
        <ul>
            @foreach($articleObj->sharingsSchools as $sharingObj)
                <li>{{$sharingObj->school->name}}</li>
            @endforeach
        </ul>
        </p>
    </section>


    <section id="article">
        {!! $articleObj->text !!}
    </section>




    <section id="attachements">
        @if($articleObj->images()->count() == 0)
            <p>{{ trans('articles.labels.no-images')  }}</p>
        @else
            <ul>
                @foreach($articleObj->images as $imageObj)
                    <li>{{ $imageObj->name }}.{{ $imageObj->ext }}</li>

                @endforeach
            </ul>
        @endif
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
