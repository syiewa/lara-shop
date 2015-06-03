<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach($categories as $cat)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        @if(count($cat['children']) > 0)
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$cat['slug']}}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{$cat['name']}} 
                            @if(shopOpt('category_product_count') == 1)
                            <span class="label label-success pull-right">{{count($cat['children'])}}</span>
                            @endif
                        </a>
                        @else
                        <h4 class="panel-title"><a href="{{url('product/'.$cat['slug'])}}">{{$cat['name']}}</a></h4>
                        @endif
                    </h4>
                </div>
                @if(count($cat['children']) > 0)
                <div id="{{$cat['slug']}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach($cat['children'] as $child)
                            <li><a href="{{url('product/'.$child['slug'])}}">{{$child['name']}} </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div><!--/category-products-->

<!--        <div class="brands_products">brands_products
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                    <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                    <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                    <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                    <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                    <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                    <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                </ul>
            </div>
        </div>/brands_products

        <div class="price-range">price-range
            <h2>Price Range</h2>
            <div class="well text-center">
                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div>/price-range

        <div class="shipping text-center">shipping
            <img src="{{asset('front/eshopper/images/home/shipping.jpg')}}" alt="" />
        </div>/shipping-->

    </div>
</div>