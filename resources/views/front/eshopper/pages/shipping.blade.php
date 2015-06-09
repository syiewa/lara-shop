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
            if (enable_shipping == '1') {
                $("#prov").prop("disabled", true);
            } else {
                $("#prov").prop("disabled", false);
            }
        });
        $.get('{{url("api/ongkir/kota")}}/{{$order["shipping"]["province"]}}', function(e) {
            $('#city').html(e);
        }).done(function(e) {
            $('#city').val(city);
            if (enable_shipping == '1') {
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
                if (enable_shipping == '1') {
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
                'name': $('#name').val(),
                'address': $('#address').val(),
                'phone': $('#phone').val(),
                'mob_phone': $('#mob_phone').val(),
                'province': $('#prov').val(),
                'city': $('#city').val(),
                'payment_id': $('input[name="payment"]:checked').val(),
            };
            $.post('{{url("checkout/shipping")}}', data, function(e) {
                if (e.success) {
                    simpleCart.empty();
                    anotherCart.empty();
                    window.location.replace("{{url('checkout/complete')}}");
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
    <div class="payment-options" style="margin-bottom: 50px;">
        @foreach(getPayment() as $payment)
        <span>
            <label><input type="radio" name='payment' value="{{$payment->id}}"> {{ucwords($payment->payment_type)}}</label>
        </span>
        @endforeach
    </div>
    <div class="payment-options" id="payment">
        <!--        <form class="form-horizontal" role="form">
                    <fieldset>
                        <legend>Payment</legend>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-holder-name">Name on Card</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Card Holder's Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Card Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="card-number" id="card-number" placeholder="Debit/Credit Card Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="expiry-month">Expiration Date</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <select class="form-control col-sm-2" name="expiry-month" id="expiry-month">
                                            <option>Month</option>
                                            <option value="01">Jan (01)</option>
                                            <option value="02">Feb (02)</option>
                                            <option value="03">Mar (03)</option>
                                            <option value="04">Apr (04)</option>
                                            <option value="05">May (05)</option>
                                            <option value="06">June (06)</option>
                                            <option value="07">July (07)</option>
                                            <option value="08">Aug (08)</option>
                                            <option value="09">Sep (09)</option>
                                            <option value="10">Oct (10)</option>
                                            <option value="11">Nov (11)</option>
                                            <option value="12">Dec (12)</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <select class="form-control" name="expiry-year">
                                            <option value="13">2013</option>
                                            <option value="14">2014</option>
                                            <option value="15">2015</option>
                                            <option value="16">2016</option>
                                            <option value="17">2017</option>
                                            <option value="18">2018</option>
                                            <option value="19">2019</option>
                                            <option value="20">2020</option>
                                            <option value="21">2021</option>
                                            <option value="22">2022</option>
                                            <option value="23">2023</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="cvv">Card CVV</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="cvv" id="cvv" placeholder="Security Code">
                            </div>
                        </div>
                    </fieldset>
                </form>-->
    </div>
    <span>
        <a href="" class="btn btn-default btn-lg check_out pull-right" id="next">Checkout</a>  
    </span>
</section> <!--/#cart_items-->
@stop