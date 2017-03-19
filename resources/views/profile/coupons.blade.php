@extends('layout.main')

@section('seo')
    <title>Купоны пользователя Shmot.top</title>
@endsection

@section('page')

    <section class="page-header page-header-xs">
        <div class="container">

            <!-- breadcrumbs -->
            <ol class="breadcrumb breadcrumb-inverse">
                <li><a href="{{url('/')}}">{{trans('all.home')}}</a></li>
                <li class="active">{{trans('coupons.coupons')}}</li>
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
                        <h3>{{trans('coupons.yours')}}<span> {{trans('coupons.coupons')}}</span></h3>
                        <p>{{trans('coupons.you_can_find')}}</p>
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
                                    <hr/>
                                    <p>{{trans('coupons.you_can_use')}}</p>
                                    <hr/>
                                    <div class="countdown countdown-sm"
                                         data-from="{{$months[$coupon->expiration_date->month-1].' '.$coupon->expiration_date->day.', '.$coupon->expiration_date->year.' '.$coupon->expiration_date->hour.':'.$coupon->expiration_date->minute.':'.$coupon->expiration_date->second}}">
                                        <!-- Example Date From: December 31, 2018 15:03:26 --></div>
                                    <hr/>
                                    <a href="{{url('/catalog')}}" class="btn btn-3d btn-primary">{{trans('coupons.to_shop')}}</a>
                                </div>

                            </div>
                        @endforeach
                    </div>

                @else
                    <h5>У вас нет купонов.</h5>
                @endif
            </div>


            <!-- LEFT -->
            <div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8">


                <!-- SIDE NAV -->
                <ul class="side-nav list-group margin-bottom-60" id="sidebar-nav">
                    <li class="list-group-item "><a href="{{url('/profile/settings')}}"><i class="fa fa-gears"></i>
                            {{trans('settings.settings')}}</a></li>
                    <li class="list-group-item active"><a href="{{url('/profile/coupons')}}"><i
                                    class="fa fa-ticket"></i>
                            {{trans('settings.coupons')}}</a></li>
                    <li class="list-group-item "><a href="{{url('/profile/orders')}}"><i class="fa fa-archive"></i>
                            {{trans('settings.orders')}}</a></li>
                    <li class="list-group-item"><a href="{{url('/profile/favourites')}}"><i
                                    class="fa fa-star"></i>
                            {{trans('settings.favorite')}}</a></li>
                </ul>

            </div>

        </div>
    </section>
    <!-- / -->

@endsection