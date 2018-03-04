@extends('layout_full')

@section('sidebar')

@endsection

@section('content')
    @include('assignments.partials.header')
    @if(count($assignmentObj->programmingLanguages) > 0)
        <ul>
            @foreach($assignmentObj->programmingLanguages as $programmingLanguage)
                <li>{{ $programmingLanguage->name }}</li>
            @endforeach
        </ul>
    @endif

    <section id="assignment">
        @include('assignments.partials.info')

        {!! $content !!}
    </section>
    <section id="datapub">
        <h2>Vzorové vstupy a výstupy</h2>

            @if($datapub == null)
                <p class="text-center text-danger">
                    K tomuto zadaniu zatiaľ neexistujú verejná dáta.<br/>
                    <i class="fa fa-4x fa-meh-o" aria-hidden="true"></i>
                </p>
            @else
                @for($i = 0; $i < count($datapub); $i++)
                    <div class="data">
                            <h3>Data {{$i + 1}}</h3>
                            <h4>Vstup</h4>
                            <pre>{{$datapub[$i]->input}}</pre>

                            <h4>Výstup</h4>
                            <pre>{{$datapub[$i]->output}}</pre>
                    </div>
                @endfor
            @endif
    </section>
    <section id="comments">
        <h2>Komentáre</h2>
        <?php $objectObj = $assignmentObj; ?>

        @include('comments.comments')

        @if(count($comments) > 0)
            <p class="text-center">
                <a href="{{action('CommentController@index',[$assignmentObj->commentRoute(), $assignmentObj->code])}}">všetky komentáre</a>
            </p>
        @endif
    </section>
@endsection

@section('scripts')
    <script src="{{asset('js/comments.js')}}"></script>
@endsection

