<form class="form-horizontal" action="{{ action($_form_action, $_form_params)}}" method="post">
    {!! csrf_field() !!}
    @if($_form_method != 'post')
        <input type="hidden" name="_method" value="{{$_form_method}}">
    @endif

    {!! ContentNav::submit(['label' => $userObj->id ? trans('general.save') : trans('general.create')]) !!}

    <section id="basic">

        @if($userObj->id != null)
            <div class="row">
                <div class="col-md-20">
                    <label for="">#</label>
                </div>
                <div class="col-md-40">
                    {{$userObj->code}}
                </div>
            </div>
        @endif
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="col-md-20" for="">{{ trans('users.labels.title') }}</label>
            <div class="col-md-40">
                <input class="form-control" type="text" name="title"
                       value="{{ old('title', $userObj->title) }}"/>
                @if( $errors->has('title') )
                    <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="col-md-20" for="">{{ trans('users.labels.name') }}</label>
            <div class="col-md-40">
                <input class="form-control" type="text" name="name" value="{{ old('name', $userObj->name) }}"/>
                @if( $errors->has('name') )
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
            <label class="col-md-20" for="">{{ trans('users.labels.surname') }}</label>
            <div class="col-md-40">
                <input class="form-control" type="text" name="surname"
                       value="{{ old('surname', $userObj->surname) }}"/>
                @if( $errors->has('surname') )
                    <span class="help-block">{{ $errors->first('surname') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="col-md-20" for="">{{ trans('users.labels.email') }}</label>
            <div class="col-md-40">
                <input class="form-control" type="email" name="email"
                       value="{{ old('email', $userObj->email) }}"/>
                @if( $errors->has('email') )
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
            <label class="col-md-20" for="">{{ trans('users.labels.birthdate') }}</label>
            <div class="col-md-40">
                <input class="form-control" type="date" name="birthdate"
                       value="{{ old('birthdate', $userObj->birthdate) }}"/>
                @if( $errors->has('birthdate') )
                    <span class="help-block">{{ $errors->first('birthdate') }}</span>
                @endif
            </div>
        </div>
    </section>
</form>