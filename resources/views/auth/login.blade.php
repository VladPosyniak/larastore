@extends('layout.main')

@section('seo')
    <title>Войти в аккаунт Shmot.top</title>
@endsection

@section('page')
    <section class="page-header">
        <div class="container">

            <h1>{{trans('login.login')}}</h1>

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
                        {{trans('login.i_customer')}}
                    </header>

                    <fieldset class="nomargin">

                        <label class="input margin-bottom-10">
                            <i class="ico-append fa fa-envelope"></i>
                            <input required name="email" type="email" class="@if ($errors->has('email')) error @endif"
                                   placeholder="{{trans('reg.email')}}">
                            <b class="tooltip tooltip-bottom-right">{{trans('reg.verify_error')}}</b>
                            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                        </label>


                        <label class="input margin-bottom-10">
                            <i class="ico-append fa fa-lock"></i>
                            <input required name="password" type="password"
                                   class="@if ($errors->has('password')) error @endif" placeholder="{{trans('reg.password')}}">
                            <b class="tooltip tooltip-bottom-right">{{trans('reg.latin_error')}}</b>
                            @if ($errors->has('password')) <p
                                    class="help-block">{{ $errors->first('password') }}</p> @endif
                        </label>

                        {{--<div class="clearfix note margin-bottom-30">--}}
                        {{--<a class="pull-right" href="{{url('/forgot')}}">Forgot Password?</a>--}}
                        {{--</div>--}}

                        <label class="checkbox weight-300">
                            <input type="checkbox" name="remember">
                            <i></i> {{trans('login.remember')}}
                        </label>

                    </fieldset>

                    <footer>
                        <button type="submit" class="btn btn-primary noradius pull-right"><i class="fa fa-check"></i>
                            {{trans('login.ok')}}
                        </button>
                    </footer>

                    </form>
                    <!-- /login form -->

                </div>
                <!-- /LOGIN -->

                <!-- SOCIAL LOGIN -->
                <div class="col-md-6 col-sm-6">
                    <form action="#" method="post" class="sky-form boxed">

                        <header class="size-18 margin-bottom-20">
                            {{trans('reg.reg_with_social')}}
                        </header>

                        <fieldset class="nomargin">

                            <div class="row">

                                <div class="col-md-8 col-md-offset-2">

                                    <a href="{{url('/socialite/vkontakte')}}"
                                       class="btn btn-block btn-social btn-vk margin-bottom-10">
                                        <i class="fa fa-vk"></i> {{trans('reg.vk_reg')}}
                                    </a>

                                </div>
                            </div>

                        </fieldset>

                        <footer>
                            {{trans('login.dont_have')}} <a href="{{url('/registration')}}"><strong>{{trans('login.click')}}</strong></a>
                        </footer>

                    </form>

                </div>
                <!-- /SOCIAL LOGIN -->

            </div>


        </div>
    </section>
    <!-- / -->
@endsection