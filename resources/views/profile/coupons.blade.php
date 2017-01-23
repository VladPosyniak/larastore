@extends('layout.main')

@section('seo')

@endsection

@section('page')

    <section class="page-header page-header-xs">
        <div class="container">

            <!-- breadcrumbs -->
            <ol class="breadcrumb breadcrumb-inverse">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">Coupons</li>
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
                        <h3>Your<span> coupons</span></h3>
                        <p>Here you can find your coupons.</p>
                    </div>

                </div>
            </section>
            <!-- RIGHT -->
            <div class="col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4 margin-bottom-80">


                @if(isset($coupons[0]))
                    <div class="row">

                        @foreach($coupons as $coupon)
                            <div class="col-md-4 col-sm-4">

                                <div class="price-clean">
                                    <h4>
                                        - {{$coupon['discount']}}%
                                    </h4>
                                    {{--<h5> COUPON </h5>--}}
                                    <hr/>
                                    <p>You can use this coupon for any product!</p>
                                    <hr/>
                                    <div class="countdown countdown-sm"
                                         data-from="{{$months[$coupon->expiration_date->month-1].' '.$coupon->expiration_date->day.', '.$coupon->expiration_date->year.' '.$coupon->expiration_date->hour.':'.$coupon->expiration_date->minute.':'.$coupon->expiration_date->second}}">
                                        <!-- Example Date From: December 31, 2018 15:03:26 --></div>
                                    <hr/>
                                    <a href="{{url('/catalog')}}" class="btn btn-3d btn-primary">TO SHOP!</a>
                                </div>

                            </div>
                        @endforeach
                        {{--<div class="col-md-4 col-sm-4">--}}

                        {{--<div class="price-clean">--}}
                        {{--<h4>--}}
                        {{--<sup>$</sup>15<em>/month</em>--}}
                        {{--</h4>--}}
                        {{--<h5> STARTER </h5>--}}
                        {{--<hr />--}}
                        {{--<p>For individuals looking for something simple to get started.</p>--}}
                        {{--<hr />--}}
                        {{--<a href="#" class="btn btn-3d btn-teal">Learn More</a>--}}
                        {{--</div>--}}

                        {{--</div>--}}

                    </div>

                @else
                    <h5>У вас нет купонов.</h5>
                @endif
            </div>


            <!-- LEFT -->
            <div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8">


                <!-- SIDE NAV -->
                <ul class="side-nav list-group margin-bottom-60" id="sidebar-nav">
                    {{--<li class="list-group-item"><a href="{{url('/profile/history')}}"><i class="fa fa-history"></i> ORDER--}}
                    {{--HISTORY</a></li>--}}
                    <li class="list-group-item "><a href="{{url('/profile/settings')}}"><i class="fa fa-gears"></i>
                            SETTINGS</a></li>
                    <li class="list-group-item active"><a href="{{url('/profile/coupons')}}"><i
                                    class="fa fa-ticket"></i>
                            COUPONS</a></li>
                    <li class="list-group-item "><a href="{{url('/profile/orders')}}"><i class="fa fa-archive"></i>
                            ORDERS</a></li>
                    <li class="list-group-item"><a href="{{url('/profile/favourites')}}"><i
                                    class="fa fa-star"></i>
                            FAVOURITES</a></li>
                </ul>

            </div>

        </div>
    </section>
    <!-- / -->

@endsection