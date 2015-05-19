<li>
    @if(count($tariff))
    @foreach($tariff as $tarif)
    @if(count($tarif['costs']) > 0)
    @foreach($tarif['costs'] as $cost)
    <div class="panel panel-default">
        <div class="panel-body">
            {{$cost['service']}}
            <div class="radio">
                <label>
                    <input type="radio" name="tarif"  class="tarif" value="{{$cost['cost'][0]['value']}}">
                    {{$cost['cost'][0]['value']}}
                </label>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div class="panel panel-default">
        <div class="panel-body">
            Tarif Pengiriman Tidak diketemukan / Tarif Flat
            <div class="radio">
                <label>
                    <input type="radio" name="tarif"  class="tarif" value="20000">
                    Rp. 20.000,-
                </label>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    @else
    Coba beberapa saat lagi
    @endif
</li>


