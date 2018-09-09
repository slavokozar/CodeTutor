<table class="table">
    <thead>
    <tr>
        <th>
            <input type="checkbox" id="check_all"/>
            {{ trans('users.labels.name') }}
        </th>

        @if(!isset($_table_skip['email']))
            <th>
                {{ trans('users.labels.email') }}
                <i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
            </th>
        @endif
        @if(!isset($_table_skip['roles']))
            <th>
                {{ trans('users.labels.roles') }}
                <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
            </th>
        @endif
        @if(!isset($_table_skip['school']))
            <th>{{ trans('users.labels.school') }}</th>
        @endif
        @if(!isset($_table_skip['groups']))
            <th>{{ trans('users.labels.groups') }}</th>
        @endif
        @if(isset($_table_actions))
            <th>

            </th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($users as $userObj)
        <tr>
            <th scope="row">
                <input type="checkbox" class="check-values" name="values[]" value="{{ $userObj->id }}"/>
                @if(isset($_table_action))
                    <a href="{{ $_table_action($userObj) }}">{{$userObj->title}} {{$userObj->name}} {{$userObj->surname}}</a>
                @else
                    {{$userObj->title}} {{$userObj->name}} {{$userObj->surname}}
                @endif
            </th>
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
                                    <a href="{{ action('Users\Groups\GroupController@show', [$groupObj->code]) }}">
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
                <td class="text-right">
                    @foreach($_table_actions as $action)
                        <a class="btn btn-danger btn-sm" href="{{ $action['action']($userObj) }}" {!! $action['modal'] ? 'class="btn-modal"' : '' !!}>
                            <i class="fa {{ $action['icon'] }}" aria-hidden="true"></i>
                            {{ $action['label'] }}
                        </a>
                    @endforeach
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>

{{$users->render()}}
