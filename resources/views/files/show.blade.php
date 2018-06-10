@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('files.link'), 'action' => 'Files\FileController@index' ],
            [ 'label' => $fileObj->name]
        ])
    !!}

    <h1>{{ $fileObj->name }}</h1>

    {!!
    ContentNav::render([
        'left' => [
            ['label' => trans('files.submit.link'), 'action' => 'Files\SubmitController@index', 'params' => [$fileObj->code] ],
        ],
        'right' => [
            ['label' => trans('files.datapub.link'), 'action' => 'Files\DatapubController@index', 'params' => [$fileObj->code] ],
            ['label' => trans('files.datatest.link'), 'action' => 'Files\DatatestController@index', 'params' => [$fileObj->code] ],
            ['label' => trans('general.edit'), 'action' => 'Files\FileController@edit', 'params' => [$fileObj->code] ],
            ['label' => trans('general.delete'), 'modal' => true, 'action' => 'Files\FileController@deleteModal', 'params' => [$fileObj->code]]
        ]
    ])
 !!}





    <section id="assignment">

        <div class="row">
            <div class="col-lg-30">
                <div id="" class="row">
                    <label class="col-lg-20">Autor</label>
                    <div class="col-lg-40">
                        {{ $fileObj->author->fullName() }}
                    </div>

                </div>
                <div id="" class="row">
                    <label class="col-lg-20">Odovzdavanie od</label>
                    <div class="col-lg-40">
                        {{ $fileObj->start_at }}
                    </div>

                </div>

                <div id="" class="row">
                    <label class="col-lg-20">Odovzdavanie do</label>
                    <div class="col-lg-40">
                        {{ $fileObj->deadline_at }}
                    </div>

                </div>

                <div id="languages" class="row">
                    <label class="col-lg-20">Povolene jazyky</label>
                    <div class="col-lg-40">
                        @if(count($fileObj->programmingLanguages) > 0)
                            <ul>
                                @foreach($fileObj->programmingLanguages as $programmingLanguage)
                                    <li>{{ $programmingLanguage->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                </div>

            </div>
            <div class="col-lg-30 text-right text-danger" >
                @include('files.partials.info')
            </div>
        </div>


        <label for="">Text zadania</label>

        {!! $content !!}
    </section>
    {{--<section id="datapub">--}}
        {{--<h2>Vzorové vstupy a výstupy</h2>--}}

            {{--@if($datapub == null)--}}
                {{--<p class="text-center text-danger">--}}
                    {{--K tomuto zadaniu zatiaľ neexistujú verejná dáta.<br/>--}}
                    {{--<i class="fa fa-4x fa-meh-o" aria-hidden="true"></i>--}}
                {{--</p>--}}
            {{--@else--}}
                {{--@for($i = 0; $i < min(count($datapub), 3); $i++)--}}
                    {{--<div class="data">--}}
                            {{--<h3>Data {{$i + 1}}</h3>--}}
                            {{--<h4>Vstup</h4>--}}
                            {{--<pre>{{$datapub[$i]->input}}</pre>--}}

                            {{--<h4>Výstup</h4>--}}
                            {{--<pre>{{$datapub[$i]->output}}</pre>--}}
                    {{--</div>--}}
                {{--@endfor--}}
            {{--@endif--}}
    {{--</section>--}}
    <section id="comments">
        <h2>Komentáre</h2>
        <?php $objectObj = $fileObj; ?>

        @include('comments.comments')

        @if(count($comments) > 0)
            <p class="text-center">
                <a href="{{action('System\CommentController@index',[$fileObj->commentRoute, $fileObj->code])}}">všetky komentáre</a>
            </p>
        @endif
    </section>
@endsection

@section('scripts')
    <script src="{{asset('js/comments.js')}}"></script>
@endsection

