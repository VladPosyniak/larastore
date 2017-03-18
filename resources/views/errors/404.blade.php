@extends('layout.main')

@section('seo')
    <title>404</title>
@endsection

@section('page')

    <section class="page-header dark">
        <div class="container">

            <h1>Страница не найдена!</h1>

            <!-- breadcrumbs -->
            <ol class="breadcrumb">
                <li><a href="/">Главная</a></li>
                <li class="active">Ошибка 404</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->




    <!-- -->
    <section class="padding-xlg">
        <div class="container">

            <div class="row">

                <div class="col-md-6 col-sm-6 hidden-xs">

                    <div class="error-404">
                        404
                    </div>

                </div>

                <div class="col-md-6 col-sm-6">

                    <h3 class="nomargin">Извините, <strong>но данная страница не существует!</strong></h3>
                    <p class="nomargin-top size-20 font-lato text-muted">Пожалуйста, воспользуйтесь поиском.</p>

                    <!-- INLINE SEARCH -->
                    <div class="inline-search clearfix margin-bottom-60">
                        <form action="{{url('/search')}}" method="get" class="widget_search">
                            <input type="search" placeholder="{{trans('layout.search')}}" id="s" name="keyword" class="serch-input">
                            <button type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                            <div class="clear"></div>
                        </form>
                    </div>
                    <!-- /INLINE SEARCH -->

                    <div class="divider nomargin-bottom"><!-- divider --></div>

                    <a class="size-16 font-lato" href="{{redirect()->back()}}"><i class="glyphicon glyphicon-menu-left margin-right-10 size-12"></i> Вернуться на предыдущую страницу</a>

                </div>

            </div>

        </div>
    </section>
    <!-- / -->
@endsection