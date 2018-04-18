<div class="activity">
    <div class="activity-image">
        <span class="fa fa-newspaper-o" aria-hidden="true"></span>
    </div>
    <div class="activity-content">
        <a href="{{action('Articles\ArticleController@show',[$articleObj->code])}}">
            <h2>{{$articleObj->name}}</h2>
        </a>
        <div class="activity-details">
            <span class="activity-author">{{ trans('activities.from-user') }} {{$articleObj->author->name}}</span>

            @if($articleObj->group != null)<span
                    class="activity-group">{{ trans('activities.in-group') }} {{$articleObj->group->name}}</span>@endif
            <span class="activity-date">{{$articleObj->updated_at}}</span>
        </div>
        <p class="activity-description">
            {!! $articleObj->description !!}
            <a class="read-more"
               href="{{action('Articles\ArticleController@show',[$articleObj->code])}}">{{ trans('articles.articles.read-more') }}</a>
        </p>
    </div>
</div>