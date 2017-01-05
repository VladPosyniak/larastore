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
                Настройки SEO
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Настройки SEO</li>
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
                        <div class="box-header">
                            <h3 class="box-title">SEO настройки страниц</h3>
                        </div>
                        <div class="box-body">

                            {!! Form::open(array('action' => 'Admin\ConfigController@updateSeo', 'method'=> 'PATCH', 'files'=>true, 'class'=>'form-horizontal')) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <em>SEO главной страницы</em>
                            <div class="form-group @if ($errors->has('home_title')) has-error @endif">
                                {!! Form::label('home_title', 'Название', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('home_title', Setting::get('seo.home_title'), array('class'=>'form-control')) !!}
                                    @if ($errors->has('home_title')) <p
                                            class="help-block">{{ $errors->first('home_title') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('home_keywords')) has-error @endif">
                                {!! Form::label('home_keywords', 'Ключевые слова', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('home_keywords', Setting::get('seo.home_keywords'), array('class'=>'form-control')) !!}
                                    @if ($errors->has('home_keywords')) <p
                                            class="help-block">{{ $errors->first('home_keywords') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('home_description')) has-error @endif">
                                {!! Form::label('home_description', 'Описание', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::textarea('home_description', Setting::get('seo.home_description'), array('class'=>'form-control', 'rows'=>'2')) !!}
                                    @if ($errors->has('home_description')) <p
                                            class="help-block">{{ $errors->first('home_description') }}</p> @endif
                                </div>
                            </div>
                            <hr>
                            <em>SEO каталога</em>
                            <div class="form-group @if ($errors->has('catalog_title')) has-error @endif">
                                {!! Form::label('catalog_title', 'Название', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('catalog_title', Setting::get('seo.catalog_title'), array('class'=>'form-control')) !!}
                                    @if ($errors->has('catalog_title')) <p
                                            class="help-block">{{ $errors->first('catalog_title') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('catalog_keywords')) has-error @endif">
                                {!! Form::label('catalog_keywords', 'Ключевые слова', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('catalog_keywords', Setting::get('seo.catalog_keywords'), array('class'=>'form-control')) !!}
                                    @if ($errors->has('catalog_keywords')) <p
                                            class="help-block">{{ $errors->first('catalog_keywords') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('catalog_description')) has-error @endif">
                                {!! Form::label('catalog_description', 'Описание', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::textarea('catalog_description', Setting::get('seo.catalog_description'), array('class'=>'form-control', 'rows'=>'2')) !!}
                                    @if ($errors->has('catalog_description')) <p
                                            class="help-block">{{ $errors->first('catalog_description') }}</p> @endif
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