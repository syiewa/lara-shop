@extends('front.eshopper.layouts.index')
@section('slider')
@overwrite
@section('sidebar')
@overwrite
@section('js')
<script>
    simpleCart.empty();
    anotherCart.empty();
</script>
@endsection
@section('main')
<div class="row">    		
    <div class="col-sm-12">    			   			
        <h2 class="title text-center">Checkout</h2>    	
        <div class="col-sm-12">
            <p class='text-center'>
                @if(Session::has('error'))
                {{Session::get('error')}}
                @else
                Transaksi Success
                @endif
            </p>
        </div>
    </div>			 		
</div> 

@stop

