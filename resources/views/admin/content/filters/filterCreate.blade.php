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
                Добавление фильтра в группу фильтров
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li>Слайдера</li>
                <li class="active">Добавление фильтра в группу фильтров</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Информация о фильтре</h3>
                        </div>
                        <div class="box-body">
                            <form enctype="multipart/form-data" action="{{url('admin/content/filters/store')}}"
                                  method="post">

                                {!! csrf_field() !!}
                                <div class="container-fluid">

                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#main" data-toggle="tab">Общее</a></li>

                                        @foreach($languages as $language)
                                            <li><a href="#{{$language->code}}" data-toggle="tab"><img
                                                            class="flag-lang"
                                                            src="{{asset($language->image)}}"
                                                            width="16"
                                                            height="11"
                                                            alt="lang"/></a></li>
                                        @endforeach

                                    </ul>


                                    <div class="tab-content">
                                        <hr>
                                        <div class="tab-pane active" id="main">
                                            <div class="form-group">
                                                <label for="type">Группа фильтра</label>
                                                <select class="form-control input-sm select2 " name="group">
                                                    @foreach($groups as $group)
                                                        <option value="{{$group->id}}">{{$group->description_ru->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('group')) <p
                                                        class="help-block">{{ $errors->first('group') }}</p> @endif
                                            </div>
                                        </div>
                                        @foreach($languages as $language)
                                            <div class="tab-pane" id="{{$language->code}}">
                                                <div class="form-group">
                                                    <label for="value_{{$language->code}}">Значение</label>
                                                    <input type="text" class="form-control" name="value_{{$language->code}}">
                                                    @if ($errors->has('value_'.$language->code)) <p
                                                            class="help-block">{{ $errors->first('value_'.$language->code) }}</p> @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>


                                </div>

                                <hr>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-md">
                                        Добавить фильтр
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