@if (session()->has('flash_notification.message'))
    <div id="flash">
        <div class="alert alert-{{ session('flash_notification.level') }}">
            {!! session('flash_notification.message') !!}
        </div>
    </div>
@endif