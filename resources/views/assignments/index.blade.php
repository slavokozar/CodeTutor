@extends('layouts.app')

@section('sidebar')
    <h3>Tagy</h3>
    @foreach(\App\Models\ArticleTag::all() as $tag)

        <span data-size="{{ rand (1, 5) }}">{{$tag->tag}}</span>
    @endforeach
@endsection

@section('content')
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        <li class="active">Zadania</li>
    </ol>

    <h1>Zadania</h1>

{{--    @if(Auth::check() && Auth::user()->isAssignmentAuthor())--}}
        <div class="row">
            <div class="col-md-60">
                <ul id="content-nav-tabs" class="nav nav-tabs nav-tabs-right">
                    <li role="presentation">
                        <a href="{{action('Assignments\AssignmentController@create')}}" class="btn">Vytvoriť nové</a>
                    </li>
                </ul>
            </div>
        </div>
    {{--@endif--}}

{{--    @if(count($assignments) == 0)--}}
        <p class="text-center text-danger">
            Práve tu nie su žiadne zadania.<br/>
            <i class="fa fa-4x fa-meh-o" aria-hidden="true"></i><br/>
            Ľutujeme, ak si myslíte, že články by tu mali byť, neváhajte <a href="/#contact">kontaktovať</a> správcov.
        </p>
    {{--@else--}}

        {{--@foreach($assignments as $assignmentObj)--}}
            {{--<div class="assignment {{ $assignmentObj->is_public ? '' : 'private'}}">--}}
                {{--<a href="{{action('Assignments\AssignmentController@show',[$assignmentObj->code])}}">--}}
                    {{--<h2 class="assignment-name">{{$assignmentObj->name}}</h2>--}}
                {{--</a>--}}
                {{--<p class="assignment-author">{{$assignmentObj->author->name}} | {{$assignmentObj->created_at}}</p>--}}
                {{--<div class="assignment-right">--}}
                    {{--<div class="assignment-deadline">ostáva <span>20</span> dní</div>--}}
                    {{--<div class="assignment-submits"><span>7</span> odovzdaní</div>--}}
                    {{--<div class="assignment-points"><span>29</span>/100 bodov</div>--}}
                    {{--{!! $assignmentObj->deadline() !!}--}}
                    {{--@if(Auth::check())--}}
                    {{--<div class="assignment-submits"><span>{{count($assignmentObj->userSolutions())}}</span>--}}
                    {{--odovzdaní--}}
                    {{--</div>--}}
                    {{--@if(count($assignmentObj->userSolutions()) > 0)--}}
                    {{--<div class="assignment-submits"><span>{{$assignmentObj->userScore()}}</span> /--}}
                    {{--<span>{{$assignmentObj->maxPoints()}}</span> bodov--}}
                    {{--</div>--}}
                    {{--@endif--}}

                    {{--@if($assignmentObj->group->isLecturer(Auth::profile()))--}}
                    {{--<span class="toolbar">--}}
                    {{--<a href="{{action('Assignments\AssignmentController@edit',[$assignmentObj->code])}}"><i--}}
                    {{--class="fa fa-pencil" aria-hidden="true"></i></a>--}}
                    {{--<a class="link-modal" href="{{action('Assignments\AssignmentController@delete',[$assignmentObj->code])}}"><i--}}
                    {{--class="fa fa-times" aria-hidden="true"></i></a>--}}
                    {{--</span>--}}
                    {{--@endif--}}
                    {{--@endif--}}
                {{--</div>--}}
                {{--<p class="assignment-description">{!! $assignmentObj->description !!}</p>--}}
                {{--<a href="{{action('Assignments\AssignmentController@show',[$assignmentObj->code])}}">Viac...</a>--}}
            {{--</div>--}}
        {{--@endforeach--}}
    {{--@endif--}}
@endsection

@section('scripts')
    <script>
        var sizes = [14, 18, 22, 26, 32];
        $('#sidebar span').each(function(){

            var size = $(this).data('size');

            $(this).css({
                'font-size': sizes[size]
            });
        })
    </script>
@endsection