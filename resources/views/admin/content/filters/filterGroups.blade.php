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
                Группы фильтров
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Группы фильтров</li>
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
                            <ul class="todo-list ui-sortable">
                                @foreach ($groups as $group)
                                    <li>
                                        <table class="table table-condensed" style="margin-bottom: 0px;">
                                            <tbody>
                                            <td>
                                                <h4>{{$group->name}}</h4>
                                            </td>
                                            <td style="vertical-align: inherit;" class="text-right">
                                                <div class="btn-group ">
                                                    <a href="{!! URL::to('admin/content/filter-groups/edit/'.$group->id) !!}"
                                                       class="btn btn-sm btn-primary btn-flat"><i
                                                                class=" fa fa-pencil"></i></a>
                                                    <a href="{{url('admin/content/filter-groups/delete/'.$group->id)}}" data-id="{{$group->id}}"
                                                       class="btn btn-sm btn-danger btn-flat remove_group"><i
                                                                class=" fa fa-trash-o"></i></a>
                                                </div>
                                            </td>

                                            </tr>

                                            </tbody>
                                        </table>
                                    </li>
                                    {{-- <li id="item-{{$product->id}}">
                                        <!-- drag handle -->
                                        <span class="handle ui-sortable-handle">
                                        <i class="fa fa-ellipsis-v"></i>
                                        <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                        <!-- checkbox -->
                                        <span class="text"><img style="max-height: 50px;" class="img responsive"
                                        @if ($product->cover)
                                        src="{{ asset('files/products/img/small/'.$product->cover) }}"
                                        @else
                                        src="{{ asset('dist/img/boxed-bg.png') }}"
                                        @endif
                                        ></span>
                                        <!-- todo text -->
                                        <span class="text">{{$product->name}}</span>
                                        <span class="">{{$product->price}}</span>
                                        <!-- General tools such as edit or delete-->
                                        <div class="tools">
                                            <a href='{!! URL::to('/content/cat/edit/'.$product->id); !!}' style="text-decoration:none; color:#000000 !important;" class="fa fa-edit"></a>
                                            <a data-id="{{$product->id}}" href='#' style="text-decoration:none; color:#000000 !important;" class="fa fa-trash-o remove_prod"></a>
                                        </div>
                                    </li> --}}
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">

                    <div class="box box-solid">

                        <!-- /.box-header -->
                        <div class="box-body">
                            <a href="{!! URL::to('admin/content/filter-groups/create') !!}"
                               class="btn btn-block btn-primary btn-flat">Создать группу</a>
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
        $('.remove_group').on('click',function () {
            if (!confirm('Вы действительно хотите удалить эту группу?')){
                return false;
            }
        })
    </script>

</body>
</html>