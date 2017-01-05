@include("admin.layout.header")
<title>Панель приборов</title>
</head>

<body class="hold-transition sidebar-mini skin-red-light">
<div class="wrapper">

    @include("admin.layout.topmenu")
    @include("admin.layout.navbar")

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <i class="fa fa-tachometer"></i> Панель управления
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Панель управления</li>
            </ol>
        </section>
        <hr>

        <!-- Main content -->
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">
                    <!-- LINE CHART -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Статистика</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">


                            <div class="chart">
                                <div id="main_chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Клиентов</span>
                            <span class="info-box-number">{{$clients_count}}</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                    <a href="{{url('admin/clients')}}" style="color: white">Подробнее...</a>
                  </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-star"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Продуктов</span>
                            <span class="info-box-number">{{$products_count}}</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <a href="{{url('admin/content/prod')}}" style="color: white">Подробнее...</a>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="fa fa-list-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Заказов</span>
                            <span class="info-box-number">{{$orders_count}}</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <a href="{{url('admin/orders')}}" style="color: white">Подробнее...</a>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-money"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Денег получено</span>
                            <span class="info-box-number">{{currency($cash,'UAH')}}</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <a href="{{url('admin/orders')}}" style="color: white">Подробнее...</a>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
                {{--<div class="col-md-3 col-sm-6 col-xs-12">--}}
                    {{--<div class="info-box bg-red">--}}
                        {{--<span class="info-box-icon"><i class="fa fa-users"></i></span>--}}
                        {{--<div class="info-box-content">--}}
                            {{--<span class="info-box-text">Уникальный посетителей</span>--}}
                            {{--<span class="info-box-number">{{$unique_users}}</span>--}}
                            {{--<div class="progress">--}}
                                {{--<div class="progress-bar" style="width: 100%"></div>--}}
                            {{--</div>--}}
                            {{--<span class="progress-description">--}}
                    {{--<a href="{{url('admin/clients')}}" style="color: white">Подробнее...</a>--}}
                  {{--</span>--}}
                        {{--</div><!-- /.info-box-content -->--}}
                    {{--</div><!-- /.info-box -->--}}
                {{--</div><!-- /.col -->--}}
                {{--<div class="col-md-3 col-sm-6 col-xs-12">--}}
                    {{--<div class="info-box bg-aqua">--}}
                        {{--<span class="info-box-icon"><i class="fa fa-list-alt"></i></span>--}}
                        {{--<div class="info-box-content">--}}
                            {{--<span class="info-box-text">ОНЛАЙН</span>--}}
                            {{--<span class="info-box-number">{{$online}}</span>--}}
                            {{--<div class="progress">--}}
                                {{--<div class="progress-bar" style="width: 100%"></div>--}}
                            {{--</div>--}}
                            {{--<a href="{{url('admin/orders')}}" style="color: white">Подробнее...</a>--}}
                        {{--</div><!-- /.info-box-content -->--}}
                    {{--</div><!-- /.info-box -->--}}
                {{--</div><!-- /.col -->--}}
            </div>

        </div>

        <div class="col-md-12">


            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Последние заказы</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>ID заказа</th>
                                <th>Стоимость</th>
                                <th>Статус</th>
                                <th>Дата последнего обновления</th>
                                <th>Дата создания</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td><a href="{{url('admin/orders/show/'.$order->id)}}">{{$order->id}}</a></td>
                                    <td>{{currency($order->to_pay, 'UAH')}}</td>
                                    <td><span class="label label-success">{{$order->status}}</span></td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a"
                                             data-height="20">{{$order->updated_at->diffForHumans()}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a"
                                             data-height="20">{{$order->created_at->diffForHumans()}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="{{url('admin/orders')}}" class="btn btn-sm btn-default btn-flat pull-right">Просмотреть все
                        заказы</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>


    </div>
    <!-- /.content -->


</div>

@include("admin.layout.footer")
<!-- page script -->
<!-- Morris.js charts -->


<script>
    $(function () {
        Highcharts.chart('main_chart', {
            title: {
                text: 'Количество заказов по месяцам',
                x: -20 //center
            },
//            subtitle: {
//                text: 'Source: WorldClimate.com',
//                x: -20
//            },
            xAxis: {
                categories: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                    'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь']
            },
            yAxis: {
                title: {
                    text: 'Заказы'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [
                {
                    name: 'Заказы',
                    data: [{{$all_month_orders['January']}}, {{$all_month_orders['February']}}, {{$all_month_orders['March']}}, {{$all_month_orders['April']}}, {{$all_month_orders['May']}}, {{$all_month_orders['June']}}, {{$all_month_orders['July']}}, {{$all_month_orders['August']}}, {{$all_month_orders['September']}}, {{$all_month_orders['October']}}, {{$all_month_orders['November']}},{{$all_month_orders['December']}}]
                },
//                {
//                    name: 'New York',
//                    data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
//                }, {
//                    name: 'Berlin',
//                    data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
//                }, {
//                    name: 'London',
//                    data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
//                }
            ]
        });
    });
</script>
</body>
</html>