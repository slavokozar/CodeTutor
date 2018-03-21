@extends('layouts.error')

@section('content-error')
    <h1>404</h1>
    <p class="text-center text-danger">
        <i class="fa fa-5x fa-exclamation-triangle" aria-hidden="true"></i>
        <br/>
        {!! $message !!}
    </p>
    @if(isset($action) && isset($label))
        <p class="text-center">{{ trans('general.back-to') }} <a href="{!! $action  !!}">{{$label}}</a></p>
    @endif
@endsection