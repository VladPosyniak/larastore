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
                Отчет компании
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Отчет компании</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-9">
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
                        <div class="box-body text-center">
                            <h1>
                                {{$reports['campaign_title']}}
                            </h1>
                            <button class="btn btn-success" data-toggle="modal" data-target="#modal">Открыть сообщение
                            </button>
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Отчет компании</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Параметры компании</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <h2>Основное</h2>

                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Свойство</th>
                                                <th>Значение</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    id
                                                </td>
                                                <td>
                                                    {{$reports['id']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Тип
                                                </td>
                                                <td>
                                                    {{$reports['type']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Отправленно сообщений
                                                </td>
                                                <td>
                                                    @if(isset($reports['emails_sent']))
                                                        <span class="badge">{{$reports['emails_sent']}}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Отписалось
                                                </td>
                                                <td>
                                                    <span class="badge">{{$reports['unsubscribed']}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Время отправки
                                                </td>
                                                <td>
                                                    {{$reports['send_time']}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <h2>Статистика просмотров</h2>

                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Свойство</th>
                                                <th>Значение</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    Всего просмотров
                                                </td>
                                                <td>
                                                    <span class="badge">{{$reports['opens']['opens_total']}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Уникальных просмотров
                                                </td>
                                                <td>
                                                    <span class="badge">{{$reports['opens']['unique_opens']}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Темп просмотров
                                                </td>
                                                <td>
                                                    <span class="badge">{{$reports['opens']['open_rate']}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Последний просмотр
                                                </td>
                                                <td>
                                                    {{$reports['opens']['last_open']}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <h2>Статистика нажатий на ссылку</h2>

                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Свойство</th>
                                                <th>Значение</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    Всего нажатий
                                                </td>
                                                <td>
                                                    <span class="badge">{{$reports['clicks']['clicks_total']}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Уникальных нажатий
                                                </td>
                                                <td>
                                                    <span class="badge">{{$reports['clicks']['unique_clicks']}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Уникальных нажатий от подписчиков
                                                </td>
                                                <td>
                                                    <span class="badge">{{$reports['clicks']['unique_subscriber_clicks']}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Темп нажатий
                                                </td>
                                                <td>
                                                    <span class="badge">{{$reports['clicks']['click_rate']}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Последнее нажатие
                                                </td>
                                                <td>
                                                    {{$reports['clicks']['last_click']}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        <h2>Настройки</h2>

                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Свойство</th>
                                                <th>Значение</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    Тема компании
                                                </td>
                                                <td>
                                                    {{$campaign['settings']['subject_line']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Заголовок
                                                </td>
                                                <td>
                                                    {{$campaign['settings']['title']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Имя отправителя
                                                </td>
                                                <td>
                                                    {{$campaign['settings']['from_name']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Почта отправителя
                                                </td>
                                                <td>
                                                    {{$campaign['settings']['reply_to']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Id шаблона
                                                </td>
                                                <td>
                                                    {{$campaign['settings']['template_id']}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <h2>Отслеживание</h2>

                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Свойство</th>
                                                <th>Значение</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    Отслеживание открытий
                                                </td>
                                                <td>
                                                    @if($campaign['tracking']['opens'])
                                                        Да
                                                    @else
                                                        Нет
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    HTML clicks
                                                </td>
                                                <td>
                                                    @if($campaign['tracking']['html_clicks'])
                                                        Да
                                                    @else
                                                        Нет
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Text clicks
                                                </td>
                                                <td>
                                                    @if($campaign['tracking']['text_clicks'])
                                                        Да
                                                    @else
                                                        Нет
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Goal tracking
                                                </td>
                                                <td>
                                                    @if($campaign['tracking']['goal_tracking'])
                                                        Да
                                                    @else
                                                        Нет
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Ecomm360
                                                </td>
                                                <td>
                                                    @if($campaign['tracking']['ecomm360'])
                                                        Да
                                                    @else
                                                        Нет
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">

                </div>
            </div>

        </section>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">{{$reports['campaign_title']}}</h4>
                    </div>
                    <div class="modal-body">
                        @if(isset($content['html']))
                            {!! $content['html']!!}
                        @else
                            <b>Шаблона для этой копании не заданно</b>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
@include("admin.layout.footer")
<!-- page script -->
    <script>
        $(function () {
            $('body').on('click', '.remove', function (event) {
                event.preventDefault();
                var id = $(this).attr('data-id');
                bootbox.confirm("Действительно хотите удалить клиента и его заказы?", function (result) {
                    if (result == true) {
                        var data = {_token: CSRF_TOKEN, _method: 'DELETE', id: id};
                        //console.log(id);
                        $.ajax({
                            type: 'POST',
                            url: SYS_URL + '/delivery/campaigns/delete/' + id,
                            data: data,
                            //dataType: 'html',
                            success: function (html) {
                                window.location = SYS_URL + '/delivery/campaigns'
                            }
                        });
                    }
                    else {
                    }
                });
            });
            $("#example1").DataTable({
                "language": {
                    "url": "{!! asset('plugins/datatables/lang/Russian.json') !!}",
                }
            });

        });
    </script>
</body>
</html>