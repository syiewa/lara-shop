@extends('backend/layouts/index')
@section('css')
@endsection
@section('js')
<script>
    $(document).ready(function() {
        var ship = function() {
            $.get("{{url('backend/options/shipindex')}}", function(data) {
                $("#shipping").html(data);
            });
        }
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr("href") // activated tab
            switch (target) {
                case '#shipping':
                    ship();
                    break;
            }
        });
        $(document).on('submit','#form-ship',function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            $.post(url,$(this).serialize(),function(data){
               console.log(data); 
            });
        })
    })
</script>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{$title}}
        <small>{{$sub_title}}</small>
    </h1>
    {!! Breadcrumbs::render('productcreate') !!}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div><!-- /.box-header -->
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
                                    <li><a href="#general" data-toggle="tab">General Options</a></li>
                                    <li class="active"><a href="#shipping" data-toggle="tab">Shipping Option</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="general">

                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane active" id="shipping">

                                    </div><!-- /.tab-pane -->
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