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
                        {{$message}}
                    </p>

                    <hr/>

                    <p class="text-center">
                        {!! $payment !!}
                    </p>
                </div>
            </div>
            <!-- /CHECKOUT FINAL MESSAGE -->

            <div class="panel panel-success">
                <div class="panel-body">
                    <h4>Не забудьте поздравить самых близких!</h4>
                    <p>
                        Добавьте даты праздников у ваших близких и мы напомним вам их поздравить за неделю! А так же,
                        дадим
                        скидку на любой подарок в размере 10%!
                    </p>
                    <form action="{{url('/event-create')}}" method="post">
                        {!! csrf_field() !!}
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <label for="name">Название события</label>
                                <input name="name" type="text" class="form-control"
                                       placeholder="Например: день рождение мамы" required>
                            </div>
                            <div class="panel-body">
                                <label for="date">Дата события</label>
                                <input type="text" name="date" class="form-control datepicker"
                                       placeholder="Например: 2017-02-22" data-format="yyyy-mm-dd" data-lang="ru"
                                       data-RTL="false" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Отправить!</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
    <!-- / -->

@endsection