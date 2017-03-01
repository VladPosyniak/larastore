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
                    @if($product['price_old'] !== null)
                        <span class="label label-danger">{{trans('product_page.sale')}}</span>
                    @endif
                </div>
                <!-- /product more info -->
            </div>

            <div class="shop-item-summary">
                <h2>{{$product['name']}}</h2>

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
                        {{trans('product_page.not_av')}}
                    @endif
                </div>
                <!-- /price -->

                <!-- buttons -->
                <div>
                    <a class="btn btn-default" href='{{url('product/'.$product['id'])}}'><i
                                class="fa fa-cart-plus"></i>{{trans('product_page.buy')}}</a>
                </div>
                <!-- /buttons -->
            </div>

        </div>

    </li>
    <!-- /ITEM -->

@endforeach