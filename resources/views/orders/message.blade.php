@extends('layout.main')

@section('seo')

@endsection

@section('page')


    <section class="page-header page-header-xs">
        <div class="container">

            <h1>{{trans('checkout.checkout')}}</h1>

            <!-- breadcrumbs -->
            <ol class="breadcrumb">
                 <li><a href="shmot.top">{{trans('checkout.home')}}</a></li>
                 <li class="active">{{trans('checkout.checkout')}}</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->
    <section>
        <div class="container">

            <!-- MESSAGE -->
            <div class="panel panel-default">
                <div class="panel-body">
                    {!!$message!!}
                </div>
            </div>
            <!-- MESSAGE -->
        </div>
    </section>


@endsection