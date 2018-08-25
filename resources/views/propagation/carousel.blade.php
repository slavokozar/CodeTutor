{{--<div id="banner-carousel" class="carousel slide" data-ride="carousel">--}}
{{--<!-- Indicators -->--}}
{{--@if($carousel->count() > 1)--}}
{{--<ol class="carousel-indicators">--}}
{{--@for($i = 0; $i < 5; $i++)--}}
{{--<li data-target="#banner-carousel" data-slide-to="{{$i}}"--}}
{{--@if($i == 0)class="active"@endif></li>--}}
{{--@endfor--}}
{{--</ol>--}}
{{--@endif--}}

{{--<!-- Wrapper for slides -->--}}
{{--@if($carousel->count() > 1)--}}
{{--<div class="carousel-inner" role="listbox">--}}
{{--@for($i = 0; $i < 5; $i++)--}}
{{--<?php $item = $carousel->get(0); ?>--}}

{{--<div class="item{{ $i == 0 ? ' active' : '' }}">--}}
{{--<h3>{{$item->name}}</h3>--}}

{{--<p>{{$item->description}}</p>--}}
{{--@if($item instanceof \App\Models\Article)--}}
{{--<a href="{{action('Articles\ArticleController@show',$item->code)}}">viac...</a>--}}
{{--@elseif($item instanceof \App\Models\Assignment)--}}
{{--<a href="{{action('Assignments\AssignmentController@show',$item->code)}}">viac...</a>--}}
{{--@endif--}}

{{--</div>--}}
{{--@endfor--}}
{{--</div>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}