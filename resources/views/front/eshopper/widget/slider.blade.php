@if(count($slideshow) > 0)
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($slideshow as $key=>$val)
                        <li data-target="#slider-carousel" data-slide-to="{{$key+1}}" class="{{$key == 0 ? 'active' : ''}}"></li>
                        @endforeach
                    </ol>

                    <div class="carousel-inner">
                        @foreach($slideshow as $key =>$ss)
                        <div class="item {{$key == 0 ? 'active' : ''}}">
                            <div class="col-sm-6">
                                <h1>{{$ss->ss_name}}</h1>
<!--                                <h2>Free E-Commerce Template</h2>-->
                                <p>{!!$ss->ss_description!!}</p>
                                <a type="button" class="btn btn-default get" href="{{$ss->ss_url}}">Get it now</a>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{asset('images/slideshow/thumb/'.$ss->ss_image)}}" class="girl img-responsive" alt="" />
<!--                                <img src="{{asset('front/eshopper/images/home/pricing.png')}}"  class="pricing" alt="" />-->
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->
@endif