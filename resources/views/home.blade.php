@extends('layout.main')

@section('seo')
    <title>{{Setting::get('seo.home_title')}}</title>
    <meta name="keywords" content="{{Setting::get('seo.home_keywords')}}"/>
    <meta name="description" content="{{Setting::get('seo.home_description')}}"/>
@endsection

@section('page')
    <!-- SLIDER -->
    <section class="padding-top-40">
        <div class="container">

            <!-- OWL SLIDER -->
            <div class="owl-carousel buttons-autohide controlls-over nomargin"
                 data-plugin-options='{"items": 1, "autoHeight": false, "navigation": true, "pagination": false, "transitionStyle":"fade", "progressBar":"true"}'>

                @if(isset($slider_home->data))
                    @foreach($slider_home->data as $slide)
                        <a href="{{$slide['link']}}">
                            <img class="img-responsive" src="{{asset('files/sliders/'.$slide['image'])}}"
                                 alt="">
                        </a>
                    @endforeach
                @endif
            </div>
            <!-- /OWL SLIDER -->


            <!-- INFO BAR -->
            <div class="info-bar info-bar-clean info-bar-bordered nomargin-bottom">
                <div class="container">

                    <div class="row">

                        <div class="col-sm-4">
                            <i class="glyphicon glyphicon-globe"></i>
                            <h3>FREE SHIPPING &amp; RETURN</h3>
                            <p>Lorem ipsum dolor sit amet</p>
                        </div>

                        <div class="col-sm-4">
                            <i class="glyphicon glyphicon-usd"></i>
                            <h3>MONEY BACK GUARANTEE</h3>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>

                        <div class="col-sm-4">
                            <i class="glyphicon glyphicon-flag"></i>
                            <h3>ONLINE SUPPORT 24/7</h3>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /INFO BAR -->

        </div>
    </section>
    <!-- /SLIDER -->


    <!-- FEATURED -->
    <section class="nopadding-bottom">
        <div class="container">

            <div class="row">

                <div class="col-sm-9 col-sm-push-3">

                    <h1 class="size-17 margin-bottom-20">FEATURED PRODUCTS</h1>

                    <ul class="shop-item-list products row list-inline nomargin">
                        @include('catalog.products_smarty')
                    </ul>


                </div>

                <div class="col-sm-3 col-sm-pull-9">

                    <!-- CATEGORIES -->
                    <div class="side-nav margin-bottom-60">

                        <div class="side-nav-head">
                            <button class="fa fa-bars"></button>
                            <h4>CATEGORIES</h4>
                        </div>

                        <ul class="list-group list-group-bordered list-group-noicon uppercase">
                            {{--@foreach(\larashop\Classes::all() as $class)--}}
                            {{--<li class="list-group-item">--}}
                            {{--<a href="{{ url('catalog/'.$class->urlhash) }}">--}}
                            {{--{{$class->name}}</a></li>--}}
                            {{--@endforeach--}}
                            @foreach(\larashop\Classes::all() as $class)
                                <li class="list-group-item">
                                    <a class="dropdown-toggle"
                                       href="{{ url('catalog/'.$class->urlhash) }}">{{$class->description->name}}</a>
                                    <ul>
                                        <li><a href="{{ url('catalog/'.$class->urlhash) }}">ALL</a></li>
                                        @foreach(\larashop\Categories::all() as $cat)
                                            @if($cat->class_id == $class->id)
                                                <li>
                                                    <a href="{{ url('catalog/'.$class->urlhash.'/'.$cat->urlhash) }}"><span
                                                                class="size-11 text-muted pull-right">({{$cat->products->count()}}
                                                            )</span>{{$cat->description->name}}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>

                            @endforeach

                        </ul>

                    </div>
                    <!-- /CATEGORIES -->


                    <!-- BANNER ROTATOR -->
                    <div class="owl-carousel buttons-autohide controlls-over margin-bottom-60 text-center"
                         data-plugin-options='{"singleItem": true, "autoPlay": 4000, "navigation": true, "pagination": false, "transitionStyle":"goDown"}'>
                        <a href="#">
                            <img class="img-responsive" src="{{asset('smarty/images/demo/shop/banners/off_1.png')}}"
                                 width="270" height="350" alt="">
                        </a>
                        <a href="#">
                            <img class="img-responsive" src="{{asset('smarty/images/demo/shop/banners/off_2.png')}}"
                                 width="270" height="350" alt="">
                        </a>
                    </div>
                    <!-- /BANNER ROTATOR -->


                    <!-- FREE RETURNS -->
                    <div class="margin-bottom-60">
                        <h4>FREE RETURNS</h4>
                        <p class="nomargin">We stand behind our goods and services and want you to be satisfied with
                            them.</p>
                        <a href="#">Returns Policy &raquo;</a>
                    </div>
                    <!-- /FREE RETURNS -->

                </div>

            </div>

        </div>
    </section>
    <!-- /FEATURED -->


    <!-- NEW PRODUCTS -->
    <section class="nopadding-bottom">
        <div class="container">

            <h2 class="owl-featured noborder"><strong>NEW</strong> PRODUCTS</h2>

            <div class="owl-carousel featured nomargin owl-padding-10"
                 data-plugin-options='{"singleItem": false, "items": "6", "stopOnHover":false, "autoPlay":4000, "autoHeight": false, "navigation": true, "pagination": false}'>

            @foreach($newProds as $newProd)
                <!-- item -->
                    <div class="shop-item">

                        <div class="thumbnail noborder nopadding">
                            <!-- product image(s) -->
                            <a class="shop-item-image" href="{{url('/product/'.$newProd['id'])}}">
                                <img class="img-responsive" src="{{ asset('/files/products/img/'.$newProd->cover) }}"
                                     alt=""/>
                            </a>
                            <!-- /product image(s) -->

                            <!-- hover buttons -->
                            <div class="shop-option-over">
                                <a class="btn btn-default" href="{{url('/product/'.$newProd['id'])}}"><i
                                            class="fa fa-cart-plus size-18"></i></a>
                            </div>
                            <!-- /hover buttons -->

                        </div>

                        <div class="shop-item-summary text-center">
                            <h2 class="size-14">{{$newProd->name}}</h2>

                            <!-- rating -->
                            <div class="shop-item-rating-line">
                                <div class="rating rating-4 size-11"><!-- rating-0 ... rating-5 --></div>
                            </div>
                            <!-- /rating -->

                            <!-- price -->
                            <div class="shop-item-price">
                                @if($newProd->price_old !== null)
                                    <span class="line-through">{{currency($newProd->price_old)}}</span>
                                @endif
                                {{currency($newProd->price)}}
                            </div>
                            <!-- /price -->
                        </div>

                    </div>
                    <!-- /item -->
                @endforeach


            </div>

        </div>
    </section>
    <!-- NEW PRODUCTS -->

@endsection