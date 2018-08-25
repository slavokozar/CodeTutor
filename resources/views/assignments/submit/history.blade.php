@inject('assignmentService', 'Facades\App\Services\Assignments\AssignmentService')


@extends('layouts.main')

@section('content-main')

    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'label' => trans('assignments.link'), 'action' => 'Assignments\AssignmentController@index' ],
            [ 'label' => $assignmentObj->name, 'action' => 'Assignments\AssignmentController@show', 'params' => [$assignmentObj->code]],
            [ 'label' => trans('assignments.submit.link'), 'action' => 'Assignments\SubmitController@index', 'params' => [$assignmentObj->code]],
            [ 'label' => trans('assignments.history.link')]
        ])
    !!}

    <h1>{{ trans('assignments.history.link') }}</h1>

    <section id="submit-history">

        @foreach($solutions as $solutionObj)
            @php $time = strtotime($solutionObj->created_at) @endphp
            <h4>{{ date('d. m. Y', $time) }} <span>{{ date('H:i:s', $time) }}</span></h4>
            <div class="row">
                <div class="col-lg-20 col-lg-push-40 text-right">
                    <div id="assignment-stats">
                        <div class="assignment-value">
                            automatický test
                            <span>{{ $assignmentService::userTestScore($assignmentObj, Auth::user()) }}</span>
                            /
                            <span>{{ $assignmentService::maxTestScore($assignmentObj, Auth::user()) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-40 col-lg-pull-20">
                    <div class="row">
                        <div class="col-md-20"><label>{{ trans('assignments.submit.file') }}</label></div>
                        <div class="col-md-40">
                            {!! $solutionObj->icon() !!} {{$solutionObj->filename}}
                        </div>
                    </div>


                </div>
            </div>

            <a class="read-more" href="{{ action('Assignments\SolutionController@show', [$assignmentObj->code, $solutionObj->code]) }}">Zobraziť odovzdané riešenie...</a>
            <hr/>
        @endforeach
        {{--<div class="row">--}}
        {{--<div class="col-lg-20 col-lg-push-40 text-right">--}}
        {{--<div id="assignment-stats">--}}
        {{--<div class="assignment-value">zostáva {!! $assignmentService::deadline($assignmentObj) !!}</div>--}}
        {{--@if(Auth::check())--}}
        {{--<div class="assignment-value">--}}
        {{--odovzdaní--}}
        {{--<span>{{ $assignmentService::userSolutions($assignmentObj, Auth::user()) }}</span>--}}
        {{--</div>--}}
        {{--<div class="assignment-value">--}}
        {{--automatiký test--}}
        {{--<span>{{ $assignmentService::userTestScore($assignmentObj, Auth::user()) }}</span>--}}
        {{--/--}}
        {{--<span>{{ $assignmentService::maxTestScore($assignmentObj, Auth::user()) }}</span>--}}
        {{--</div>--}}
        {{--<div class="assignment-value">--}}
        {{--manuálne hodnotenie--}}
        {{--<span>{{ $assignmentService::userReviewScore($assignmentObj, Auth::user()) }}</span>--}}
        {{--/--}}
        {{--<span>{{ $assignmentService::maxReviewScore($assignmentObj, Auth::user()) }}</span>--}}
        {{--</div>--}}
        {{--@endif--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-40 col-lg-pull-20">--}}
        {{--<h3>{{ trans('assignments.submit.heading') }}</h3>--}}
        {{--@if($assignmentObj->checked_at == null)--}}
        {{--<div class="alert alert-danger" role="alert">Toto zadanie ešte nebolo validované.</div>--}}
        {{--@elseif(strtotime($assignmentObj->start_at) > time())--}}
        {{--<div class="alert alert-danger" role="alert">Toto zadanie ešte nie je možné odovzdávať.</div>--}}
        {{--@elseif(strtotime($assignmentObj->deadline_at) < time())--}}
        {{--<div class="alert alert-danger" role="alert">Toto zadanie už nie je možné odovzdávať.</div>--}}
        {{--@else--}}

        {{--<form id="submit-upload" method="post" enctype="multipart/form-data"--}}
        {{--action="{{action('Assignments\SubmitController@upload',[$assignmentObj->code])}}">--}}

        {{--{!! csrf_field() !!}--}}

        {{--<input type="file" name="file" style="display:none">--}}

        {{--<button type="submit" class="btn btn-lg btn-danger">Vybrať súbor</button>--}}
        {{--<span>Podporované typy: .c, .cpp, .java, .zip</span>--}}


        {{--</form>--}}

        {{--@endif--}}
        {{--<h3>Odovzdané riešenie</h3>--}}
        {{--<div id="submit-solution">--}}
        {{--@if($solution != null)--}}

        {{--<div id="submit-file">{!! $solution->icon() !!} {{$solution->filename}}</div>--}}


        {{--@if($solution != null && $solution->lang == '')--}}
        {{--<div id="submit-error">--}}
        {{--<div class="alert alert-danger">Odovzdané riešenie neobsahuje požadované súbory.<br/>Požiadavky--}}
        {{--na riešenie nájdete v pravidlách.--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--@endif--}}

        {{--<div>--}}
        {{--<a href="">Zobraziť odovzdané riešenie</a>--}}
        {{--</div>--}}

        {{--<ul id="submit-files">--}}
        {{--@foreach($solution->files()->orderBy('dirname', 'asc')->get() as $fileObj)--}}
        {{--<li>{{ $fileObj->dirname . ( $fileObj->dirname != '/' ? '/' : '' ) . $fileObj->filename . '.' . $fileObj->ext }}</li>--}}
        {{--@endforeach--}}
        {{--</ul>--}}
        {{--@endif--}}
        {{--</div>--}}
        {{--@if($assignmentService::userSolutions($assignmentObj, Auth::user()) > 0)--}}
        {{--<h3>Staršie odovzdania</h3>--}}
        {{--<div id="submit-history">--}}
        {{--<a href="">Zobraziť históriu odovzdaní</a>--}}
        {{--</div>--}}
        {{--@endif--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--@endif--}}

    </section>
@endsection