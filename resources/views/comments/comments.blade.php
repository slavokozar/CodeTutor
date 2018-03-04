@if(Auth::check())
    <div class="comment-wrapper">
        <form id="comment-add" method="post" action="{{action('System\CommentController@store',[$objectObj->commentRoute(), $objectObj->code])}}">
            {!! csrf_field() !!}
            <div class="avatar">
                <img class="img-responsive" src="{{Auth::user()->avatar()}}" />
            </div>

            <div class="comment">
                <textarea name="comment" class="form-control" rows="1" placeholder="Pridajte komentár..."></textarea>
            </div>

            <button type="submit" class="btn btn-sm btn-danger hidden">Odoslať</button>
        </form>
    </div>
@else
    <p class="text-center text-danger">Musíte sa prihlásiť, aby ste mohli vytvárať, alebo odpovedať na komentáre.</p>
@endif


<?php if(!isset($comments)) $comments = $objectObj->comments; ?>
@foreach($comments as $commentObj)
    @include('comments.show')
@endforeach

