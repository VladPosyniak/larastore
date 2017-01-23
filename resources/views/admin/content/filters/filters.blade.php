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
                Фильтры
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Фильтры</li>
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


                            <div class="tab-content">
                                <div class="tab-pane active">
                                    <h4>Выберите группу фильтров</h4>
                                </div>
                                @foreach($groups as $group)
                                    <div class="tab-pane" id="{{$group->id}}-group">
                                        <ul class="todo-list ui-sortable">
                                            @foreach ($filters as $filter1)
                                                @if($group->id === $filter1->filter_group_id)
                                                    <li>
                                                        <table class="table table-condensed"
                                                               style="margin-bottom: 0px;">
                                                            <tbody>
                                                            <td>
                                                                <h4>{{$filter1->description_ru->value}}</h4>
                                                            </td>
                                                            <td style="vertical-align: inherit;" class="text-right">
                                                                <div class="btn-group ">
                                                                    <a href="{!! URL::to('admin/content/filters/edit/'.$filter1->id) !!}"
                                                                       class="btn btn-sm btn-primary btn-flat"><i
                                                                                class=" fa fa-pencil"></i></a>
                                                                    <a href="{{url('admin/content/filters/delete/'.$filter1->id)}}"
                                                                       data-id="{{$filter1->id}}"
                                                                       class="btn btn-sm btn-danger btn-flat remove_group"><i
                                                                                class=" fa fa-trash-o"></i></a>
                                                                </div>
                                                            </td>

                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>


                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        @foreach($groups as $group)
                            <li><a href="#{{$group->id}}-group" data-toggle="tab">{{$group->description_ru->name}}</a></li>
                        @endforeach
                    </ul>

                    <div class="box box-solid">

                        <!-- /.box-header -->
                        <div class="box-body">
                            <a href="{!! URL::to('admin/content/filters/create') !!}"
                               class="btn btn-block btn-primary btn-flat">Создать значение</a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
@include("admin.layout.footer")
<!-- page script -->

    <script>
        $('.remove_group').on('click', function () {
            if (!confirm('Вы действительно хотите удалить эту группу?')) {
                return false;
            }
        })
    </script>

</body>
</html>