@php
    $_delete_action = action('Users\UserController@destroy',[$userObj->code]);
@endphp

@include('users.partials.delete')