@extends('layout.main')

@@section('seo')
    <title>Заказы пользователя Shmot.top</title>
@endsection

@section('page')

    <section class="page-header page-header-xs">
        <div class="container">

            <!-- breadcrumbs -->
            <ol class="breadcrumb breadcrumb-inverse">
                <li><a href="{{url('/')}}">{{trans('all.home')}}</a></li>
                <li class="active">{{trans('settings.orders')}}</li>
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
                        <h3>{{trans('orders_settings.yours')}}<span> {{trans('orders_settings.orders')}}</span></h3>
                        <p>{{trans('orders_settings.here')}}</p>
                    </div>

                </div>
            </section>
            <!-- RIGHT -->
            <div class="col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4 margin-bottom-80">


                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><i class="fa fa-building pull-right hidden-xs"></i>Код заказа</th>
                            <th><i class="fa fa-calendar pull-right hidden-xs"></i> Цена</th>
                            <th><i class="glyphicon glyphicon-send pull-right hidden-xs"></i> Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->code}}</td>
                                <td>{{currency($order->to_pay)}}</td>
                                <td><span class="label label-info">{{$order->status}}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>


            <!-- LEFT -->
            <div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8">


                <!-- SIDE NAV -->
                <ul class="side-nav list-group margin-bottom-60" id="sidebar-nav">
                    <li class="list-group-item "><a href="{{url('/profile/settings')}}"><i class="fa fa-gears"></i>{{trans('settings.settings')}}</a></li>
                    <li class="list-group-item"><a href="{{url('/profile/coupons')}}"><i class="fa fa-ticket"></i>{{trans('settings.coupons')}}</a></li>
                    <li class="list-group-item active"><a href="{{url('/profile/orders')}}"><i
                                    class="fa fa-archive"></i>{{trans('settings.orders')}}</a></li>
                    <li class="list-group-item"><a href="{{url('/profile/favourites')}}"><i
                                    class="fa fa-star"></i>{{trans('settings.favorite')}}</a></li>
                </ul>

            </div>

        </div>
    </section>
    <!-- / -->

@endsection