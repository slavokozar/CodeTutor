@extends('layout_sidebar')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/shCore.css')}}">
    <link rel="stylesheet" href="{{asset('css/shThemeDefault.css')}}">

@endsection

@section('content')
    <section>
        <h1>Zdrojovy kod</h1>
        <div id="source">
            <pre class="brush: java">{{$source}}</pre>
        </div>
    </section>

    <div id="reviewModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Okomentovat riadok</h4>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" rows="3" placeholder="Komentár..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('scripts')
    <script src="{{asset('js/shCore.js')}}"></script>
    <script src="{{asset('js/shBrushCpp.js')}}"></script>
    <script src="{{asset('js/shBrushJava.js')}}"></script>

    <script>
        SyntaxHighlighter.defaults['highlight'] = [1,3];
        SyntaxHighlighter.all();


        function waitForHighlight(){
            console.log('wait');
            setTimeout(function(){
                console.log('waited',$('#source .syntaxhighlighter').length);
                if($('#source .syntaxhighlighter').length == 0){
                    waitForHighlight();
                }else{
                    $('#source .syntaxhighlighter .gutter .line').each(function() {
//                        $(this).append('<button class="btn btn-comment btn-primary"><i class="fa fa-comment" aria-hidden="true"></i></button>');
                    });
                    startCommenting();
                }
            }, 500);
        };
        waitForHighlight();

        function startCommenting(){
            $(document).on('click','.syntaxhighlighter .line',function(e){
                var className = $(e.target).closest('.line').attr('class').match(/number([0-9]*)/);
                if (!className || className.length == 0) {
                    return null;
                }

                console.log(parseInt(className[0].replace('number', '')));
            })
        }

        function createComment(){


            $('#reviewModal').modal('show');
        }

        function editComment(){


            $('#reviewModal').modal('show');
        }

        function deleteComment(){



        }
    </script>
@endsection


{{--Add base files to your page: shCore.js and shCore.css--}}
{{--Include shCore.css and shThemeDefault.css--}}


{{--Add brushes that you want (for example, shBrushJScript.js for JavaScript, see the list of all available brushes)--}}


{{--Create a code snippet with either <pre /> or <script /> method (see below)--}}
