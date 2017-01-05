@include("admin.layout.header")
<title>Панель приборов</title>
<script src="{{asset('//cdn.ckeditor.com/4.5.10/full/ckeditor.js')}}"></script>
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
                Создание компании
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li class="active">Создание компании</li>
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

                        <div class="box-body">
                            <h3>Основные настройки компании</h3>

                            {!! Form::open(array('action' => 'DeliveryController@storeCampaign', 'method'=> 'POST', 'files'=>true, 'class'=>'form-horizontal')) !!}


                            <div class="form-group @if ($errors->has('title')) has-error @endif">
                                {!! Form::label('title', 'Название', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('title',null , array('class'=>'form-control')) !!}
                                    <small>Только для внутренего использования</small>
                                    @if ($errors->has('title')) <p
                                            class="help-block">{{ $errors->first('title') }}</p> @endif
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('subject')) has-error @endif">
                                {!! Form::label('subject', 'Тема письма', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('subject',null , array('class'=>'form-control')) !!}
                                    <small>Что-то, что сможет заинтересовать покупателя</small>
                                    @if ($errors->has('subject')) <p
                                            class="help-block">{{ $errors->first('subject') }}</p> @endif
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('from_name')) has-error @endif">
                                {!! Form::label('from_name', 'Автор компании', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('from_name',null , array('class'=>'form-control')) !!}
                                    <small>Название компании или имя автора рассылки</small>
                                    @if ($errors->has('from_name')) <p
                                            class="help-block">{{ $errors->first('from_name') }}</p> @endif
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('reply_to')) has-error @endif">
                                {!! Form::label('reply_to', 'Почта компании', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('reply_to',null , array('class'=>'form-control')) !!}
                                    <small>Почта с которой будет производиться рассылка</small>
                                    @if ($errors->has('reply_to')) <p
                                            class="help-block">{{ $errors->first('reply_to') }}</p> @endif
                                </div>
                            </div>


                            <div class="form-group @if ($errors->has('list_name')) has-error @endif">
                                {!! Form::label('list_name', 'Список подписчиков', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    <select name='list_name' class="form-control">
                                        @if(isset($lists[0]))
                                            @foreach($lists as $list)
                                                <option value="{{$list['name']}}">{{$list['name']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small>Выберите список подписчиков, которым будет отправленна компания</small>
                                    @if ($errors->has('list_name')) <p
                                            class="help-block">{{ $errors->first('list_name') }}</p> @endif
                                </div>
                            </div>

                            <hr>
                            <h3>Настройки шаблона</h3>

                            <div class="form-group @if ($errors->has('template_id')) has-error @endif">
                                {!! Form::label('template_id', 'Шаблон компании', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    <select name='template_id' class="form-control">
                                        @if(isset($templates[0]))
                                            @foreach($templates as $template)
                                                @if($template['type'] === 'user')
                                                <option value="{{$template['id']}}">{{$template['name']}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    <small>
                                        Выберите шаблон из списка.
                                        <br>
                                        Создать новый можно <a href="https://us14.admin.mailchimp.com/templates/create-template/">здесь</a>
                                    </small>
                                    @if ($errors->has('template_id')) <p
                                            class="help-block">{{ $errors->first('template_id') }}</p> @endif
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('html')) has-error @endif">
                                {!! Form::label('html', 'Содержимое письма', array('class'=>'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::textarea('html',null , array('class'=>'form-control')) !!}
                                    @if ($errors->has('html')) <p
                                            class="help-block">{{ $errors->first('html') }}</p> @endif
                                    <script>
                                        CKEDITOR.replace('html');
                                    </script>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-8">
                                    {!! HTML::decode(Form::button('Создать', array('type' => 'submit', 'class'=>'btn btn-success'))) !!}
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