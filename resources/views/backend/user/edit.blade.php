@extends('backend/layouts/index')
@section('css')
<link href="{{asset('backend/plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('backend/plugins/fileinput/fileinput.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('js')
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
    {!! Breadcrumbs::render('useredit') !!}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div><!-- /.box-header -->
                <form role="form" action='{{route('backend.user.update',$user->id)}}' method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="id" value="{{$user->id}}">
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
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" value="{{$user->first_name}}" class="form-control" id="first_name" placeholder="Enter First Name" name='first_name'>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" value="{{$user->last_name}}" class="form-control" id="last_name" placeholder="Enter Last Name" name='last_name'>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" value="{{$user->email}}" class="form-control" id="email" placeholder="Enter Email" name='email'>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" id="name" placeholder="Enter Password" name='password'>
                        </div>
                        <div class="form-group">
                            <label>Select Role</label>
                            <select id="form-field-select-3" class="form-control search-select" name="role">
                                <option value="">Pilih Role</option>
                                @foreach($roles as $key=>$val)
                                @if($user->roles()->count())
                                <option value="{{$key}}" {{$key == $user->roles()->first()->id ? 'selected="selected"' : ''}}>{{$val}}</option>
                                @endif
                                <option value="{{$key}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>
                                @if($user->status == 1)
                                <input type="checkbox" class="minimal" name='status' checked /> Active ?
                                @else
                                <input type="checkbox" class="minimal" name='status' /> Active ?
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