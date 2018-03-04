@extends('layout_sidebar')

@section('sidebar')
    @include('assignments.partials.sidebar')
@endsection

@section('content')
    <?php
        $subheading = 'Nastavenia testov';
    ?>
    @include('assignments.partials.header')

    <section id="settings">

        <form method="post" action="{{ action('Assignments\TestController@postSettings',$assignmentObj->code) }}">
            {!! csrf_field() !!}

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        @foreach($assignmentObj->programmingLanguages as $programmingLanguage)
            <div class="language-wrapper">
                <h4>Jazyk {{ucfirst($programmingLanguage->name)}}</h4>

                <?php
                    $language = $settings[$programmingLanguage->code];
                ?>

                @if($language != null)
                    <div class="row">
                        <label class="col-lg-20 control-label control-label-sm">Timeout kompilácie</label>
                        <div class="col-lg-10">
                            <input type="number" name="timeout_{{$programmingLanguage->code}}" class="form-control form-control-sm" placeholder="Timeout"
                                   value="{{ old('timeout.'.$programmingLanguage->code, $settings[$programmingLanguage->code]->timeout) }}">
                        </div>
                    </div>
                    <div class="row" style="margin-top:5px">
                        <label class="col-lg-20 control-label control-label-sm">Parametre základnej kompilácie</label>
                        <div class="col-lg-40 ">
                            <select name="options_basic_{{$programmingLanguage->code}}[]" class="js-select form-control form-control-sm" multiple>
                                @foreach($language->options_basic as $option)
                                    <option value="{{$option}}" {{ in_array($option, old('options_basic_'.$programmingLanguage->code, $settings[$programmingLanguage->code]->options_basic)) ? 'selected' : '' }}>{{$option}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-top:5px">
                        <label class="col-lg-20 control-label control-label-sm">Parametre testovacej kompilácie</label>
                        <div class="col-lg-40 ">
                            <select name="options_extended_{{$programmingLanguage->code}}[]" class="js-select form-control form-control-sm" multiple>
                                @foreach($language->options_extended as $option)
                                    <option value="{{$option}}" {{ in_array($option, old('options_extended_'.$programmingLanguage->code, $settings[$programmingLanguage->code]->options_extended)) ? 'selected' : '' }}>{{$option}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @else
                    <p class="text-center text-danger">Pre tento jazyk momentálne tester nepodporuje žiadne nastavenia.</p>
                @endif

            </div>
        @endforeach
            <button type="submit">Odoslat</button>
        </form>
    </section>

@endsection

@section('scripts')
    <script>
        $('.js-select').select2({
            theme: "classic"
        });
    </script>
@endsection
