<div class="comment-wrapper" data-comment="{{$commentObj->id}}">
    <div class="avatar">
        <img class="img-responsive" src="{{ $commentObj->author->avatar() }}"/>
    </div>
    <div class="comment">
        <span class="comment-name">{{$commentObj->author->name}}</span>
        <span class="comment-time">- {{$commentObj->created_at}}</span>
        @if($commentObj->created_at != $commentObj->updated_at)
            <span class="comment-time">- upravené {{$commentObj->updated_at}}</span>
        @endif

        @if(Auth::check() && $commentObj->canModify(Auth::user()))
            <div class="comment-tool">
                <a class="comment-remove" href="{{action('System\CommentController@destroy',[$objectObj->commentRoute, $objectObj->code, $commentObj->id])}}">
                    <i class="fa fa-trash" aria-hidden="true"></i> Odstrániť

                </a>
                <a class="comment-edit" href="{{action('System\CommentController@edit',[$objectObj->commentRoute, $objectObj->code, $commentObj->id])}}">
                    <i class="fa fa-pencil" aria-hidden="true"></i> Upraviť
                </a>
            </div>

        @endif

        <p>{{$commentObj->text}}</p>

        @if(Auth::check() && $commentObj->canReply(Auth::user()))
            <a href="{{action('System\CommentController@create',[$objectObj->commentRoute, $objectObj->code, $commentObj->reply_to_id == null ? $commentObj->id : $commentObj->reply_to_id])}}" class="comment-reply">
                <i class="fa fa-reply" aria-hidden="true"></i> Odpovedať
            </a>
        @endif
    </div>



    @if($commentObj->reply_to_id == null)
        <div class="comment-clear"></div>
        <div class="comment-replies">
            @foreach($commentObj->replies as $commentObj)
                @include('comments.show')
            @endforeach
        </div>
    @endif


</div>
