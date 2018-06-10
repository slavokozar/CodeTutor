<div class="activity-image">
    <span class="fa fa-graduation-cap" aria-hidden="true"></span>
</div>

<div class="activity-content">
    <a href="{{action('Assignments\AssignmentController@show',[$assignmentObj->code])}}">
        <h2>{{$assignmentObj->name}}</h2>
    </a>
    <div class="activity-info">
        <div class="activity-detail">
            <div class="activity-author">
                <strong>{{ trans('assignments.single') }}</strong>
                {{ trans('feed.from-user') }}
                <strong>{{ $assignmentObj->author->fullName() }}</strong>
            </div>
            <div class="activity-sharing">
                @if( $activityObj->school != null)
                    {{ trans('feed.shared-in-school') }}
                    <strong>{{ $activityObj->school->name }}</strong>
                @elseif( $activityObj->group != null)
                    {{ trans('feed.shared-in-group') }}
                    <strong>{{ $activityObj->group->name }}</strong>
                @endif
            </div>
        </div>
        <div class="activity-date">{{$assignmentObj->updated_at}}</div>
    </div>
    <div class="activity-description">
        {!! $assignmentObj->description !!}
        <a class="read-more"
           href="{{action('Assignments\AssignmentController@show',[$assignmentObj->code])}}">{{ trans('feed.read-more') }}</a>
    </div>
</div>