<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ action('Users\Groups\TeacherController@store',[$groupObj->code]) }}" method="post">
                {!! csrf_field() !!}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ trans('users.teachers.add') }}</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">{!! trans('users.groups.add-teachers', ['group' => $groupObj->name] ) !!}</p>
                    <div class="form-group">
                        <label for="">{{ trans('users.teachers.link') }}</label>
                        <select name="users[]" id="" class="form-control js-select" multiple>
                            @foreach($users as $userObj)
                                <option value="{{ $userObj->id }}">{{ $userObj->title }} {{ $userObj->name }} {{ $userObj->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ trans('general.buttons.cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('general.buttons.add') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>