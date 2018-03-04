@extends('wrapper')


@section('wrapper')
    <div class="container content">
        <div class="row-flex">
            <div class="col-md-3 col-md-push-9">
                @yield('sidebar')
            </div>
            <div class="col-md-9 col-md-pull-3">
                @yield('content')
            </div>
        </div>
    </div>
@endsection