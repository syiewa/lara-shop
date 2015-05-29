<form action="{{url('backend/options/generalstore')}}" method="post" class="form-horizontal" id="form-gen" enctype="multipart/form-data">
    <input type="hidden" value="{{csrf_token()}}" name="_token">
    @foreach($general as $key => $val)
    @if($val->gen_store_name == 'store_address')
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">{{ucwords(str_replace('_',' ',$val->gen_store_name))}}</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="{{$val->gen_store_name}}">{{$val->gen_store_val}}</textarea>
        </div>
    </div>
    @elseif($val->gen_store_name == 'store_logo')
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">{{ucwords(str_replace('_',' ',$val->gen_store_name))}}</label>
        <div class="col-sm-10">
            <input id="input-2" type="file" name="{{$val->gen_store_name}}" class="file" data-show-upload="false" data-show-caption="true">
        </div>
    </div>
    @else
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">{{ucwords(str_replace('_',' ',$val->gen_store_name))}}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="{{$val->gen_store_name}}" value="{{$val->gen_store_val}}">
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
