@include("admin.layout.header")
<!-- iCheck -->
{!! Html::style('plugins/iCheck/square/blue.css'); !!}
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
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Информация о продукте</h3>
                        </div>
                        <div class="box-body">

                            {!! Form::model($product, array('action' => array('ContentController@updateProduct', $product->id), 'method'=> 'PATCH', 'files'=>true, 'class'=>'form-horizontal')) !!}
                            {{ csrf_field() }}
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#main" data-toggle="tab">Общее</a></li>
                                <li><a href="#parameters" data-toggle="tab">Характеристики</a></li>
                                <li><a href="#options" data-toggle="tab">Опции</a></li>
                                <li><a href="#seo" data-toggle="tab">Seo</a></li>
                                <li><a href="#description" data-toggle="tab">Описание</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active " id="main">
                                    <br>
                                    <div class="form-group">
                                        {!! Form::label('price', 'Цена', array('class'=>'col-sm-3 control-label')) !!}

                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                {{--{!! Form::text('price', null, array('class'=>'form-control')) !!}--}}
                                                <input type="text" name="price"
                                                       value="{{currencyWithoutPrefix($product->price,'UAH')}}"
                                                       class="form-control">
                                                <span class="input-group-addon">грн.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        {!! Form::label('price_old', 'Старая цена', array('class'=>'col-sm-3 control-label')) !!}

                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                {{--{!! Form::text('price_old', null, array('class'=>'form-control')) !!}--}}
                                                <input type="text" name="price_old"
                                                       value="{{currencyWithoutPrefix($product->price_old,'UAH')}}"
                                                       class="form-control">
                                                <span class="input-group-addon">грн.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4" class="col-sm-3 control-label">Категория</label>
                                        <div class="col-md-9">
                                            {!! Form::select('categories_id', $CatList, Null, array('class'=>'form-control input-sm select2', 'style'=>'width: 100%')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group @if ($errors->has('cover')) has-error @endif">
                                        {!! Form::label('cover', 'Изображение', array('class'=>'col-sm-3 control-label')) !!}
                                        <div class="col-sm-2"><img style="max-height: 50px;" class="img responsive"
                                                                   @if ($product->cover)
                                                                   src="{{ asset('files/products/img/small/'.$product->cover) }}"
                                                                   @else
                                                                   src="{{ asset('dist/img/boxed-bg.png') }}"
                                                    @endif
                                            >
                                        </div>
                                        <div class="col-sm-3">
                                            {!! Form::file('cover', null, array('class'=>'form-control')) !!}
                                            @if ($errors->has('cover')) <p
                                                    class="help-block">{{ $errors->first('cover') }}</p> @endif
                                        </div>
                                        {{--{!! Form::label('label', 'Label', array('class'=>'col-sm-2 control-label')) !!}--}}
                                        {{--<div class="col-sm-2">--}}
                                        {{--{!! Form::text('label', null, array('class'=>'form-control')) !!}--}}
                                        {{--@if ($errors->has('label')) <p class="help-block">{{ $errors->first('label') }}</p> @endif--}}
                                        {{--</div>--}}
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword4" class="col-sm-3 control-label">Фильтры</label>
                                        <div class="col-md-9">
                                            {!! Form::select('filters[]', $filters, $myfilters_arr, array('class'=>'form-control input-sm select2', 'style'=>'width: 100%', 'multiple'=>'multiple')) !!}
                                        </div>
                                    </div>

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
                                            <input name="quantity" value="{{$product->quantity}}"
                                                   class="form-control input-sm"
                                                   type="number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4" class="col-sm-3 control-label">В наличии</label>
                                        <div class="col-md-9">
                                            <label class="col-md-12">
                                                {!! Form::checkbox('isset', 'true', null, array('class' => 'minimal')) !!}
                                                есть
                                            </label>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane" id="parameters">
                                    <div class="container-fluid text-center">
                                        <h4>Характеристики</h4>
                                        <button class="btn btn-primary btn-md add_button" type="button">Добавить +
                                        </button>
                                        @foreach($my_parameters as $my_parameter)
                                            <div class="form-inline" role="form">
                                                <br>
                                                <div class="form-group">
                                                    <label for="parameter" class="sr-only">Параметр</label>
                                                    <div class="input-group">
                                            <span class="input-group-btn">
                                            <button class="btn btn-default add_parameter" type="button"><i
                                                        class="glyphicon glyphicon-plus"></i></button>
                                            </span>
                                                        <select class="form-control" name="parameter_id[]">
                                                            @foreach($parameters as $parameter)
                                                                <option value="{{$parameter->id}}"
                                                                        @if($my_parameter->parameters_id == $parameter->id) selected="selected" @endif >{{$parameter->title}} @if($parameter->unit !='undefind')
                                                                        ({{$parameter->unit}}) @endif</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="value" class="sr-only">Значение параметра</label>
                                                        <input class="form-control" value="{{$my_parameter->value}}"
                                                               name="parameter_value[]"
                                                               placeholder="Значение параметра"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-default remove_button" type="button"><i
                                                                    class="glyphicon glyphicon-minus"></i>
                                                        </button>


                                                    </div>


                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="tab-pane" id="options">
                                    <div class="container-fluid text-center">
                                        <h4>Опции</h4>
                                        <button class="btn btn-primary btn-md add_option" type="button">Добавить +
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
                                                        <input type="text" placeholder="Значение" class="form-control">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input type="text" placeholder="цена" class="form-control">
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <button data-id="" class="btn btn-success value-add">Добавить значение
                                                </button>
                                            </li>
                                        </ul>
                                    </div>


                                    <hr>
                                </div>

                                <div class="tab-pane" id="seo">
                                    <br>
                                    <div class="form-group @if ($errors->has('title')) has-error @endif">
                                        {!! Form::label('title', 'Title', array('class'=>'col-sm-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('title', null, array('class'=>'form-control')) !!}
                                            @if ($errors->has('title')) <p
                                                    class="help-block">{{ $errors->first('title') }}</p> @endif
                                        </div>
                                    </div>
                                    <div class="form-group @if ($errors->has('keywords')) has-error @endif">
                                        {!! Form::label('keywords', 'Keywords', array('class'=>'col-sm-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('keywords', null, array('class'=>'form-control')) !!}
                                            @if ($errors->has('keywords')) <p
                                                    class="help-block">{{ $errors->first('keywords') }}</p> @endif
                                        </div>
                                    </div>
                                    <hr>
                                </div>

                                <div class="tab-pane" id="description">
                                    <br>
                                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                                        {!! Form::label('name', 'Название', array('class'=>'col-sm-3 control-label')) !!}
                                        <div class="col-sm-4">
                                            {!! Form::text('name', null, array('class'=>'form-control')) !!}
                                            @if ($errors->has('name')) <p
                                                    class="help-block">{{ $errors->first('name') }}</p> @endif
                                        </div>
                                    </div>
                                    <div class="form-group @if ($errors->has('description')) has-error @endif">
                                        {!! Form::label('description', 'Описание', array('class'=>'col-sm-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::textarea('description', null, array('class'=>'form-control', 'rows'=>'2')) !!}
                                            @if ($errors->has('description')) <p
                                                    class="help-block">{{ $errors->first('description') }}</p> @endif
                                        </div>
                                    </div>
                                    <div class="form-group @if ($errors->has('description_full')) has-error @endif">
                                        {!! Form::label('description_full', 'Детальное описание', array('class'=>'col-sm-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::textarea('description_full', null, array('class'=>'form-control', 'rows'=>'2')) !!}
                                            @if ($errors->has('description_full')) <p
                                                    class="help-block">{{ $errors->first('description_full') }}</p> @endif
                                        </div>
                                    </div>

                                </div>
                            </div>


                            {{--<div class="form-group">--}}
                            {{--<label for="inputPassword4" class="col-sm-3 control-label">Опции цен</label>--}}
                            {{--<div class="col-md-9">--}}
                            {{--{!! Form::select('opts[]', $opt_arr, $myopt_arr, array('class'=>'form-control input-sm select2', 'style'=>'width: 100%', 'multiple'=>'multiple')) !!}--}}

                            {{--</div>--}}
                            {{--</div>--}}





                            {{--<div class="form-group @if ($errors->has('urlhash')) has-error @endif">--}}
                            {{--{!! Form::label('urlhash', 'URL-имя', array('class'=>'col-sm-3 control-label')) !!}--}}
                            {{--<div class="col-sm-9">--}}
                            {{--<div class="input-group">--}}
                            {{--<span class="input-group-addon">{!! URL::to('/') !!}/</span>--}}
                            {{--{!! Form::text('urlhash', null, array('class'=>'form-control')) !!}--}}
                            {{--<span class="input-group-addon">.html</span>--}}
                            {{--</div>--}}
                            {{--@if ($errors->has('urlhash')) <p class="help-block">{{ $errors->first('urlhash') }}</p> @endif--}}
                            {{--</div>--}}
                            {{--</div>--}}



                        </div>
                    </div>
                    <div class="form-group">
                        <div class="text-right">
                            {!! HTML::decode(Form::button('Изменить', array('type' => 'submit', 'class'=>'btn btn-success'))) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
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
            $.ajax({
                url: SYS_URL + '/admin/content/product/getParameters',
                type: "POST",
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
        })


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
            var title;
            var unit;
            title = $('.paramenter_modal').val();
            unit = $('.unit_modal').val();
            $.ajax({
                url: SYS_URL + '/admin/content/product/createParameter',
                method: 'POST',
                data: {title: title, unit: unit},
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (param) {
                    $('select').append($('<option>', {value: param[0], text: param[1] + ' (' + param[2] + ')'}));//добавляем к существующему списку новый параметр
                    $('#myModal').modal('hide');
                },
                error: function (msg) {
                    console.log(msg);
                }
            });
        });

    });
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Добавить параметр</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control paramenter_modal" name="parameter"
                       placeholder="Наименование параметра"/><br>
                <input type="text" class="form-control unit_modal" name="unit" placeholder="Единица измерения"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary save_and_close">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>


</html>