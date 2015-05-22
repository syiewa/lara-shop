@extends('backend/layouts/index')
@section('css')
@endsection
@section('js')
<script src="{{asset('backend/plugins/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    var roles = function() {
        $.get("{{route('backend.role.index')}}", function(data) {
            $("#roles").html(data);
        });
    };
    var perm = function() {
        $.get("{{route('perm')}}", function(data) {
            $("#perm").html(data);
        });
    };
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        var target = $(e.target).attr("href");// activated tab
        if (target == '#roles') {
            roles();
        }
        if (target == '#perm')
        {
            perm();
        }
    });
    $("#roles").on('click', '.delete-role', function(event) {
        var id = $(this).attr('data-id');
        bootbox.confirm("Are you sure to delete this role?", function(result) {
            if (result) {
                $.ajax({
                    method: "DELETE",
                    url: "{{url('backend/role')}}/" + id,
                    data: {_token: "{{csrf_token()}}"}
                }).done(function(msg) {
                    if (msg.success) {
                        roles();
                    }
                });
            }
        });
        event.preventDefault();
    });
    $('.delete-user').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        bootbox.confirm("Are you sure to delete this role?", function(result) {
            if (result) {
                $.ajax({
                    method: "DELETE",
                    url: "{{url('backend/user')}}/" + id,
                    data: {_token: "{{csrf_token()}}"}
                }).done(function(msg) {
                    if (msg.success) {
                        location.reload();
                    }
                });
            }
        });
    });
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
    {!! Breadcrumbs::render('user') !!}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <div class="btn-group">
                        <a href="{{route('backend.user.create')}}" class="btn btn-default">Tambah User</a>
                        <a href="{{route('backend.role.create')}}" class="btn btn-default">Tambah Role</a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#users" data-toggle="tab">Users</a></li>
                            <li><a href="#roles" data-toggle="tab">Roles</a></li>
                            <li><a href="#perm" data-toggle="tab">Permissions</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="users">
                                <table id="product-table" class="table table-bordered table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>
                                                {{$user->name}}
                                            </td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                            <td>
                                                @foreach($user->roles as $role)
                                                {{$role->name}}
                                                @endforeach
                                            </td>
                                            <td>
                                                {!!$user->is_active!!}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-primary " href="{{route('backend.user.edit',$user->id)}}">Edit</a>
                                                    <button class="btn btn-danger delete-user" data-id="{{$user->id}}">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="roles">

                            </div>
                            <div class="tab-pane" id="perm">

                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@stop