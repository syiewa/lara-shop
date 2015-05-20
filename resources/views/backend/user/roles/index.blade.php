<table id="product-table" class="table table-bordered table-striped table-responsive">
    <thead>
        <tr>
            <th>Name</th>
            <th>Display Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr>
            <td>
                {{$role->name}}
            </td>
            <td>
                {{$role->display_name}}
            </td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-primary " href="{{route('backend.role.edit',$role->id)}}">Edit</a>
                    <button class="btn btn-danger delete-role"  data-id="{{$role->id}}">Delete</button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>