@extends('layout_full')

@section('sidebar')
    <section>
        <div class="sidebar-wrapper">
            <h2>Testy</h2>
            @if(sizeof($tests->testsCount) > 0)
                <ul>
                @for($testNo = 0; $testNo < $tests->testsCount; $testNo++)
                    <li class="test-link">
                        <a class="" href="#test-test{{$testNo + 1}}">
                            <span class="btn-test-caption">Test {{$testNo + 1}}</span>
                            <span class="btn-test-remove"><i class="fa fa-times"></i></span>
                        </a>
                    </li>
                @endfor
                </ul>
            @else
                <p>Žiadne dostupné testy</p>
            @endif
        </div>
    </section>

@endsection



@section('content')
    <?php
    if($data == 'verejne') $subheading = 'Verejné dáta';
    elseif($data == 'testovacie') $subheading = 'Testovacie dáta';
    ?>

    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-fw fa-home" aria-hidden="true"></i></a>
        <li><a href="{{action('Assignments\AssignmentController@index')}}">Zadania</a></li>
        @if($action == 'show')
            <li class="active">{{$assignmentObj->name}}</li>
        @else
            <li><a href="{{action('Assignments\AssignmentController@show',[$assignmentObj->code])}}">{{$assignmentObj->name}}</a></li>
            <li class="active">{{$action}}</li>
        @endif
    </ol>

    <h1>
        {!! $assignmentObj->is_public ? '' : 'profile' !!}
        {!! $assignmentObj->checked_at != null ? '' : '<i class="fa fa-fw fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Neoverené zadanie"></i>' !!}
        {{ $assignmentObj->name }}{{ isset($subheading) ? ': ' . $subheading : ''}}
    </h1>


    <section id="test-editor">
        <form id="test-form" method="post" action="{{action('Assignments\TestController@update',[$assignmentObj->code, $data])}}">
            {!! csrf_field() !!}

            <input id="test-value" type="hidden" name="tests" value=""/>

            <div class="row">
                <div class="col-md-60">
                    <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
                        <li role="presentation">
                                <a href="{{action('Assignments\TestController@show',[$assignmentObj->code, $data])}}" class="btn">zrušiť</a>
                        </li>
                        <li role="presentation">
                            <button type="submit" class="btn btn-danger">Upraviť</button>
                        </li>
                    </ul>
                </div>
            </div>
        </form>

        <div id="test-tests">

            @if($tests->testsCount > 0)
                @for($testNo = 0; $testNo < $tests->testsCount; $testNo++)
                    <?php $test = $tests->tests[$testNo]; ?>
                    @include('assignments.tests.test')
                @endfor
            @else
                <p class="notest text-center text-danger">K tomuto zadaniu zatiaľ neexistujú testy.</p>
            @endif
        </div>

        <div class="row">
            <div class="col-md-60 text-center">
                <a href="{{action('Assignments\TestController@newTest', [$assignmentObj->code, $data])}}" class="btn btn-link btn-test-add">
                    <i class="fa fa-plus-square fa-2x" aria-hidden="true"></i>
                    <br/>
                    Pridať test
                </a>
            </div>
        </div>

    </section>



@endsection

@section('scripts')
    <script src="{{asset('js/bootstrap-select.js')}}"></script>
    <script src="{{asset('js/testEditor.js')}}"></script>
    <script>
        $('#test-tabs li').click(function(){
            $(this).addClass('active');
        })
    </script>
@endsection
