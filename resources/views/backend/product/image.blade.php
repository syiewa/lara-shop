<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Path Full</th>
            <th>Path Thumb</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($images))
        @foreach($images as $image)
        <tr>
            <td><img src="{{asset($image->path_thumb)}}" /></td>
            <td>{{asset($image->path_full)}}</td>
            <td>{{asset($image->path_thumb)}}</td>
            <td><a href="{{$image->id}}" class="btn btn-danger del-img">Delete</a></td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="4">
                NO DATA
            </td>
        </tr>
        @endif
    </tbody>
</table>