<form action="{{url('backend/options/shopstore')}}" method="post" class="form-horizontal" id="form-shop" enctype="multipart/form-data">
    <input type="hidden" value="{{csrf_token()}}" name="_token">
    @foreach($shop as $key => $val)
    @if($val->shop_opt_name == 'display_mode' || $val->shop_opt_name == 'category_product_count' || $val->shop_opt_name == 'enable_slideshow' || $val->shop_opt_name == 'share_button_product')
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">{{ucwords(str_replace('_',' ',$val->shop_opt_name))}}</label>
        <div class="col-sm-10">

            <label class="radio-inline">
                <input type="radio" name="{{$val->shop_opt_name}}" id="inlineRadio1" value="0" {{$val->shop_opt_value == 0 ? 'checked="checked"' : ''}}> No
            </label>
            <label class="radio-inline">
                <input type="radio" name="{{$val->shop_opt_name}}" id="inlineRadio2" value="1" {{$val->shop_opt_value == 1 ? 'checked="checked"' : ''}}> Yes
            </label>
        </div>
    </div>
    @else
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">{{ucwords(str_replace('_',' ',$val->shop_opt_name))}}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="{{$val->shop_opt_name}}" value="{{$val->shop_opt_value}}">
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
<script>
    $("#input-2").fileinput({
        overwriteInitial: true,
    });
</script>
