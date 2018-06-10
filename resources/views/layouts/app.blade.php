<!DOCTYPE html>
<html>
<head>
    @include('layouts.partials.meta')

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('css/shCore.css')}}">
    <link rel="stylesheet" href="{{asset('css/shThemeDefault.css')}}">

    <link rel="shortcut icon" href="{{asset('img/codeleague.ico')}}" type="image/x-icon">
</head>
<body>
    @include('layouts.partials.navbar')

    @yield('content')

    @include('layouts.partials.footer')

    <script src="{{asset('js/app.js')}}"></script>

    @yield('scripts')

</body>
</html>