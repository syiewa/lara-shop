@extends('backend/layouts/index')
@section('css')
<style>
    .dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }
    .dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
    .dd-list .dd-list { padding-left: 30px; }
    .dd-collapsed .dd-list { display: none; }
    .dd-item,
    .dd-empty,
    .dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }
    .dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
                 background: #fafafa;
                 background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
                 background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
                 background:         linear-gradient(top, #fafafa 0%, #eee 100%);
                 -webkit-border-radius: 3px;
                 border-radius: 3px;
                 box-sizing: border-box; -moz-box-sizing: border-box;
    }
    .dd-handle:hover { color: #2ea8e5; background: #fff; }
    .dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
    .dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
    .dd-item > button[data-action="collapse"]:before { content: '-'; }
    .dd-placeholder,
    .dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
    .dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
                background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                    -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
                background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
                background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                    linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
                background-size: 60px 60px;
                background-position: 0 0, 30px 30px;
    }
    .dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
    .dd-dragel > .dd-item .dd-handle { margin-top: 0; }
    .dd-dragel .dd-handle {
        -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
        box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
    }
    .dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
                   background: #fafafa;
                   background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
                   background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
                   background:         linear-gradient(top, #fafafa 0%, #eee 100%);
                   -webkit-border-radius: 3px;
                   border-radius: 3px;
                   box-sizing: border-box; -moz-box-sizing: border-box;
    }
    .dd3-content:hover { color: #2ea8e5; background: #fff; }
    .dd-dragel > .dd3-item > .dd3-content { margin: 0; }
    .dd3-item > button { margin-left: 30px; }
    .dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
                  border: 1px solid #aaa;
                  background: #ddd;
                  background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
                  background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
                  background:         linear-gradient(top, #ddd 0%, #bbb 100%);
                  border-top-right-radius: 0;
                  border-bottom-right-radius: 0;
    }
    .dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
    .dd3-handle:hover { background: #ddd; }
</style>
@endsection
@section('js')
<script src="{{asset('backend/plugins/nestedsortable/jquery.nestable.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/plugins/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
var tpage = function() {
    $.get('{{ route("api.page","top") }}', {}, function(data) {
        $('#nestable').html(data);
    })
};
var bpage = function() {
    $.get('{{ route("api.page","bottom") }}', {}, function(data) {
        $('#nestable2').html(data);
    })
};
$(document).ready(function() {
    $('.dd').nestable({/* config options */
        maxDepth: 2
    });
    tpage();
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        var target = $(e.target).attr("href") // activated tab
        if (target == '#menu-top') {
            tpage();
        } else if (target == '#menu-bottom') {
            bpage();
        }
    });
    $('#save-top').click(function(e) {
        $('#nestable').slideUp(function() {
            var data = {"data": $('#nestable').nestable('serialize'), '_token': '{{csrf_token()}}', 'position': 'top'};
            $.post('{{route("api.postpage")}}', data, function(e) {
                if (e) {
                    tpage();
                }
            }).done(function() {
                $('#nestable').slideDown();
            });
        });
        e.preventDefault();
    });
    $('#save-bottom').click(function(e) {
        $('#nestable2').slideUp(function() {
            var data = {"data": $('#nestable2').nestable('serialize'), '_token': '{{csrf_token()}}', 'position': 'bottom'};
            $.post('{{route("api.postpage")}}', data, function(e) {
                if (e) {
                    bpage();
                }
            }).done(function() {
                $('#nestable2').slideDown();
            });
        });
        e.preventDefault();
    });
    $("#nestable").on('click', '#delete', function(event) {
        bootbox.confirm("Are you sure to delete this page?", function(result) {
            if (result) {
                var id = $('#delete').attr('data-id');
                var data = {'_token': '{{csrf_token()}}'};
                $('#nestable').slideUp(function() {
                    $.ajax({
                        url: '{{url("backend/page")}}/' + id,
                        type: 'DELETE',
                        data: data,
                        success: function(result) {
                            if (result) {
                                tpage();
                            }
                        }
                    }).done(function() {
                        $('#nestable').slideDown();
                    });
                });
            }
        });
        event.preventDefault();
    });
    $("#nestable2").on('click', '#delete', function(event) {
        bootbox.confirm("Are you sure to delete this page?", function(result) {
            if (result) {
                var id = $('#delete').attr('data-id');
                var data = {'_token': '{{csrf_token()}}'};
                $('#nestable2').slideUp(function() {
                    $.ajax({
                        url: '{{url("backend/page")}}/' + id,
                        type: 'DELETE',
                        data: data,
                        success: function(result) {
                            if (result) {
                                bpage();
                            }
                        }
                    }).done(function() {
                        $('#nestable2').slideDown();
                    });
                });
            }
        });
        event.preventDefault();
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
    {!! Breadcrumbs::render('page') !!}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#menu-top" data-toggle="tab">Top Menu</a></li>
                            <li><a href="#menu-bottom" data-toggle="tab">Bottom Menu</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="menu-top">
                                <a class="btn btn-success" href="{{route('backend.page.create',['position'=>'top'])}}">Tambah Top Menu</a>
                                <div id="nestable" class="dd">
                                </div>
                                <br />
                                <button class="btn btn-default" id="save-top">Save</button>
                            </div>
                            <div class="tab-pane" id="menu-bottom">
                                <a class="btn btn-success" href="{{route('backend.page.create',['position'=>'bottom'])}}">Tambah Bottom Menu</a>
                                <div id="nestable2" class="dd">
                                </div>
                                <br />
                                <button class="btn btn-default" id="save-bottom">Save</button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@stop