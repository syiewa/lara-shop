@extends('front.eshopper.layouts.index')
@section('slider')
@overwrite
@section('sidebar')
@overwrite
@section('css')
<style>
    .user-details {position: relative; padding: 0;}
    .user-details .user-image {position: relative;  z-index: 1; width: 100%; text-align: center;}
    .user-image img { clear: both; position: relative;}

    .user-details .user-info-block {width: 100%; position: relative; background: rgb(255, 255, 255); z-index: 0; padding-top: 35px;}
    .user-info-block .user-heading {width: 100%; text-align: center; margin: 10px 0 0;}
    .user-info-block .navigation {float: left; width: 100%; margin: 0; padding: 0; list-style: none; border-bottom: 1px solid #f5f5f5; border-top: 1px solid #f5f5f5;}
    .navigation li {float: left; margin: 0; padding: 0;}
    .navigation li a {padding: 20px 30px; float: left;color: black;text-decoration: none}
    .navigation li.active a {color:#fdb45e;}
    .user-info-block .user-body {float: left; width: 100%;}
    .user-body .tab-content > div {float: left; width: 100%;}
    .user-body .tab-content h4 {width: 100%; margin: 10px 0; color: #333;}
</style>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $.get('{{url("api/ongkir/province")}}', function(e) {
            $('#province').html(e);
        });
        $('#province').on('change', '#prov', function(e) {
            var prov_id = $(this).val();
            $.get('{{url("api/ongkir/kota")}}/' + prov_id, function(e) {
                $('#kota').html(e);
            });
        });
    });
</script>
@endsection
@section('main')
<div class="row">    		
    <div class="col-sm-12">    			   			
        <h2 class="title text-center">Account</h2>    	
        <div class="col-sm-12">
            <div class="col-sm-12 col-md-12 user-details">
                <div class="user-image">
                    <img src="{{Auth::user()->avatar}}" alt="{{Auth::user()->first_name}}" title="{{Auth::user()->last_name}}" class="img-circle">
                </div>
                <div class="user-info-block">
                    <div class="user-heading">
                        <h3>{{Auth::user()->first_name.' '.Auth::user()->last_name}}</h3>
                    </div>
                    <ul class="navigation">
                        <li class="active">
                            <a data-toggle="tab" href="#information">
                                <span class="glyphicon glyphicon-user"></span> User Profile
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#email">
                                <span class="glyphicon glyphicon-envelope"></span> Orders
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#events">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </a>
                        </li>
                    </ul>
                    <div class="user-body">
                        <div class="tab-content">
                            <div id="information" class="tab-pane active">
                                <h4>Account Information</h4>
                                <form role="form" action='{{route('backend.user.store')}}' method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" value="{{Auth::user()->first_name}}" class="form-control" id="name" placeholder="Enter Name" name='first_name'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" value="{{Auth::user()->email}}" class="form-control" id="email" placeholder="Enter Email" name='email'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Password</label>
                                            <input type="password" class="form-control" id="name" placeholder="Enter Password" name='password'>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Alamat</label>
                                            <textarea class="form-control" name='address'></textarea>
                                        </div>
                                        <div class="form-group" id='province'>
                                            <label for="exampleInputEmail1">Provinsi</label>
                                            <select class='form-group' name='province' id="prov">
                                                <option value=''>Pilih Provinsi</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id='kota'>
                                            <label for="exampleInputEmail1">Kota</label>
                                            <select class='form-group' name='city' id="city">
                                                <option value=''>Pilih Kota</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="email" class="tab-pane">
                                <h4>Send Message</h4>
                            </div>
                            <div id="events" class="tab-pane">
                                <h4>Events</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>			 		
</div> 

@stop

