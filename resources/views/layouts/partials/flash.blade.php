@if (session()->has('flash_notification.message'))
    <div class="container">
        <div id="flash">
            <div class="alert alert-{{ session('flash_notification.level') }}">
                {!! session('flash_notification.message') !!}
            </div>
        </div>
    </div>
@endif