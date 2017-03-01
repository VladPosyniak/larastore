@extends('layout.main')

@section('seo')

@endsection

@section('page')
    <section class="page-header">
        <div class="container">

            <h1>{{trans('placed.placed')}}</h1>

            <!-- breadcrumbs -->
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">{{trans('all.home')}}</a></li>
                <li class="active">{{trans('placed.placed')}}</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->


    <!-- -->
    <section>
        <div class="container">

            <!-- CHECKOUT FINAL MESSAGE -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Спасибо, {{Auth::user()->name}}.</h3>

                    <p>
                        {{trans('placed.desc')}}
                    </p>

                    <hr/>
                </div>
            </div>
            <!-- /CHECKOUT FINAL MESSAGE -->


        </div>
    </section>
    <!-- / -->

@endsection