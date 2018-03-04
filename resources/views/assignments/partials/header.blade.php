<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-fw fa-home" aria-hidden="true"></i></a>
    <li><a href="{{action('Assignments\AssignmentController@index')}}">Zadania</a></li>
    @if($action == 'show')
        <li class="active">{{$assignmentObj->name}}</li>
    @else
        <li><a href="{{action('Assignments\AssignmentController@show',[$assignmentObj->code])}}">{{$assignmentObj->name}}</a></li>
        <li class="active">{{$action}}</li>
    @endif
</ol>

<h1>
    {!! $assignmentObj->is_public ? '' : 'profile' !!}
    {!! $assignmentObj->checked_at != null ? '' : '<i class="fa fa-fw fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Neoverené zadanie"></i>' !!}
    {{ $assignmentObj->name }}{{ isset($subheading) ? ': ' . $subheading : ''}}
</h1>

<div class="row">
    <div class="col-md-60">

        <ul class="nav nav-tabs nav-tabs-right">
            <li role="presentation" {!! $controller == 'AssignmentController' && $action == 'show' ? 'class="active"' : '' !!}>
                <a href="{{action('Assignments\AssignmentController@show',[$assignmentObj->code])}}">
                    <i class="fa fa-fw fa-file-text-o" aria-hidden="true"></i>&nbsp;Zadanie
                </a>
            </li>

            <li role="presentation" {!! $controller == 'SubmitController' && $action == 'show' ? 'class="active"' : '' !!}>
                <a href="{{action('Assignments\SubmitController@show',[$assignmentObj->code])}}">
                    <i class="fa fa-fw fa-upload" aria-hidden="true"></i>&nbsp;Odovzdanie
                </a>
            </li>

            @if(Auth::check() && ($assignmentObj->group->isLecturer(Auth::user()) || Auth::user()->isAdmin()))
                <li class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-fw fa-cogs" aria-hidden="true"></i>&nbsp;Možnosti <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">

                        <li role="presentation">
                            <a href="{{ action('Assignments\SolutionController@index',[$assignmentObj->code]) }}">
                                <i class="fa fa-fw fa-line-chart" aria-hidden="true"></i>&nbsp;Výsledky
                            </a>
                        </li>

                        <li role="separator" class="divider"></li>

                        <li>
                            <a href="{{ action('Assignments\AssignmentController@edit', [$assignmentObj->code]) }}">
                                <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>&nbsp;Upraviť
                            </a>
                        </li>

                        <li>
                            <a href="{{ action('Assignments\TestController@settings', [$assignmentObj->code]) }}">
                                <i class="fa fa-fw fa-terminal" aria-hidden="true"></i>&nbsp;Nastavenie Testov
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="{{ action('Assignments\TestController@show',[$assignmentObj->code, 'testovacie']) }}">
                                <i class="fa fa-fw fa-graduation-cap" aria-hidden="true"></i>&nbsp;Testovacie data
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="{{ action('Assignments\TestController@show',[$assignmentObj->code, 'verejne']) }}">
                                <i class="fa fa-fw fa-download" aria-hidden="true"></i>&nbsp;Verejné data
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="{{ action('Assignments\TestController@example', [$assignmentObj->code]) }}">
                                <i class="fa fa-fw fa-code" aria-hidden="true"></i>&nbsp;Vzorové riešenie
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="{{ action('Assignments\TestController@review',[$assignmentObj->code]) }}">
                                <i class="fa fa-fw fa-check-square-o" aria-hidden="true"></i>&nbsp;Kontrola dát
                            </a>
                        </li>

                        <li role="separator" class="divider"></li>

                        <li>
                            <a href="{{action('Assignments\AssignmentController@remove',[$assignmentObj->code])}}">
                                <i class="fa fa-fw fa-trash-o" aria-hidden="true"></i>Odstrániť
                            </a>
                        </li>
                    </ul>
                </li>
            @endif


        </ul>
    </div>
</div>
