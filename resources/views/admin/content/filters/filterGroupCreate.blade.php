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
                Создание группы фильтров
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li>Слайдера</li>
                <li class="active">Создание группы фильтров</li>
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
                            <form enctype="multipart/form-data" action="{{url('admin/content/filter-groups/store')}}"
                                  method="post">

                                {!! csrf_field() !!}
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="description">Название</label>
                                        <input type="text" class="form-control" name="name">
                                        @if ($errors->has('name')) <p
                                                class="help-block">{{ $errors->first('name') }}</p> @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Класс товаров</label>
                                        <select class="form-control input-sm select2 " name="class">
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}">{{$class->description->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('class')) <p
                                                class="help-block">{{ $errors->first('class') }}</p> @endif
                                    </div>
                                </div>

                                <hr>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-md">
                                        Создать группу
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