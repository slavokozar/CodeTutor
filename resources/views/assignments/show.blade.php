@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
            [ 'label' => $assignmentObj->name]
        ])
    !!}

    <h1>{{ $assignmentObj->name }}</h1>

    @php

        $navigation = [
            'left' => [
                ['label' => trans('assignments.submit.link'), 'action' => 'Assignments\SubmitController@index', 'params' => [$assignmentObj->code] ],
            ],
            'right' => [
                ['label' => trans('assignments.datapub.link'), 'action' => 'Assignments\DatapubController@index', 'params' => [$assignmentObj->code] ],
                ['label' => trans('assignments.datatest.link'), 'action' => 'Assignments\DatatestController@index', 'params' => [$assignmentObj->code] ],
                ['label' => trans('general.edit'), 'action' => 'Assignments\AssignmentController@edit', 'params' => [$assignmentObj->code] ],
                ['label' => trans('general.delete'), 'modal' => true, 'action' => 'Assignments\AssignmentController@deleteModal', 'params' => [$assignmentObj->code]]
            ]
        ];

        if(Auth::check() && Auth::user()->isAuthor()){
            $navigation['left'][] = ['label' => trans('assignments.solutions.link'), 'action' => 'Assignments\SolutionController@index', 'params' => [$assignmentObj->code] ];
        }
    @endphp

    {!! ContentNav::render($navigation) !!}





    <section id="assignment">

        <div class="row">
            <div class="col-lg-30">
                <div id="" class="row">
                    <label class="col-lg-20">Autor</label>
                    <div class="col-lg-40">
                        {{ $assignmentObj->author->fullName() }}
                    </div>

                </div>
                <div id="" class="row">
                    <label class="col-lg-20">Odovzdavanie od</label>
                    <div class="col-lg-40">
                        {{ $assignmentObj->start_at }}
                    </div>

                </div>

                <div id="" class="row">
                    <label class="col-lg-20">Odovzdavanie do</label>
                    <div class="col-lg-40">
                        {{ $assignmentObj->deadline_at }}
                    </div>

                </div>

                <div id="languages" class="row">
                    <label class="col-lg-20">Povolene jazyky</label>
                    <div class="col-lg-40">
                        @if(count($assignmentObj->programmingLanguages) > 0)
                            <ul>
                                @foreach($assignmentObj->programmingLanguages as $programmingLanguage)
                                    <li>{{ $programmingLanguage->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                </div>

            </div>
            <div class="col-lg-30 text-right text-danger">
                @include('assignments.partials.info')
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
        <?php $objectObj = $assignmentObj; ?>

        @include('comments.comments')

        @if(count($comments) > 0)
            <p class="text-center">
                <a href="{{action('System\CommentController@index',[$assignmentObj->commentRoute, $assignmentObj->code])}}">všetky
                    komentáre</a>
            </p>
        @endif
    </section>
@endsection

@section('scripts')
    <script src="{{asset('js/comments.js')}}"></script>
@endsection

