@include("admin.layout.header")
<title>Панель приборов</title>
</head>
<body class="hold-transition sidebar-mini skin-red-light">
<div class="wrapper">
@include("admin.layout.topmenu")
@include("admin.layout.navbar")
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Управление заказами
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
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#"
                                                                                                         class="close"
                                                                                                         data-dismiss="alert"
                                                                                                         aria-label="close">&times;</a>
                                </p>
                            @endif
                        @endforeach
                    </div> <!-- end .flash-message -->

                    <div class="box">
                        <div class="box-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#to_process" data-toggle="tab">Заказы к обработке</a></li>
                                <li><a href="#all_orders" data-toggle="tab">Все заказы</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="to_process">
                                    <br>
                                    <table id="table1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>
                                                <center>Создан</center>
                                            </th>
                                            <th>
                                                <center>Обновлено</center>
                                            </th>

                                            <th>
                                                <center>Имя покупателя</center>
                                            </th>
                                            <th>
                                                <center>Статус</center>
                                            </th>
                                            <th>
                                                <center>Цена</center>
                                            </th>
                                            <th>
                                                <center>Тип оплаты</center>
                                            </th>
                                            <th>
                                                <center>Оплачено</center>
                                            </th>
                                            <th>
                                                <center>Действие</center>
                                            </th>
                                            <th>
                                                <center>Изменить статус</center>
                                            </th>
                                            <th>
                                                <center>id</center>
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($to_processing[0]))
                                            @foreach ($to_processing as $order)
                                                <tr>
                                                    <td>{{$order->created_at}}</td>
                                                    <td>{{$order->updated_at}}</td>
                                                    <td>{{$order->user->name}}</td>
                                                    <td><span class="label label-success">{{$order->status}}</span></td>
                                                    <td>{{currency($order->to_pay,'UAH')}}</td>
                                                    <td>{{$order->pay_type}}</td>
                                                    <td>{{$order->paid}}</td>
                                                    <td class="text-center">
                                                        <a href="{{url('admin/orders/show/'.$order->id)}}" class="btn btn-info" title="Подробно"><i class="fa fa-info" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{url('admin/orders/changestatus/'.$order->id.'/wait')}}" title="Ожидает обработки" class="btn btn-warning"><i class="fa fa-clock-o" aria-hidden="true"></i></a>
                                                        <a href="{{url('admin/orders/changestatus/'.$order->id.'/processing')}}" title="Обрабатывается" class="btn btn-info"><i class="fa fa-circle-o-notch fa-spin"></i></a>
                                                        <a href="{{url('admin/orders/changestatus/'.$order->id.'/complete')}}" title="Обработан" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td>{{$order->id}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        {{--{{dd($campaign)}}--}}
                                        </tbody>

                                    </table>
                                </div>
                                <div class="tab-pane" id="all_orders">
                                    <br>
                                    <table id="table2" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>
                                                <center>Создан</center>
                                            </th>
                                            <th>
                                                <center>Обновлено</center>
                                            </th>

                                            <th>
                                                <center>Имя покупателя</center>
                                            </th>
                                            <th>
                                                <center>Статус</center>
                                            </th>
                                            <th>
                                                <center>Цена</center>
                                            </th>
                                            <th>
                                                <center>Тип оплаты</center>
                                            </th>
                                            <th>
                                                <center>Оплачено</center>
                                            </th>
                                            <th>
                                                <center>Действие</center>
                                            </th>
                                            <th>
                                                <center>Изменить статус</center>
                                            </th>
                                            <th>
                                                <center>id</center>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($all_orders[0]))
                                            @foreach ($all_orders as $order)
                                                <tr>
                                                    <td>{{$order->created_at}}</td>
                                                    <td>{{$order->updated_at}}</td>
                                                    <td>{{$order->user->name}}</td>
                                                    <td><span class="label label-success">{{$order->status}}</span></td>
                                                    <td>{{currency($order->to_pay)}}</td>
                                                    <td>{{$order->pay_type}}</td>
                                                    <td>{{$order->paid}}</td>
                                                    <td class="text-center">
                                                        <a href="{{url('admin/orders/show/'.$order->id)}}" class="btn btn-info" title="Подробно"><i class="fa fa-info" aria-hidden="true"></i></a>
                                                        <a href="" class="btn btn-success" title="Распечатать"><i class="fa fa-print" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{url('admin/orders/changestatus/'.$order->id.'/wait')}}" title="Ожидает обработки" class="btn btn-warning"><i class="fa fa-clock-o" aria-hidden="true"></i></a>
                                                        <a href="{{url('admin/orders/changestatus/'.$order->id.'/processing')}}" title="Обрабатывается" class="btn btn-info"><i class="fa fa-circle-o-notch fa-spin"></i></a>
                                                        <a href="{{url('admin/orders/changestatus/'.$order->id.'/complete')}}" title="Обработан" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td>{{$order->id}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        {{--{{dd($campaign)}}--}}
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="col-md-3">

                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
@include("admin.layout.footer")
<!-- page script -->
    <script>
        $(function () {
//            $('body').on('click', '.remove', function (event) {
//                event.preventDefault();
//                var id = $(this).attr('data-id');
//                bootbox.confirm("Действительно хотите удалить клиента и его заказы?", function (result) {
//                    if (result == true) {
//                        var data = {_token: CSRF_TOKEN, _method: 'DELETE', id: id};
//                        //console.log(id);
//                        $.ajax({
//                            type: 'POST',
//                            url: SYS_URL + '/delivery/campaigns/delete/' + id,
//                            data: data,
//                            //dataType: 'html',
//                            success: function (html) {
//                                window.location = SYS_URL + '/delivery/campaigns'
//                            }
//                        });
//                    }
//                    else {
//                    }
//                });
//            });
            $("#table1").DataTable({
                "language": {
                    "url": "{!! asset('plugins/datatables/lang/Russian.json') !!}",
                }
            });
            $("#table2").DataTable({
                "language": {
                    "url": "{!! asset('plugins/datatables/lang/Russian.json') !!}",
                }
            });

        });
    </script>
</body>
</html>