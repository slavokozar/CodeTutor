<div class="row test-line form-group-sm">
    <div class="col-lg-32">
        <input name="value" type="text" class="form-control" id="exampleInputEmail1"
               placeholder="Výstup" value="{{$line->value}}">
    </div>
    <div class="col-lg-8">
        <input name="points" type="number" class="form-control" id="exampleInputEmail1"
               placeholder="Body" value="{{$line->points}}">
    </div>
    <div class="col-lg-8">
        <select name="typedef" class="form-control selectpicker">
            <option {{$line->typedef == 'Integer' ? 'selected' : '' }}>Int</option>
            <option {{$line->typedef == 'Double' ? 'selected' : '' }}>Dbl</option>
            <option {{$line->typedef == 'String' ? 'selected' : '' }}>Str</option>
        </select>
    </div>
    <div class="col-lg-8">
        <input name="precision" type="number" class="form-control" id="exampleInputPassword1"
               placeholder="Presnosť" value="{{$line->precision}}">
    </div>
    <div class="col-lg-4 text-center">
        <a href="#" class="btn-line-remove">
            <i class="fa fa-times" aria-hidden="true"></i>
        </a>
    </div>
</div>