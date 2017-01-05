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
            Редактирование категории
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li>Категории товаров</li>
                <li class="active">Редактирование категории</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Информация о категории</h3>
                        </div>
                        <div class="box-body">

                            {!! Form::model($cat, array('action' => array('ContentController@updateCat', $cat->id), 'method'=> 'PATCH', 'files'=>true, 'class'=>'form-horizontal')) !!}

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                {!! Form::label('name', 'Название', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('name', null, array('class'=>'form-control')) !!}
                                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('description')) has-error @endif">
                                {!! Form::label('description', 'Описание', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('description', null, array('class'=>'form-control')) !!}
                                    @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('class')) has-error @endif" >
                                <label class="col-sm-3 control-label">Класс товаров</label>
                                <div class="col-sm-9">
                                    <select name="class" class="form-control">
                                        <option value="{{$currentClass->id}}">{{$currentClass->name}}</option>
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('description')) <p
                                            class="help-block">{{ $errors->first('description') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('urlhash')) has-error @endif">
                                {!! Form::label('urlhash', 'URL-имя', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">{!! URL::to('/') !!}/{{$currentClass->urlhash}}/</span>
                                        {!! Form::text('urlhash', null, array('class'=>'form-control')) !!}

                                    </div>
                                    @if ($errors->has('urlhash')) <p class="help-block">{{ $errors->first('urlhash') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('cover')) has-error @endif">
                                {!! Form::label('cover', 'Изображение', array('class'=>'col-sm-3 control-label')) !!}
                                @if ($cat->cover)
                                <div class="col-sm-5">
                                    <img style=" max-height: 50px; " src="{!! asset('files/cats/img/'.$cat->cover) !!}" alt="4" class="img-responsive">
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::file('cover', null, array('class'=>'form-control')) !!}
                                    @if ($errors->has('cover')) <p class="help-block">{{ $errors->first('cover') }}</p> @endif
                                </div>
                                @else
                                <div class="col-sm-9">
                                    {!! Form::file('cover', null, array('class'=>'form-control')) !!}
                                    @if ($errors->has('cover')) <p class="help-block">{{ $errors->first('cover') }}</p> @endif
                                </div>
                                @endif
                            </div>

                            <h4>SEO категории</h4>
                            <div class="form-group @if ($errors->has('title')) has-error @endif">
                                {!! Form::label('title', 'Название', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('title',null, array('class'=>'form-control')) !!}
                                    @if ($errors->has('title')) <p
                                            class="help-block">{{ $errors->first('title') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('keywords')) has-error @endif">
                                {!! Form::label('keywords', 'Ключевые слова', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('keywords', null, array('class'=>'form-control')) !!}
                                    @if ($errors->has('keywords')) <p
                                            class="help-block">{{ $errors->first('keywords') }}</p> @endif
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

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-8">
                                    {!! HTML::decode(Form::button('Сохранить', array('type' => 'submit', 'class'=>'btn btn-success'))) !!}
                                </div>
                            </div>
                            {!! Form::close(); !!}
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