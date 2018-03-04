<div id="modal-results" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-center">Výsledy automatického testu</h4>
            </div>
            <div class="modal-body">
                @if(isset($result->compilation))
                    <h3>Kompilácia</h3>
                    @if($result->compilation->isOK)
                        <div class="alert alert-success">
                            <i class="fa fa-2x fa-check" aria-hidden="true"></i>
                            Kompilácia prebehla úspešne.
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <i class="fa fa-2x fa-exclamation-triangle" aria-hidden="true"></i>
                            Počas kompilácie sa vyskytli následovné chyby a varovania. Body sú prideľované len
                            riešeniam, ktorých kompilácia skončí bez akýchkoľvek varovaní, alebo chýb.
                        </div>
                    @endif

                    @foreach($result->compilation->warnings as $warning)
                        <div class="alert alert-warning">
                            {{$warning}}
                        </div>
                    @endforeach

                    @foreach($result->compilation->errors as $error)
                        <div class="alert alert-danger">
                            {{$error}}
                        </div>
                    @endforeach
                @endif

                @if(isset($result->comments) && count($result->comments) > 0)
                    <h3>Komentáre</h3>
                    @foreach($result->comments as $comment)
                        <div class="alert alert-info">
                            {{$comment}}
                        </div>
                    @endforeach
                @endif



                @if(isset($result->tests) && count($result->tests) > 0)
                    @foreach($result->tests as $test)
                        <h3>Test {{$test->description}} ({{$test->duration}} ms)</h3>
                        @foreach($test->errors as $error)
                            <div class="alert alert-danger">{{$error}}</div>
                        @endforeach

                        @foreach($test->tasks as $task)
                            <h4>Úloha {{$task->taskNumber}}</h4>
                            <?php $points = 0; $success = true; ?>
                            @foreach($task->lines as $line)
                                <?php $points += $line->points ?>
                                @if($line->note != "")
                                    <div class="alert alert-warning">{{$line->note}}</div>
                                @endif
                            @endforeach

                            @if($points == 0)
                                <div class="alert alert-danger">{{$points}} / {{$task->totalPoints}} bodov</div>
                            @elseif($points == $task->totalPoints)
                                <div class="alert alert-success">{{$points}} / {{$task->totalPoints}} bodov</div>
                            @else
                                <div class="alert alert-warning">{{$points}} / {{$task->totalPoints}} bodov</div>
                            @endif
                        @endforeach


                    @endforeach
                @endif

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
