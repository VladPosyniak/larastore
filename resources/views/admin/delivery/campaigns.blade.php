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
                Управление компаниями
            </h1>
            <h4>
                Всего:
                {{--@if(isset($campaigns['total_items']))--}}
                    {{--{{$campaigns['total_items']}}--}}
                {{--@endif--}}
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Управление компаниями</li>
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
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        <center>Дата создания</center>
                                    </th>
                                    <th>
                                        <center>id</center>
                                    </th>
                                    <th>
                                        <center>Имя</center>
                                    </th>
                                    <th>
                                        <center>Список</center>
                                    </th>
                                    <th>
                                        <center>Статус</center>
                                    </th>
                                    <th>
                                        <center>Прочитано</center>
                                    </th>

                                    <th>
                                        <center>Управление</center>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--@if(isset($campaigns['campaigns'][0]))--}}
                                    {{--@foreach ($campaigns['campaigns'] as $campaign)--}}
                                        {{--<tr>--}}
                                            {{--<td>{{$campaign['create_time']}}</td>--}}
                                            {{--<td>{{$campaign['id']}}</td>--}}
                                            {{--<td>{{$campaign['settings']['title']}}</td>--}}
                                            {{--<td>{{$campaign['recipients']['list_name']}}</td>--}}
                                            {{--<td>{{$campaign['status']}}</td>--}}
                                            {{--<td>--}}
                                                {{--@if(isset($campaign['report_summary']['opens']))--}}
                                                    {{--{{$campaign['report_summary']['opens'].' раз'}}--}}
                                                {{--@endif--}}
                                            {{--</td>--}}
                                            {{--<td>--}}
                                                {{--<center>--}}
                                                    {{--<div class="btn-group text-center">--}}
                                                        {{--@if($campaign['status'] == 'save')--}}
                                                            {{--<a href='{{URL::to('/delivery/campaigns/send/'.$campaign['id'])}}'--}}
                                                               {{--class="btn btn-success btn-xs">отправить</a>--}}
                                                        {{--@endif--}}
                                                        {{--<a href='{{URL::to('/delivery/subscribers/edit/'.$campaign['id'])}}'--}}
                                                           {{--class="btn btn-warning btn-xs">редактировать</a>--}}
                                                        {{--<a href='{{URL::to('delivery/campaigns/reports/'.$campaign['id'])}}'--}}
                                                           {{--class="btn btn-info btn-xs">отчет</a>--}}
                                                        {{--<button type="button" data-id="{{$campaign['id']}}"--}}
                                                                {{--class="btn btn-danger btn-xs remove">удалить--}}
                                                        {{--</button>--}}
                                                    {{--</div>--}}
                                                {{--</center>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                    {{--@endforeach--}}
                                {{--@endif--}}
                                {{--{{dd($campaign)}}--}}
                                </tbody>

                            </table>
                        </div>

                    </div>
                    <a href="{{url('delivery/campaigns/create')}}" class="btn btn-success">Создать компанию</a>

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