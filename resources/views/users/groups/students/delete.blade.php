@php
    $_delete_action = action('Users\Groups\StudentController@destroy',[$groupObj->code, $userObj->code]);
@endphp

@include('users.partials.delete')