@extends('layout.main')

@section('seo')
    <title>{{$currentProd->description->title}}</title>
    <meta name="keywords" content="{{$currentProd->description->keywords}}"/>
    <meta name="description" content="{{$currentProd->description->description_meta}}"/>
@endsection

@section('page')
    <section class="page-header page-header-xs">
        <div class="container">

            <h1>{{mb_strtoupper($currentProd->description->name)}}</h1>

            <!-- breadcrumbs -->
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">{{trans('product_page.home')}}</a></li>
                <li><a href="{{url('/catalog')}}">{{trans('product_page.catalog')}}</a></li>
                <li><a href="{{url('/catalog/'.$currentClass['urlhash'])}}">{{$currentClass->description->name}}</a>
                </li>
                <li>
                    <a href="{{url('/catalog/'.$currentClass['urlhash'].'/'.$currentCat['urlhash'])}}">{{$currentCat->description->name}}</a>
                </li>
                <li class="active">{{$currentProd->description->name}}</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <section>
        <div class="container">

            <div class="row">

                <!-- RIGHT -->
                <div class="col-lg-9 col-md-9 col-sm-9 col-lg-push-3 col-md-push-3 col-sm-push-3">

                    <div class="row">

                        <!-- IMAGE -->
                        <div class="col-lg-6 col-sm-6">

                            <div class="thumbnail relative margin-bottom-3">

                                <figure id="zoom-primary" class="zoom" data-mode="mouseover">

                                    <a class="lightbox bottom-right"
                                       href="{{ asset('/files/products/img/'.$currentProd->cover) }}"
                                       data-plugin-options='{"type":"image"}'><i class="glyphicon glyphicon-search"></i></a>

                                    <img class="img-responsive"
                                         src="{{ asset('/files/products/img/'.$currentProd->cover) }}" width="1200"
                                         height="1500" alt="This is the product title"/>
                                </figure>

                            </div>

                            <!-- Thumbnails (required height:100px) -->
                            <div data-for="zoom-primary" class="zoom-more owl-carousel owl-padding-3 featured"
                                 data-plugin-options='{"singleItem": false, "autoPlay": false, "navigation": true, "pagination": false}'>
                                <a class="thumbnail active"
                                   href="{{ asset('/files/products/img/'.$currentProd->cover) }}">
                                    <img src="{{ asset('/files/products/img/small/'.$currentProd->cover) }}"
                                         height="100" alt=""/>
                                </a>
                                @foreach($currentProd->images as $image)
                                    <a class="thumbnail"
                                       href="{{ asset('/files/products/img/'.$image->url) }}">
                                        <img src="{{ asset('/files/products/img/small/'.$image->url) }}"
                                             height="100" alt=""/>
                                    </a>
                                @endforeach
                            </div>
                            <!-- /Thumbnails -->

                        </div>
                        <!-- /IMAGE -->

                        <!-- ITEM DESC -->
                        <div class="col-lg-6 col-sm-6">

                            <!-- buttons -->
                            <div class="pull-right">
                                <a class="btn btn-default add-wishlist" href="#" data-added="{{$favourite}}"
                                   data-id="{{$currentProd->id}}" {{--data-toggle="tooltip"--}}
                                   @if($favourite)
                                   title="{{trans('product_page.del_wish')}}"
                                   @else
                                   title="{{trans('product_page.add_wish')}}"
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
                                @if($currentProd->quantity > 0 && $currentProd->isset)
                                    <span class="pull-right text-success"><i
                                                class="fa fa-check"></i> {{trans('product_page.in_stock')}}</span>
                                @else
                                    <span class="pull-right text-danger"><i
                                                class="fa fa-times"></i> {{trans('product_page.out_stock')}}</span>
                                @endif
                                {{--<strong>SKU:</strong> UY7321987--}}
                            </div>


                            <!-- short description -->

                            <p>{{$currentProd->description->description}}</p>

                            <!-- /short description -->

                            <hr/>

                            <!-- FORM -->
                            <form class="clearfix form-inline nomargin" method="get" action="">
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
                                @if($currentProd->quantity > 0 && $currentProd->isset)
                                    <div class="products">
                                        <button id="{{$currentProd['id']}}" data-id="{{$currentProd['id']}}"
                                                data-title="{{$currentProd->description->name}}"
                                                data-img="{{ asset('/files/products/img/'.$currentProd['cover']) }}"
                                                data-price="{{currencyWithoutPrefix($currentProd['price'])}}"
                                                data-currency="{{currencyPrefix()}}"
                                                class="btn btn-default btn-lg btn-block btn-success buy-btn btn-hvr hvr-buzz-out">{{trans('product_page.add')}}
                                        </button>
                                    </div>
                                    <hr/>
                                @endif

                            </form>
                            <!-- /FORM -->

                            <div class="col-md-12">
                                <div class="heading-title heading-border-bottom">
                                    <h3><i class="fa fa-truck" aria-hidden="true"></i> Доставка</h3>
                                </div>
                                <ul class="list-unstyled list-icons">
                                    <li><i class="fa fa-check text-success"></i> <b>Новой почтой</b></li>
                                </ul>
                                <div class="heading-title heading-border-bottom">
                                    <h3><i class="fa fa-credit-card" aria-hidden="true"></i> Оплата</h3>
                                </div>
                                <ul class="list-unstyled list-icons">
                                    <li><i class="fa fa-check text-success"></i> <b>Банковской картой</b></li>
                                    <li><i class="fa fa-check text-success"></i> <b>При получении</b></li>
                                </ul>
                            </div>

                        </div>
                        <!-- /ITEM DESC -->

                    </div>


                    <ul id="myTab" class="nav nav-tabs nav-top-border margin-top-80" role="tablist">
                        <li role="presentation" class="active"><a href="#description" role="tab"
                                                                  data-toggle="tab">{{trans('product_page.desc')}}</a>
                        </li>
                        <li role="presentation"><a href="#specs" role="tab"
                                                   data-toggle="tab">{{trans('product_page.spec')}}</a></li>
                        {{--<li role="presentation"><a href="#reviews" role="tab" data-toggle="tab">Reviews (2)</a></li>--}}
                    </ul>

                    <div class="tab-content padding-top-20">
                        <!-- DESCRIPTION -->
                        <style>
                            #description img {
                                max-width: 100%;
                                display: block;
                                margin: auto;
                            }
                        </style>
                        <div role="tabpanel" class="tab-pane fade in active" id="description">
                            {!! $currentProd->description->description_full!!}
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

                        {{--           <!-- REVIEWS -->--}}
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


                        <h2 class="owl-featured">
                            <strong>{{trans('product_page.related')}}</strong> {{trans('product_page.products')}}:</h2>
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
                                        </a>
                                        <!-- /product image(s) -->

                                        <!-- product more info -->
                                        <div class="shop-item-info">
                                            {{--<span class="label label-success">NEW</span>--}}
                                            @if($prod->price_old != '')
                                                <span class="label label-danger">{{trans('product_page.sale')}}</span>
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
                            <h4>{{trans('product_page.categories')}}</h4>
                        </div>

                        <ul class="list-group list-group-bordered list-group-noicon uppercase">
                            @foreach(\larashop\Classes::all() as $class)
                                <li class="list-group-item @if($class->description->name == $currentClass->description->name)active @endif">
                                    <a class="dropdown-toggle"
                                       href="{{ url('catalog/'.$class->urlhash) }}">{{$class->description->name}}</a>
                                    <ul>
                                        <li>
                                            <a href="{{ url('catalog/'.$class->urlhash) }}">{{trans('product_page.all')}}</a>
                                        </li>
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

                    <!-- HTML BLOCK -->
                    <div class="margin-bottom-60">
                        <h4>{{trans('catalog_page.newsletter_header')}}</h4>
                        <p>{{trans('catalog_page.newsletter_body')}}</p>

                        <form action="\newsletter-add" role="form" method="post">
                        {{csrf_field()}}
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" id="email" name="email" class="form-control required"
                                       placeholder="{{trans('catalog_page.enter_email')}}">
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
    <script>
        $('.add-wishlist').on('click', function () {
            var product_id = $(this).data('id');
            if ($(this).data('added') == 0) {
                $.get('{{url('/profile/favourites/add')}}/' + product_id, function (response) {
                    if (response) {
                        $('.add-wishlist').children('.fa').css('color', 'darkred');
                        $('.add-wishlist').data('added', 1);
                        $('.add-wishlist').attr('title', 'Remove from Wishlist');
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
                        $('.add-wishlist').attr('title', "{{trans('product_page.add_wish')}}");
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
