@extends('layouts.app')

@section('content')

    <div id="auth" class="container">

        <div class="wrapper">
            <div class="row">

                <div class="col-md-6 col-md-offset-3 text-center">
                    <h2>Zmena hesla</h2>

                    <form class="form-horizontal" role="form" method="POST"
                          action="{{ action('ProfileController') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('password_old') ? ' has-error' : '' }}">
                            <label for="password_old" class="col-md-4 control-label">vaše heslo</label>

                            <div class="col-md-8">
                                @if ($errors->has('password_old'))
                                    <span class="help-block">{{ $errors->first('password_old') }}</span>
                                @endif
                                <input id="password_old" type="password" class="form-control"
                                       name="password_old" required placeholder="vaše heslo">

                                <i class="fa fa-eye" aria-hidden="true"
                                   style="position:absolute; font-size: 26px; bottom: 13px; right:18px; color:#373737"></i>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">nové heslo</label>

                            <div class="col-md-8">
                                @if ($errors->has('password'))
                                    <span class="help-block">{{ $errors->first('password') }}</span>
                                @endif
                                <input id="password" type="password" class="form-control" name="password" required
                                       placeholder="nové heslo">

                                <i class="fa fa-eye" aria-hidden="true"
                                   style="position:absolute; font-size: 26px; bottom: 13px; right:18px; color:#373737"></i>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Zmeniť heslo</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection