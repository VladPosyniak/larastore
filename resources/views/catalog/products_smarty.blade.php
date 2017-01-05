@foreach($products as $product)
    <!-- ITEM -->
    <li class="col-lg-3 col-sm-3 test">
        <div class="shop-item prod">

            <div class="thumbnail">
                <!-- product image(s) -->
                <a class="shop-item-image" href="{{url('/product/'.$product['id'])}}">
                    <img class="img-responsive"
                         src="{{ asset('/files/products/img/'.$product['cover']) }}"
                         alt="shop first image"/>
                    {{--<img class="img-responsive"--}}
                    {{--src="{{asset('smarty/images/demo/shop/products/300x450/p14.jpg')}}"--}}
                    {{--alt="shop hover image"/>--}}
                </a>
                <!-- /product image(s) -->

                <!-- hover buttons -->
                <div class="shop-option-over">
                    <!-- replace data-item-id width the real item ID - used by js/view/demo.shop.js -->
                    {{--<a class="btn btn-default add-wishlist" href="#" data-item-id="1"--}}
                       {{--data-toggle="tooltip" title="Add To Wishlist"><i--}}
                                {{--class="fa fa-heart nopadding"></i></a>--}}
                    {{--<a class="btn btn-default add-compare" href="#" data-item-id="1"--}}
                       {{--data-toggle="tooltip" title="Add To Compare"><i--}}
                                {{--class="fa fa-bar-chart-o nopadding" data-toggle="tooltip"></i></a>--}}
                </div>
                <!-- /hover buttons -->

                <!-- product more info -->
                <div class="shop-item-info">
                    {{--<span class="label label-success">NEW</span>--}}
                    @if($product['price_old'] !== null)
                        <span class="label label-danger">SALE</span>
                    @endif
                </div>
                <!-- /product more info -->
            </div>

            <div class="shop-item-summary text-center">
                <h2>{{$product['name']}}</h2>

                <!-- rating -->
                <div class="shop-item-rating-line">
                    <div class="rating rating-4 size-13"><!-- rating-0 ... rating-5 --></div>
                </div>
                <!-- /rating -->

                <!-- price -->
                <div class="shop-item-price">
                    @if($product['price'] !== '')
                        @if($product['price_old'] !== null)
                            <span class="line-through">{{currency($product['price_old'])}}</span>
                        @endif
                        <div class="price-js" style="display: inline-block">{{currency($product['price'])}}</div>
                    @else
                        not available
                    @endif
                </div>
                <!-- /price -->
            </div>


            <!-- buttons -->
            {{--<div class="shop-item-buttons text-center products+">--}}
                {{--<a id="{{$product['id']}}" data-id="{{$product['id']}}" data-title="{{$product['name']}}" data-img="{{ asset('/files/products/img/'.$product['cover']) }}" data-currency="{{currencyPrefix()}}" data-price="{{currencyWithoutPrefix($product['price'])}}" class="btn btn-default buy-btn" href="#"><i--}}
                            {{--class="fa fa-cart-plus"></i> Add--}}
                    {{--to--}}
                    {{--Cart</a>--}}
            {{--</div>--}}
            <div class="text-center">
                <a class="btn btn-default" href='{{url('product/'.$product['id'])}}'><i
                            class="fa fa-cart-plus"></i>BUY</a>
            </div>
            <br>
            <div class="product-attr">
                {{--<div class="box-icon-title">--}}
                    {{--<i class="noborder fa fa-cogs"></i>--}}
                    {{--<h4>Характеристики:</h4>--}}
                {{--</div>--}}
                <ul class="list-unstyled list-icons" style="padding: 0">
                    @foreach($attr as $item)
                        @if($item->id == $product['id'])
                        <li><b>{{$item->title}}</b>: {{$item->value.' '.$item->unit}}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <!-- /buttons -->
        </div>

    </li>
    <!-- /ITEM -->

@endforeach
