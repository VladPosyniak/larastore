@extends('layout.main')

@section('seo')

@endsection

@section('page')
    <!-- -->
    <section>
        <div class="container">

            <div class="row">

                <!-- LOGIN -->
                <div class="col-md-6 col-sm-6">

                    <!-- ALERT -->
                    <!--
                    <div class="alert alert-mini alert-danger margin-bottom-30">
                        <strong>Oh snap!</strong> Login Incorrect!
                    </div>
                    -->
                    <!-- /ALERT -->

                    <!-- register form -->
                    <form class="nomargin sky-form boxed" action="{{url('/registration')}}" method="post">
                        <header>
                            <i class="fa fa-users"></i> Register
                        </header>
                        {{csrf_field()}}
                        <fieldset class="nomargin">
                            <label class="input margin-bottom-10">
                                <i class="ico-append fa fa-envelope"></i>
                                <input class="@if ($errors->has('email')) error @endif" type="text" name="email"
                                       placeholder="Email address">
                                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
                                @if ($errors->has('email')) <p
                                        class="help-block">{{ $errors->first('email') }}</p> @endif
                            </label>

                            <label class="input margin-bottom-10">
                                <i class="ico-append fa fa-lock"></i>
                                <input class="@if ($errors->has('password')) error @endif" type="password"
                                       name="password" placeholder="Password">
                                <b class="tooltip tooltip-bottom-right">Only latin characters and numbers</b>
                                @if ($errors->has('password')) <p
                                        class="help-block">{{ $errors->first('password') }}</p> @endif
                            </label>

                            <label class="input margin-bottom-10">
                                <i class="ico-append fa fa-lock"></i>
                                <input name="password_confirmation"
                                       class="@if ($errors->has('password_confirmation')) error @endif" type="password"
                                       placeholder="Confirm password">
                                <b class="tooltip tooltip-bottom-right">Only latin characters and numbers</b>
                                @if ($errors->has('password_confirmation')) <p
                                        class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif
                            </label>

                            <label class="input margin-bottom-10">
                                <i class="ico-append fa fa-user"></i>
                                <input name="name" class="@if ($errors->has('name')) error @endif" type="text"
                                       placeholder="Your name">
                                <b class="tooltip tooltip-bottom-right">Only latin characters and numbers</b>
                                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            </label>

                            {{--<div class="row margin-bottom-10">--}}
                            {{--<div class="col-md-6">--}}
                            {{--<label class="input">--}}
                            {{--<input class="@if ($errors->has('name')) error @endif" name="fname" type="text" placeholder="First name">--}}
                            {{--</label>--}}
                            {{--</div>--}}
                            {{--<div class="col col-md-6">--}}
                            {{--<label class="input">--}}
                            {{--<input class="@if ($errors->has('name')) error @endif" name="lname" type="text" placeholder="Last name">--}}
                            {{--</label>--}}
                            {{--</div>--}}
                            {{--@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif--}}
                            {{--</div>--}}

                            {{--<label class="select margin-bottom-10 margin-top-20">--}}
                            {{--<select class="@if ($errors->has('gender')) error @endif" name="gender">--}}
                            {{--<option value="0" selected disabled>Gender</option>--}}
                            {{--<option value="1">Male</option>--}}
                            {{--<option value="2">Female</option>--}}
                            {{--<option value="3">Other</option>--}}
                            {{--</select>--}}
                            {{--<i></i>--}}
                            @if ($errors->has('gender')) <p class="help-block">{{ $errors->first('gender') }}</p> @endif
                            {{--</label>--}}


                            <div class="margin-top-30">
                                {{--<label class="checkbox nomargin"><input class="checked-agree" type="checkbox" name="checkbox"><i></i>I agree to the <a href="#" data-toggle="modal" data-target="#termsModal">Terms of Service</a></label>--}}
                                <label class="checkbox nomargin"><input type="checkbox" name="checkbox"><i></i>I want to
                                    receive news and special offers</label>
                            </div>
                        </fieldset>

                        <div class="row margin-bottom-20">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> REGISTER
                                </button>
                            </div>
                        </div>

                    </form>
                    <!-- /register form -->

                </div>
                <!-- /LOGIN -->

                <!-- SOCIAL LOGIN -->
                <div class="col-md-6 col-sm-6">
                    <form action="#" method="post" class="sky-form boxed">

                        <header class="size-18 margin-bottom-20">
                            Register using your favourite social network
                        </header>

                        <fieldset class="nomargin">

                            <div class="row">

                                <div class="col-md-8 col-md-offset-2">

                                    <a href="{{url('/socialite/facebook')}}"
                                       class="btn btn-block btn-social btn-facebook margin-bottom-10">
                                        <i class="fa fa-facebook"></i> Sign up with Facebook
                                    </a>

                                    <a href="{{url('/socialite/vkontakte')}}"
                                       class="btn btn-block btn-social btn-twitter margin-bottom-10">
                                        <i class="fa fa-vk"></i> Sign up with Vkontakte
                                    </a>

                                    <a href="{{url('/socialite/google')}}"
                                       class="btn btn-block btn-social btn-google margin-bottom-10">
                                        <i class="fa fa-google-plus"></i> Sign up with Google
                                    </a>
                                    <a href="{{url('/socialite/linkedin')}}"
                                       class="btn btn-block btn-social btn-linkedin margin-bottom-10">
                                        <i class="fa fa-linkedin"></i> Sign in with LinkedIn
                                    </a>

                                </div>
                            </div>

                        </fieldset>

                        <footer>
                            Already have an account? <a href="{{url('/login')}}"><strong>Back to login!</strong></a>
                        </footer>

                    </form>

                </div>
                <!-- /SOCIAL LOGIN -->

            </div>


        </div>
    </section>
    <!-- / -->

@endsection