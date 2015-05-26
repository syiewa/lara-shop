<li>
    @if(count($tariff))
    <input type='hidden' id='province' value='{{$destination['province_id']}}'>
    <input type='hidden' id='city_name' value='{{$destination['city_id']}}'>
    @foreach($tariff as $tarif)
    @if(count($tarif['costs']) > 0)
    @foreach($tarif['costs'] as $cost)
    <div class="panel panel-default">
        <div class="panel-body">
            {{$tarif['name'].' - '.$cost['service'].' / '.$cost['description']}}
            <div class="radio">
                <label>
                    <input type="radio" name="tarif"  class="tarif" value="{{$tarif['code'].'-'.$cost['service'].'-'.$cost['cost'][0]['value']}}">
                    {{$cost['cost'][0]['value']}}
                </label>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div class="panel panel-default">
        <div class="panel-body">
            Tarif Pengiriman Tidak diketemukan.
        </div>
    </div>
    @endif
    @endforeach
    @else
    Coba beberapa saat lagi
    @endif
</li>


