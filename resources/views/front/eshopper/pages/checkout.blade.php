@extends('front/eshopper/layouts/index')
@section('slider')
@overwrite
@section('sidebar')
@overwrite
@section('css')
<style>
    #login-dp{
        min-width: 250px;
        padding: 14px 14px 0;
        overflow:hidden;
        background-color:rgba(255,255,255,.8);
    }
    #login-dp .help-block{
        font-size:12px    
    }
    #login-dp .bottom{
        background-color:rgba(255,255,255,.8);
        border-top:1px solid #ddd;
        clear:both;
        padding:14px;
    }
    #login-dp .social-buttons{
        margin:12px 0    
    }
    #login-dp .social-buttons a{
        width: 49%;
    }
    #login-dp .form-group {
        margin-bottom: 10px;
    }
    .btn-fb{
        color: #fff;
        background-color:#3b5998;
    }
    .btn-fb:hover{
        color: #fff;
        background-color:#496ebc 
    }
    .btn-tw{
        color: #fff;
        background-color:#55acee;
    }
    .btn-tw:hover{
        color: #fff;
        background-color:#59b5fa;
    }
    @media(max-width:768px){
        #login-dp{
            background-color: inherit;
            color: #fff;
        }
        #login-dp .bottom{
            background-color: inherit;
            border-top:0 none;
        }
    }
</style>
@endsection
@section('main')
<div class="col-sm-4 col-sm-offset-1">
    <div class="row">
        <div class="col-md-12">
            Login via
            <div class="social-buttons">
                <a href="{{url('login/facebook')}}" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
                <a href="{{url('login/twitter')}}" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
                <a href="{{url('login/google')}}" class="btn btn-google-plus"><i class="fa fa-google-plus"></i>Google +</a>
            </div>
            or
            <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail2">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
                </div>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword2">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                    <div class="help-block text-right"><a href="">Forget the password ?</a></div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> keep me logged-in
                    </label>
                </div>
            </form>
        </div>
        <div class="bottom text-center">
            New here ? <a href="#"><b>Join Us</b></a>
        </div>
    </div>
</div>
<div class="col-sm-1">
    <h2 class="or">OR</h2>
</div>
<div class="col-sm-4">
    <div class="signup-form"><!--sign up form-->
        <h2>New User Signup!</h2>
        <form action="#">
            <input type="text" placeholder="Name"/>
            <input type="email" placeholder="Email Address"/>
            <input type="password" placeholder="Password"/>
            <button type="submit" class="btn btn-default">Signup</button>
        </form>
    </div><!--/sign up form-->
</div>
@stop