<div class="col-sm-10">
    <div class="images-square" data-image="{{$imageObj->code}}">
        <img class="images-inner" alt="image"
             src="{{ $imageObj->url() }}">
        <div class="images-info">
            <span class="images-caption">{{$imageObj->name}}.{{$imageObj->ext}}</span>
        </div>
    </div>
</div>