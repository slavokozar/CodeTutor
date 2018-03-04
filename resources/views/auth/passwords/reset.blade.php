@extends('wrapper')

@section('wrapper')
    <div id="auth" class="container">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Reset hesla</h1>
                </div>
                <div class="col-md-6 col-md-offset-3 text-center">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{$token}}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ $email or old('email') }}" required autofocus placeholder="Email">
                        </div>

                        <div class="form-group password-control{{ $errors->has('password') ? ' has-error' : '' }}"
                             style="position:relative">

                            @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                            <input id="password" type="password" class="form-control" name="password"
                                   style="margin-right:30px;" placeholder="Heslo*">
                            <i class="fa fa-eye" aria-hidden="true"
                               style="position:absolute; font-size: 26px; bottom: 13px; right:18px; color:#373737"></i>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
