<div class="form-inline" role="form">
    <br>
    <div class="form-group">
        <label for="parameter" class="sr-only">Параметр</label>
        <div class="input-group">
<span class="input-group-btn">
<button class="btn btn-default add_parameter" type="button"><i class="glyphicon glyphicon-plus"></i></button>
</span>
            <select class="form-control select-opt" name="parameter_id_{{$language->code}}[]">
                @foreach($parameters as $parameter)
                    <option value="{{$parameter->id}}">{{$parameter->title}} @if($parameter->unit !='undefind')
                            ({{$parameter->unit}}) @endif</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="value" class="sr-only">Значение параметра</label>
            <input class="form-control" name="parameter_value_{{$language->code}}[]" placeholder="Значение параметра"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default remove_button" type="button"><i class="glyphicon glyphicon-minus"></i>
            </button>


        </div>


    </div>
</div>