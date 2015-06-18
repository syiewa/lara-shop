@extends('front/eshopper/layouts/index')
@section('slider')
@overwrite
@section('sidebar')
@overwrite
@section('js')
<script>
    $(document).ready(function() {
        var province = "{{$order['shipping']['province']}}";
        var city = "{{$order['shipping']['city']}}";
        var enable_shipping = "{{shipOption('enable_shipping')}}";
        $.get('{{url("api/ongkir/province")}}', function(e) {
            $('#prov').html(e);
        }).done(function(e) {
            $('#prov').val(province)
            if (enable_shipping == '0') {
                $("#prov").prop("disabled", true);
            } else {
                $("#prov").prop("disabled", false);
            }
        });
        $.get('{{url("api/ongkir/kota")}}/{{$order["shipping"]["province"]}}', function(e) {
            $('#city').html(e);
        }).done(function(e) {
            $('#city').val(city);
            if (enable_shipping == '0') {
                $("#city").prop("disabled", true);
            } else {
                $("#city").prop("disabled", false);
            }
        });
        $(document).on('change', '#prov', function(e) {
            var prov_id = $(this).val();
            $.get('{{url("api/ongkir/kota")}}/' + prov_id, function(e) {
                $('#city').html(e);
            }).done(function(e) {
                $('#city').val(city);
                if (enable_shipping == '0') {
                    $("#city").prop("disabled", true);
                } else {
                    $("#city").prop("disabled", false);
                }
            });
        });
        $("#next").click(function(e) {

            e.preventDefault();
            var data = {
                '_token': "{{csrf_token()}}",
                'user_id': "{{Auth::user()->id}}",
                'email': $("#email").val(),
                'first_name': $('#first_name').val(),
                'last_name': $('#last_name').val(),
                'address': $('#address').val(),
                'phone': $('#phone').val(),
                'mob_phone': $('#mob_phone').val(),
                'province': $('#prov option:selected').val(),
                'city': $('#city option:selected').val(),
            };
            $.post('{{url("checkout/shipping")}}', data, function(e) {
                if (e.success) {
                    window.location.replace("{{url('checkout/review')}}");
                }
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
        $('input[type="radio"][name="payment"]').change(function(e) {
            var id = $('input[name="payment"]:checked').val();
            $.get('{{url("checkout/payment-description")}}/' + id, function(d) {
                $("#payment").html(d);
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
                            <input type="text" placeholder="First Name" value="{{$user->first_name}}" id="first_name">
                            <input type="text" placeholder="Last Name" value="{{$user->last_name}}" id="last_name">
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
        </div>
    </div>
    <div class="review-payment">
        <h2>Review & Payment</h2>
    </div>
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total Price</td>
                </tr>
            </thead>
            <tbody>
                @foreach($order['product'] as $product)
                <tr>
                    <td class="cart_product">
                        <a href=""><img src="{{asset($product['product_img'])}}" alt=""></a>
                    </td>
                    <td class="cart_description">
                        <h4><a href="">{{$product['product_name']}}</a></h4>
                        <p>{{$product['product_options']}}</p>
                    </td>
                    <td class="cart_price">
                        <p>{{$product['product_price']}}</p>
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button">
                            {{$product['product_qty']}}
                        </div>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">{{$product['product_tprice']}}</p>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3">&nbsp;</td>
                    <td colspan="2">
                        <table class="table table-condensed total-result">
                            <tr>
                                <td>Cart Sub Total</td>
                                <td>{{$order['sub_total']}}</td>
                            </tr>
                            <tr class="shipping-cost">
                                <td>Shipping Cost</td>
                                <td>{{$order['shipping']['fee']}}</td>										
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td><span>{{$order['total']}}</span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <span>
        <a href="" class="btn btn-default btn-lg check_out pull-right" id="next">Checkout</a>  
    </span>
</section> <!--/#cart_items-->
@stop