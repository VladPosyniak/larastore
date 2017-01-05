@extends('layout.main')

@section('seo')

@endsection

@section('page')
    <section class="page-header">
        <div class="container">

            <h1>ORDER PLACED</h1>

            <!-- breadcrumbs -->
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">Checkout Final</li>
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
                        Ваше напоминание создано!
                    </p>

                    <hr/>
                </div>
            </div>
            <!-- /CHECKOUT FINAL MESSAGE -->


        </div>
    </section>
    <!-- / -->

@endsection