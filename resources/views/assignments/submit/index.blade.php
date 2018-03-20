@extends('layouts.sidebar')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/jquery.fileupload.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.fileupload-ui.css')}}">

    <noscript>
        <link rel="stylesheet" href="{{asset('css/jquery.fileupload-noscript.css')}}">
        <link rel="stylesheet" href="{{asset('css/jquery.fileupload-ui-noscript.css')}}">
    </noscript>
@endsection

@section('content')
    <section id="submit">
        @include('assignments.partials.header')

        @if($assignmentObj->checked_at == null)
            <p class="text-center text-danger">Toto zadanie ešte nebolo validované.</p>
        @elseif(strtotime($assignmentObj->start_at) > time())
            <p class="text-center text-danger">Toto zadanie ešte nie je možné odovzdávať.</p>
        @elseif(strtotime($assignmentObj->deadline_at) < time())
            <p class="text-center text-danger">Toto zadanie už nie je možné odovzdávať.</p>
        @else
            <div class="row">
                    <div class="col-lg-20 col-lg-push-40 text-right">
                        @include('assignments.partials.results')
                    </div>
                    <div class="col-lg-40 col-lg-pull-20">
                        <h2>Odovzdanie riešenia</h2>

                        {{--<form id="submit-upload" method="post" enctype="multipart/form-data"--}}
                              {{--action="{{action('Assignments\AssignmentController@upload',[$assignmentObj->code])}}">--}}
                            {{--{!! csrf_field() !!}--}}

                            {{--<input type="file" name="files" style="display:none">--}}

                            {{--<button type="submit" class="btn btn-primary">Vybrať súbor</button>--}}
                            {{--<p class="text-muted">Podporované su typy: c, cpp, java, zip</p>--}}
                        {{--</form>--}}


                        <div id="submit-solution">
                            @if($solution != null)
                                <span id="submit-file" style="">{!! $solution->icon() !!} {{$solution->filename}}</span>
                                <h4>Odovzdané súbory</h4>
                                <div id="submit-files" class="minimized">
                                    {!! $files !!}
                                </div>
                                <button id="submit-files-minimize" class="hidden"><i class="fa fa-angle-double-up"
                                                                                     aria-hidden="true"></i></button>
                                <button id="submit-files-maximize"><i class="fa fa-angle-double-down"
                                                                      aria-hidden="true"></i></button>
                            @endif
                        </div>

                        @if($solution != null && $solution->lang == '')
                            <div id="upload-error">
                                <div class="alert alert-danger">Odovzdané riešenie neobsahuje požadované súbory.<br/>Požiadavky
                                    na riešenie nájdete v pravidlách.
                                </div>
                            </div>
                        @endif
                        <div id="submit-test">
                            @if($solution != null)
                                <h3>Automatický test</h3>

                                <div id="submit-result">
                                    @if($resultFile)
                                        {{--<a id="submit-test-results"--}}
                                           {{--href="{{action('Assignments\AssignmentController@result',[$assignmentObj->code])}}"--}}
                                           {{--class="btn btn-info">Výsledok automatického testu</a>--}}
                                    @else
                                        <div class="alert alert-danger">Teste nebol spustený, skúste to neskôr.</div>
                                        <a href="test" id="submit-test-start" class="btn btn-primary">Spustiť test</a>
                                    @endif
                                </div>
                            @endif
                        </div>


                    </div>
                </div>
        @endif

    </section>
@endsection

@section('scripts')

    <script src="{{asset('js/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('js/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('js/jquery.fileupload.js')}}"></script>

    <script src="{{asset('js/modules/main.js')}}"></script>

    <script src="{{asset('js/modules/upload.js')}}"></script>
    <script src="{{asset('js/modules/tester.js')}}"></script>
    <script src="{{asset('js/modules/submit.js')}}"></script>
@endsection
