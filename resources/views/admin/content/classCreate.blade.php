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
                Создание класса
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li>Классы товаров</li>
                <li class="active">Создание класса</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    @if($errors->has())
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4>Данные класса не прошли валидацию!</h4>
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
                            <h3 class="box-title">Информация о классе</h3>
                        </div>
                        <div class="box-body">

                            {!! Form::open(array('action' => 'Admin\ClassController@storeClass', 'method'=> 'POST', 'files' => true, 'class'=>'form-horizontal')) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#main" data-toggle="tab">Общее</a></li>
                                @foreach($languages as $language)
                                    <li class=""><a href="#{{$language->code}}" data-toggle="tab"><img
                                                    class="flag-lang"
                                                    src="{{asset($language->image)}}"
                                                    width="16"
                                                    height="11"
                                                    alt="lang"/></a></li>
                                @endforeach
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="main">
                                    <br>
                                    <div class="form-group @if ($errors->has('urlhash')) has-error @endif">
                                        {!! Form::label('urlhash', 'URL-имя', array('class'=>'col-sm-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <span class="input-group-addon">{!! URL::to('/catalog') !!}/</span>
                                                {!! Form::text('urlhash', null, array('class'=>'form-control')) !!}

                                            </div>
                                            @if ($errors->has('urlhash')) <p
                                                    class="help-block">{{ $errors->first('urlhash') }}</p> @endif
                                        </div>
                                    </div>
                                    <div class="form-group @if ($errors->has('cover')) has-error @endif">
                                        {!! Form::label('cover', 'Изображение', array('class'=>'col-sm-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::file('cover', null, array('class'=>'form-control')) !!}
                                            @if ($errors->has('cover')) <p
                                                    class="help-block">{{ $errors->first('cover') }}</p> @endif
                                        </div>
                                    </div>
                                </div>
                                @foreach($languages as $language)
                                    <div class="tab-pane" id="{{$language->code}}">
                                        <br>
                                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                                            {!! Form::label('name', 'Название', array('class'=>'col-sm-3 control-label')) !!}
                                            <div class="col-sm-9">
                                                {!! Form::text('name_'.$language->code, null, array('class'=>'form-control')) !!}
                                                @if ($errors->has('name_'.$language->code)) <p
                                                        class="help-block">{{ $errors->first('name_'.$language->code) }}</p> @endif
                                            </div>
                                        </div>

                                        <h4>SEO класса</h4>
                                        <div class="form-group @if ($errors->has('title_'.$language->code)) has-error @endif">
                                            {!! Form::label('title', 'Название', array('class'=>'col-sm-3 control-label')) !!}
                                            <div class="col-sm-9">
                                                {!! Form::text('title_'.$language->code,null, array('class'=>'form-control')) !!}
                                                @if ($errors->has('title_'.$language->code)) <p
                                                        class="help-block">{{ $errors->first('title_'.$language->code) }}</p> @endif
                                            </div>
                                        </div>
                                        <div class="form-group @if ($errors->has('keywords_'.$language->code)) has-error @endif">
                                            {!! Form::label('keywords_'.$language->code, 'Ключевые слова', array('class'=>'col-sm-3 control-label')) !!}
                                            <div class="col-sm-9">
                                                {!! Form::text('keywords_'.$language->code, null, array('class'=>'form-control')) !!}
                                                @if ($errors->has('keywords_'.$language->code)) <p
                                                        class="help-block">{{ $errors->first('keywords_'.$language->code) }}</p> @endif
                                            </div>
                                        </div>
                                        <div class="form-group @if ($errors->has('description_'.$language->code)) has-error @endif">
                                            {!! Form::label('description_'.$language->code, 'Описание', array('class'=>'col-sm-3 control-label')) !!}
                                            <div class="col-sm-9">
                                                {!! Form::textarea('description_'.$language->code, null, array('class'=>'form-control', 'rows'=>'2')) !!}
                                                @if ($errors->has('description_'.$language->code)) <p
                                                        class="help-block">{{ $errors->first('description_'.$language->code) }}</p> @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>





                        </div>
                    </div>
                    <div class="form-group text-right">
                        <div class="col-sm-offset-3 col-sm-8">
                            {!! HTML::decode(Form::button('Создать', array('type' => 'submit', 'class'=>'btn btn-success'))) !!}
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
@include("admin.layout.footer")
<!-- page script -->
</body>
</html>