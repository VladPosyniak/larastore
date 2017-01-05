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
                Редактирование фильтра
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">{{Setting::get('config.sitename')}}</a></li>
                <li>Слайдера</li>
                <li class="active">Редактирование фильтра</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Информация о группе</h3>
                        </div>
                        <div class="box-body">
                            <form action="{{url('admin/content/filters/update/'.$filter1->id)}}"
                                  method="post">
                                <input type="hidden" name="_method" value="PATCH">
                                {!! csrf_field() !!}
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="description">Значение</label>
                                        <input type="text" class="form-control" value="{{$filter1->value}}" name="value">
                                        @if ($errors->has('value')) <p
                                                class="help-block">{{ $errors->first('value') }}</p> @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Класс товаров</label>
                                        <select class="form-control input-sm select2 " name="group">
                                            @foreach($groups as $group)
                                                <option @if($group->id === $filter1->filter_group_id) selected @endif value="{{$group->id}}">{{$group->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('group')) <p
                                                class="help-block">{{ $errors->first('group') }}</p> @endif
                                    </div>
                                </div>

                                <hr>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-md">
                                        Изменить фильтр
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