@include("admin.layout.header")
<title>Панель приборов</title>
</head>
<style>

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
                Редактирование слайдера
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li>Слайдера</li>
                <li class="active">Редактирование слайдера</li>
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
                            <form enctype="multipart/form-data"  action="{{url('admin/content/sliders/update/'.$slider->id)}}"
                                  method="post">
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
                                <h4>Уже добавленные слайды</h4>
                                <div style="margin-top: 20px" class="row">
                                    @foreach($slider->data as $item)
                                        <div style="margin-bottom: 10px" class="col-md-6">
                                            <button style="position: absolute; right: -1px; margin-top: 10px; margin-right: 20px" class="delete btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            <img style="width: 100%;height: 300px" src="{{asset('files/sliders/'.$item['image'])}}" class="img img-responsive" alt="">
                                            <input type="hidden" name="images_old[]" value="{{$item['image']}}">
                                            <label class="control-label" for="links[]">Ссылка:</label>
                                            <input class="form-control" value="{{$item['link']}}" name="links_old[]" type="text" required>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="description">Название</label>
                                        <input type="text" value="{{$slider->name}}" class="form-control" name="name">
                                        @if ($errors->has('name')) <p
                                                class="help-block">{{ $errors->first('name') }}</p> @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Описание</label>
                                        <input type="text" value="{{$slider->description}}" class="form-control"
                                               name="description">
                                        @if ($errors->has('description')) <p
                                                class="help-block">{{ $errors->first('description') }}</p> @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="identificator">Идентификатор</label>
                                        <input type="text" value="{{$slider->identificator}}" class="form-control"
                                               name="identificator">
                                        @if ($errors->has('identificator')) <p
                                                class="help-block">{{ $errors->first('identificator') }}</p> @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Описание</label>
                                        <select class="form-control input-sm select2 " name="type">
                                            <option @if($slider->type == 'banner')selected="selected"
                                                    @endif  value="banner">banner
                                            </option>
                                            <option @if($slider->type == 'slider')selected="selected"
                                                    @endif value="slider">slider
                                            </option>
                                        </select>
                                        @if ($errors->has('type')) <p
                                                class="help-block">{{ $errors->first('type') }}</p> @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="height">Высота изображения (пискели)</label>
                                        <input type="text" value="{{$slider->height}}" class="form-control" name="height">
                                        @if ($errors->has('height')) <p class="help-block">{{ $errors->first('height') }}</p> @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="width">Ширина изображения (пискели)</label>
                                        <input type="text" value="{{$slider->width}}" class="form-control" name="width">
                                        @if ($errors->has('width')) <p class="help-block">{{ $errors->first('width') }}</p> @endif
                                    </div>
                                </div>

                                <hr>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-md">
                                        Обновить слайдер
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

        $('.delete').click(function () {
            $(this).parent().remove();
        })
    </script>
</body>
</html>