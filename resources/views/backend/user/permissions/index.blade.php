<form method="post" action="{{route('perm.post')}}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="submit" class="btn btn-default" value="Save">
    <br />
    <br />
    <table id="product-table" class="table table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th></th>
                @foreach($roles as $role)
                <th>{{$role->display_name}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Backend</strong></td>
                @foreach($roles as $role)
                <?php $checked = $role->perms()->where('name', 'backend')->count(); ?>
                <td><input type="checkbox" value="backend" name="{{$role->name}}[]" {{$checked > 0 ? 'checked' : ''}}></td>
                @endforeach
            </tr>
            @foreach($modul as $mod)
            <tr>
                <td><strong>{{ucfirst($mod)}}</strong></td>
                <td colspan="{{$roles->count()}}"></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;Read</td>
                @foreach($roles as $role)
                <?php $checked = $role->perms()->where('name', $mod . '-read')->count(); ?>
                <td><input type="checkbox" value="{{$mod}}-read" name="{{$role->name}}[]" {{$checked > 0 ? 'checked' : ''}}></td>
                @endforeach
            </tr>
            <tr>
                <td>&nbsp;&nbsp;Create</td>
                @foreach($roles as $role)
                <?php $checked = $role->perms()->where('name', $mod . '-create')->count(); ?>
                <td><input type="checkbox" value="{{$mod}}-create" name="{{$role->name}}[]" {{$checked > 0 ? 'checked' : ''}}></td>
                @endforeach
            </tr>
            <tr>
                <td>&nbsp;&nbsp;Update</td>
                @foreach($roles as $role)
                <?php $checked = $role->perms()->where('name', $mod . '-update')->count(); ?>
                <td><input type="checkbox" value="{{$mod}}-update" name="{{$role->name}}[]" {{$checked > 0 ? 'checked' : ''}}></td>
                @endforeach
            </tr>
            <tr>
                <td>&nbsp;&nbsp;Delete</td>
                @foreach($roles as $role)
                <?php $checked = $role->perms()->where('name', $mod . '-delete')->count(); ?>
                <td><input type="checkbox" value="{{$mod}}-delete" name="{{$role->name}}[]" {{$checked > 0 ? 'checked' : ''}}></td>
                @endforeach
            </tr>
            @endforeach
            <tr>
                <td><strong>Options</strong></td>
                @foreach($roles as $role)
                <?php $checked = $role->perms()->where('name', 'options')->count(); ?>
                <td><input type="checkbox" value="options" name="{{$role->name}}[]" {{$checked > 0 ? 'checked' : ''}}></td>
                @endforeach
            </tr>
        </tbody>
    </table>
</form>