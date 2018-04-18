@extends('layouts.main')

@section('content-main')
    <section id="activities-list">
        <h1>Activity feed</h1>

        @if(count($activities) == 0)
            <p class="text-center text-danger">{!! trans('articles.articles.no-articles') !!}</p>
        @else
            @foreach($activities as $activityObj)

                <div class="activity">

                    @if($activityObj->object_type == 'article')
                        @php $articleObj = $activityObj->object() @endphp

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
                                        {{ trans('activities.from-user') }}
                                        {{ $articleObj->author->name }}
                                    </div>
                                    <div class="activity-sharing">
                                        @if( $activityObj->school != null)
                                            {{ trans('activities.shared-in-school') }}
                                            {{ $activityObj->school->name }}
                                        @elseif( $activityObj->group != null)
                                            {{ trans('activities.shared-in-group') }}
                                            {{ $activityObj->group->name }}
                                        @endif
                                    </div>
                                </div>
                                <div class="activity-date">{{$articleObj->updated_at}}</div>
                            </div>
                            <div class="activity-description">
                                {!! $articleObj->description !!}
                                <a class="read-more"
                                   href="{{action('Articles\ArticleController@show',[$articleObj->code])}}">{{ trans('articles.articles.read-more') }}</a>
                            </div>
                        </div>

                    @elseif($activityObj->object_type == 'assignment')

                    @endif
                </div>

            @endforeach
        @endif
    </section>

@endsection