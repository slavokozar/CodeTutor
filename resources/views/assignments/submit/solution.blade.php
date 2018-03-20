@extends('layouts.sidebar')

@section('sidebar')
    @include('assignments.partials.sidebar')
@endsection

@section('content')
    <section id="submit">
{{--        @include('assignments.partials.header')--}}

        <div class="row">
            <div class="col-md-4 col-md-push-8 text-right">
                @include('assignments.partials.results')
            </div>
            <div class="col-md-8 col-md-pull-4">
                <h2>Odovzdané riešenie</h2>
                {{--<hr/>--}}
                {{--@if(Auth::profile()->isAdmin())--}}
                {{--<div class="row">--}}
                {{--<form method="post" action="{{action('ProfileController@switchUser')}}">--}}
                {{--{!! csrf_field() !!}--}}

                {{--<div class="col-md-12">--}}
                {{--Ako uzivatel:--}}
                {{--@if(Session::get('profile')!= null)--}}
                {{--{{Session::get('profile')->name}}--}}
                {{--@else--}}
                {{--{{Auth::profile()->name}}--}}
                {{--@endif--}}


                {{--</div>--}}
                {{--<div class="col-md-6">--}}
                {{--<input type="text" id="profile-select" class="form-control" name="profile" placeholder="Uzivatel"/>--}}
                {{--</div>--}}
                {{--<div class="col-md-6"><button class="btn btn-primary" type="submit">Prepnut uzivatela</button></div>--}}
                {{--</form>--}}
                {{--</div>--}}
                {{--@endif--}}
                {{--<hr/>--}}

                <div id="submit-solution">
                    @if($solution != null)
                        <span id="submit-file" style="">{!! $solution->icon() !!} {{$solution->filename}}</span>
                        <h4>Odovzdané súbory</h4>
                        <div id="submit-files" class="minimized">
                            {!! $files !!}
                        </div>
                        <button id="submit-files-minimize" class="hidden"><i class="fa fa-angle-double-up" aria-hidden="true"></i></button>
                        <button id="submit-files-maximize"><i class="fa fa-angle-double-down" aria-hidden="true"></i></button>
                    @endif
                </div>



                <div id="submit-test">
                    @if($solution != null)
                        <h3>Automatický test</h3>

                        <div id="submit-result">
                            @if($resultFile)
                                <a id="submit-test-results" href="{{action('Assignments\AssignmentController@result',[$assignment->code])}}" class="btn btn-info">Výsledok automatického testu</a>
                            @else
                                <div class="alert alert-danger">Teste nebol spustený, skúste to neskôr.</div>
                                <a href="{{$solution->user->code}}/test" id="submit-test-start" class="btn btn-primary">Spustiť test</a>
                            @endif
                        </div>
                    @endif
                </div>


            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('js/modules/main.js')}}"></script>

    <script src="{{asset('js/modules/tester.js')}}"></script>
    <script src="{{asset('js/modules/submit.js')}}"></script>
@endsection


