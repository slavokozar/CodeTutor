<div class="activity-image">
    <span class="fa fa-file-text-o" aria-hidden="true"></span>
</div>

<div class="activity-content">
    <a href="{{action('Files\FileController@show',[$fileObj->code])}}">
        <h2>{{$fileObj->name}}</h2>
    </a>
    <div class="activity-info">
        <div class="activity-detail">
            <div class="activity-author">
                <strong>{{ trans('files.single') }}</strong>
                {{ trans('feed.from-user') }}
                <strong>{{ $fileObj->author->fullName() }}</strong>
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
        <div class="activity-date">{{$fileObj->updated_at}}</div>
    </div>
    <div class="activity-description">
        {!! $fileObj->description !!}
        <a class="read-more"
           href="{{action('Files\FileController@show',[$fileObj->code])}}">{{ trans('feed.read-more') }}</a>
    </div>
</div>