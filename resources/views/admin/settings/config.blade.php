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
                Основные настройки
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Основные настройки</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#">
                                </p>
                            @endif
                        @endforeach
                    </div> <!-- end .flash-message -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Конфигурация</h3>
                        </div>
                        <div class="box-body">

                            {!! Form::open(array('action' => 'Admin\ConfigController@update', 'method'=> 'PATCH', 'files'=>true, 'class'=>'form-horizontal')) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group @if ($errors->has('logo')) has-error @endif">
                                {!! Form::label('logo', 'Логотип', array('class'=>'col-sm-3 control-label')) !!}
                                @if (Setting::get('config.logo'))
                                    <div class="col-sm-5">
                                        <img style=" max-height: 50px; "
                                             src="{!! asset('files/img/'.Setting::get('config.logo')) !!}" alt="4"
                                             class="img-responsive">
                                    </div>
                                    <div class="col-sm-4">
                                        {!! Form::file('logo', null, array('class'=>'form-control')) !!}
                                        @if ($errors->has('logo')) <p
                                                class="help-block">{{ $errors->first('logo') }}</p> @endif
                                    </div>
                                @else
                                    <div class="col-sm-9">
                                        {!! Form::file('logo', null, array('class'=>'form-control')) !!}
                                        @if ($errors->has('logo')) <p
                                                class="help-block">{{ $errors->first('logo') }}</p> @endif
                                    </div>
                                @endif
                            </div>
                            <!-- Фавикон-->
                            <div class="form-group @if ($errors->has('favicon')) has-error @endif">
                                {!! Form::label('favicon', 'Фавикон', array('class'=>'col-sm-3 control-label')) !!}
                                @if (Setting::get('config.favicon'))
                                    <div class="col-sm-5">
                                        <img style=" max-height: 50px; "
                                             src="{!! asset('favicon.ico') !!}" alt="4" class="img-responsive">
                                    </div>
                                    <div class="col-sm-4">
                                        {!! Form::file('favicon', null, array('class'=>'form-control')) !!}
                                        @if ($errors->has('favicon')) <p
                                                class="help-block">{{ $errors->first('favicon') }}</p> @endif
                                    </div>
                                @else
                                    <div class="col-sm-9">
                                        {!! Form::file('favicon', null, array('class'=>'form-control')) !!}
                                        @if ($errors->has('favicon')) <p
                                                class="help-block">{{ $errors->first('favicon') }}</p> @endif
                                    </div>
                                @endif
                            </div>


                            {{--<div class="form-group @if ($errors->has('sitecolor')) has-error @endif">--}}
                                {{--{!! Form::label('sitecolor', 'Цвет сайта', array('class'=>'col-sm-3 control-label')) !!}--}}
                                {{--<div class="col-sm-9">--}}
                                    {{--{!! Form::text('sitecolor', Setting::get('config.sitecolor'), array('class'=>'form-control')) !!}--}}
                                    {{--@if ($errors->has('sitecolor')) <p--}}
                                            {{--class="help-block">{{ $errors->first('sitecolor') }}</p> @endif--}}
                                {{--</div>--}}
                            {{--</div>--}}


                            <div class="form-group @if ($errors->has('sitename')) has-error @endif">
                                {!! Form::label('sitename', 'Название сайта', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('sitename', Setting::get('config.sitename'), array('class'=>'form-control')) !!}
                                    @if ($errors->has('sitename')) <p
                                            class="help-block">{{ $errors->first('sitename') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('sitedesc')) has-error @endif">
                                {!! Form::label('sitedesc', 'Описание', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::textarea('sitedesc', Setting::get('config.sitedesc'), array('class'=>'form-control', 'rows'=>'2')) !!}
                                    @if ($errors->has('sitedesc')) <p
                                            class="help-block">{{ $errors->first('sitedesc') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('email')) has-error @endif">
                                {!! Form::label('email', 'E-mail', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('email', Setting::get('config.email'), array('class'=>'form-control')) !!}
                                    @if ($errors->has('email')) <p
                                            class="help-block">{{ $errors->first('email') }}</p> @endif
                                </div>
                            </div>
                            <hr>

                            {{--temlate settings--}}
                            <em>Настройки шаблона</em>
                            <div class="form-group @if ($errors->has('theme_color')) has-error @endif">
                                {!! Form::label('theme_color', 'Тема', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    <select name="theme_color" class="form-control">
                                        <option @if(Setting::get('view.theme_color') == ' ') selected @endif value=" ">
                                            Стандартная
                                        </option>
                                        <option @if(Setting::get('view.theme_color') == 'bg-grey') selected
                                                @endif value="bg-grey">Серый задний фон
                                        </option>
                                        <option @if(Setting::get('view.theme_color') == 'grain-grey') selected
                                                @endif value="grain-grey">Зернисто серый
                                        </option>
                                        <option @if(Setting::get('view.theme_color') == 'grain-blue') selected
                                                @endif value="grain-blue">Зернисто синий
                                        </option>
                                        <option @if(Setting::get('view.theme_color') == 'grain-green') selected
                                                @endif value="grain-green">Зернисто зеленый
                                        </option>
                                        <option @if(Setting::get('view.theme_color') == 'grain-orange') selected
                                                @endif value="grain-orange">Зернисто оранжевый
                                        </option>
                                        <option @if(Setting::get('view.theme_color') == 'grain-yellow') selected
                                                @endif value="grain-yellow">Зернисто желтый
                                        </option>
                                    </select>
                                    @if ($errors->has('theme_color')) <p
                                            class="help-block">{{ $errors->first('theme_color') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('theme_smoothscroll')) has-error @endif">
                                {!! Form::label('theme_smoothscroll', 'Плавная прокрутка', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <input name="theme_smoothscroll" type="checkbox" @if(Setting::get('view.theme_smoothscroll')) checked @endif>
                                        </label>
                                    </div>
                                    @if ($errors->has('theme_smoothscroll')) <p
                                            class="help-block">{{ $errors->first('theme_smoothscroll') }}</p> @endif
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-8">
                                    {!! HTML::decode(Form::button('Сохранить', array('type' => 'submit', 'class'=>'btn btn-success'))) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
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