@include("admin.layout.header")
<title>Заказ №{{$order->id}}</title>
</head>
<style type="text/css" media="print">
    .noprint{
        display: none;
    }
</style>
<body class="hold-transition sidebar-mini skin-red-light">
<div class="wrapper">
@include("admin.layout.topmenu")
@include("admin.layout.navbar")
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Заказ {{$order->code}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Управление заказами</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </p>
                            @endif
                        @endforeach
                    </div> <!-- end .flash-message -->

                    <div class="box">
                        <div class="box-body">
                            <div class="panel panel-primary noprint">
                                <div class="panel-heading">
                                    Управление статусом
                                </div>
                                <div class="panel-body text-center">
                                    <a href="{{url('admin/orders/changestatus/'.$order->id.'/wait')}}" title="В обработку" class="btn btn-warning"><i class="fa fa-clock-o" aria-hidden="true"></i> Обрабатывается</a>
                                    <a href="{{url('admin/orders/changestatus/'.$order->id.'/processing')}}" title="К доставке" class="btn btn-info"><i class="fa fa-circle-o-notch fa-spin"></i> Обработан</a>
                                    <a href="{{url('admin/orders/changestatus/'.$order->id.'/complete')}}" title="Отправлен" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Доставляется</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="noprint panel panel-primary">
                                        <!-- Default panel contents -->
                                        <div class="panel-heading">Информация о заказе</div>

                                        <!-- List group -->
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <button data-toggle="tooltip" data-placement="top"
                                                        title="Дата добавления" style="margin-right: 20px"
                                                        class="btn btn-primary"><i class="fa fa-calendar fa-fw"></i>
                                                </button> {{$order->created_at}}</li>
                                            <li class="list-group-item">
                                                <button data-toggle="tooltip" data-placement="top" title="Оплата"
                                                        style="margin-right: 20px" class="btn btn-primary"><i
                                                            class="fa fa-credit-card fa-fw"></i>
                                                </button> {{$order->pay_type}}</li>
                                            <li class="list-group-item">
                                                <button data-toggle="tooltip" data-placement="top" title="Статус"
                                                        style="margin-right: 20px" class="btn btn-primary"><i
                                                            class="fa fa-circle-o-notch fa-spin"></i>
                                                </button> {{$order->status}}</li>
                                            <li class="list-group-item">
                                                <button data-toggle="tooltip" data-placement="top" title="Валюта"
                                                        style="margin-right: 20px" class="btn btn-primary"><i
                                                            class="fa fa-money"></i>
                                                </button> {{$order->currency}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-primary">
                                        <!-- Default panel contents -->
                                        <div class="panel-heading">Информация о покупателе</div>

                                        <!-- List group -->
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <button data-toggle="tooltip" data-placement="top"
                                                        title="Имя покупателя" style="margin-right: 20px"
                                                        class="btn btn-primary"><i class="fa fa-user fa-fw"></i>
                                                </button> {{$customer->name}}</li>
                                            <li class="list-group-item">
                                                <button data-toggle="tooltip" data-placement="top"
                                                        title="Номер телефона" style="margin-right: 20px"
                                                        class="btn btn-primary"><i class="fa fa-phone fa-fw"></i>
                                                </button> {{$customer->phone}}</li>
                                            <li class="list-group-item">
                                                <button data-toggle="tooltip" data-placement="top" title="Емейл"
                                                        style="margin-right: 20px" class="btn btn-primary"><i
                                                            class="fa fa-envelope-o  fa-fw"></i>
                                                </button> {{$customer->email}}</li>
                                            <li class="list-group-item">
                                                <button data-toggle="tooltip" data-placement="top" title="Язык"
                                                        style="margin-right: 20px" class="btn btn-primary"><i
                                                            class="fa fa-globe  fa-fw"></i>
                                                </button> {{$customer->locale}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-primary">
                                <!-- Default panel contents -->
                                <div class="panel-heading">Адрес доставки</div>

                                <!-- List group -->
                                <ul class="list-group">
                                    <li class="list-group-item"><b>Страна: </b>{{$address['country']}}</li>
                                    <li class="list-group-item"><b>Город: </b>{{$address['city']}}</li>
                                    <li class="list-group-item"><b>Индекс: </b>{{$address['postal_code']}}</li>
                                    <li class="list-group-item"><b>Компания: </b>{{$address['company']}}</li>
                                    <li class="list-group-item"><b>Адрес: </b>{{$address['address']}}</li>
                                    <li class="list-group-item"><b>Комментарий: </b>{{$address['comment']}}</li>
                                </ul>
                            </div>

                            <div class="panel panel-primary">
                                <!-- Default panel contents -->
                                <div class="panel-heading">Товары</div>


                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>
                                            <center>Id товара</center>
                                        </th>
                                        <th>
                                            <center>Название</center>
                                        </th>
                                        <th>
                                            <center>Опции</center>
                                        </th>

                                        <th>
                                            <center>Количество</center>
                                        </th>
                                        <th>
                                            <center>Цена</center>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td class="text-center">{{$item->data->id}}</td>
                                            <td class="text-center">{{$item->data->description->name}}</td>
                                            <td class="text-center">{{$item->options}}</td>
                                            <td class="text-center">{{$item->amount}}</td>
                                            <td class="text-center">{{currency($item->data->price, $order->currency)}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <ul class="list-group text-center">
                                    <li class="list-group-item"><b>Купон:</b> {{$coupon}}</li>
                                    <li class="list-group-item"><b>Итого:</b> {{currency($order->to_pay, $order->currency)}}</li>
                                </ul>
                            </div>

                            <div class="container-fluid text-right">
                                <button class="btn btn-success" onclick="window.print();">Печать</button>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
@include("admin.layout.footer")
<!-- page script -->

</body>
</html>