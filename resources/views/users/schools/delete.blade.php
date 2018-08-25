<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">{{ trans('users.schools.delete.heading') }}</h4>
            </div>
            <div class="modal-body">
                <p class="text-center text-danger">
                    <i class="fa fa-5x fa-exclamation-triangle" aria-hidden="true"></i>
                </p>
                <p class="text-center text-danger">{!! trans('users.schools.delete.message', ['name' => $schoolObj->name]) !!}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">{{ trans('general.cancel') }}</button>
                <button type="button" class="btn btn-danger">{{ trans('general.delete') }}</button>
            </div>
        </div>
    </div>
</div>