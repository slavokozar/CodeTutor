@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => Auth::user()->fullName() ],
            [ 'label' => trans('profile.files.link') ]
        ])
    !!}

    <h1>{{ trans('profile.files.heading') }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Files\FileController@create']
            ]
        ])
     !!}

    <section class="table-list">
        @if(count($files) == 0)
            <p class="text-center text-danger">{!! trans('profile.files.no-files') !!}</p>
        @else
            @foreach($files as $fileObj)
                <div class="table-row">
                    <div class="table-row-content">
                        <div class="table-column-name">
                            <a href="{{action('Files\FileController@show',[$fileObj->code])}}">
                                {{$fileObj->name}}
                            </a>
                        </div>
                        <div class="table-column-date">{{$fileObj->updated_at}}</div>
                    </div>
                    <div class="table-row-description">
                        {{ $fileObj->description }}
                    </div>
                </div>
            @endforeach
        @endif
    </section>

@endsection