@extends('backend/layouts/index')
@section('css')
<link href="{{asset('backend/plugins/summernote/summernote.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('backend/plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('backend/plugins/fileinput/fileinput.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('js')
<script src="{{asset('backend/plugins/summernote/summernote.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/plugins/fileinput/fileinput.min.js')}}" type="text/javascript"></script>
<script>
function make_slug(str)
{
    str = str.toLowerCase();
    str = str.replace(/[^a-z0-9]+/g, '-');
    str = str.replace(/^-|-$/g, '');
    return str;
}
$(function() {
    var kupret = $("select[name=page_type] option:selected").val();
    var fcontent = "<label for='exampleInputEmail1'>Content<\/label>";
    fcontent += "<textarea id='summernote' name='page_content'>";
    fcontent += "{!!$page->page_content!!}";
    fcontent += "<\/textarea>";
    if (kupret == 'link') {
        $('#fslug').html('<label for="exampleInputEmail1">URL</label><input name="page_slug" type="text" class="form-control" placeholder="" aria-describedby="basic-addon1" id="url" value="{{$page->page_slug}}">');
        $('#fcontent').html('');
    } else {
        $('#fslug').html('<label for="exampleInputEmail1">Slug</label><div class="input-group"><span class="input-group-addon" id="basic-addon1">{{url()}}/</span><input name="page_slug" type="text" class="form-control" placeholder="" aria-describedby="basic-addon1" id="slug" value="{{$page->page_slug}}"> </div>');
        $('#fcontent').html(fcontent);
        $('#summernote').summernote({height: 300});
    }
    $('select[name="page_type"]').change(function() {
        var value = $(this).val();
        if (value == 'link') {
            $('#fslug').html('<label for="exampleInputEmail1">URL</label><input name="page_slug" type="text" class="form-control" placeholder="" aria-describedby="basic-addon1" id="url" value="{{$page->page_slug}}">');
            $('#fcontent').html('');
        } else {
            $('#fslug').html('<label for="exampleInputEmail1">Slug</label><div class="input-group"><span class="input-group-addon" id="basic-addon1">{{url()}}/</span><input name="page_slug" type="text" class="form-control" placeholder="" aria-describedby="basic-addon1" id="slug" value="{{$page->page_slug}}"></div>');
            $('#fcontent').html(fcontent);
            $('#summernote').summernote({height: 300});
        }
    });
    $('#summernote').summernote({height: 300});
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
    $("#input-2").fileinput({
        overwriteInitial: true,
    });
    $('#name').keyup(function() {
        $('#slug').val(make_slug($(this).val()));
    });
    $("#slug").on('change', function() {
        $(this).val(make_slug($(this).val()));
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
    {!! Breadcrumbs::render('pageedit') !!}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div><!-- /.box-header -->
                <form role="form" action='{{route('backend.page.update',$page->id)}}' method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="id" value="{{$page->id}}">
                    <input type="hidden" name="page_position" value="{{ $position }}">
                    <div class="box-body">
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
                        <div class="form-group">
                            <label for="exampleInputEmail1">Menu Type</label>
                            <select id="form-field-select-3" class="form-control search-select kopet" name="page_type">
                                <option value="">Pilih Menu</option>
                                <option value="link" {{$page->page_type == 'link' ? 'selected="selected"' : ''}}>Link</option>
                                <option value="page" {{$page->page_type == 'page' ? 'selected="selected"' : ''}}>Page</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" value="{{$page->page_name}}" class="form-control" id="name" placeholder="Enter Page Title" name='page_name'>
                        </div>
                        <div class="form-group" id="fslug">
                            <label for="exampleInputEmail1">Slug</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">{{url()}}/</span>
                                <input name="page_slug" type="text" class="form-control" placeholder="" aria-describedby="basic-addon1" id="slug" value="{{$page->page_slug}}">
                            </div>
                        </div>
                        <div class="form-group" id="fcontent">
                            <label for="exampleInputEmail1">Content</label>
                            <textarea id="summernote" name="page_content">{!!$page->page_content!!}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Select Parent</label>
                            <select id="form-field-select-3" class="form-control search-select" name="page_parent">
                                <option value="">Pilih Parent</option>
                                @foreach($parent as $key=>$val)
                                <option value="{{$key}}" {{$key == $page->page_parent ? 'selected="selected"' : ''}}>{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>
                                @if($page->page_status == 1)
                                <input type="checkbox" class="minimal" name='page_status' checked /> Active ?
                                @else
                                <input type="checkbox" class="minimal" name='page_status' /> Active ?
                                @endif
                            </label>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{URL::previous()}}" class="btn btn-warning">Back</a>
                    </div>
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@stop