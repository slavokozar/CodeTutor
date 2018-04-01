@extends('layouts.app')

@section('content')

    <main role="main" class="container">
            <div class="row">
                <div class="col-md-60 text-center">
                    <h1>Registrovat</h1>
                </div>


                <div class="col-md-40 col-md-offset-10 text-center">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-20 control-label">titul</label>

                            <div class="col-md-40">
                                @if ($errors->has('title'))
                                    <span class="help-block">{{ $errors->first('title') }}</span>
                                @endif
                                <input id="name" type="text" class="form-control" name="title"
                                       value="{{ old('title') }}" autofocus placeholder="titul">
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-20 control-label">meno</label>

                            <div class="col-md-40">
                                @if ($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                                <input id="name" type="text" class="form-control" name="name"
                                       value="{{ old('name') }}" autofocus placeholder="meno">
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-20 control-label">priezvisko</label>

                            <div class="col-md-40">
                                @if ($errors->has('surname'))
                                    <span class="help-block">{{ $errors->first('surname') }}</span>
                                @endif
                                <input id="name" type="text" class="form-control" name="surname"
                                       value="{{ old('surname') }}" autofocus placeholder="priezvisko">
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-20 control-label">dátum narodenia</label>

                            <div class="col-md-40">
                                @if ($errors->has('date'))
                                    <span class="help-block">{{ $errors->first('date') }}</span>
                                @endif
                                <input id="date" type="text" class="form-control" name="date"
                                       value="{{ old('date') }}" placeholder="dátum narodenia">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('school_id') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-20 control-label">škola</label>

                            <div class="col-md-40">

                                @if ($errors->has('school_id'))
                                    <span class="help-block">{{ $errors->first('school_id') }}</span>
                                @endif

                                <select id="school_id" name="school_id" class="form-control">
                                    <option value="">Vyberte školu...</option>
                                    @foreach($schools as $school)
                                        <option value="{{$school->id}}"
                                                @if(old('school_id') !== null && old('school_id') == $school->id) selected @endif>{{$school->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-20 control-label">email</label>

                            <div class="col-md-40">

                                @if ($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" placeholder="email">

                            </div>
                        </div>

                        <div class="form-group password-control{{ $errors->has('password') ? ' has-error' : '' }}"
                             style="position:relative">
                            <label for="name" class="col-md-20 control-label">heslo</label>

                            <div class="col-md-40">

                                @if ($errors->has('password'))
                                    <span class="help-block">{{ $errors->first('password') }}</span>
                                @endif
                                <input id="password" type="password" class="form-control" name="password"
                                       style="margin-right:30px;" placeholder="heslo">
                                <i class="fa fa-eye" aria-hidden="true"
                                   style="position:absolute; font-size: 26px; bottom: 12px; right:50px; color:#373737"></i>
                            </div>
                        </div>

                        <div class="form-group">

                            <button type="submit" class="btn btn-danger">
                                Registrovať
                            </button>

                        </div>
                    </form>

                </div>
            </div>


    </main>
@endsection

@section('scripts')
    <script>
        $('.password-control .fa').mousedown(function () {
            $(this).closest('.password-control').find('input').attr('type', 'text');
            $(this).toggleClass('fa-eye').toggleClass('fa-eye-slash');
        });

        $('.password-control .fa').mouseup(function () {
            $(this).closest('.password-control').find('input').attr('type', 'password');
            $(this).toggleClass('fa-eye').toggleClass('fa-eye-slash');
        });
    </script>

@endsection