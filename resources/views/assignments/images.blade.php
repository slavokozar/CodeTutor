<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">{{ trans('assignments.delete.heading') }}</h4>
            </div>
            <div class="modal-body">
                <div id="images-upload">
                    <form method="post"
                          action="{{ action('Assignments\ImageController@store', [$assignmentObj == null ? 'null' : $assignmentObj->code]) }}"
                          enctype="multipart/form-data">
                        <div class="upload-area">
                            <a href="#">
                                <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                <p>{{trans('builder/media.modal.images.drag')}}</p>
                            </a>

                            <input type="file" name="files" multiple>
                        </div>
                    </form>
                </div>


                <div id="images-row" class="row">
                    <div id="images-empty" class="col-md-60 text-center {{ (count($images) > 0) ? 'hidden' : ''}}">
                        <p>{{trans('images.empty')}}</p>
                        <p>{{trans('images.empty-hint')}}</p>
                    </div>


                    @foreach($images as $imageObj)
                        @include('files.images.modal-thumb')
                    @endforeach
                </div>
                {{--{!! $files->render() !!}--}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">{{ trans('general.cancel') }}</button>
                <button type="button" class="btn btn-danger success">{{ trans('general.insert') }}</button>
            </div>

        </div>
    </div>
</div>