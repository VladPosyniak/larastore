@foreach($products as $product)
    <!-- ITEM -->
    <li class="col-lg-3 col-sm-3 test">
        <div class="shop-item prod">

            <div class="thumbnail">
                <!-- product image(s) -->
                <a class="shop-item-image" href="{{url('/product/'.$product['id'])}}">
                    <img class="img-responsive"
                         src="{{ asset('/files/products/img/medium/'.$product['cover']) }}"
                         alt="shop first image"/>
                    {{--<img class="img-responsive"--}}
                    {{--src="{{asset('smarty/images/demo/shop/products/300x450/p14.jpg')}}"--}}
                    {{--alt="shop hover image"/>--}}
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

            <div class="shop-item-summary text-center">
                <h2>{{$product['name']}}</h2>
                <!-- price -->
                <div class="shop-item-price">
                    @if($product['price'] !== '')
                        @if($product['price_old'] !== null)
                            <span class="line-through">{{currency($product['price_old'])}}</span>
                        @endif
                        <div class="price-js" style="display: inline-block">{{currency($product['price'])}}</div>
                    @else
                        {{trans('product_page.not_av')}}
                    @endif
                </div>
                <!-- /price -->
            </div>


            <!-- buttons -->
            <div class="text-center">
                <a class="btn btn-default" href='{{url('product/'.$product['id'])}}'><i
                            class="fa fa-cart-plus"></i>{{trans('product_page.buy')}}</a>
            </div>
            <br>
            <div class="product-attr">
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
