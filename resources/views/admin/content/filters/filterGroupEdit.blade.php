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
                Редактирование группы фильтров
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li>Слайдера</li>
                <li class="active">Редактирование группы фильтров</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Информация о группе</h3>
                        </div>
                        <div class="box-body">
                            <form enctype="multipart/form-data" action="{{url('admin/content/filter-groups/update/'.$group->id)}}"
                                  method="post">
                                <input type="hidden" name="_method" value="PATCH">
                                {!! csrf_field() !!}
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="description">Название</label>
                                        <input type="text" class="form-control" value="{{$group->name}}" name="name">
                                        @if ($errors->has('name')) <p
                                                class="help-block">{{ $errors->first('name') }}</p> @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Класс товаров</label>
                                        <select class="form-control input-sm select2 " name="class">
                                            @foreach($classes as $class)
                                                <option @if($class->id === $group->filter_class_id) selected @endif value="{{$class->id}}">{{$class->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('class')) <p
                                                class="help-block">{{ $errors->first('class') }}</p> @endif
                                    </div>
                                </div>

                                <hr>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-md">
                                        Изменить группу
                                    </button>
                                </div>
                            </form>
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
</body>
</html>