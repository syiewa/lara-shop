@extends('backend/layouts/index')
@section('css')
<link href="{{asset('backend/plugins/fileinput/fileinput.min.css')}}" rel="stylesheet" type="text/css" />
<style>
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
</style>
@endsection
@section('js')
<script src="{{asset('front/eshopper/js/jquery.autocomplete.min.js')}}"></script>
<script src="{{asset('backend/plugins/fileinput/fileinput.min.js')}}" type="text/javascript"></script>
<script>
$(document).ready(function() {
    var city = '';
    $.get('{{url("api/ongkir/city/".$city)}}', function(e) {
        city = e;
    });
    var gen = function() {
        $.get("{{url('backend/options/generalindex')}}", function(data) {
            $("#general").html(data);
        });
    }
    var ship = function() {
        $.get("{{url('backend/options/shipindex')}}", function(data) {
            $("#shipping").html(data);

        }).done(function() {
            $.get('{{url("api/ongkir/city")}}', function(e) {
                $('#city_asal').autocomplete({
                    lookup: e,
                    onSelect: function(suggestion) {
                        $('#city_asal_hid').val(suggestion.data);
                    }
                }).val(city);
            });
        });
    }
    var shop = function() {
        $.get("{{url('backend/options/shopindex')}}", function(data) {
            $("#shop").html(data);
        });
    }
    var mail = function() {
        $.get("{{url('backend/options/mailindex')}}", function(data) {
            $("#mail").html(data);
        });
    }
    var social = function() {
        $.get("{{url('backend/options/socialindex')}}", function(data) {
            $("#social").html(data);
        });
    }
    var payment = function() {
        $.get("{{url('backend/options/paymentindex')}}", function(data) {
            $("#payment").html(data);
        });
    }
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        var target = $(e.target).attr("href") // activated tab
        switch (target) {
            case '#general':
                gen();
                break;
            case '#shipping':
                ship();
                break;
            case '#shop':
                shop();
                break;
            case '#mail':
                mail();
                break;
            case '#social':
                social();
                break;
            case '#payment':
                payment();
                break;
        }
    });
    gen();
    $(document).on('submit', '#form-ship', function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        $.post(url, $(this).serialize(), function(data) {
        }).fail(function(fail) {
            if (fail.status === 422) {
                var alert = '';
                alert += '<div class="alert alert-danger"><strong>Whoops!</strong> There were some problems with your input.<br><br>';
                alert += '<ul>';
                $.each(fail.responseJSON, function(key, value) {
                    alert += '<li>' + value + '</li>';
                });
                alert += '</ul>';
                $("#bahaya").html(alert);
            }
        });
    });
    $(document).on('submit', '#form-shop', function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        $.post(url, $(this).serialize(), function(data) {
        }).fail(function(fail) {
            if (fail.status === 422) {
                var alert = '';
                alert += '<div class="alert alert-danger"><strong>Whoops!</strong> There were some problems with your input.<br><br>';
                alert += '<ul>';
                $.each(fail.responseJSON, function(key, value) {
                    alert += '<li>' + value + '</li>';
                });
                alert += '</ul>';
                $("#bahaya").html(alert);
            }

        });
    });
    $(document).on('submit', '#form-mail', function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        $.post(url, $(this).serialize(), function(data) {
        }).fail(function(fail) {
            if (fail.status === 422) {
                var alert = '';
                alert += '<div class="alert alert-danger"><strong>Whoops!</strong> There were some problems with your input.<br><br>';
                alert += '<ul>';
                $.each(fail.responseJSON, function(key, value) {
                    alert += '<li>' + value + '</li>';
                });
                alert += '</ul>';
                $("#bahaya").html(alert);
            }

        });
    });
    $(document).on('submit', '#form-social', function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        $.post(url, $(this).serialize(), function(data) {
        }).fail(function(fail) {
            if (fail.status === 422) {
                var alert = '';
                alert += '<div class="alert alert-danger"><strong>Whoops!</strong> There were some problems with your input.<br><br>';
                alert += '<ul>';
                $.each(fail.responseJSON, function(key, value) {
                    alert += '<li>' + value + '</li>';
                });
                alert += '</ul>';
                $("#bahaya").html(alert);
            }

        });
    });
    $(document).on('submit', '#form-gen', function(e) {
        e.preventDefault();
        var fd = new FormData();
        var url = $(this).attr('action');
        var file = $('input[type=file]')[0].files[0];
        if (file) {
            fd.append('store_logo', file);
        }
        var other_data = $(this).serializeArray();
        $.each(other_data, function(key, input) {
            fd.append(input.name, input.value);
        });
        $.ajax({
            url: url,
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function(data, textStatus, jqXHR) {
            },
            error: function(e) {
                if (fail.status === 422) {
                    var alert = '';
                    alert += '<div class="alert alert-danger"><strong>Whoops!</strong> There were some problems with your input.<br><br>';
                    alert += '<ul>';
                    $.each(e.responseJSON, function(key, value) {
                        alert += '<li>' + value + '</li>';
                    });
                    alert += '</ul>';
                    $("#bahaya").html(alert);
                }
            }
        });
    })
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
    {!! Breadcrumbs::render('options') !!}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div id="bahaya">
                    </div>
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
                                    <li  class="active"><a href="#general" data-toggle="tab">General Options</a></li>
                                    <li><a href="#shipping" data-toggle="tab">Shipping Option</a></li>
                                    <li><a href="#payment" data-toggle="tab">Payment Option</a></li>
                                    <li><a href="#shop" data-toggle="tab">Shop Option</a></li>
                                    <li><a href="#mail" data-toggle="tab">Mail Option</a></li>
                                    <li><a href="#social" data-toggle="tab">Social Option</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="general">

                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="shipping">

                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="shop">

                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="mail">

                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="social">

                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="payment">

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