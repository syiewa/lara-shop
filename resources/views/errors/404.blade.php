<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE 2 | 404 Page not found</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="{{asset('backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{asset('backend/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="{{asset('backend/plugins/iCheck/square/blue.css')}}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <div class="wrapper">

            <!-- Main content -->
            <section class="content">

                <div class="error-page">
                    <h2 class="headline text-yellow"> 404</h2>
                    <div class="error-content">
                        <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                        <p>
                            We could not find the page you were looking for.
                            Meanwhile, you may <a href='{{url()}}'>return to dashboard</a> or try using the search form.
                        </p>
<!--                        <form class='search-form'>
                            <div class='input-group'>
                                <input type="text" name="search" class='form-control' placeholder="Search"/>
                                <div class="input-group-btn">
                                    <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
                                </div>
                            </div> /.input-group 
                        </form>-->
                    </div><!-- /.error-content -->
                </div><!-- /.error-page -->
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <!-- jQuery 2.1.3 -->
        <script src="{{asset('backend/plugins/jQuery/jQuery-2.1.3.min.js')}}"></script>
        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="{{asset('backend/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>  
        <script src="{{asset('backend/plugins/blockui/jquery.blockUI.js')}}" type="text/javascript"></script>  
        <!-- iCheck -->
        <script src="{{asset('backend/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script>
    </body>
</html>
