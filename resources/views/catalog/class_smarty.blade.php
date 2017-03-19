@extends('layout.main')

@section('seo')
    <title>{{$currentClass->description->title}}</title>
    <meta name="keywords" content="{{$currentClass->description->keywords}}"/>
    <meta name="description" content="{{$currentClass->description->description}}"/>
@endsection

@section('page')
    <section class="page-header">
        <div class="container">

            <h1>{{mb_strtoupper($currentClass->description->name)}}</h1>

            <!-- breadcrumbs -->
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">{{trans('category_page.home')}}</a></li>
                <li><a href="{{url('/catalog')}}">{{trans('category_page.catalog')}}</a></li>
                <li class="active">{{$currentClass->description->name}}</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->

    <!-- -->
    <section>
        <div class="container">

            <div class="row">

                <!-- RIGHT -->
                <div class="col-lg-9 col-md-9 col-sm-9 col-lg-push-3 col-md-push-3 col-sm-push-3">


                    <!-- CAROUSEL -->
                    <div class="owl-carousel buttons-autohide controlls-over margin-bottom-30 radius-4"
                         data-plugin-options='{"singleItem": true, "autoPlay": 6000, "navigation": true, "pagination": true, "transitionStyle":"fade"}'>
                        <!-- item -->
                        @if(isset($sliders['catalog_&_class']))
                            @foreach($sliders['catalog_&_class']->data as $slide)
                                <div>
                                    <a href="{{$slide['link']}}">
                                        <img class="img-responsive radius-4"
                                             src="{{asset('files/sliders/'.$slide['image'])}}"
                                             width="851" height="335"
                                             alt="">
                                    </a>
                                </div>
                        @endforeach
                    @endif
                        <!-- /item -->

                    </div>
                    <!-- /CAROUSEL -->


                    <!-- LIST OPTIONS -->
                    <div class="clearfix shop-list-options margin-bottom-20">

                        <div class="options-left">
                           
                            <a class="btn active fa fa-th many-col" href="#"><!-- grid --></a>
                            <a class="btn fa fa-list one-col" href="#"><!-- list --></a>
                        </div>

                    </div>
                    <!-- /LIST OPTIONS -->


                    <ul class="shop-item-list row list-inline nomargin products">
                        @include('catalog.products_smarty')
                    </ul>

                    <hr/>

                    <!-- Pagination Default -->
                    <div class="text-center">
                        {{$products->links()}}
                    </div>
                    <!-- /Pagination Default -->

                </div>


                <!-- LEFT -->
                <div class="col-lg-3 col-md-3 col-sm-3 col-lg-pull-9 col-md-pull-9 col-sm-pull-9">

                    <!-- CATEGORIES -->
                    <div class="side-nav margin-bottom-60">

                        <div class="side-nav-head">
                            <button class="fa fa-bars"></button>
                            <h4>{{trans('category_page.categories')}}</h4>
                        </div>

                        <ul class="list-group list-group-bordered list-group-noicon uppercase">
                            @foreach(\larashop\Classes::all() as $class)
                                <li class="list-group-item @if($class->id === $currentClass->id)active @endif">
                                    <a class="dropdown-toggle"
                                       href="{{ url('catalog/'.$class->urlhash) }}">{{$class->description->name}}</a>
                                    <ul>
                                        <li><a href="{{ url('catalog/'.$class->urlhash) }}" class="active">{{trans('all.all')}}</a></li>
                                        @foreach(\larashop\Categories::all() as $cat)
                                            @if($cat->class_id === $class->id)
                                                <li>
                                                    <a href="{{ url('catalog/'.$class->urlhash.'/'.$cat->urlhash) }}"><span
                                                                class="size-11 text-muted pull-right">({{$cat->products->count()}}
                                                            )</span>{{$cat->description->name}}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>

                            @endforeach

                        </ul>

                    </div>
                    <!-- /CATEGORIES -->


                    <!-- BANNER ROTATOR -->
                    <div class="owl-carousel buttons-autohide controlls-over margin-bottom-60 text-center"
                         data-plugin-options='{"singleItem": true, "autoPlay": 4000, "navigation": true, "pagination": false, "transitionStyle":"goDown"}'>
                        @if(isset($sliders['left_column_banner']))
                            @foreach($sliders['left_column_banner']->data as $slide)
                                <a href="{{$slide['link']}}">
                                    <img class="img-responsive" src="{{asset('files/sliders/'.$slide['image'])}}"
                                         width="270" height="350" alt="">
                                </a>
                            @endforeach
                        @endif
                    </div>
                    <!-- /BANNER ROTATOR -->

                    {{--FILTERS--}}

                    <h4>{{trans('catalog_page.filters')}}</h4>
                    <form id="filter" action="">
                        <label class="size-12 margin-top-10"><b>Диапозон цены</b></label>
                        <div class="input-group">
                            <span class="input-group-addon">ОТ</span>
                            <input type="text" name="min-price" class="form-control" value="1" placeholder="min">
                            <span class="input-group-addon">{{currencyPrefix()}}</span>
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">ДО</span>
                            <input type="text" name="max-price" class="form-control" value="9999" placeholder="max">
                            <span class="input-group-addon">{{currencyPrefix()}}</span>
                        </div>
                        @foreach($filtersGroups as $filtersGroup)
                            <label class="size-12 margin-top-10"><b>{{$filtersGroup->description->name}}</b></label>
                            <select name="filter[]" class="form-control">
                                <option value="">{{trans('all.all')}}</option>
                                @foreach($filters as $filter)
                                    @foreach($filter as $value)
                                        @if($value->filter_group_id == $filtersGroup->id)
                                            <option value="{{$value->id}}">{{$value->description->value}}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        @endforeach

                        <p></p>
                        <button type="submit"
                                class="btn btn-default btn-md btn-block btn-primary btn-hvr hvr-icon-spin">{{trans('catalog_page.search')}}
                        </button>
                    </form>
                    <hr/>

                {{--/FILTERS--}}

                    <!-- HTML BLOCK -->
                    <div class="margin-bottom-60">
                        <h4>{{trans('catalog_page.newsletter_header')}}</h4>
                        <p>{{trans('catalog_page.newsletter_body')}}</p>

                        <form action="\newsletter-add" role="form" method="post">
                        {{csrf_field()}}
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" id="email" name="email" class="form-control required"
                                       placeholder="{{trans('catalog_page.enter_email')}}">
                                <span class="input-group-btn">
                                            <button class="btn btn-success" type="submit"><i
                                                        class="glyphicon glyphicon-send"></i></button>
                                        </span>
                            </div>
                        </form>

                    </div>
                    <!-- /HTML BLOCK -->

                </div>

            </div>
        </div>
        </div>
    </section>
    <!-- / -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

    <script>
        $(window).on('hashchange', function () {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                }
            }
        });
        $(document).ready(function () {
            $('.pagination li:eq(1)').attr('href', location.href);
            $(document).on('click', '.pagination a', function (e) {
                getPosts($(this).attr('href').split('page=')[1]);
                e.preventDefault();
            });
            $('.pagination li').click(function () {
                $('.pagination li').removeClass('active');
                $(this).addClass('active');
            })
        });
        function getPosts(page) {
            $('.shop-item-image img').attr('src', '{{asset('smarty/images/loaders/4.gif')}}');
            $.ajax({
                url: '?page=' + page,
                dataType: 'json',
            }).done(function (data) {
                $('.products').html(data);
                location.hash = page;
            }).fail(function () {
                alert('Posts could not be loaded.');
            });
        }


        $('#filter').submit(function () {
            updateFilter();
            return false;
        });

        var template = '';

        function updateFilter() {
            $('.shop-item-image img').attr('src', '{{asset('smarty/images/loaders/4.gif')}}');
            var filters = $('#filter').serializeArray();
            var filter = [];
            var min_price = $("input[name='min-price']").val();
            var max_price = $("input[name='max-price']").val();

            jQuery.each(filters, function (i, filters) {
                if (filters.name == "filter[]") {
                    if (filters.value !== '') {
                        filter[filter.length] = filters.value;
                    }
                }
            });
            console.log(filter);
            $.get(location.href, {
                'filters[]': filter,
                'minPrice': min_price,
                'maxPrice': max_price,
                'template': template
            }, function (html) {
                $('.products').html(html);
            });

            return false;
        }

        $('.one-col').click(function () {
            $('.options-left .btn').removeClass('active');
            $(this).addClass('active');
            template = '_full';
            updateFilter();
            return false
        });
        $('.many-col').click(function () {
            $('.options-left .btn').removeClass('active');
            $(this).addClass('active');
            template = '';
            updateFilter();
            return false
        })
    </script>

@endsection