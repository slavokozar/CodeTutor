<div id="assignment-info">
<span class="assignment-deadline">zostáva {!! $assignmentObj->deadline() !!}</span>
{{--@if(Auth::check())--}}
{{--<br/>--}}
{{--<span class="assignment-deadline">odovzdaní <span>{{count($assignmentObj->userSolutions())}}</span></span>--}}
{{--<br/>--}}
{{--@if($assignmentObj->userHasScore())--}}
{{--<span class="assignment-deadline">automatiký test <span>{{$assignmentObj->userScore()}}</span> / <span>{{$assignmentObj->maxScore()}}</span></span>--}}
{{--<br/>--}}
{{--@endif--}}
{{--@if($assignmentObj->userHasManualScore())--}}
{{--<span class="assignment-deadline">manuálne hodnotenie <span>{{$assignmentObj->userManualScore()}}</span> / <span>{{$assignmentObj->maxManualScore()}}</span></span>--}}
{{--<br/>--}}
{{--@endif--}}
{{--@endif--}}
</div>