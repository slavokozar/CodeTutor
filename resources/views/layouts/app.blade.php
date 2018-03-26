<!DOCTYPE html>
<html>
<head>
    @include('layouts.partials.meta')

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.css')}}">
    <link rel="shortcut icon" href="{{asset('img/codeleague.ico')}}" type="image/x-icon">
</head>
<body>
    @include('layouts.partials.navbar')
    @include('layouts.partials.flash')

    @yield('content')

    @include('layouts.partials.footer')

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.js')}}"></script>
    <script src="{{asset('js/jquery-ui.js')}}"></script>
    <script src="{{asset('js/select2.full.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $(function () {
            //todo loader

            $('a.btn-modal').click(function(e){
                e.preventDefault();

                $.ajax({
                    'url': $(this).attr('href'),
                    'method': 'get'
                }).done(function(data){

                    $modal = $(data);
                    $('body').append($modal);
                    $modal.modal('show');

                    $modal.on('hidden.bs.modal', function(){
                        $modal.remove();
                    })

                    $modal.find('.js-select').select2({});

                })
            });
        });
    </script>
    @yield('scripts')

</body>
</html>