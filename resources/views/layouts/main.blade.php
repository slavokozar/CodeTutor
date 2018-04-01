@extends('layouts.app')

@section('content')
    <main role="main" class="container">
        @include('flash::message')

        @yield('content-main')

    </main>
@endsection