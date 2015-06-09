<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Home | E-Shopper</title>
        <link href="{{asset('front/eshopper/css/etalage.css')}}" rel="stylesheet">
        <link href="{{asset('front/eshopper/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('front/eshopper/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('front/eshopper/css/prettyPhoto.css')}}" rel="stylesheet">
        <link href="{{asset('front/eshopper/css/price-range.css')}}" rel="stylesheet">
        <link href="{{asset('front/eshopper/css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('front/eshopper/css/main.css')}}" rel="stylesheet">
        <link href="{{asset('front/eshopper/css/responsive.css')}}" rel="stylesheet">
        <style>
            ul.dropdown-cart{
                min-width:180px;
            }
            ul.dropdown-cart li .item{
                display:block;
                padding:3px 0px;
                margin: 3px 0;
            }
            ul.dropdown-cart li .item:hover{
                background-color:#f3f3f3;
            }
            ul.dropdown-cart li .item:after{
                visibility: hidden;
                display: block;
                font-size: 0;
                content: " ";
                clear: both;
                height: 0;
            }

            ul.dropdown-cart li .item-left{
                float:left;
            }
            ul.dropdown-cart li .item-left img,
            ul.dropdown-cart li .item-left span.item-info{
                float:left;
            }
            ul.dropdown-cart li .item-left span.item-info{
                margin-left:10px;   
            }
            ul.dropdown-cart li .item-left span.item-info span{
                display:block;
            }
            ul.dropdown-cart li .item-right{
                float:right;
            }
            ul.dropdown-cart li .item-right button{
                margin-top:14px;
            }
        </style>
        @section('css')
        @show
        <!--[if lt IE 9]>
        <script src="{{asset('front/eshopper/js/html5shiv.js')}}"></script>
        <script src="{{asset('front/eshopper/js/respond.min.js')}}"></script>
        <![endif]-->       
        <link rel="shortcut icon" href="{{asset('front/eshopper/images/ico/favicon.ico')}}">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('front/eshopper/images/ico/apple-touch-icon-144-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('front/eshopper/images/ico/apple-touch-icon-114-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('front/eshopper/images/ico/apple-touch-icon-72-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" href="{{asset('front/eshopper/images/ico/apple-touch-icon-57-precomposed.png')}}">
    </head><!--/head-->

    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=1374445972820863";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        @section('header')
        @include('front.eshopper.layouts.header',['mtop'=>$mtop])
        @show
        @section('slider')
        @if(shopOpt('enable_slideshow') == 1)
        @include('front.eshopper.widget.slider',$slideshow)
        @endif
        @show

        <section>
            <div class="container">
                <div class="row">
                    @section('sidebar')
                    @include('front.eshopper.layouts.sidebar',$categories)
                    @show
                    @if(count($errors))
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @yield('main')
                </div>
            </div>
        </section>

        @section('footer')
        @include('front.eshopper.layouts.footer',['mbottom'=>$mbottom])
        @show

        <script src="{{asset('front/eshopper/js/jquery.js')}}"></script>
        <script src="{{asset('front/eshopper/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('front/eshopper/js/jquery.scrollUp.min.js')}}"></script>
        <script src="{{asset('front/eshopper/js/price-range.js')}}"></script>
        <script src="{{asset('front/eshopper/js/jquery.prettyPhoto.js')}}"></script>
        <script src="{{asset('front/eshopper/js/jquery.etalage.min.js')}}"></script>
        <script src="{{asset('front/eshopper/js/main.js')}}"></script>
        <script src="{{asset('front/eshopper/js/simpleCart.js')}}"></script>
        <script>
            var data2 = [
                {view: "image", attr: "thumb", label: false},
                {attr: "productid", label: "ID"},
                /* Name */
                {attr: "name", label: "Product"},
                /* Quantity */
                {attr: "quantity", label: "Qty"},
                /* Price */
                {attr: "price", label: "Price", view: 'currency'},
                {view: function(item, column) {
                        var str = '';
                        var telo = item.get('options');
                        for (var key in telo) {
                            if (key !== 'productid' && key !== 'thumb') {
                                str += key + ' : ' + telo[key] + '<br />';
                            }
                        }
                        return str;

                    }, label: 'Options'},
                /* Remove */
            ];
            var data = [
                {view: "image", attr: "thumb", label: false},
                {attr: "productid", label: "ID"},
                /* Name */
                {attr: "name", label: "Product"},
                /* Quantity */
                {attr: "quantity", label: "Qty"},
                /* Price */
                {attr: "price", label: "Price", view: 'currency'},
                {view: function(item, column) {
                        var str = '';
                        var telo = item.get('options');
                        for (var key in telo) {
                            if (key !== 'productid' && key !== 'thumb') {
                                str += key + ' : ' + telo[key] + '<br />';
                            }
                        }
                        return str;

                    }, label: 'Options'},
                /* Remove */
            ];
            data2.push({view: "remove", text: "Remove", label: false})
            simpleCart({
                cartStyle: "table",
                cartColumns: data2,
                shippingFlatRate: 0,
            });
            simpleCart.currency({
                code: "IDR",
                name: "Rupiah",
                symbol: "Rp. ",
                delimiter: ".",
                after: false,
                accuracy: 0
            });
            var anotherCart = simpleCart.copy("anotherCart");
            anotherCart({
                cartStyle: "table",
                cartColumns: data,
                shippingFlatRate: 0,
            });
            anotherCart.currency({
                code: "IDR",
                name: "Rupiah",
                symbol: "Rp. ",
                delimiter: ".",
                after: false,
                accuracy: 0
            });
            simpleCart.bind('beforeRemove', function(item) {
                anotherCart.find(item.get('id')).remove();
            });

            $('#etalage').etalage({
                thumb_image_width: 300,
                thumb_image_height: 400,
                show_hint: true,
                click_callback: function(image_anchor, instance_id) {
                    alert('Callback example:\nYou clicked on an image with the anchor: "' + image_anchor + '"\n(in Etalage instance: "' + instance_id + '")');
                }
            });
            $("#logout").click(function(e) {
                e.preventDefault();
                simpleCart.empty();
                anotherCart.empty();
                return window.location.replace("{{url('logout')}}");
            });

        </script>
        @section('js')
        @show
    </body>
</html>