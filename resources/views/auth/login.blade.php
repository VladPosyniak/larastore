@extends('layout.main')

@section('seo')

@endsection

@section('page')
    <section class="page-header">
        <div class="container">

            <h1>LOGIN</h1>

            <!-- breadcrumbs -->
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Pages</a></li>
                <li class="active">Login</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->


    <!-- -->
    <section>
        <div class="container">

            <div class="row">

                <!-- LOGIN -->
                <div class="col-md-6 col-sm-6">

                    <!-- login form -->

                    {!! Form::open(array('url' => 'login','class' => 'sky-form boxed', 'method'=> 'POST', 'autocomplete'=>'off')) !!}

                    <header class="size-18 margin-bottom-20">
                        I'm a returning customer
                    </header>

                    <fieldset class="nomargin">

                        <label class="input margin-bottom-10">
                            <i class="ico-append fa fa-envelope"></i>
                            <input required name="email" type="email" class="@if ($errors->has('email')) error @endif"
                                   placeholder="Email address">
                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
                            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                        </label>


                        <label class="input margin-bottom-10">
                            <i class="ico-append fa fa-lock"></i>
                            <input required name="password" type="password"
                                   class="@if ($errors->has('password')) error @endif" placeholder="Password">
                            <b class="tooltip tooltip-bottom-right">Only latin characters and numbers</b>
                            @if ($errors->has('password')) <p
                                    class="help-block">{{ $errors->first('password') }}</p> @endif
                        </label>

                        {{--<div class="clearfix note margin-bottom-30">--}}
                        {{--<a class="pull-right" href="{{url('/forgot')}}">Forgot Password?</a>--}}
                        {{--</div>--}}

                        <label class="checkbox weight-300">
                            <input type="checkbox" name="remember">
                            <i></i> Keep me logged in
                        </label>

                    </fieldset>

                    <footer>
                        <button type="submit" class="btn btn-primary noradius pull-right"><i class="fa fa-check"></i>
                            OK, LOG IN
                        </button>
                    </footer>

                    </form>
                    <!-- /login form -->

                    {{--<!-- ALERT -->--}}
                    {{--<div class="alert alert-mini alert-danger margin-bottom-30">--}}
                    {{--<strong>Oh snap!</strong> Login Incorrect!--}}
                    {{--</div><!-- /ALERT -->--}}

                </div>
                <!-- /LOGIN -->

                <!-- SOCIAL LOGIN -->
                <div class="col-md-6 col-sm-6">
                    <form action="#" method="post" class="sky-form boxed">

                        <header class="size-18 margin-bottom-20">
                            Sign In using your favourite social network
                        </header>

                        <fieldset class="nomargin">

                            <div class="row">

                                <div class="col-md-8 col-md-offset-2">

                                    <a href="{{url('/socialite/facebook')}}"
                                       class="btn btn-block btn-social btn-facebook margin-bottom-10">
                                        <i class="fa fa-facebook"></i> Sign in with Facebook
                                    </a>

                                    <a href="{{url('/socialite/vkontakte')}}"
                                       class="btn btn-block btn-social btn-vk margin-bottom-10">
                                        <i class="fa fa-vk"></i> Sign in with Vkontakte
                                    </a>

                                    <a href="{{url('/socialite/google')}}"
                                       class="btn btn-block btn-social btn-google margin-bottom-10">
                                        <i class="fa fa-google-plus"></i> Sign in with Google
                                    </a>
                                    <a href="{{url('/socialite/linkedin')}}"
                                       class="btn btn-block btn-social btn-linkedin margin-bottom-10">
                                        <i class="fa fa-linkedin"></i> Sign in with LinkedIn
                                    </a>

                                </div>
                            </div>

                        </fieldset>

                        <footer>
                            Don't have an account yet? <a href="{{url('/registration')}}"><strong>Click to
                                    register!</strong></a>
                        </footer>

                    </form>

                </div>
                <!-- /SOCIAL LOGIN -->

            </div>


        </div>
    </section>
    <!-- / -->




    {{--{!! Form::open(array('url' => 'login', 'method'=> 'POST', 'autocomplete'=>'off')) !!}--}}



    {{--<div class="form-group has-feedback @if ($errors->has('email')) has-error @endif">--}}
    {{--{!! Form::text('email', '', array('class'=>'form-control', 'autocorrect'=>'off', 'autocapitalize'=>'off', 'autocomplete'=>'off', 'placeholder'=>'Email')) !!}--}}
    {{--<span class="glyphicon glyphicon-envelope form-control-feedback"></span>--}}
    {{--@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif--}}
    {{--</div>--}}



    {{--<div class="form-group has-feedback @if ($errors->has('password')) has-error @endif">--}}
    {{--{!! Form::password('password', array('class'=>'form-control', 'autocorrect'=>'off', 'autocapitalize'=>'off', 'autocomplete'=>'off', 'placeholder'=>'Password')); !!}--}}
    {{--<span class="glyphicon glyphicon-lock form-control-feedback"></span>--}}
    {{--@if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif--}}
    {{--</div>--}}

    {{--<div class="row">--}}
    {{--<div class="col-xs-8">--}}



    {{--<div class="checkbox icheck">--}}
    {{--<label>--}}
    {{--{!! Form::checkbox('remember'); !!} Remember Me--}}
    {{--</label>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<!-- /.col -->--}}
    {{--<div class="col-xs-4">--}}

    {{--{!! Form::button('Sign In', array('type' => 'submit', 'class'=>'btn btn-primary btn-block btn-flat')); !!}--}}

    {{--</div>--}}
    {{--<!-- /.col -->--}}
    {{--</div>--}}
    {{--{!! Form::close() !!}--}}


    {{--<!-- /.social-auth-links -->--}}

    {{--<a href="{!! URL::to('/forgot') !!}">I forgot my password</a><br>--}}

    {{--</div>--}}
    {{--<div class="row">--}}
    {{--<p class=" text-center">--}}
    {{--<a href="{{url('/socialite/facebook')}}" class="btn btn-info">Войти через Facebook</a>--}}
    {{--<a href="{{url('/socialite/google')}}" class="btn btn-info">Войти через Google</a>--}}
    {{--<a href="{{url('/socialite/vkontakte')}}" class="btn btn-info">Войти через VK</a>--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--<!-- /.login-box-body -->--}}
    {{--</div>--}}
    {{--<!-- /.login-box -->--}}

    <!-- jQuery 2.1.4 -->
    {{--{!! Html::script('plugins/jQuery/jQuery-2.1.4.min.js') !!}--}}
    {{--<!-- Bootstrap 3.3.5 -->--}}
    {{--{!! Html::script('bootstrap/js/bootstrap.min.js') !!}--}}

    {{--<!-- iCheck -->--}}
    {{--{!! Html::script('plugins/iCheck/icheck.min.js') !!}--}}
    {{--<script>--}}
    {{--$(function () {--}}
    {{--$('input').iCheck({--}}
    {{--checkboxClass: 'icheckbox_square-blue',--}}
    {{--radioClass: 'iradio_square-blue',--}}
    {{--increaseArea: '20%' // optional--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}

@endsection