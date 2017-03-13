@include("admin.layout.header")
<!-- iCheck -->
{!! Html::style('plugins/iCheck/square/blue.css') !!}
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
                Редактирование продукта
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li>Список продуктов</li>
                <li class="active">Редактирование продукта</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    @if($errors->has())
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4>Данные товара не прошли валидацию!</h4>
                            </div>
                            <div class="panel-body">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-9">
                    <div class="box">

                        <div class="box-header">
                            <h3 class="box-title">Информация о продукте</h3>
                        </div>
                        <div class="box-body">

                            {!! Form::open(array('action' => ['ContentController@updateProduct',$product->id], 'method'=> 'PATCH', 'files' => true, 'class'=>'form-horizontal')) !!}
                            {!! csrf_field() !!}

                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#main" data-toggle="tab">Общее</a></li>
                                <li><a href="#images" data-toggle="tab">Изображения</a></li>
                                @foreach($languages as $language)
                                    <li><a href="#{{$language->code}}" data-toggle="tab"><img class="flag-lang"
                                                                                              src="{{asset($language->image)}}"
                                                                                              width="16"
                                                                                              height="11"
                                                                                              alt="lang"/></a></li>
                                @endforeach
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="main">
                                    <br>
                                    <div class="form-group">

                                        {!! Form::label('price', 'Цена', array('class'=>'col-sm-3 control-label')) !!}

                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                {!! Form::text('price', currencyWithoutPrefix($product->price,'UAH'), array('class'=>'form-control')) !!}
                                                <span class="input-group-addon">грн.</span>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('price_old', 'Старая цена', array('class'=>'col-sm-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                {!! Form::text('price_old', currencyWithoutPrefix($product->price_old,'UAH'), array('class'=>'form-control')) !!}
                                                <span class="input-group-addon">грн.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4" class="col-sm-3 control-label">Категория</label>
                                        <div class="col-md-9">
                                            {!! Form::select('categories_id', $CatList, $product->categories_id, array('class'=>'form-control input-sm select2', 'style'=>'width: 100%')) !!}
                                        </div>
                                    </div>


                                    {{--<div class="form-group">--}}
                                    {{--<label for="inputPassword4" class="col-sm-3 control-label">Опции цен</label>--}}
                                    {{--<div class="col-md-9">--}}
                                    {{--{!! Form::select('opts[]', $opt_arr, [], array('class'=>'form-control input-sm select2', 'style'=>'width: 100%', 'multiple'=>'multiple')) !!}--}}

                                    {{--</div>--}}
                                    {{--</div>--}}



                                    {{--<div class="form-group @if ($errors->has('urlhash')) has-error @endif">--}}
                                    {{--{!! Form::label('urlhash', 'URL-имя', array('class'=>'col-sm-3 control-label')) !!}--}}
                                    {{--<div class="col-sm-9">--}}
                                    {{--<div class="input-group">--}}
                                    {{--<span class="input-group-addon">{!! URL::to('/prod') !!}/</span>--}}
                                    {{--{!! Form::text('urlhash', null, array('class'=>'form-control')) !!}--}}
                                    {{--</div>--}}
                                    {{--@if ($errors->has('urlhash')) <p class="help-block">{{ $errors->first('urlhash') }}</p> @endif--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="form-group @if ($errors->has('cover')) has-error @endif">
                                        {!! Form::label('cover', 'Обложка', array('class'=>'col-sm-3 control-label')) !!}
                                        <div class="col-sm-5">
                                            {!! Form::file('cover', null, array('class'=>'form-control')) !!}
                                            @if ($errors->has('cover')) <p
                                                    class="help-block">{{ $errors->first('cover') }}</p> @endif
                                        </div>
                                        @if($product->cover)
                                            <div class="col-sm-5">
                                                <img style=" max-height: 50px; "
                                                     src="{!! asset('files/products/img/small/'.$product->cover) !!}"
                                                     alt="4"
                                                     class="img-responsive">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="filters[]" class="col-sm-3 control-label">Фильтры</label>
                                        <div class="col-md-9">
                                            {!! Form::select('filters[]', $filters, $myfilters_arr, array('class'=>'form-control input-sm select2', 'style'=>'width: 100%', 'multiple'=>'multiple')) !!}
                                        </div>
                                    </div>
                                    {{--<div class="form-group @if ($errors->has('values')) has-error @endif">--}}
                                    {{--{!! Form::label('values', 'Свойства', array('class'=>'col-sm-3 control-label')) !!}--}}
                                    {{--<div class="col-sm-9">--}}
                                    {{--{!! Form::textarea('values', null, array('class'=>'form-control', 'rows'=>'2')) !!}--}}
                                    {{--@if ($errors->has('values')) <p class="help-block">{{ $errors->first('values') }}</p> @endif--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <hr>


                                    <div class="form-group">
                                        <label for="inputPassword4" class="col-sm-3 control-label">Сопутствующие
                                            товары</label>
                                        <div class="col-md-9">
                                            {!! Form::select('related[]', $Prods, $myProds, array('class'=>'form-control input-sm select2', 'style'=>'width: 100%', 'multiple'=>'multiple')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="quantity">Количество</label>
                                        <div class="col-md-9">
                                            <input name="quantity" class="form-control input-sm"
                                                   value="{{$product->quantity}}" type="number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4" class="col-sm-3 control-label">В наличии</label>
                                        <div class="col-md-9">
                                            <label class="col-md-12">
                                                {!! Form::checkbox('isset', 'true', $product->isset, array('class' => 'minimal')) !!}
                                                есть
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane " id="images">
                                    <br>
                                    <h4>Уже добавленные изображения</h4>
                                    <div style="margin-top: 20px" class="row">
                                        @foreach($product->images as $image)
                                            <div style="margin-bottom: 10px" class="col-md-3">
                                                <button style="position: absolute; right: -1px; margin-top: 10px; margin-right: 20px"
                                                        class="delete_old_image btn btn-danger"><i class="fa fa-trash"
                                                                                                   aria-hidden="true"></i>
                                                </button>
                                                <img style="width: 100%;height: 300px"
                                                     src="{{asset('files/products/img/'.$image->url)}}"
                                                     class="img img-responsive" alt="">
                                                <input type="hidden" name="images_old[]" value="{{$image->id}}">
                                                <label class="control-label" for="links[]">Ссылка:</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button class="btn btn-success image-add">
                                        Добавить изображение
                                    </button>
                                    <hr>
                                    <div class="row product-images">
                                    </div>

                                </div>
                                @foreach($languages as $language)
                                    <div class="tab-pane " id="{{$language->code}}">
                                        <ul class="nav nav-tabs">
                                            <br>
                                            <li><a href="#parameters_{{$language->code}}" class="active"
                                                   data-toggle="tab">Характеристики</a></li>
                                            <li><a href="#options_{{$language->code}}" data-toggle="tab">Опции</a></li>
                                            <li><a href="#seo_{{$language->code}}" data-toggle="tab">Seo</a></li>
                                            <li><a href="#description_{{$language->code}}"
                                                   data-toggle="tab">Описание</a></li>
                                        </ul>

                                        <div class="tab-content ">
                                            <div class="tab-pane active " id="parameters_{{$language->code}}">
                                                <div class="container-fluid text-center">
                                                    <h4>Характеристики</h4>
                                                    <button class="btn btn-primary btn-md add_button"
                                                            data-lang="{{$language->id}}" type="button">
                                                        Добавить +
                                                    </button>
                                                    @foreach($parameters_description[$language->code] as $parameter)
                                                        <div class="form-inline" role="form">
                                                            <br>
                                                            <div class="form-group">
                                                                <label for="parameter" class="sr-only">Параметр</label>
                                                                <div class="input-group">
                                                                            <span class="input-group-btn">
                                                                            <button class="btn btn-default add_parameter" type="button"><i class="glyphicon glyphicon-plus"></i></button>
                                                                            </span>
                                                                              <select class="form-control select-opt"
                                                                            name="parameter_id_{{$language->code}}[]">
                                                                        @foreach($parameters[$language->code] as $item)
                                                                            <option @if($item->title === $parameter->title) selected @endif value="{{$item->id}}">{{$parameter->title}} @if($item->unit !='undefind')
                                                                                    ({{$item->unit}}
                                                                                    ) @endif</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="value" class="sr-only">Значение
                                                                        параметра</label>
                                                                    <input type="text" value="{{$parameter->value}}" class="form-control"
                                                                           name="parameter_value_{{$language->code}}[]"
                                                                           placeholder="Значение параметра" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <button class="btn btn-default remove_button"
                                                                            type="button"><i
                                                                                class="glyphicon glyphicon-minus"></i>
                                                                    </button>


                                                                </div>


                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>


                                                <hr>
                                            </div>
                                            <div class="tab-pane" id="options_{{$language->code}}">
                                                <div class="container-fluid text-center">
                                                    <h4>Опции</h4>
                                                    <button class="btn btn-primary btn-md add_option" type="button">
                                                        Добавить +
                                                    </button>
                                                    <hr>
                                                    <ul class="list-group margin-top-10">
                                                        <li class="list-group-item active">
                                                            <input type="text" placeholder="Название группы опций"
                                                                   class="form-control">
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <input type="text" placeholder="Значение"
                                                                           class="form-control">
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <input type="text" placeholder="цена"
                                                                           class="form-control">
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <button data-id="" class="btn btn-success value-add">
                                                                Добавить значение
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>


                                                <hr>
                                            </div>
                                            <div class="tab-pane" id="seo_{{$language->code}}">
                                                <br>
                                                <div class="form-group @if ($errors->has('title')) has-error @endif">
                                                    {!! Form::label('title_'.$language->code, 'Title', array('class'=>'col-sm-3 control-label')) !!}
                                                    <div class="col-sm-9">
                                                        {!! Form::text('title_'.$language->code, $product_description[$language->code]->title, array('class'=>'form-control')) !!}
                                                        @if ($errors->has('title_'.$language->code)) <p
                                                                class="help-block">{{ $errors->first('title_'.$language->code) }}</p> @endif
                                                    </div>
                                                </div>
                                                <div class="form-group @if ($errors->has('keywords')) has-error @endif">
                                                    {!! Form::label('keywords_'.$language->code, 'Keywords', array('class'=>'col-sm-3 control-label')) !!}
                                                    <div class="col-sm-9">
                                                        {!! Form::text('keywords_'.$language->code, $product_description[$language->code]->keywords, array('class'=>'form-control')) !!}
                                                        @if ($errors->has('keywords_'.$language->code)) <p
                                                                class="help-block">{{ $errors->first('keywords_'.$language->code) }}</p> @endif
                                                    </div>
                                                </div>
                                                <div class="form-group @if ($errors->has('keywords')) has-error @endif">
                                                    {!! Form::label('description_meta_'.$language->code, 'Description meta', array('class'=>'col-sm-3 control-label')) !!}
                                                    <div class="col-sm-9">
                                                        {!! Form::text('description_meta_'.$language->code, $product_description[$language->code]->description_meta, array('class'=>'form-control')) !!}
                                                        @if ($errors->has('description_meta_'.$language->code)) <p
                                                                class="help-block">{{ $errors->first('description_meta_'.$language->code) }}</p> @endif
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>

                                            <div class="tab-pane" id="description_{{$language->code}}">
                                                <br>
                                                <div class="form-group @if ($errors->has('name')) has-error @endif">
                                                    {!! Form::label('name_'.$language->code, 'Название', array('class'=>'col-sm-3 control-label')) !!}
                                                    <div class="col-sm-4">
                                                        {!! Form::text('name_'.$language->code, $product_description[$language->code]->name, array('class'=>'form-control')) !!}
                                                        @if ($errors->has('name_'.$language->code)) <p
                                                                class="help-block">{{ $errors->first('name_'.$language->code) }}</p> @endif
                                                    </div>
                                                </div>
                                                <div class="form-group @if ($errors->has('description')) has-error @endif">
                                                    {!! Form::label('description_'.$language->code, 'Описание', array('class'=>'col-sm-3 control-label')) !!}
                                                    <div class="col-sm-9">
                                                        {!! Form::textarea('description_'.$language->code, $product_description[$language->code]->description, array('class'=>'form-control', 'rows'=>'2')) !!}
                                                        @if ($errors->has('description_'.$language->code)) <p
                                                                class="help-block">{{ $errors->first('description_'.$language->code) }}</p> @endif
                                                    </div>
                                                </div>
                                                <div class="form-group @if ($errors->has('description_full_'.$language->code)) has-error @endif">
                                                    {!! Form::label('description_full_'.$language->code, 'Детальное описание', array('class'=>'col-sm-3 control-label')) !!}
                                                    <div class="col-sm-9">
                                                        <textarea
                                                                name="description_full_{{$language->code}}">{!! $product_description[$language->code]->description_full !!}</textarea>
                                                        @if ($errors->has('description_full_'.$language->code)) <p
                                                                class="help-block">{{ $errors->first('description_full_'.$language->code) }}</p> @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                        </div>
                    </div>
                    <div class="form-group">
                        <div class="text-right">
                            {!! HTML::decode(Form::button('Изменить', array('type' => 'submit', 'class'=>'btn btn-success'))) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-md-3">

                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
</div>
@include("admin.layout.footer")
<!-- iCheck -->
{!! Html::script('plugins/iCheck/icheck.min.js') !!}

<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
<script>
    $(document).ready(function () {
        $('.add_button').click(function () {
            var button;
            var list;

            button = $(this); // объект кнопка
            var lang = $(button).data('lang');
            $.ajax({
                url: SYS_URL + '/admin/content/product/getParameters',
                type: "POST",
                data: {
                    lang: lang
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function ($list) {
                    button.after($list);
                },
                error: function (msg) {
                    console.log(msg);
                }
            });
        });


        $(document).on('click', '.remove_button', function () {
            var block;
            if (confirm('Удалить параметр?')) {
                block = $(this).parent().parent().parent();
                block.remove();
            }
        });

        $(document).on('click', '.add_parameter', function () {
            $('#myModal').modal();
        });


        $('.save_and_close').click(function () {
                    @foreach($languages as $language)
            var title_{{$language->code}};
            var unit_{{$language->code}};

            title_{{$language->code}} = $('.parameter_modal_{{$language->code}}').val();
            unit_{{$language->code}} = $('.unit_modal_{{$language->code}}').val();
            @endforeach

            $.ajax({
                url: SYS_URL + '/admin/content/product/createParameter',
                method: 'POST',
                data: {
                    @foreach($languages as $language)
                    title_{{$language->code}}: title_{{$language->code}},
                    unit_{{$language->code}}: unit_{{$language->code}},
                    @endforeach
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (param) {
                    $('.select-opt').append($('<option>', {value: param[0], text: param[1] + ' (' + param[2] + ')'}));//добавляем к существующему списку новый параметр
                    $('#myModal').modal('hide');
                },
                error: function (msg) {
                    console.log(msg);
                }
            });
        });

        $('.image-add').on('click', function () {
            $('.product-images').append('<div class="col-md-4"><a href="#" style="position: absolute; right: 20px" class="product-image-remove"><i class="fa fa-trash-o" aria-hidden="true"></i></a><input class="form-control" type="file" name="product_images[]"></div>')
            return false;
        });
        $('.delete_old_image').click(function () {
            $(this).parent().remove();
        })

        $('.add_option').on('click', function () {
            $(this).after('<input class="form-control" type="text">')
        });
        $('.product-images').on('click', '.product-image-remove', function () {
            $(this).parent().remove();
            return false;
        })

    });
</script>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    @foreach($languages as $language)
        CKEDITOR.replace('description_full_{{$language->code}}');
    @endforeach
</script>
<!-- page script -->
<script type="text/javascript">
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
    $(".select2").select2({
        maximumSelectionSize: 4
    });
</script>
</body>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Добавить параметр</h4>
            </div>
            <div class="modal-body">

                <ul class="nav nav-tabs">
                    @foreach($languages as $language)
                        <li><a href="#opt_{{$language->code}}" data-toggle="tab"><img class="flag-lang"
                                                                                      src="{{asset($language->image)}}"
                                                                                      width="16"
                                                                                      height="11"
                                                                                      alt="lang"/></a></li>
                    @endforeach
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @foreach($languages as $language)
                        <div class="tab-pane" id="opt_{{$language->code}}">
                            <br>
                            <input type="text" class="form-control parameter_modal_{{$language->code}}"
                                   name="parameter_{{$language->code}}"
                                   placeholder="Наименование параметра"/><br>
                            <input type="text" class="form-control unit_modal_{{$language->code}}"
                                   name="unit_{{$language->code}}"
                                   placeholder="Единица измерения"/>
                        </div>
                    @endforeach
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary save_and_close">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
</html>