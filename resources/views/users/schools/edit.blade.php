@extends('layouts.main')

@section('content-main')
    {!!
        BreadCrumb::render([
            [ 'url' => '/', 'label' => '<i class="fa fa-home" aria-hidden="true"></i>' ],
            [ 'action' => 'Users\UserController@index', 'label' => trans('users.users.link') ],
            [ 'action' => 'Users\Schools\SchoolController@index', 'label' => trans('users.schools.link') ],
            [ 'label' => $schoolObj->name ]
        ])
    !!}

    @if($schoolObj->id)
        <h1>{{ $schoolObj->name }}</h1>
    @else
        <h1>{{ trans('users.schools.create') }}</h1>
    @endif

    <form class="form-horizontal"
          action="{{ $schoolObj->id == null ? action('Users\Schools\SchoolController@store') : action('Users\Schools\SchoolController@update', $schoolObj->code)}}"
          method="post">
        {!! csrf_field() !!}
        @if($schoolObj->id != null)
            <input type="hidden" name="_method" value="put">
        @endif

        {!! ContentNav::submit(['label' => trans('general.save')]) !!}

        <section id="basic">

            @if($schoolObj->id != null)
                <div class="row">
                    <div class="col-md-20">
                        <label for="">#</label>
                    </div>
                    <div class="col-md-40">
                        {{$schoolObj->code}}
                    </div>
                </div>
            @endif
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="col-md-20" for="">{{ trans('users.labels.name') }}</label>
                <div class="col-md-40">
                    <input class="form-control" type="text" name="name"
                           value="{{ old('name', $schoolObj->name) }}"/>
                    @if( $errors->has('name') )
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <label class="col-md-20" for="">{{ trans('users.labels.address') }}</label>
                <div class="col-md-40">
                        <textarea class="form-control"
                                  name="address">{{ old('address', $schoolObj->address) }}</textarea>
                    @if( $errors->has('address') )
                        <span class="help-block">{{ $errors->first('address') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                <label class="col-md-20" for="">{{ trans('users.labels.url') }}</label>
                <div class="col-md-40">
                    <input class="form-control" type="text" name="url" value="{{ old('url', $schoolObj->url) }}"/>
                    @if( $errors->has('url') )
                        <span class="help-block">{{ $errors->first('url') }}</span>
                    @endif
                </div>
            </div>
        </section>
    </form>

@endsection