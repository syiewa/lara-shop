<label for="exampleInputEmail1">Provinsi</label>
<select class='form-group' name='province' id="prov">
    <option value=''>Pilih Provinsi</option>
    @foreach($province as $prov)
    <option value="{{$prov['province_id']}}">{{$prov['province']}}</option>
    @endforeach
</select>

