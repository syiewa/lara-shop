@extends('backend/layouts/index')
@section('css')
<link href="{{asset('backend/plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('backend/plugins/fileinput/fileinput.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('backend/plugins/jQuery-Tags-Input/jquery.tagsinput.css')}}">
@endsection
@section('js')
<script src="{{asset('backend/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/plugins/fileinput/fileinput.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/plugins/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/plugins/input-mask/jquery.inputmask.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/plugins/input-mask/jquery.inputmask.extensions.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/plugins/input-mask/jquery.inputmask.numeric.extensions.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/plugins/jQuery-Tags-Input/jquery.tagsinput.js')}}"></script>
<script>
$('#tags_2').tagsInput({
    width: 'auto'
});
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
});
//Red color scheme for iCheck
$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    checkboxClass: 'icheckbox_minimal-red',
    radioClass: 'iradio_minimal-red'
});
//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
});
$("#price").inputmask();
$("#input-2").fileinput({
    uploadUrl: "{{route('backend.image.store')}}",
    uploadAsync: true,
    minFileCount: 1,
    maxFileCount: 5,
    allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
    uploadExtraData: function() {  // callback example
        var out = {_token: "{{ csrf_token() }}", id_product: "{{$product->id}}"};
        return out;
    }
});
var img = function() {
    $.get("{{route('backend.image.show',$product->id)}}", function(data) {
        $("#image-pro").html(data);
    });
}
$('#input-2').on('fileuploaded', function(event, data, previewId, index) {
    var form = data.form, files = data.files, extra = data.extra,
            response = data.response, reader = data.reader;
    img();
});
var max_fields = 10; //maximum input boxes allowed
var wrapper = $(".input_fields_wrap"); //Fields wrapper
var add_button = $(".add_field_button"); //Add button 
var button = '<div class="form-group"><div class="row"><div class="col-xs-2"><input type="text" class="form-control" placeholder="Name" name="name[]"></div><div class="col-xs-2"><input type="text" class="form-control" placeholder="Value" name="value[]"></div><div class="col-xs-3"><button type="button" class="btn btn-default remove_field">Remove field</button></div></div></div>'

var x = 1; //initlal text box count
$(add_button).click(function(e) { //on add input button click
    e.preventDefault();
    if (x < max_fields) { //max input box allowed
        x++; //text box increment
        $(wrapper).append(button); //add input box
    }
});

$(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
    e.preventDefault();
    $(this).closest('.form-group').remove();
    x--;
})
$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
    var target = $(e.target).attr("href") // activated tab
    if (target == '#add_image') {
        img();
    }
})
$("#image-pro").on('click', '.del-img', function(e) {
    e.preventDefault();
    var id = $(this).attr('href');
    bootbox.confirm("Are you sure to delete this product?", function(result) {
        if (result) {
            $.ajax({
                method: "DELETE",
                url: "{{url('backend/image')}}/" + id,
                data: {_token: "{{csrf_token()}}"}
            }).done(function(msg) {
                if (msg.success) {
                    img();
                }
            });
        }
    });
});
</script>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{$title}}
        <small>{{$sub_title}}</small>
    </h1>
    {!! Breadcrumbs::render('productedit') !!}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <!--                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div> /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(count($errors))
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#add_pro" data-toggle="tab">Edit Product</a></li>
                                    <li><a href="#add_image" data-toggle="tab">Manage Image</a></li>
                                    <li><a href="#add_meta" data-toggle="tab">Meta Product</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="add_pro">
                                        <form role="form" method="post" action="{{route('backend.product.update',$product->id)}}" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="put">
                                            <input type="hidden" name="id" value="{{$product->id}}">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select id="form-field-select-3" class="form-control search-select" name="id_category">
                                                    <option value="">Pilih Category</option>
                                                    @foreach($category as $key=>$val)
                                                    <option value="{{$key}}" {{$key == $product->id_category ? 'selected="selected"' : ''}}>{{$val}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>SKU</label>
                                                <input type="text" name="product_sku" class="form-control" value="{{$product->product_sku}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" name="product_name" class="form-control" value="{{$product->product_name}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Description</label>
                                                <textarea name="product_description" class="form-control">{{$product->product_description}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Product Price</label>
                                                <input id="price" data-inputmask="'alias': 'decimal', 'groupSeparator': '.', 'autoGroup': true" type="text" name="product_price" class="form-control" value="{{$product->product_price}}">
                                            </div>
                                            <div class="input_fields_wrap">
                                                @if(count($product->attribute) > 0)
                                                @foreach($product->attribute as $key => $attr)
                                                <div class="form-group">
                                                    @if($key == 0)
                                                    <label>Attributes</label>
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-xs-2">
                                                            <input type="text" class="form-control" placeholder="Name" name="name[]" value="{{$attr->name}}">
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <input type="text" class="form-control" placeholder="Value" name="value[]" value="{{$attr->values}}">
                                                        </div>
                                                        @if($key != 0)
                                                        <div class="col-xs-3">
                                                            <button type="button" class="btn btn-default remove_field">Remove field</button>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <div class="form-group">
                                                    <label>Attributes</label>
                                                    <div class="row">
                                                        <div class="col-xs-2">
                                                            <input type="text" class="form-control" placeholder="Name" name="name[]" value="{{old('name[]')}}">
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <input type="text" class="form-control" placeholder="Value" name="value[]" value="{{old('value[]')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <button type="button" class="btn btn-default add_field_button">Add field</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>
                                                    @if($product->status == 1)
                                                    <input type="checkbox" class="minimal" name='status' checked /> Active ?
                                                    @else
                                                    <input type="checkbox" class="minimal" name='status' /> Active ?
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="{{URL::previous()}}" class="btn btn-warning">Back</a>
                                            </div>
                                        </form>
                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="add_image">
                                        <form role="form" method="post" action="{{route('backend.image.store')}}" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id_product" value="{{$product->id}}">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Images</label>
                                                <input id="input-2" type="file" name='image[]' multiple=true class="file-loading" data-show-upload="false">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="{{URL::previous()}}" class="btn btn-warning">Back</a>
                                            </div>
                                        </form>
                                        <div id="image-pro">
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="add_meta">
                                        <form method="post" action="{{route('backend.product.meta')}}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id_product" value="{{ $product->id }}">
                                            <div class="form-group">
                                                <label>Meta Title</label>
                                                <input type="text" name="meta_title" class="form-control" value="{{$product->metaproduct->meta_title or ''}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Meta Description</label>
                                                <textarea name="meta_description" class="form-control">{{$product->metaproduct->meta_description or ''}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Meta Keywords</label>
                                                <input id="tags_2" type="text" class="tags" name="meta_keyword" value="{{$product->metaproduct->meta_keyword or ''}}">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="{{URL::previous()}}" class="btn btn-warning">Back</a>
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div> <!-- /.row -->
                    <!-- END CUSTOM TABS -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@stop