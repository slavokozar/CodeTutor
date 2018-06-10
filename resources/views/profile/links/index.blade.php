@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => Auth::user()->fullName() ],
            [ 'label' => trans('profile.links.link') ]
        ])
    !!}

    <h1>{{ trans('profile.links.heading') }}</h1>

    {!!
        ContentNav::render([
            'right' => [
                ['label' => trans('general.create'), 'action' => 'Links\LinkController@create']
            ]
        ])
     !!}

    <section class="table-list">
        @if(count($links) == 0)
            <p class="text-center text-danger">{!! trans('profile.links.no-links') !!}</p>
        @else
            @foreach($links as $linkObj)
                <div class="table-row">
                    <div class="table-row-content">
                        <div class="table-column-name">
                            <a href="{{action('Links\LinkController@show',[$linkObj->code])}}">
                                {{$linkObj->name}}
                            </a>
                        </div>
                        <div class="table-column-date">{{$linkObj->updated_at}}</div>
                    </div>
                    <div class="table-row-description">
                        {{ $linkObj->description }}
                    </div>
                </div>
            @endforeach
        @endif
    </section>

@endsection