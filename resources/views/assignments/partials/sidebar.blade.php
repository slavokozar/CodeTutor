<section class="sidebar dark" style="padding:0 20px">
    <div class="sidebar-wrapper">
        <h2>Zadania</h2>
        @if(sizeof($groups) > 0)
        @foreach ($groups as $group)
            <h3>{{$group->name}}</h3>
            <ul>
                @foreach($group->assignments as $assignment)
                <li>
                    <a href="{{action('Assignments\AssignmentController@show',[$assignment->code])}}">{{$assignment->name}}</a>

                    @if(Auth::check() && $group->isLecturer(Auth::user()))
                    <span class="toolbar pull-right">
                        <a href="{{action('Assignments\AssignmentController@edit',[$assignment->code])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
{{--                        <a href="{{action('Assignments\AssignmentController@destroy',[$assignment->code])}}"><i class="fa fa-times" aria-hidden="true"></i></a>--}}
                    </span>
                    @endif
                </li>
                @endforeach
            </ul>
        @endforeach
        @else
            <p>Žiadne dostupné zadania</p>
        @endif

    </div>
</section>