<label for="exampleInputEmail1">Kota</label>
<select class='form-group' name='province'>
    <option value=''>Pilih Kota</option>
    @foreach($city as $kota)
    <option value="{{$kota['city_id']}}">{{$kota['city_name']}}</option>
    @endforeach
</select>

