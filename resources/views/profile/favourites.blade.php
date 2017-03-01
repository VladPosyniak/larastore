@extends('layout.main')

@section('seo')

@endsection

@section('page')

    <section class="page-header page-header-xs">
        <div class="container">

            <!-- breadcrumbs -->
            <ol class="breadcrumb breadcrumb-inverse">
                <li><a href="{{url('/')}}">{{trans('all.home')}}</a></li>
                <li class="active">{{trans('settings.favorite')}}</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->


    <!-- -->
    <section>

        <div class="container">

            <section class="heading-title heading-arrow-bottom margin-bottom-40">
                <div class="container">

                    <div class="text-center">
                        <h3>{{trans('favourites.yours')}}<span> {{trans('favourites.fav_products')}}</span></h3>
                        <p>{{trans('favourites.here')}}</p>
                    </div>

                </div>
            </section>
            <!-- RIGHT -->
            <div class="col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4 margin-bottom-80">
                @if(isset($products[0]))
                    <ul class="shop-item-list products row list-inline nomargin">
                        @foreach($products as $product)
                            <li class="col-lg-3 col-sm-3 product-{{$product['id']}}" >
                                <div class="shop-item">

                                    <div class="thumbnail">
                                        <!-- product image(s) -->
                                        <a class="shop-item-image" href="{{url('/product/'.$product['id'])}}">
                                            <img class="img-responsive"
                                                 src="{{ asset('/files/products/img/'.$product['cover']) }}"
                                                 alt="shop first image"/>
                                        </a>
                                        <!-- /product image(s) -->

                                        <!-- hover buttons -->
                                        <div class="shop-option-over">
                                            <!-- replace data-item-id width the real item ID - used by js/view/demo.shop.js -->
                                            <a class="btn btn-default remove_favourite" href="#"
                                               data-id="{{$product['id']}}"
                                               data-toggle="tooltip" title="{{trans('favourites.remove')}}"><i
                                                        class="fa fa-times nopadding"></i></a>
                                        </div>
                                        <!-- /hover buttons -->

                                        <!-- product more info -->
                                        <div class="shop-item-info">
                                            @if($product['price_old'] !== null)
                                                <span class="label label-danger">{{trans('favourites.sale')}}</span>
                                            @endif
                                        </div>
                                        <!-- /product more info -->
                                    </div>

                                    <div class="shop-item-summary text-center">
                                        <h2>{{$product['name']}}</h2>

                                        <!-- rating -->

                                    <!-- /rating -->

                                        <!-- price -->
                                        <div class="shop-item-price">
                                            @if($product['price'] !== '')
                                                @if($product['price_old'] !== null)
                                                    <span class="line-through">{{currency($product['price_old'])}}</span>
                                                @endif
                                                <div class="price-js"
                                                     style="display: inline-block">{{currency($product['price'])}}</div>
                                            @else
                                                {{trans('favourites.not_av')}}
                                            @endif
                                        </div>
                                        <!-- /price -->
                                    </div>
                                </div>

                            </li>
                        @endforeach
                    </ul>
                @else
                    <h2>Nothing...</h2>
                @endif
            </div>


            <!-- LEFT -->
            <div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8">


                <!-- SIDE NAV -->
                <ul class="side-nav list-group margin-bottom-60" id="sidebar-nav">
                    <li class="list-group-item "><a href="{{url('/profile/settings')}}"><i class="fa fa-gears"></i>{{trans('settings.settings')}}</a></li>
                    <li class="list-group-item"><a href="{{url('/profile/coupons')}}"><i class="fa fa-ticket"></i>{{trans('settings.coupons')}}</a></li>
                    <li class="list-group-item "><a href="{{url('/profile/orders')}}"><i
                                    class="fa fa-archive"></i>{{trans('settings.orders')}}</a></li>
                    <li class="list-group-item active"><a href="{{url('/profile/favourites')}}"><i
                                    class="fa fa-star"></i>{{trans('settings.favorite')}}</a></li>
                </ul>

            </div>

        </div>
    </section>
    <!-- / -->

@endsection

@section('scripts')
    <script>
        $('.remove_favourite').click( function () {
            var product_id = $(this).data('id');
            $.get('{{url('/profile/favourites/delete')}}/' + product_id, function (response) {
                if (response) {
                    $('.product-'+product_id).fadeOut();
                    return false;
                }
                else {
                    alert('Something wrong')
                }
            })
        })
    </script>
@endsection