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
$(function() {
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
    $('#summernote').summernote({height: 300});
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
    {!! Breadcrumbs::render('slideshowcreate') !!}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div><!-- /.box-header -->
                <form role="form" action='{{route('backend.slideshow.store')}}' method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                            <label for="exampleInputEmail1">Slideshow Title</label>
                            <input type="text" value="{{old('ss_name')}}" class="form-control" id="name" placeholder="Enter Title" name='ss_name'>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slideshow URL</label>
                            <input type="text" value="{{old('ss_url')}}" class="form-control" id="name" placeholder="Enter URL" name='ss_url'>
                        </div>
                        <div class="form-group" id="fcontent">
                            <label for="exampleInputEmail1">Slideshow Description</label>
                            <textarea id="summernote" name="ss_description">{{old('ss_description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Slideshow Image</label>
                            <input id="input-2" type="file" name='ss_image' class="file" data-show-upload="false" data-show-caption="true">
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" class="minimal" name='ss_status'/> Active ?
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