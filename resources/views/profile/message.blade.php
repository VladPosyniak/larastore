@extends('layout.main')

@section('seo')
    <title>Сообщение Shmot.top</title>
@endsection

@section('page')

    <section>
        <div class="container">

            <!-- MESSAGE -->
            <div class="panel panel-default">
                <div class="panel-body">
                    {!!$message!!}
                </div>
            </div>
            @if(count($errors) > 0)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2>{{trans('messages.errors')}}:</h2>
                        <ul>
                            @foreach($errors as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
        @endif
        <!-- MESSAGE -->
        </div>
    </section>


@endsection