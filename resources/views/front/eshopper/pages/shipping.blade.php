@extends('front/eshopper/layouts/index')
@section('slider')
@overwrite
@section('sidebar')
@overwrite
@section('js')
<script>
    $(document).ready(function() {
        $.get('{{url("api/ongkir/province")}}', function(e) {
            $('#prov').html(e);
        }).done(function(e) {
            $('#prov').val("{{$order['province']}}")
            $("#prov").prop("disabled", true);
        });
        $.get('{{url("api/ongkir/kota")}}/{{$order["province"]}}', function(e) {
            $('#city').html(e);
        }).done(function(e) {
            $('#city').val("{{$order['city']}}")
            $("#city").prop("disabled", true);
        });
        $("#next").click(function(e) {

            e.preventDefault();
            var data = {
                '_token': "{{csrf_token()}}",
                'email': $("#email").val(),
                'name': $('#name').val(),
                'address': $('#address').val(),
                'phone': $('#phone').val(),
                'mob_phone': $('#mob_phone').val()
            };
            $.post('{{url("checkout/shipping")}}', data, function(e) {
            }).done(function() {
            }).fail(function(e) {
                var alert = '';
                alert += '<div class="alert alert-danger"><strong>Whoops!</strong> There were some problems with your input.<br><br>';
                alert += '<ul>';
                $.each(e.responseJSON, function(key, value) {
                    alert += '<li>' + value + '</li>';
                });
                alert += '</ul>';
                $("#bahaya").html(alert);
            });
        });
    });
</script>
@endsection
@section('main')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->
    </div><!--/checkout-options-->

    <div class="register-req">
        <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
    </div><!--/register-req-->

    <div class="shopper-informations">
        <div id="bahaya">
        </div>
        <div class="row">
            <div class="col-sm-7 clearfix">
                <div class="bill-to">
                    <p>Bill To</p>
                    <div class="form-one">
                        <form>
                            <input type="text" placeholder="Email*" value="{{$user->email}}" id="email">
                            <input type="text" placeholder="Name" value="{{$user->name}}" id="name">
                            <textarea placeholder="Address 1 *" id="address">{{$user->address}}</textarea>
                        </form>
                    </div>
                    <div class="form-two" id="address">
                        <form>
                            <select name='province' id="prov">
                                <option value=''>Pilih Provinsi</option>
                            </select>
                            <select name='city' id="city">
                                <option value=''>Pilih Kota</option>
                            </select>
                            <input type="text" placeholder="Phone *" value="{{$user->phone}}" id="phone">
                            <input type="text" placeholder="Mobile Phone" value="{{$user->mob_phone}}" id="mob_phone">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="order-message">
                    <p>Shipping Order</p>
                    <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                </div>	
            </div>	
            <a href="" class="btn btn-default check_out" id="next">Checkout</a>
            <br />
            <br />
        </div>
    </div>
</section> <!--/#cart_items-->
@stop