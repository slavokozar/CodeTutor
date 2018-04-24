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
        @if(isset($_table_actions))
            <th>&nbsp;</th>
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
                        <a href="{{ $_table_action($userObj) }}">{{$userObj->title}} {{$userObj->name}} {{$userObj->surname}}</a>
                    @else
                        {{$userObj->title}} {{$userObj->name}} {{$userObj->surname}}
                    @endif
                @endif
            </td>
            @if(!isset($_table_skip['email']))
                <td>{{$userObj->email}}</td>
            @endif
            @if(!isset($_table_skip['roles']))
                <td>
                    @if($userObj->role)
                        {{ trans('users.users.roles')[$userObj->role] }}
                    @endif
                </td>
            @endif
            @if(!isset($_table_skip['school']))
                <td>
                    @if(count($userObj->schools) > 0)
                        <ul>
                            @foreach($userObj->schools as $schoolObj)
                                <li>
                                    <a href="{{ action('Users\Schools\SchoolController@show', [$schoolObj->code]) }}">
                                        {{$schoolObj->name}}
                                    </a>
                                    @if($schoolObj->pivot->role)
                                        ({{ trans('users.schools.roles')[$schoolObj->pivot->role] }})
                                    @endif

                                </li>
                            @endforeach
                        </ul>
                    @endif
                </td>
            @endif
            @if(!isset($_table_skip['groups']))
                <td>
                    @if(count($userObj->groups) > 0)
                        <ul>
                            @foreach($userObj->groups as $groupObj)
                                <li>
                                    <a href="{{ action('Users\Groups\GroupController@show', [$schoolObj->code]) }}">
                                        {{$groupObj->name}}
                                    </a>
                                    @if($groupObj->pivot->role)
                                        ({{ trans('users.groups.roles')[$groupObj->pivot->role] }})
                                    @endif

                                </li>
                            @endforeach
                        </ul>
                    @endif
                </td>
            @endif
            @if(isset($_table_actions))
                <td>
                    @foreach($_table_actions as $action)
                        <a href="{{ $action['action']($userObj) }}" {!! $action['modal'] ? 'class="btn-modal"' : '' !!}>
                            <i class="fa {{ $action['icon'] }}" aria-hidden="true"></i>
                        </a>
                    @endforeach
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>

{{$users->render()}}
