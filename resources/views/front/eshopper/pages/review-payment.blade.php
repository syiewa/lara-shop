@extends('front/eshopper/layouts/index')
@section('slider')
@overwrite
@section('sidebar')
@overwrite
@section('js')
<script>
    $(document).ready(function() {
        $("#pay").click(function(e) {
            var url = $(this).attr('href');
            $.post('{{url("checkout/postorder")}}', {'_token': "{{csrf_token()}}"}, function(o) {
                if(o.success){
                    window.location.replace(url);
                }
            });
            e.preventDefault();
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
    <div class="well col-xs-12 col-sm-12 col-md-12">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <h3>Shipping Address</h3>
                <address>
                    <strong>{{$order['user']['first_name'].' '.$order['user']['last_name']}}</strong>
                    <br>
                    {{$order['user']['address']}}
                    <br>
                    {{getCity($order['user']['province'])}}, {{getCity($order['user']['city'])}}
                    <br>
                    <abbr title="Phone">P:</abbr> {{$order['user']['phone']}} / {{$order['user']['mob_phone']}}
                </address>
            </div>
        </div>
        <div class="row">
            <div class="text-center">
                <h1>Receipt</h1>
            </div>
            </span>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>#</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order['product'] as $product)
                    <tr>
                        <td class="col-md-9">
                            <em>{{$product['product_name']}}</em></h4>
                            <p>{{$product['product_options']}}</p>
                        </td>
                        <td class="col-md-1" style="text-align: center"> {{$product['product_qty']}} </td>
                        <td class="col-md-1 text-center">{{$product['product_price']}}</td>
                        <td class="col-md-1 text-center">{{$product['product_tprice']}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td class="text-right">
                            <p>
                                <strong>Subtotal: </strong>
                            </p>
                            <p>
                                <strong>Shipping Fee: </strong>
                            </p></td>
                        <td class="text-center">
                            <p>
                                <strong>{{$order['sub_total']}}</strong>
                            </p>
                            <p>
                                <strong>{{$order['shipping']['fee']}}</strong>
                            </p></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td class="text-right"><h4><strong>Total: </strong></h4></td>
                        <td class="text-center text-danger"><h4><strong>{{$order['total']}}</strong></h4></td>
                    </tr>
                </tbody>
            </table>
            <a href="{{$pay}}" class="btn btn-success btn-lg btn-block" id="pay">
                Pay Now   <span class="glyphicon glyphicon-chevron-right"></span>
            </a></td>
        </div>
    </div>
</section> <!--/#cart_items-->
@stop