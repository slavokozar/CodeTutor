<div class="comment-wrapper">
    <div class="avatar">
        <img class="img-responsive" src="{!! Auth::user()->avatar() !!}"/>
    </div>

    <div class="comment">
        <form action="{{action('System\CommentController@update',[$objectObj->commentRoute, $objectObj->code, $commentObj->id])}}" method="post">
            {!! csrf_field() !!}
            <textarea class="form-control" rows="3" name="comment">{{$commentObj->text}}</textarea>
            <button type="submit" class="btn btn-sm btn-danger pull-right">Odoslať</button>
            <button class="btn btn-cancel btn-sm btn-default pull-right">Zrušiť</button>
        </form>
    </div>
</div>