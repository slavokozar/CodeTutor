@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('links.link'), 'action' => 'Links\LinkController@index' ],
            [ 'label' => $linkObj->name]
        ])
    !!}

    <h1>{{ $linkObj->name }}</h1>

    {!!
    ContentNav::render([
        'right' => [
            ['label' => trans('general.edit'), 'action' => 'Links\LinkController@edit', 'params' => [$linkObj->code] ],
            ['label' => trans('general.delete'), 'modal' => true, 'action' => 'Links\LinkController@deleteModal', 'params' => [$linkObj->code]]
        ]
    ])
 !!}


    <section id="link">
        <div id="" class="row">
            <label class="col-lg-20">Autor</label>
            <div class="col-lg-40">
                {{ $linkObj->author->fullName() }}
            </div>
        </div>


        <label for="">Text zadania</label>

        {{--{!! $content !!}--}}
    </section>

    <section id="comments">
        <h2>{ trans('general.comments') }</h2>
        <?php $objectObj = $linkObj; ?>

        @include('comments.comments')

        @if(count($comments) > 0)
            <p class="text-center">
                <a href="{{action('System\CommentController@index',[$linkObj->commentRoute, $linkObj->code])}}">všetky komentáre</a>
            </p>
        @endif
    </section>
@endsection

@section('scripts')
    <script src="{{asset('js/comments.js')}}"></script>
@endsection

