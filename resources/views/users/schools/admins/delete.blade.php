@php
    $_delete_action = action('Users\Schools\AdminController@destroy',[$schoolObj->code, $userObj->code]);
@endphp

@include('users.partials.delete')