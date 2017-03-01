@extends('layout.main')

@section('seo')
    <title>{{Setting::get('seo.home_title')}}</title>
    <meta name="keywords" content="{{Setting::get('seo.home_keywords')}}"/>
    <meta name="description" content="{{Setting::get('seo.home_description')}}"/>
@endsection

@section('page')

    <section class="page-header page-header-xs dark">
        <div class="container">

            <h1>{{trans('search.result')}}</h1>

            <!-- breadcrumbs -->
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">{{trans('all.home')}}</a></li>
                <li class="active">{{trans('search.result')}}</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->


    <style>
        .input-group-btn select {
            border: #DDDDDD 2px solid;
            margin-top: 0px;
            margin-bottom: 0px;
            padding-top: 7px;
            padding-bottom: 7px;
        }
    </style>
    <!-- -->
    <section class="padding-xs alternate">
        <div class="container">

            <!-- SEARCH -->
            <form method="get" action="{{url('search')}}" class="clearfix well well-sm search-big nomargin">
                <div class="col-md-12">
                    <div class="form-group nomargin">
                        <div class="input-group">
                            <span class="input-group-btn">
                            <select name="category" class="btn">
                                <option value="">{{trans('search.all_categories')}}</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"  @if($current_category == $category->id) selected @endif>{{$category->description->name}}</option>
                                @endforeach
                            </select>
                            </span>

                            <input name="keyword" value="{{$keyword or ''}}" class="form-control  @if ($errors->has('keyword')) error @endif"
                                   type="text" placeholder="{{trans('layout.search')}}...">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default input-lg noborder-left my-group-button">
                                    <i class="fa fa-search fa-lg nopadding"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            </form>
            <!-- /SEARCH -->

        </div>
    </section>
    <!-- / -->



    <!-- -->
    <section>
        <div class="container">

            <div class="row">

                <!-- RIGHT -->
                <div class="col-md-12">
                    @if($products->first() != null)
                        <ul class="shop-item-list products row list-inline nomargin">
                            @include('catalog.products_smarty')
                        </ul>
                    @else
                        <h2>{{trans('search.nothing')}}...</h2>
                    @endif
                </div>

            </div>

        </div>
    </section>
    <!-- / -->


@endsection
