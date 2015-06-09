<footer id="footer"><!--Footer-->
<!--    <div class="footer-top">
        <div class="container">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="companyinfo">
                                    <h2>{{genOpt('store_name')}}</h2>
                                    <p>{{genOpt('store_address')}}</p>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="col-sm-3">
                                    <div class="video-gallery text-center">
                                                                    <a href="#">
                                                                        <div class="iframe-img">
                                                                            <img src="{{asset('front/eshopper/images/home/iframe1.png')}}" alt="" />
                                                                        </div>
                                                                        <div class="overlay-icon">
                                                                            <i class="fa fa-play-circle-o"></i>
                                                                        </div>
                                                                    </a>
                                                                    <p>Circle of Hands</p>
                                                                    <h2>24 DEC 2014</h2>
                                    </div>
                                </div>
            
                                <div class="col-sm-3">
                                    <div class="video-gallery text-center">
                                                                    <a href="#">
                                                                        <div class="iframe-img">
                                                                            <img src="{{asset('front/eshopper/images/home/iframe2.png')}}" alt="" />
                                                                        </div>
                                                                        <div class="overlay-icon">
                                                                            <i class="fa fa-play-circle-o"></i>
                                                                        </div>
                                                                    </a>
                                                                    <p>Circle of Hands</p>
                                                                    <h2>24 DEC 2014</h2>
                                    </div>
                                </div>
            
                                <div class="col-sm-3">
                                    <div class="video-gallery text-center">
                                                                    <a href="#">
                                                                        <div class="iframe-img">
                                                                            <img src="{{asset('front/eshopper/images/home/iframe3.png')}}" alt="" />
                                                                        </div>
                                                                        <div class="overlay-icon">
                                                                            <i class="fa fa-play-circle-o"></i>
                                                                        </div>
                                                                    </a>
                                                                    <p>Circle of Hands</p>
                                                                    <h2>24 DEC 2014</h2>
                                    </div>
                                </div>
            
                                <div class="col-sm-3">
                                    <div class="video-gallery text-center">
                                                                    <a href="#">
                                                                        <div class="iframe-img">
                                                                            <img src="{{asset('front/eshopper/images/home/iframe4.png')}}" alt="" />
                                                                        </div>
                                                                        <div class="overlay-icon">
                                                                            <i class="fa fa-play-circle-o"></i>
                                                                        </div>
                                                                    </a>
                                                                    <p>Circle of Hands</p>
                                                                    <h2>24 DEC 2014</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="address">
                                    <img src="{{asset('front/eshopper/images/home/map.png')}}" alt="" />
                                    <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                                </div>
                            </div>
                        </div>
        </div>
    </div>-->

    <div class="footer-widget">
        <div class="container">
            <div class="row">
                @foreach($mbottom as $mb)
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2><a href="{{$mb['page_type'] == 'link'? $mb['page_slug'] : url($mb['page_slug'])}}">{{$mb['page_name']}}</a></h2>
                        @if(count($mb['children'])>0)
                        <ul class="nav nav-pills nav-stacked">
                            @foreach($mb['children'] as $child)
                            <li><a href="{{$child['page_type'] == 'link'? $child['page_slug'] : url($child['page_slug'])}}">{{$child['page_name']}}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
                @endforeach
                <div class="col-sm-3">
                    <div class="single-widget">
                        <h2>Address</h2>
                        <p>{{genOpt('store_name')}}</p>
                        <p>{{genOpt('store_address')}}</p>
                    </div>
                </div>
<!--                <div class="col-sm-3 pull-right">
                    <div class="single-widget">
                        <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/Syiewa" data-widget-id="607727090562048000"  width="300"
                           height="300">Tweets by @Syiewa</a>
                        <script>!function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                                if (!d.getElementById(id)) {
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = p + "://platform.twitter.com/widgets.js";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }
                            }(document, "script", "twitter-wjs");</script>


                    </div>
                </div>-->
                <div class="col-sm-3 pull-right">
                    <div class="single-widget">
                        <div class="fb-page" data-href="{{socialUrl('facebook')}}" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"   width="300"
                             height="250" data-chrome="transparent nofooter">
                            <div class="fb-xfbml-parse-ignore">
                                <blockquote cite="{{socialUrl('facebook')}}">
                                    <a href="{{socialUrl('facebook')}}">Instagram</a>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                <div class="col-sm-3 col-sm-offset-1">
                                    <div class="single-widget">
                                                                <h2>Facebook</h2>
                                                                <form action="#" class="searchform">
                                                                    <input type="text" placeholder="Your email address" />
                                                                    <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                                                    <p>Get the most recent updates from <br />our site and be updated your self...</p>
                                                                </form>
                                    </div>
                                </div>-->

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2013 {{genOpt('store_name')}} All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->