@extends('layouts.sidebar')

@section('sidebar')
    @include('assignments.partials.sidebar')
@endsection

@section('content')
    @include('assignments.partials.header')

    <div class="row">
        <div class="col-md-60 text-center">
            <h3>Chcete naozaj vymazat zadanie: <strong>{{$assignmentObj->name}}</strong>?</h3>
            <form action="{{action('Assignments\AssignmentController@delete',[$assignmentObj->code])}}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="delete">
                <a href="{{action('Assignments\AssignmentController@show',[$assignmentObj->code])}}" class="btn btn-default">Zrušiť</a>
                <button type="submit" class="btn btn-danger">Vymazať</button>
            </form>
        </div>
    </div>
@endsection



