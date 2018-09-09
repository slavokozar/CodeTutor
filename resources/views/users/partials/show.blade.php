<section id="basic">
    {!!
        DataRender::render([
            ['label'=>'#', 'value'=>$userObj->code],
            ['label'=>trans('users.labels.title'), 'value'=>$userObj->title],
            ['label'=>trans('users.labels.name'), 'value'=>$userObj->name],
            ['label'=>trans('users.labels.surname'), 'value'=>$userObj->surname],
            ['label'=>trans('users.labels.email'), 'value'=>$userObj->email],
            ['label'=>trans('users.labels.birthdate'), 'value'=>$userObj->birthdate]
        ])
    !!}
</section>

@if(isset($schools))
<section id="schools">
    <h3>{{trans('users.schools.heading')}}</h3>

    @php $schools = $userObj->schools @endphp
    @if($schools->count() > 0)
        <ul class="list-group">
            @foreach($schools as $schoolObj)
                <li class="list-group-item">{{ $schoolObj->name }}
                    ({{ trans('users.schools.roles')[$schoolObj->pivot->role] }})
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info" role="alert">{{ trans('users.users.no-schools') }}</div>
    @endif
</section>
@endif

@if(isset($groups))
<section id="groups">
    <h3>{{trans('users.groups.heading')}}</h3>

    @php $groups = $userObj->groups @endphp
    @if($groups->count() > 0)
        <ul class="list-group">
            @foreach($groups as $groupObj)
                <li class="list-group-item">{{ $groupObj->name }}
                    ({{ trans('users.groups.roles')[$groupObj->pivot->role] }})
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info" role="alert">{{ trans('users.users.no-groups') }}</div>
    @endif
</section>
@endif