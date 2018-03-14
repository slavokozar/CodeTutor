<div class="row">
    <div class="col-md-20">
        <label for="">#</label>
    </div>
    <div class="col-md-40">
        {{$userObj->code}}
    </div>
</div>
<div class="row">
    <div class="col-md-20">
        <label for="">{{ trans('users.labels.name') }}</label>
    </div>
    <div class="col-md-40">
        {{$userObj->name}}
    </div>
</div>
<div class="row">
    <div class="col-md-20">
        <label for="">{{ trans('users.labels.email') }}</label>
    </div>
    <div class="col-md-40">
        {{$userObj->email}}
    </div>
</div>
<div class="row">
    <div class="col-md-20">
        <label for="">{{ trans('users.labels.birthdate') }}</label>
    </div>
    <div class="col-md-40">
        {{$userObj->name}}
    </div>
</div>