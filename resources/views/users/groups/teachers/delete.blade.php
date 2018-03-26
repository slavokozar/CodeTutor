@php
    $_delete_action = action('Users\Schools\TeacherController@destroy',[$schoolObj->code, $userObj->code]);
@endphp

@include('users.partials.delete')