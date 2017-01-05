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
                        <h3>Your<span> orders</span></h3>
                        <p>Here you can find your orders and check their status.</p>
                    </div>

                </div>
            </section>
            <!-- RIGHT -->
            <div class="col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4 margin-bottom-80">


                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><i class="fa fa-building pull-right hidden-xs"></i>Номер заказа</th>
                            <th><i class="fa fa-calendar pull-right hidden-xs"></i> Цена</th>
                            <th><i class="glyphicon glyphicon-send pull-right hidden-xs"></i> Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
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
                    {{--<li class="list-group-item"><a href="{{url('/profile/history')}}"><i class="fa fa-history"></i> ORDER--}}
                    {{--HISTORY</a></li>--}}
                    <li class="list-group-item "><a href="{{url('/profile/settings')}}"><i class="fa fa-gears"></i>
                            SETTINGS</a></li>
                    <li class="list-group-item"><a href="{{url('/profile/coupons')}}"><i class="fa fa-ticket"></i>
                            COUPONS</a></li>
                    <li class="list-group-item active"><a href="{{url('/profile/orders')}}"><i
                                    class="fa fa-archive"></i>
                            ORDERS</a></li>
                </ul>

            </div>

        </div>
    </section>
    <!-- / -->

@endsection