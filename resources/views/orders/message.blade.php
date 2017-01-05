@extends('layout.main')

@section('seo')

@endsection

@section('page')


    <section class="page-header page-header-xs">
        <div class="container">

            <h1>CHECKOUT</h1>

            <!-- breadcrumbs -->
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li class="active">Checkout</li>
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