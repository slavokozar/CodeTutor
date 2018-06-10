<li>
    <div class="row">
        <div class="col-md-8">
            <img class="img-responsive" src="{{ $imageObj->url() }}"/>
        </div>
        <div class="col-md-44">
            {{ $imageObj->name }}
        </div>
        <div class="col-md-8">
            <a class="image-delete"
               href="{{ action('Files\ImageController@delete', [$imageObj->id]) }}">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
            </a>
        </div>
    </div>

</li>