@extends('layouts.app')

@section('content')
    <div id="auth" class="container">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Reset hesla</h1>
                </div>
                <div class="col-md-4 col-md-offset-4 text-center">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ old('email') }}" required placeholder="Email">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-danger">
                                Resetovať
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

