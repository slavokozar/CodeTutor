@extends('layout_sidebar')

@section('sidebar')
    @include('assignments.partials.sidebar')
@endsection

@section('content')
    @include('assignments.partials.header')

    @if(count($errors) > 0)
        @foreach($errors as $error)
            <div class="alert alert-danger" role="alert">{{$error}}</div>
        @endforeach
    @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th rowspan="2">User</th>
                @for($i = 1; $i <= $tasksCount; $i++)
                    <th colspan="{{$testsCount}}">Task {{$i}} (max {{$tasksMaxPoints[$i-1]}})</th>
                @endfor
                <th rowspan="2">Spolu (max {{$maxPoints}})</th>
                <th rowspan="2"></th>
            </tr>
            <tr>
                @for($i = 1; $i <= $tasksCount; $i++)
                    @for($j = 1; $j <= $testsCount; $j++)
                        <th>test {{$j}}</th>
                    @endfor
                @endfor
            </tr>
            </thead>
            <tbody>
        @foreach($assignmentObj->group->users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    @for($i = 1; $i <= $tasksCount; $i++)
                        @for($j = 1; $j <= $testsCount; $j++)
                            <td>{{ResultsService::taskPoints($user, $assignmentObj, $i, $j)}}</td>
                        @endfor
                    @endfor
                    <td>{{ResultsService::assignmentPoints($user, $assignmentObj)}}</td>
                    <td class="text-right">
                        <a href="{{action('Assignments\AssignmentController@userSolution',[$assignmentObj->code, $user->code])}}" class="btn btn-sm btn-primary"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                    </td>
                </tr>



        @endforeach
            </tbody>
        </table>
    @endif
@endsection



