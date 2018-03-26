@php
    $_delete_action = action('Users\Groups\TeacherController@destroy',[$groupObj->code, $userObj->code]);
@endphp

@include('users.partials.delete')