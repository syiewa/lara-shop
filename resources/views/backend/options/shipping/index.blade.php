<form action="{{url('backend/options/shipstore')}}" method="post" class="form-horizontal" id="form-ship">
    <input type="hidden" value="{{csrf_token()}}" name="_token">
    @foreach($shipping as $key => $val)
    @if($val->ship_option_name == 'enable_shipping')
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Enable Shipping</label>
        <div class="col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="{{$val->ship_option_name}}" {{$val->ship_option_value == 1 ? 'checked="checked"' : ''}}>
                </label>
            </div>
        </div>
    </div>
    @elseif($val->ship_option_name == 'shipping_method')
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Shipping Method</label>
        <?php
        $jne = strpos($val->ship_option_value, 'jne');
        $tiki = strpos($val->ship_option_value, 'tiki');
        $pos = strpos($val->ship_option_value, 'pos');
        ?>
        <div class="col-sm-10">
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox1" value="jne" name='{{$val->ship_option_name}}[]' {{$jne === false ? '' : 'checked="checked"'}}> JNE
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox2" value="tiki" name='{{$val->ship_option_name}}[]' {{$tiki === false ? '' : 'checked="checked"'}}> TIKI
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox3" value="pos" name='{{$val->ship_option_name}}[]' {{$pos === false ? '' : 'checked="checked"'}}> POS
            </label>
        </div>
    </div>
    @elseif($val->ship_option_name == 'rajaongkir_key')
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Raja Ongkir Key</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name='{{$val->ship_option_name}}' value="{{$val->ship_option_value}}">
        </div>
    </div>
    @elseif($val->ship_option_name == 'shipping_from')
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Shipping From</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="city_asal">
            <input type="hidden" name='{{$val->ship_option_name}}' value="{{$val->ship_option_value}}" id="city_asal_hid" />
        </div>
    </div>
    @endif
    @endforeach
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Save</button>
        </div>
    </div>
</form>
