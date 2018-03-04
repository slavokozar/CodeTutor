@extends('layout_full')

@section('sidebar')
{{--    @include('assignments.partials.sidebar')--}}
@endsection

@section('content')
    <?php
        if($data == 'verejne') $subheading = 'Verejné dáta';
        elseif($data == 'testovacie') $subheading = 'Testovacie dáta';
    ?>
    @include('assignments.partials.header')


    <section id="data">

    @if($contents == null)
        <p class="text-center text-danger">
            K tomuto zadaniu zatiaľ neexistujú verejná dáta.<br/>
            <a href="{{action('Assignments\TestController@edit', [$assignmentObj->code, $data])}}" class="btn btn-primary">Vytvoriť</a>
        </p>
    @else
        @for($i = 0; $i < count($contents); $i++)
            <div class="data">
                <h3>Data {{$i + 1}}</h3>
                <h4>Vstup</h4>
                <pre>{{$contents[$i]->input}}</pre>

                <h4>Výstup</h4>
                <pre>{{$contents[$i]->output}}</pre>
            </div>
        @endfor

        <div class="row">
            <div class="col-md-60 text-center">
                <a class="btn btn-primary" href="{{action('Assignments\TestController@edit', [$assignmentObj->code, $data])}}">Upraviť</a>
            </div>
        </div>
    @endif
    </section>

@endsection

@section('scripts')
    {{--<script src="{{asset('js/testEditor.js')}}"></script>--}}
@endsection
