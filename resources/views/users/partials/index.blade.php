@if(count($users) > 0)
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            @if(!isset($_table_skip['name']))
                <th>{{ trans('users.labels.name') }}</th>
            @endif
            @if(!isset($_table_skip['email']))
                <th>{{ trans('users.labels.email') }}</th>
            @endif
            @if(!isset($_table_skip['roles']))
                <th>{{ trans('users.labels.roles') }}</th>
            @endif
            @if(!isset($_table_skip['school']))
                <th>{{ trans('users.labels.school') }}</th>
            @endif
            @if(!isset($_table_skip['groups']))
                <th>{{ trans('users.labels.groups') }}</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($users as $userObj)
            <tr>
                <th scope="row">
                    @if(isset($_table_action))
                        <a href="{{ $_table_action($userObj) }}">{{$userObj->code}}</a>
                    @else
                        {{$userObj->code}}
                    @endif
                </th>
                <td>
                    @if(!isset($_table_skip['name']))
                        @if(isset($_table_action))
                            <a href="{{ $_table_action($userObj) }}">{{$userObj->name}}</a>
                        @else
                            {{$userObj->name}}
                        @endif
                    @endif
                </td>
                @if(!isset($_table_skip['email']))
                    <td>{{$userObj->email}}</td>
                @endif
                @if(!isset($_table_skip['roles']))
                    <td>{{$userObj->role}}</td>
                @endif
                @if(!isset($_table_skip['school']))
                    <td>
                        @foreach($userObj->schools as $schoolObj)
                            {{$schoolObj->name}}
                        @endforeach
                    </td>
                @endif
                @if(!isset($_table_skip['groups']))
                    <td>
                        @foreach($userObj->groups as $groupObj)
                            {{$groupObj->name}}
                        @endforeach
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p></p>
@endif
