@foreach($products as $product)

    <!-- ITEM -->
    <li class="col-lg-12">

        <div class="shop-item clearfix ">

            <div class="thumbnail">
                <!-- product image(s) -->
                <a class="shop-item-image" href="{{url('/product/'.$product['id'])}}">
                    <img class="img-responsive" src="{{ asset('/files/products/img/'.$product['cover']) }}"
                         alt="shop first image"/>
                    {{--<img class="img-responsive" src="smarty/images/demo/shop/products/300x450/p14.jpg" alt="shop hover image" />--}}
                </a>
                <!-- /product image(s) -->

                <!-- product more info -->
                <div class="shop-item-info">
                    {{--<span class="label label-success">NEW</span>--}}
                    @if($product['price_old'] !== null)
                        <span class="label label-danger">SALE</span>
                    @endif
                </div>
                <!-- /product more info -->
            </div>

            <div class="shop-item-summary">
                <h2>{{$product['name']}}</h2>

                <!-- rating -->
            {{--<div class="rating rating-4 size-13"><!-- rating-0 ... rating-5 --></div>--}}
            <!-- /rating -->

                <p><!-- product short description -->
                    {{$product['description']}}
                </p><!-- /product short description -->

                <!-- price -->
                <div class="shop-item-price">
                    @if($product['price'] !== '')
                        @if($product['price_old'] !== null)
                            <span class="line-through">{{currency($product['price_old'])}}</span>
                        @endif
                        {{currency($product['price'])}}
                    @else
                        Not Available
                    @endif
                </div>
                <!-- /price -->

                <!-- buttons -->
                {{--<div class="shop-item-buttons">--}}
                    {{--<a id="{{$product['id']}}" data-id="{{$product['id']}}" data-title="{{$product['name']}}" data-img="{{ asset('/files/products/img/'.$product['cover']) }}" data-price="{{currency($product['price'])}}" class="btn btn-default buy-btn" href="#"><i--}}
                                {{--class="fa fa-cart-plus"></i> Add--}}
                        {{--to--}}
                        {{--Cart</a>--}}
                    {{--<!-- replace data-item-id width the real item ID - used by js/view/demo.shop.js -->--}}
                    {{--<a class="btn btn-default add-wishlist" href="#" data-item-id="1" data-toggle="tooltip"--}}
                       {{--title="Add To Wishlist"><i class="fa fa-heart nopadding"></i></a>--}}
                    {{--<a class="btn btn-default add-compare" href="#" data-item-id="1" data-toggle="tooltip"--}}
                       {{--title="Add To Compare"><i class="fa fa-bar-chart-o nopadding" data-toggle="tooltip"></i></a>--}}
                {{--</div>--}}
                <div>
                    <a class="btn btn-default" href='{{url('product/'.$product['id'])}}'><i
                                class="fa fa-cart-plus"></i>BUY</a>
                </div>
                <!-- /buttons -->
            </div>

        </div>

    </li>
    <!-- /ITEM -->

@endforeach