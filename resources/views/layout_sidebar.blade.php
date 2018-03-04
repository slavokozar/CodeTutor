@extends('wrapper')


@section('wrapper')
    <div id="content" class="container">
        <div class="row row-flex">
            <div id="sidebar" class="col-lg-15 col-lg-push-45 visible-lg-block">
                @yield('sidebar')
            </div>
            <div class="col-lg-45 col-lg-pull-15">
                @yield('content')
            </div>
        </div>
    </div>
@endsection