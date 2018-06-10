@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('files.link') ]
        ])
    !!}


    <h1>{{ trans('files.heading') }}</h1>

    @if(Auth::check() && Auth::user()->isAuthor())
    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Files\FileController@create']
            ]
        ])
     !!}
    @endif

    <section id="activities-list">

        @if(count($files) == 0)
            <p class="text-center text-danger">{!! trans('files.no-files') !!}</p>
        @else
            @foreach($files as $fileObj)
                @include('files.activity')
            @endforeach
            {!! $files->render() !!}
        @endif
    </section>
@endsection