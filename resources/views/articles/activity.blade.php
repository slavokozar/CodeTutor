<div class="activity-image">
    <span class="fa fa-newspaper-o" aria-hidden="true"></span>
</div>

<div class="activity-content">
    <a href="{{action('Articles\ArticleController@show',[$articleObj->code])}}">
        <h2>{{$articleObj->name}}</h2>
    </a>
    <div class="activity-info">
        <div class="activity-detail">
            <div class="activity-author">
                <strong>{{ trans('articles.single') }}</strong>
                {{ trans('feed.from-user') }}
                <strong>{{ $articleObj->author->fullName() }}</strong>
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
        <div class="activity-date">{{$articleObj->updated_at}}</div>
    </div>
    <div class="activity-description">
        {!! $articleObj->description !!}
        <a class="read-more"
           href="{{action('Articles\ArticleController@show',[$articleObj->code])}}">{{ trans('feed.read-more') }}</a>
    </div>
</div>