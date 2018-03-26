@php
    $_delete_action = action('Users\Schools\StudentController@destroy',[$schoolObj->code, $userObj->code]);
@endphp

@include('users.partials.delete')