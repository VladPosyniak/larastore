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
                Создание слайдера
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li>Слайдера</li>
                <li class="active">Создание слайдера</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Информация о слайдере</h3>
                        </div>
                        <div class="box-body">
                            <form enctype="multipart/form-data" action="{{url('admin/content/sliders/store')}}" method="post">
                                {!! csrf_field() !!}
                            <h4 class="text-center">Слайды</h4>
                            <div class="container-fluid text-center">
                                <button class="btn btn-lmd btn-success add_images">
                                    Добавить слайд +
                                </button>
                                <div style="margin-top: 20px" class="row images">

                                </div>
                            </div>
                            <hr>
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="description">Название</label>
                                    <input type="text" class="form-control" name="name">
                                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <input type="text" class="form-control" name="description">
                                    @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                                </div>
                                <div class="form-group">
                                    <label for="identificator">Идентификатор</label>
                                    <input type="text" class="form-control" name="identificator">
                                    @if ($errors->has('identificator')) <p class="help-block">{{ $errors->first('identificator') }}</p> @endif
                                </div>
                                <div class="form-group">
                                    <label for="type">Описание</label>
                                    <select class="form-control input-sm select2 " name="type" id="">
                                        <option value="banner">banner</option>
                                        <option value="slider">slider</option>
                                    </select>
                                    @if ($errors->has('type')) <p class="help-block">{{ $errors->first('type') }}</p> @endif
                                </div>
                                <div class="form-group">
                                    <label for="height">Высота изображения (пискели)</label>
                                    <input type="text" class="form-control" name="height">
                                    @if ($errors->has('height')) <p class="help-block">{{ $errors->first('height') }}</p> @endif
                                </div>
                                <div class="form-group">
                                    <label for="width">Ширина изображения (пискели)</label>
                                    <input type="text" class="form-control" name="width">
                                    @if ($errors->has('width')) <p class="help-block">{{ $errors->first('width') }}</p> @endif
                                </div>
                            </div>

                            <hr>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-md">
                                        Создать слайдер
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

    <script>
        $('.add_images').click(function () {
            $('.images').after('' +
                    '<div style="margin-bottom: 10px" class="col-md-6">' +
                    '<input name="images[]" type="file" required><br>' +
                    '<label class="control-label" for="links[]">Ссылка:</label> ' +
                    ' <input class="form-control" name="links[]" type="text" required>' +
                    '</div>');
            return false;
        })
    </script>
</body>
</html>