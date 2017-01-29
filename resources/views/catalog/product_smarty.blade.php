@extends('layout.main')

@section('seo')
    <title>{{$currentProd->description->title}}</title>
    <meta name="keywords" content="{{$currentProd->description->keywords}}"/>
    <meta name="description" content="{{$currentProd->description->description}}"/>
@endsection

@section('page')
    <section class="page-header page-header-xs">
        <div class="container">

            <h1>{{mb_strtoupper($currentProd->description->name)}}</h1>

            <!-- breadcrumbs -->
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('/catalog')}}">Catalog</a></li>
                <li><a href="{{url('/catalog/'.$currentClass['urlhash'])}}">{{$currentClass->description->name}}</a>
                </li>
                <li>
                    <a href="{{url('/catalog/'.$currentClass['urlhash'].'/'.$currentCat['urlhash'])}}">{{$currentCat->description->name}}</a>
                </li>
                <li class="active">{{$currentProd->description->name}}</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->
    <div style="max-width: 728px;height: 90px;line-height: 90px;text-align: center;border: 1px groove; margin: auto;margin-bottom: -70px; margin-top: 10px;">
        <h2>место для рекламы</h2>
    </div>

    <!-- -->
    <section>
        <div class="container">

            <div class="row">

                <!-- RIGHT -->
                <div class="col-lg-9 col-md-9 col-sm-9 col-lg-push-3 col-md-push-3 col-sm-push-3">

                    <div class="row">

                        <!-- IMAGE -->
                        <div class="col-lg-6 col-sm-6">

                            <div class="thumbnail relative margin-bottom-3">

                                <!--
                                    IMAGE ZOOM

                                    data-mode="mouseover|grab|click|toggle"
                                -->
                                <figure id="zoom-primary" class="zoom" data-mode="mouseover">
                                    <!--
                                        zoom buttton

                                        positions available:
                                            .bottom-right
                                            .bottom-left
                                            .top-right
                                            .top-left
                                    -->
                                    <a class="lightbox bottom-right"
                                       href="{{ asset('/files/products/img/'.$currentProd->cover) }}"
                                       data-plugin-options='{"type":"image"}'><i class="glyphicon glyphicon-search"></i></a>

                                    <!--
                                        image

                                        Extra: add .image-bw class to force black and white!
                                    -->
                                    <img class="img-responsive"
                                         src="{{ asset('/files/products/img/'.$currentProd->cover) }}" width="1200"
                                         height="1500" alt="This is the product title"/>
                                </figure>

                            </div>

                            <!-- Thumbnails (required height:100px) -->
                        {{--<div data-for="zoom-primary" class="zoom-more owl-carousel owl-padding-3 featured" data-plugin-options='{"singleItem": false, "autoPlay": false, "navigation": true, "pagination": false}'>--}}
                        {{--<a class="thumbnail active" href="assets/images/demo/shop/products/1000x1500/p5.jpg">--}}
                        {{--<img src="assets/images/demo/shop/products/100x100/p5.jpg" height="100" alt="" />--}}
                        {{--</a>--}}
                        {{--<a class="thumbnail" href="assets/images/demo/shop/products/1000x1500/p6.jpg">--}}
                        {{--<img src="assets/images/demo/shop/products/100x100/p6.jpg" height="100" alt="" />--}}
                        {{--</a>--}}
                        {{--<a class="thumbnail" href="assets/images/demo/shop/products/1000x1500/p7.jpg">--}}
                        {{--<img src="assets/images/demo/shop/products/100x100/p7.jpg" height="100" alt="" />--}}
                        {{--</a>--}}
                        {{--<a class="thumbnail" href="assets/images/demo/shop/products/1000x1500/p8.jpg">--}}
                        {{--<img src="assets/images/demo/shop/products/100x100/p8.jpg" height="100" alt="" />--}}
                        {{--</a>--}}
                        {{--<a class="thumbnail" href="assets/images/demo/shop/products/1000x1500/p9.jpg">--}}
                        {{--<img src="assets/images/demo/shop/products/100x100/p9.jpg" height="100" alt="" />--}}
                        {{--</a>--}}
                        {{--<a class="thumbnail" href="assets/images/demo/shop/products/1000x1500/p10.jpg">--}}
                        {{--<img src="assets/images/demo/shop/products/100x100/p10.jpg" height="100" alt="" />--}}
                        {{--</a>--}}
                        {{--<a class="thumbnail" href="assets/images/demo/shop/products/1000x1500/p11.jpg">--}}
                        {{--<img src="assets/images/demo/shop/products/100x100/p11.jpg" height="100" alt="" />--}}
                        {{--</a>--}}
                        {{--</div>--}}
                        <!-- /Thumbnails -->

                        </div>
                        <!-- /IMAGE -->

                        <!-- ITEM DESC -->
                        <div class="col-lg-6 col-sm-6">

                            <!-- buttons -->
                            <div class="pull-right">
                                <!-- replace data-item-id width the real item ID - used by js/view/demo.shop.js -->
                                <a class="btn btn-default add-wishlist" href="#" data-added="{{$favourite}}"
                                   data-id="{{$currentProd->id}}" {{--data-toggle="tooltip"--}}
                                   @if($favourite)
                                   title="Remove from Wishlist"
                                   @else
                                   title="Add To Wishlist"
                                        @endif
                                ><i
                                            @if($favourite)
                                            style="color: darkred"
                                            @endif
                                            class="fa fa-heart nopadding"></i></a>
                                {{--<a class="btn btn-default add-compare" href="#" data-item-id="1" data-toggle="tooltip"--}}
                                {{--title="Add To Compare"><i class="fa fa-bar-chart-o nopadding" data-toggle="tooltip"></i></a>--}}
                            </div>
                            <!-- /buttons -->

                            <!-- price -->
                            <div class="shop-item-price">
                                @if($currentProd->price_old != null)
                                    <span class="line-through nopadding-left">{{currency($currentProd->price_old)}}</span>
                                @endif
                                {{currency($currentProd->price)}}
                            </div>
                            <!-- /price -->
                            <hr/>
                            <div class="clearfix margin-bottom-30">
                                @if($currentProd->isset)
                                    <span class="pull-right text-success"><i class="fa fa-check"></i> In Stock</span>
                                @else
                                    <span class="pull-right text-danger"><i class="fa fa-times"></i> Out Stock</span>
                                @endif
                            <!--
                                    <span class="pull-right text-danger"><i class="glyphicon glyphicon-remove"></i> Out of Stock</span>
                                    -->

                                {{--<strong>SKU:</strong> UY7321987--}}
                            </div>


                            <!-- short description -->

                            <p>{{$currentProd->description->description}}</p>

                            <!-- /short description -->


                            <!-- countdown -->
                        {{--<div class="text-center">--}}
                        {{--<h5>Limited Offer</h5>--}}
                        {{--<div class="countdown" data-from="January 31, 2018 15:03:26" data-labels="years,months,weeks,days,hour,min,sec"><!-- Example Date From: December 31, 2018 15:03:26 --></div>--}}
                        {{--</div>--}}
                        <!-- /countdown -->


                            <hr/>

                            <!-- FORM -->
                            <form class="clearfix form-inline nomargin" method="get" action="">
                                {{--<input type="hidden" name="product_id" value="1"/>--}}

                                {{--<!-- see assets/js/view/demo.shop.js -->--}}
                                {{--<input type="hidden" id="color" name="color" value="yellow"/>--}}
                                {{--<input type="hidden" id="qty" name="qty" value="1"/>--}}
                                {{--<input type="hidden" id="size" name="size" value="5"/>--}}
                                {{--<!-- see assets/js/view/demo.shop.js -->--}}

                                {{--<div class="btn-group pull-left product-opt-color">--}}
                                {{--<button type="button" class="btn btn-default dropdown-toggle product-color-dd noradius"--}}
                                {{--data-toggle="dropdown">&nbsp;--}}
                                {{--<span class="caret"></span>--}}
                                {{--<span id="product-selected-color" class="tag shop-color"--}}
                                {{--style="background-color:#F0E68C"></span>--}}
                                {{--</button>--}}

                                {{--<!----}}
                                {{--href = required to be hex color starting with: #--}}
                                {{--data-val = color name or color id from the database--}}
                                {{---->--}}
                                {{--<ul id="product-color-dd" class="dropdown-menu clearfix" role="menu">--}}
                                {{--<li class="active"><a class="tag shop-color" data-val="purple" href="#800080"--}}
                                {{--style="background-color:#800080"></a></li>--}}
                                {{--<li><a class="tag shop-color" data-val="red" href="#FF0000"--}}
                                {{--style="background-color:#FF0000"></a></li>--}}
                                {{--<li><a class="tag shop-color" data-val="pink" href="#FF0080"--}}
                                {{--style="background-color:#FF0080"></a></li>--}}
                                {{--<li><a class="tag shop-color" data-val="orange" href="#FF6600"--}}
                                {{--style="background-color:#FF6600"></a></li>--}}
                                {{--<li><a class="tag shop-color" data-val="grey" href="#E0DCC8"--}}
                                {{--style="background-color:#E0DCC8"></a></li>--}}
                                {{--<li><a class="tag shop-color" data-val="yellow" href="#F0E68C"--}}
                                {{--style="background-color:#F0E68C"></a></li>--}}
                                {{--<li><a class="tag shop-color" data-val="light-yellow" href="#FFFFD0"--}}
                                {{--style="background-color:#FFFFD0"></a></li>--}}
                                {{--<li><a class="tag shop-color" style="background-color:#4B0082"></a></li>--}}
                                {{--<li><a class="tag shop-color" data-val="dark-grey" href="#666666"--}}
                                {{--style="background-color:#666666"></a></li>--}}
                                {{--<li><a class="tag shop-color" data-val="green" href="#00FF00"--}}
                                {{--style="background-color:#00FF00"></a></li>--}}
                                {{--</ul>--}}
                                {{--</div><!-- /btn-group -->--}}

                                {{--<div class="btn-group pull-left product-opt-size">--}}
                                {{--<button type="button" class="btn btn-default dropdown-toggle product-size-dd noradius"--}}
                                {{--data-toggle="dropdown">--}}
                                {{--<span class="caret"></span>--}}
                                {{--Size--}}
                                {{--<small id="product-selected-size">(<span>5</span>)</small>--}}
                                {{--</button>--}}

                                {{--<!-- data-val = size value or size id -->--}}
                                {{--<ul id="product-size-dd" class="dropdown-menu" role="menu">--}}
                                {{--<li class="active"><a data-val="5" href="#">5</a></li>--}}
                                {{--<li><a data-val="5.5" href="#">5.5</a></li>--}}
                                {{--<li><a data-val="6" href="#">6</a></li>--}}
                                {{--<li><a data-val="6.5" href="#">6.5</a></li>--}}
                                {{--<li><a data-val="7" href="#">7</a></li>--}}
                                {{--<li><a data-val="7.5" href="#">7.7</a></li>--}}
                                {{--<li><a data-val="8" href="#">8</a></li>--}}
                                {{--<li><a data-val="8.5" href="#">8.5</a></li>--}}
                                {{--<li><a data-val="9" href="#">9</a></li>--}}
                                {{--<li><a data-val="9.5" href="#">9.5</a></li>--}}
                                {{--<li><a data-val="10" href="#">10</a></li>--}}
                                {{--<li><a data-val="10.5" href="#">10.5</a></li>--}}
                                {{--<li><a data-val="11" href="#">11</a></li>--}}
                                {{--<li><a data-val="11.5" href="#">11.5</a></li>--}}
                                {{--<li><a data-val="12" href="#">12</a></li>--}}
                                {{--<li><a data-val="13" href="#">13</a></li>--}}
                                {{--<li><a data-val="14" href="#">14</a></li>--}}
                                {{--</ul>--}}
                                {{--</div><!-- /btn-group -->--}}

                                {{--<div class="btn-group pull-left product-opt-qty">--}}
                                {{--<button type="button" class="btn btn-default dropdown-toggle product-qty-dd noradius"--}}
                                {{--data-toggle="dropdown">--}}
                                {{--<span class="caret"></span>--}}
                                {{--Qty--}}
                                {{--<small id="product-selected-qty">(<span>5</span>)</small>--}}
                                {{--</button>--}}

                                {{--<ul id="product-qty-dd" class="dropdown-menu clearfix" role="menu">--}}
                                {{--<li class="active"><a data-val="1" href="#">1</a></li>--}}
                                {{--<li><a data-val="2" href="#">2</a></li>--}}
                                {{--<li><a data-val="3" href="#">3</a></li>--}}
                                {{--<li><a data-val="4" href="#">4</a></li>--}}
                                {{--<li><a data-val="5" href="#">5</a></li>--}}
                                {{--<li><a data-val="6" href="#">6</a></li>--}}
                                {{--<li><a data-val="7" href="#">7</a></li>--}}
                                {{--<li><a data-val="8" href="#">8</a></li>--}}
                                {{--<li><a data-val="9" href="#">9</a></li>--}}
                                {{--<li><a data-val="10" href="#">10</a></li>--}}
                                {{--</ul>--}}
                                {{--</div><!-- /btn-group -->--}}

                                @foreach($opt_groups as $group)
                                    <div data-group="{{$group->id}}" class="text-center margin-bottom-20 option-id">
                                        <b>{{$group->name}}</b>
                                        <select style="width: 100%;" class="form-control option-id">
                                            @foreach($group->options as $option)
                                                <option value="{{$option->id}}/{{currencyWithoutPrefix($option->price)}}/{{$option->value}}">{{$option->value}}
                                                    (+ {{currency($option->price)}})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                            @endforeach

                            <!--
                                    .fancy-arrow
                                    .fancy-arrow-double
                                -->
                                <div class="products">
                                    <button id="{{$currentProd['id']}}" data-id="{{$currentProd['id']}}"
                                            data-title="{{$currentProd->description->name}}"
                                            data-img="{{ asset('/files/products/img/'.$currentProd['cover']) }}"
                                            data-price="{{currencyWithoutPrefix($currentProd['price'])}}"
                                            data-currency="{{currencyPrefix()}}"
                                            class="btn btn-default btn-lg btn-block btn-success buy-btn">ADD TO CART
                                    </button>
                                </div>

                            </form>
                            <!-- /FORM -->


                            <hr/>

                        {{--<small class="text-muted">--}}
                        {{--Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla,--}}
                        {{--commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque. Ut enim--}}
                        {{--massa, sodales tempor convallis et.--}}
                        {{--</small>--}}

                        {{--<hr/>--}}

                        <!-- Share -->
                            <div class="pull-right">

                                <a href="#"
                                   class="social-icon social-icon-sm social-icon-transparent social-facebook pull-left"
                                   data-toggle="tooltip" data-placement="top" title="Facebook">
                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>

                                <a href="#"
                                   class="social-icon social-icon-sm social-icon-transparent social-twitter pull-left"
                                   data-toggle="tooltip" data-placement="top" title="Twitter">
                                    <i class="icon-twitter"></i>
                                    <i class="icon-twitter"></i>
                                </a>

                                <a href="#"
                                   class="social-icon social-icon-sm social-icon-transparent social-gplus pull-left"
                                   data-toggle="tooltip" data-placement="top" title="Google plus">
                                    <i class="icon-gplus"></i>
                                    <i class="icon-gplus"></i>
                                </a>

                                <a href="#"
                                   class="social-icon social-icon-sm social-icon-transparent social-linkedin pull-left"
                                   data-toggle="tooltip" data-placement="top" title="Linkedin">
                                    <i class="icon-linkedin"></i>
                                    <i class="icon-linkedin"></i>
                                </a>

                            </div>
                            <!-- /Share -->


                            <!-- rating -->
                        {{--<div class="rating rating-4 size-13 margin-top-10 width-100">--}}
                        {{--<!-- rating-0 ... rating-5 --></div>--}}
                        <!-- /rating -->

                        </div>
                        <!-- /ITEM DESC -->

                    </div>


                    <ul id="myTab" class="nav nav-tabs nav-top-border margin-top-80" role="tablist">
                        <li role="presentation" class="active"><a href="#description" role="tab" data-toggle="tab">Description</a>
                        </li>
                        <li role="presentation"><a href="#specs" role="tab" data-toggle="tab">Specifications</a></li>
                        {{--<li role="presentation"><a href="#reviews" role="tab" data-toggle="tab">Reviews (2)</a></li>--}}
                    </ul>

                    <div class="tab-content padding-top-20">
                        <!-- DESCRIPTION -->
                        <div role="tabpanel" class="tab-pane fade in active" id="description">
                            {{$currentProd->description->description_full}}
                        </div>

                        <!-- SPECIFICATIONS -->
                        <div role="tabpanel" class="tab-pane fade" id="specs">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Характеристика</th>
                                        <th>Значение</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($attr as $item)
                                        <tr>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->value.' '.$item->unit}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- REVIEWS -->
                        {{--<div role="tabpanel" class="tab-pane fade" id="reviews">--}}
                        {{--<!-- REVIEW ITEM -->--}}
                        {{--<div class="block margin-bottom-60">--}}

                        {{--<span class="user-avatar"><!-- user-avatar -->--}}
                        {{--<img class="pull-left media-object" src="assets/images/avatar2.jpg" width="64" height="64" alt="">--}}
                        {{--</span>--}}

                        {{--<div class="media-body">--}}
                        {{--<h4 class="media-heading size-14">--}}
                        {{--John Doe &ndash;--}}
                        {{--<span class="text-muted">June 29, 2014 - 11:23</span> &ndash;--}}
                        {{--<span class="size-14 text-muted"><!-- stars -->--}}
                        {{--<i class="fa fa-star"></i>--}}
                        {{--<i class="fa fa-star"></i>--}}
                        {{--<i class="fa fa-star"></i>--}}
                        {{--<i class="fa fa-star"></i>--}}
                        {{--<i class="fa fa-star-o"></i>--}}
                        {{--</span>--}}
                        {{--</h4>--}}

                        {{--<p>--}}
                        {{--Proin eget tortor risus. Cras ultricies ligula sed magna dictum porta. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque.--}}
                        {{--</p>--}}

                        {{--</div>--}}

                        {{--</div>--}}
                        {{--<!-- /REVIEW ITEM -->--}}

                        {{--<!-- REVIEW ITEM -->--}}
                        {{--<div class="block margin-bottom-60">--}}

                        {{--<span class="user-avatar"><!-- user-avatar -->--}}
                        {{--<img class="pull-left media-object" src="assets/images/avatar2.jpg" width="64" height="64" alt="">--}}
                        {{--</span>--}}

                        {{--<div class="media-body">--}}
                        {{--<h4 class="media-heading size-14">--}}
                        {{--John Doe &ndash;--}}
                        {{--<span class="text-muted">June 29, 2014 - 11:23</span> &ndash;--}}
                        {{--<span class="size-14 text-muted"><!-- stars -->--}}
                        {{--<i class="fa fa-star"></i>--}}
                        {{--<i class="fa fa-star"></i>--}}
                        {{--<i class="fa fa-star"></i>--}}
                        {{--<i class="fa fa-star-o"></i>--}}
                        {{--<i class="fa fa-star-o"></i>--}}
                        {{--</span>--}}
                        {{--</h4>--}}

                        {{--<p>--}}
                        {{--Proin eget tortor risus. Cras ultricies ligula sed magna dictum porta. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque.--}}
                        {{--</p>--}}

                        {{--</div>--}}

                        {{--</div>--}}
                        {{--<!-- /REVIEW ITEM -->--}}


                        {{--<!-- REVIEW FORM -->--}}
                        {{--<h4 class="page-header margin-bottom-40">ADD A REVIEW</h4>--}}
                        {{--<form method="post" action="#" id="form">--}}

                        {{--<div class="row margin-bottom-10">--}}

                        {{--<div class="col-md-6 margin-bottom-10">--}}
                        {{--<!-- Name -->--}}
                        {{--<input type="text" name="name" id="name" class="form-control" placeholder="Name *" maxlength="100" required="">--}}
                        {{--</div>--}}

                        {{--<div class="col-md-6">--}}
                        {{--<!-- Email -->--}}
                        {{--<input type="email" name="email" id="email" class="form-control" placeholder="Email *" maxlength="100" required="">--}}
                        {{--</div>--}}

                        {{--</div>--}}

                        {{--<!-- Comment -->--}}
                        {{--<div class="margin-bottom-30">--}}
                        {{--<textarea name="text" id="text" class="form-control" rows="6" placeholder="Comment" maxlength="1000"></textarea>--}}
                        {{--</div>--}}

                        {{--<!-- Stars -->--}}
                        {{--<div class="product-star-vote clearfix">--}}

                        {{--<label class="radio pull-left">--}}
                        {{--<input type="radio" name="product-review-vote" value="1" />--}}
                        {{--<i></i> 1 Star--}}
                        {{--</label>--}}

                        {{--<label class="radio pull-left">--}}
                        {{--<input type="radio" name="product-review-vote" value="2" />--}}
                        {{--<i></i> 2 Stars--}}
                        {{--</label>--}}

                        {{--<label class="radio pull-left">--}}
                        {{--<input type="radio" name="product-review-vote" value="3" />--}}
                        {{--<i></i> 3 Stars--}}
                        {{--</label>--}}

                        {{--<label class="radio pull-left">--}}
                        {{--<input type="radio" name="product-review-vote" value="4" />--}}
                        {{--<i></i> 4 Stars--}}
                        {{--</label>--}}

                        {{--<label class="radio pull-left">--}}
                        {{--<input type="radio" name="product-review-vote" value="5" />--}}
                        {{--<i></i> 5 Stars--}}
                        {{--</label>--}}

                        {{--</div>--}}

                        {{--<!-- Send Button -->--}}
                        {{--<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Send Review</button>--}}

                        {{--</form>--}}
                        {{--<!-- /REVIEW FORM -->--}}

                        {{--</div>--}}
                    </div>

                    @if(isset($relatedProducts[0]))

                        <hr class="margin-top-80 margin-bottom-80"/>


                        <h2 class="owl-featured"><strong>Related</strong> products:</h2>
                        <div class="owl-carousel featured nomargin owl-padding-10"
                             data-plugin-options='{"singleItem": false, "items": "4", "stopOnHover":false, "autoPlay":4500, "autoHeight": false, "navigation": true, "pagination": false}'>


                        @foreach($relatedProducts as $prod)
                            <!-- item -->
                                <div class="shop-item nomargin">

                                    <div class="thumbnail">
                                        <!-- product image(s) -->
                                        <a class="shop-item-image" href="{{url('product/'.$prod->id)}}">
                                            <img class="img-responsive"
                                                 src="{{ asset('/files/products/img/'.$prod->cover) }}"
                                                 alt="shop first image"/>
                                            {{--<img class="img-responsive"--}}
                                            {{--src="{{asset('smarty/images/demo/shop/products/300x450/p14.jpg')}}"--}}
                                            {{--alt="shop hover image"/>--}}
                                        </a>
                                        <!-- /product image(s) -->

                                        <!-- product more info -->
                                        <div class="shop-item-info">
                                            {{--<span class="label label-success">NEW</span>--}}
                                            @if($prod->price_old != '')
                                                <span class="label label-danger">SALE</span>
                                            @endif
                                        </div>
                                        <!-- /product more info -->
                                    </div>

                                    <div class="shop-item-summary text-center">
                                        <h2>{{$prod->description->name}}</h2>

                                        <!-- rating -->
                                    {{--<div class="shop-item-rating-line">--}}
                                    {{--<div class="rating rating-4 size-13"><!-- rating-0 ... rating-5 --></div>--}}
                                    {{--</div>--}}
                                    <!-- /rating -->

                                        <!-- price -->
                                        <div class="shop-item-price">
                                            @if($prod->price_old != '')
                                                <span class="line-through">{{currency($prod->price_old)}}</span>
                                            @endif
                                            {{currency($prod->price)}}
                                        </div>
                                        <!-- /price -->
                                    </div>

                                    <!-- buttons -->
                                    {{--<div class="shop-item-buttons text-center products">--}}
                                    {{--<a class="btn btn-default buy-btn"--}}
                                    {{--id="{{$prod->id}}"--}}
                                    {{--data-id="{{$prod->id}}"--}}
                                    {{--data-title="{{$prod->name}}"--}}
                                    {{--data-img="{{ asset('/files/products/img/'.$prod->cover) }}"--}}
                                    {{--data-price="{{currencyWithoutPrefix($prod->price)}}"--}}
                                    {{--data-currency="{{currencyPrefix()}}" href="#"><i class="fa fa-cart-plus"></i>--}}
                                    {{--Add--}}
                                    {{--to--}}
                                    {{--Cart</a>--}}
                                    {{--</div>--}}
                                    <div class="text-center">
                                        <a class="btn btn-default" href='{{url('product/'.$prod->id)}}'><i
                                                    class="fa fa-cart-plus"></i>BUY</a>
                                    </div>
                                    <!-- /buttons -->
                                </div>
                                <!-- /item -->
                            @endforeach


                        </div>
                    @endif

                </div>


                <!-- LEFT -->
                <div class="col-lg-3 col-md-3 col-sm-3 col-lg-pull-9 col-md-pull-9 col-sm-pull-9">

                    <!-- CATEGORIES -->
                    <div class="side-nav margin-bottom-60">

                        <div class="side-nav-head">
                            <button class="fa fa-bars"></button>
                            <h4>CATEGORIES</h4>
                        </div>

                        <ul class="list-group list-group-bordered list-group-noicon uppercase">
                            {{--<li class="list-group-item active">--}}
                            {{--<a class="dropdown-toggle" href="#">WOMEN</a>--}}
                            {{--<ul>--}}
                            {{--<li><a href="#"><span class="size-11 text-muted pull-right">(123)</span> Shoes &amp; Boots</a></li>--}}
                            {{--<li class="active"><a href="#"><span class="size-11 text-muted pull-right">(331)</span> Top &amp; Blouses</a></li>--}}
                            {{--<li><a href="#"><span class="size-11 text-muted pull-right">(234)</span> Dresses &amp; Skirts</a></li>--}}
                            {{--</ul>--}}
                            {{--</li>--}}
                            @foreach(\larashop\Classes::all() as $class)
                                <li class="list-group-item @if($class->description->name == $currentClass->description->name)active @endif">
                                    <a class="dropdown-toggle"
                                       href="{{ url('catalog/'.$class->urlhash) }}">{{$class->description->name}}</a>
                                    <ul>
                                        <li><a href="{{ url('catalog/'.$class->urlhash) }}">ALL</a></li>
                                        @foreach(\larashop\Categories::all() as $cat)
                                            @if($cat->class_id == $class->id)
                                                <li class="@if($cat->description->name == $currentCat->description->name)active @endif">
                                                    <a
                                                            href="{{ url('catalog/'.$class->urlhash.'/'.$cat->urlhash) }}"><span
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
                        @if(isset($sliders['left_column_banner']))
                            @foreach($sliders['left_column_banner']->data as $slide)
                                <a href="{{$slide['link']}}">
                                    <img class="img-responsive" src="{{asset('files/sliders/'.$slide['image'])}}"
                                         width="270" height="350" alt="">
                                </a>
                            @endforeach
                        @endif
                    </div>
                    <!-- /BANNER ROTATOR -->


                    <!-- FEATURED -->
                {{--<div class="margin-bottom-60">--}}

                {{--<h2 class="owl-featured">FEATURED</h2>--}}
                {{--<div class="owl-carousel featured"--}}
                {{--data-plugin-options='{"singleItem": true, "stopOnHover":false, "autoPlay":false, "autoHeight": false, "navigation": false, "pagination": false}'>--}}

                {{--<div><!-- SLIDE 1 -->--}}
                {{--<ul class="list-unstyled nomargin nopadding text-left">--}}
                {{--@foreach ($topProds as $prod)--}}
                {{--<li class="clearfix"><!-- item -->--}}
                {{--<div class="thumbnail featured clearfix pull-left">--}}
                {{--<a href="{{ URL::to('/'.$prod['link']) }}.html">--}}
                {{--<img src="{{ asset('files/products/img/small/'.$prod['cover']) }}"--}}
                {{--width="80"--}}
                {{--height="80" alt="featured item">--}}
                {{--</a>--}}
                {{--</div>--}}

                {{--<a class="block size-12"--}}
                {{--href="{{ URL::to('/'.$prod['link']) }}.html">{{$prod['name']}}</a>--}}
                {{--<div class="rating rating-4 size-13 width-100 text-left">--}}
                {{--<!-- rating-0 ... rating-5 --></div>--}}
                {{--<div class="size-18 text-left">{{$prod['price']}}</div>--}}
                {{--</li><!-- /item -->--}}
                {{--@endforeach--}}
                {{--</ul>--}}
                {{--</div><!-- /SLIDE 1 -->--}}

                {{--</div>--}}
                <!-- /FEATURED -->


                    <!-- HTML BLOCK -->
                    <div class="margin-bottom-60">
                        <h4>HTML BLOCK</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras non placerat mi. Etiam non
                            tellus
                            eunit.</p>

                        <form action="#" role="form" method="post">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" id="email" name="email" class="form-control required"
                                       placeholder="Enter your Email">
                                <span class="input-group-btn">
											<button class="btn btn-success" type="submit"><i
                                                        class="glyphicon glyphicon-send"></i></button>
										</span>
                            </div>
                        </form>

                    </div>
                    <!-- /HTML BLOCK -->

                </div>

            </div>
        </div>

        </div>
    </section>
    <!-- / -->
@endsection

@section('scripts')
    f
    <script>
        $('.add-wishlist').on('click', function () {
            var product_id = $(this).data('id');
            if ($(this).data('added') == 0) {
                $.get('{{url('/profile/favourites/add')}}/' + product_id, function (response) {
                    if (response) {
                        $('.add-wishlist').children('.fa').css('color', 'darkred');
                        $('.add-wishlist').data('added', 1);
                        $('.add-wishlist').attr('title','Remove from Wishlist');
//                        $('.add-wishlist').data('originalTitle','Remove from Wishlist');
                        _toastr('Добавлено в избранное!', "bottom-right", "success", false);
                        return false;
                    }
                    else {
                        _toastr('Сначала нужно зарегистрироваться!', "bottom-right", "danger", false);
                        return false;
                    }
                })
            }
            else {
                $.get('{{url('/profile/favourites/delete')}}/' + product_id, function (response) {
                    if (response) {
                        $('.add-wishlist').children('.fa').css('color', 'black');
                        $('.add-wishlist').data('added', 0);
                        $('.add-wishlist').attr('title','Add to Wishlist');
//                        $('.add-wishlist').data('originalTitle','Add to Wishlist');
                        _toastr('Удаленно из избранного!', "bottom-right", "success", false);
                        return false;
                    }
                    else {
                        _toastr('Сначала нужно зарегистрироваться!', "bottom-right", "danger", false);
                        return false;
                    }
                })
            }
            return false;
        })
    </script>

@endsection
