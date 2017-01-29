<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>
<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html> <!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    {{--<meta name="Author" content="Dorin Grigoras [www.stepofweb.com]"/>--}}

    @yield('seo')

    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"/>
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <!-- WEB FONTS : use %7C instead of | (pipe) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700"
          rel="stylesheet" type="text/css"/>

    <!-- CORE CSS -->
    <link href="{{asset('smarty/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- THEME CSS -->
    <link href="{{asset('smarty/css/essentials.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('smarty/css/layout.css')}}" rel="stylesheet" type="text/css"/>

    <!-- PAGE LEVEL SCRIPTS -->
    <link href="{{asset('smarty/css/header-1.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('smarty/css/layout-shop.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('smarty/css/color_scheme/green.css')}}" rel="stylesheet" type="text/css" id="color_scheme"/>
    <link rel="stylesheet" href="{{asset('smarty/css/plugin-hover-buttons.css')}}">
    <link rel="stylesheet" href="{{asset('smarty/css/other.css')}}">
</head>
<!--
    AVAILABLE BODY CLASSES:

    smoothscroll 			= create a browser smooth scroll
    enable-animation		= enable WOW animations

    bg-grey					= grey background
    grain-grey				= grey grain background
    grain-blue				= blue grain background
    grain-green				= green grain background
    grain-blue				= blue grain background
    grain-orange			= orange grain background
    grain-yellow			= yellow grain background

    boxed 					= boxed layout
    pattern1 ... patern11	= pattern background
    menu-vertical-hide		= hidden, open on click

    BACKGROUND IMAGE [together with .boxed class]
    data-background="assets/images/boxed_background/1.jpg"
-->
<body {{--data-background="https://pp.vk.me/c626417/v626417735/37f2d/dnxbA9ATs8Y.jpg"--}} class="{{--boxed--}}  @if(Setting::get('view.theme_smoothscroll')) smoothscroll @endif enable-animation {{Setting::get('view.theme_color')}} ">


<!-- SLIDE TOP -->
{{--<div id="slidetop">--}}

{{--<div class="container">--}}

{{--<div class="row">--}}

{{--<div class="col-md-4">--}}
{{--<h6><i class="icon-heart"></i> WHY SMARTY?</h6>--}}
{{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, commodo a sodales sed,--}}
{{--dignissim pretium nunc. Nam et lacus neque. Ut enim massa, sodales tempor convallis et, iaculis ac--}}
{{--massa. </p>--}}
{{--</div>--}}

{{--<div class="col-md-4">--}}
{{--<h6><i class="icon-attachment"></i> RECENTLY VISITED</h6>--}}
{{--<ul class="list-unstyled">--}}
{{--<li><a href="#"><i class="fa fa-angle-right"></i> Consectetur adipiscing elit amet</a></li>--}}
{{--<li><a href="#"><i class="fa fa-angle-right"></i> This is a very long text, very very very very very--}}
{{--very very very very very very very </a></li>--}}
{{--<li><a href="#"><i class="fa fa-angle-right"></i> Lorem ipsum dolor sit amet</a></li>--}}
{{--<li><a href="#"><i class="fa fa-angle-right"></i> Dolor sit amet,consectetur adipiscing elit--}}
{{--amet</a></li>--}}
{{--<li><a href="#"><i class="fa fa-angle-right"></i> Consectetur adipiscing elit amet,consectetur--}}
{{--adipiscing elit</a></li>--}}
{{--</ul>--}}
{{--</div>--}}

{{--<div class="col-md-4">--}}
{{--<h6><i class="icon-envelope"></i> CONTACT INFO</h6>--}}
{{--<ul class="list-unstyled">--}}
{{--<li><b>Address:</b> PO Box 21132, Here Weare St, <br/> Melbourne, Vivas 2355 Australia</li>--}}
{{--<li><b>Phone:</b> 1-800-565-2390</li>--}}
{{--<li><b>Email:</b> <a href="mailto:support@yourname.com">support@yourname.com</a></li>--}}
{{--</ul>--}}
{{--</div>--}}

{{--</div>--}}

{{--</div>--}}

{{--<a class="slidetop-toggle" href="#"><!-- toggle button --></a>--}}

{{--</div>--}}
<!-- /SLIDE TOP -->


<!-- wrapper -->
<div id="wrapper">

    <!-- Top Bar -->
    <div id="topBar">
        <div class="container">

            <!-- right -->
            <ul class="top-links list-inline pull-right">
                @if(Auth::check())
                    <li class="text-welcome hidden-xs">{{trans('layout.welcome_to')}} {{Setting::get('config.sitename', 'SiteName')}},
                        <strong>{{Auth::user()->name}}</strong>
                    </li>
                    <li>
                        <a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#"><i
                                    class="fa fa-user hidden-xs"></i>{{mb_strtoupper(trans('layout.my_account'))}}</a>
                        <ul class="dropdown-menu pull-right">
                            {{--<li><a tabindex="-1" href="{{url('/profile/history')}}"><i class="fa fa-history"></i> ORDER HISTORY</a></li>--}}
                            <li class="divider"></li>
                            {{--<li><a tabindex="-1" href="#"><i class="fa fa-bookmark"></i> MY WISHLIST</a></li>--}}
                            {{--<li><a tabindex="-1" href="#"><i class="fa fa-edit"></i> MY REVIEWS</a></li>--}}
                            <li><a tabindex="-1" href="{{url('/profile/settings')}}"><i class="fa fa-cog"></i> {{mb_strtoupper(trans('layout.my_settings'))}}</a></li>
                            <li><a tabindex="-1" href="{{url('/profile/coupons')}}"><i class="fa fa-ticket"></i> {{mb_strtoupper(trans('layout.my_coupons'))}}</a></li>
                            <li><a tabindex="-1" href="{{url('/profile/orders')}}"><i class="fa fa-archive"></i> {{mb_strtoupper(trans('layout.my_orders'))}}</a></li>
                            <li><a tabindex="-1" href="{{url('/profile/favourites')}}"><i class="fa fa-star"></i> {{mb_strtoupper(trans('layout.my_favourites'))}}</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="{{url('/logout')}}"><i class="glyphicon glyphicon-off"></i>{{mb_strtoupper(trans('layout.exit'))}}</a></li>
                        </ul>
                    </li>
                @else
                    <li class="hidden-xs"><a href="{{url('/login')}}">{{trans('layout.login')}}</a></li>
                    <li class="hidden-xs"><a href="{{url('/registration')}}">{{trans('layout.registration')}}</a></li>
                @endif

            </ul>

            <!-- left -->
            <ul class="top-links list-inline">
                <li class="hidden-xs"><a href="page-faq-1.html">FAQ</a></li>
                <li>
                    <a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#"><img class="flag-lang"
                                                                                                      src="
@if(Auth::check() && Auth::user()->locale !== null){{asset('smarty/images/flags/'.Auth::user()->locale.'.png')}}@elseif(Session::get('locale') != ''){{asset('smarty/images/flags/'.Session::get('locale').'.png')}}@else{{asset('smarty/images/flags/en.png')}}@endif"
                                                                                                      width="16"
                                                                                                      height="11"
                                                                                                      alt="lang"/>
                        @if(Auth::check() && Auth::user()->locale !== ''){{mb_strtoupper(Auth::user()->locale)}}@elseif(Session::get('locale') != ''){{mb_strtoupper(Session::get('locale'))}} @else
                            EN @endif</a>
                    <ul class="dropdown-langs dropdown-menu">
                        <li><a tabindex="-1" href="{{url('/setlocale/en')}}"><img class="flag-lang"
                                                                                  src="{{asset('smarty/images/flags/en.png')}}"
                                                                                  width="16"
                                                                                  height="11" alt="lang"/> ENGLISH</a>
                        </li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" href="{{url('/setlocale/ru')}}"><img class="flag-lang"
                                                                                  src="{{asset('smarty/images/flags/ru.png')}}"
                                                                                  width="16"
                                                                                  height="11" alt="lang"/> РУССКИЙ</a>
                        </li>
                        <li><a tabindex="-1" href="{{url('/setlocale/ua')}}"><img class="flag-lang"
                                                                                  src="{{asset('smarty/images/flags/ua.png')}}"
                                                                                  width="16"
                                                                                  height="11" alt="lang"/>
                                УКРАЇНСЬКА</a></li>
                    </ul>
                </li>
                <li>
                    <a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#">@if(Auth::check() && Auth::user()->currency !== null){{Auth::user()->currency}}@elseif(Session::get('currency') !=''){{Session::get('currency')}} @else USD @endif</a>
                    <ul class="dropdown-langs dropdown-menu">
                        <li><a tabindex="-1" href="{{url('/setcurrency/USD')}}">USD</a></li>
                        <li><a tabindex="-1" href="{{url('/setcurrency/RUB')}}">RUB</a></li>
                        <li><a tabindex="-1" href="{{url('/setcurrency/UAH')}}">UAH</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
    <!-- /Top Bar -->

    <!--
        AVAILABLE HEADER CLASSES

        Default nav height: 96px
        .header-md 		= 70px nav height
        .header-sm 		= 60px nav height

        .noborder 		= remove bottom border (only with transparent use)
        .transparent	= transparent header
        .translucent	= translucent header
        .sticky			= sticky header
        .static			= static header
        .dark			= dark header
        .bottom			= header on bottom

        shadow-before-1 = shadow 1 header top
        shadow-after-1 	= shadow 1 header bottom
        shadow-before-2 = shadow 2 header top
        shadow-after-2 	= shadow 2 header bottom
        shadow-before-3 = shadow 3 header top
        shadow-after-3 	= shadow 3 header bottom

        .clearfix		= required for mobile menu, do not remove!

        Example Usage:  class="clearfix sticky header-sm transparent noborder"
    -->
    <div id="header" class="sticky clearfix">




        <!-- TOP NAV -->
        <header id="topNav">
            <div class="container">

                <!-- Mobile Menu Button -->
                <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- BUTTONS -->
                <ul class="pull-right nav nav-pills nav-second-main">

                    <!-- SEARCH -->
                    <li class="search">
                        <a href="javascript:;">
                            <i class="fa fa-search"></i>
                        </a>
                        <div class="search-box">
                            <form action="{{url('/search')}}" method="get">
                                <div class="input-group">
                                    <input type="text" name="keyword" placeholder="{{trans('search')}}" class="form-control" required/>
                                    <span class="input-group-btn">
												<button class="btn btn-primary" type="submit">{{trans('search')}}</button>
											</span>
                                </div>
                            </form>
                        </div>
                    </li>
                    <!-- /SEARCH -->



                @if(!Request::is('checkout'))
                    <!-- QUICK SHOP CART -->

                        <li class="quick-cart">
                            <a href="#">
                                <span class="badge badge-aqua btn-xs badge-corner count_order"></span>
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                            <div class="quick-cart-box">
                                @if(Auth::check())
                                    <h5 style=" padding-top: 3px; padding-right:7px; position: absolute; right: -1px;">
                                        {{trans('layout.balance')}}: {{currency(Auth::user()->balance)}}</h5>
                                @endif
                                <h4>{{trans('layout.cart')}}</h4>


                                <div class="quick-cart-wrapper">

                                </div>

                                <!-- quick cart footer -->
                                <div class="quick-cart-footer">
                                                                        <span style="width: 100%;margin-bottom: 5px; text-align: center" ><strong>{{trans('layout.total')}}:</strong> <span
                                                                                    id="total-price"></span></span>
                                    <a href="{{url('checkout')}}" class="btn btn-primary btn-xs">{{trans('layout.checkout')}}</a>

                                </div>
                                <!-- /quick cart footer -->
                            </div>
                        </li>
                        <!-- /QUICK SHOP CART -->
                    @endif
                </ul>
                <!-- /BUTTONS -->

                <!-- Logo -->
                <a class="logo pull-left" href="{{url('/')}}">
                    <img src="{{ asset('/files/img/'.Setting::get('config.logo'))}}" alt=""/>
                </a>

                <!--
                    Top Nav

                    AVAILABLE CLASSES:
                    submenu-dark = dark sub menu
                -->
                <div class="navbar-collapse pull-right nav-main-collapse collapse submenu-dark">
                    <nav class="nav-main">

                        <!--
                            NOTE

                            For a regular link, remove "dropdown" class from LI tag and "dropdown-toggle" class from the href.
                            Direct Link Example:

                            <li>
                                <a href="#">HOME</a>
                            </li>
                        -->
                        <ul id="topMain" class="nav nav-pills nav-main">
                            {{--<li class="dropdown"><!-- HOME -->--}}
                            {{--<a class="dropdown-toggle" href="#">--}}
                            {{--HOME--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu">--}}
                            {{--<li class="dropdown">--}}
                            {{--<a class="dropdown-toggle" href="#">--}}
                            {{--HOME CORPORATE--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu">--}}
                            {{--<li><a href="index-corporate-1.html">CORPORATE LAYOUT 1</a></li>--}}
                            {{--<li><a href="index-corporate-2.html">CORPORATE LAYOUT 2</a></li>--}}
                            {{--<li><a href="index-corporate-3.html">CORPORATE LAYOUT 3</a></li>--}}
                            {{--<li><a href="index-corporate-4.html">CORPORATE LAYOUT 4</a></li>--}}
                            {{--<li><a href="index-corporate-5.html">CORPORATE LAYOUT 5</a></li>--}}
                            {{--<li><a href="index-corporate-6.html">CORPORATE LAYOUT 6</a></li>--}}
                            {{--<li><a href="index-corporate-7.html">CORPORATE LAYOUT 7</a></li>--}}
                            {{--</ul>--}}
                            {{--</li>--}}
                            {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="">CATEGORIES</a>--}}
                            {{--</li>--}}

                            <li>
                                <a href="{{url('/')}}">{{mb_strtoupper(trans('layout.home'))}}</a>
                            </li>
                            <li>
                                <a href="{{url('/catalog')}}">{{mb_strtoupper(trans('layout.catalog'))}}</a>
                            </li>

                            @foreach(\larashop\Classes::all() as $navbar_class)
                                <li class="dropdown"><!-- HOME -->
                                    <a class="dropdown-toggle" href="{{url('/'.$navbar_class->urlhash)}}">
                                        {{mb_strtoupper($navbar_class->description->name)}}
                                    </a>
                                    <ul style="min-width: 246px;" class="dropdown-menu">
                                        <li class="navbar_products"
                                            style="display: inline-block; width: 120px; height: 140px;"><a
                                                    style="text-align: center;height: 140px;"
                                                    href="{{ url('catalog/'.$navbar_class->urlhash) }}">{{trans('layout.all')}}
                                                <br>
                                                <img src="{{asset('files/classes/img/'.$navbar_class->cover)}}"
                                                     style="max-width: 100px;height: 100px" alt=""></a></li>
                                        @foreach(\larashop\Categories::all() as $cat)
                                            @if($cat->class_id == $navbar_class->id)
                                                <li style="display: inline-block;width: 120px;height: 140px;"
                                                    class="dropdown navbar_products">
                                                    <a style="text-align: center;height: 140px;"
                                                       href="{{url('/catalog/'.$navbar_class->urlhash.'/'.$cat->urlhash)}}">
                                                        {{$cat->description->name}}
                                                        <br>
                                                        <img src="{{asset('/files/cats/img/'.$cat->cover)}}"
                                                             style="width: 100px; height: 100px" alt=""></a></li>
                                                </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach


                        </ul>


                    </nav>

                </div>

            </div>

        </header>
        <!-- /Top Nav -->

    </div>


    <!--
        PAGE HEADER

        CLASSES:
            .page-header-xs	= 20px margins
            .page-header-md	= 50px margins
            .page-header-lg	= 80px margins
            .page-header-xlg= 130px margins
            .dark			= dark page header

            .shadow-before-1 	= shadow 1 header top
            .shadow-after-1 	= shadow 1 header bottom
            .shadow-before-2 	= shadow 2 header top
            .shadow-after-2 	= shadow 2 header bottom
            .shadow-before-3 	= shadow 3 header top
            .shadow-after-3 	= shadow 3 header bottom
    -->

    @yield('page')

<!-- FOOTER -->
    <footer id="footer">
        <div class="container">

            <div class="row margin-top-60 margin-bottom-40 size-13">

                <!-- col #1 -->
                <div class="col-md-4 col-sm-4">

                    <!-- Footer Logo -->
                    <img class="footer-logo" src="{{ asset('/files/img/'.Setting::get('config.logo'))}}" alt="" />

                    <p>
                        {{Setting::get('config.sitedesc')}}
                    </p>

                    <!-- Social Icons -->
                    <div class="clearfix">

                        <a href="{{Setting::get('integration.facebook')}}" class="social-icon social-icon-sm social-icon-border social-facebook pull-left" data-toggle="tooltip" data-placement="top" title="Facebook">
                            <i class="icon-facebook"></i>
                            <i class="icon-facebook"></i>
                        </a>

                        <a href="{{Setting::get('integration.twitter')}}" class="social-icon social-icon-sm social-icon-border social-twitter pull-left" data-toggle="tooltip" data-placement="top" title="Twitter">
                            <i class="icon-twitter"></i>
                            <i class="icon-twitter"></i>
                        </a>

                        <a href="{{Setting::get('integration.vkontakte')}}" class="social-icon social-icon-sm social-icon-border social-vk pull-left" data-toggle="tooltip" data-placement="top" title="Вконтакте">
                            <i class="icon-vk"></i>
                            <i class="icon-vk"></i>
                        </a>

                        <a href="{{Setting::get('integration.insta')}}" class="social-icon social-icon-sm social-icon-border social-instagram pull-left" data-toggle="tooltip" data-placement="top" title="Instagram">
                            <i class="icon-instagram"></i>
                            <i class="icon-instagram"></i>
                        </a>

                        {{--<a href="#" class="social-icon social-icon-sm social-icon-border social-gplus pull-left" data-toggle="tooltip" data-placement="top" title="Google plus">--}}
                        {{--<i class="icon-gplus"></i>--}}
                        {{--<i class="icon-gplus"></i>--}}
                        {{--</a>--}}

                        {{--<a href="#" class="social-icon social-icon-sm social-icon-border social-linkedin pull-left" data-toggle="tooltip" data-placement="top" title="Linkedin">--}}
                        {{--<i class="icon-linkedin"></i>--}}
                        {{--<i class="icon-linkedin"></i>--}}
                        {{--</a>--}}

                        {{--<a href="#" class="social-icon social-icon-sm social-icon-border social-rss pull-left" data-toggle="tooltip" data-placement="top" title="Rss">--}}
                        {{--<i class="icon-rss"></i>--}}
                        {{--<i class="icon-rss"></i>--}}
                        {{--</a>--}}

                    </div>
                    <!-- /Social Icons -->

                </div>
                <!-- /col #1 -->

                <!-- col #2 -->
                <div class="col-md-8 col-sm-8">

                    <div class="row">

                        {{--<div class="col-md-5 hidden-sm hidden-xs">--}}
                        {{--<h4 class="letter-spacing-1">RECENT NEWS</h4>--}}
                        {{--<ul class="list-unstyled footer-list half-paddings">--}}
                        {{--<li>--}}
                        {{--<a class="block" href="#">New CSS3 Transitions this Year</a>--}}
                        {{--<small>June 29, 2015</small>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a class="block" href="#">Inteligent Transitions In UX Design</a>--}}
                        {{--<small>June 29, 2015</small>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a class="block" href="#">Lorem Ipsum Dolor</a>--}}
                        {{--<small>June 29, 2015</small>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a class="block" href="#">New CSS3 Transitions this Year</a>--}}
                        {{--<small>June 29, 2015</small>--}}
                        {{--</li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}

                        <div class="col-md-3 hidden-sm hidden-xs">
                            <h4 class="letter-spacing-1">{{mb_strtoupper(trans('layout.explore_us'))}}</h4>
                            <ul class="list-unstyled footer-list half-paddings noborder">
                                <li><a class="block" href="{{url('/')}}"><i class="fa fa-angle-right"></i> {{trans('layout.home_page')}}</a></li>
                                <li><a class="block" href="{{url('/catalog')}}"><i class="fa fa-angle-right"></i> {{trans('layout.catalog_page')}}</a></li>
                                <li><a class="block" href="{{url('/profile/settings')}}"><i class="fa fa-angle-right"></i> {{trans('layout.my_settings')}}</a></li>
                                <li><a class="block" href="{{url('/profile/orders')}}"><i class="fa fa-angle-right"></i> {{trans('layout.my_orders')}}</a></li>
                                <li><a class="block" href="{{url('/profile/coupons')}}"><i class="fa fa-angle-right"></i> {{trans('layout.my_coupons')}}</a></li>
                            </ul>
                        </div>

                        <div class="col-md-4">
                            <h4 class="letter-spacing-1">{{mb_strtoupper(trans('layout.secure_payment'))}}</h4>
                            <p>{{trans('layout.secure_payment_content')}}</p>
                            <p>	<!-- see assets/images/cc/ for more icons -->
                                <img src="{{asset('smarty/images/cc/Visa.png')}}" alt="" />
                                <img src="{{asset('smarty/images/cc/Mastercard.png')}}" alt="" />
                                <img src="{{asset('smarty/images/cc/Maestro.png')}}" alt="" />
                                {{--<img src="{{asset('smarty/images/cc/Maestro.png')}}" alt="" />--}}
                            </p>
                        </div>

                        <div class="col-md-4">
                            <h2>{{Setting::get('integration.tel')}}</h2>
                            <h2>{{Setting::get('config.email')}}</h2>
                        </div>

                    </div>

                </div>
                <!-- /col #2 -->

            </div>

        </div>

        <div class="copyright">
            <div class="container">
                <ul class="pull-right nomargin list-inline mobile-block">
                    <li><a href="#">Terms &amp; Conditions</a></li>
                    <li>&bull;</li>
                    <li><a href="#">Privacy</a></li>
                </ul>

                &copy; All Rights Reserved, Company LTD
            </div>
        </div>

    </footer>
    <!-- /FOOTER -->

</div>
<!-- /wrapper -->


<!-- SCROLL TO TOP -->
<a href="#" id="toTop"></a>




<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = '/smarty/plugins/';</script>
<script type="text/javascript" src="{{asset('smarty/plugins/jquery/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('plugins/jquery.cookie/jquery.cookie.js')}}"></script>
<script src="{{asset('dist/js/cart.js')}}"></script>
<script type="text/javascript" src="{{asset('smarty/js/scripts.js')}}"></script>

<!-- jQuery UI 1.11.4 -->
<!-- jQuery 2.1.4 -->
{{--{!! Html::script('plugins/jQuery/jQuery-2.1.4.min.js') !!}--}}
{!! Html::script('dist/js/jquery-ui.min.js') !!}
<!-- Bootstrap 3.3.5 -->
{!! Html::script('bootstrap/js/bootstrap.min.js') !!}
<!-- Select2 -->
{!! Html::script('plugins/select2/select2.full.min.js') !!}
{!! Html::script('plugins/touchspin/jquery.bootstrap-touchspin.min.js') !!}
<!-- Select2 -->
{!! Html::script('plugins/select2/select2.full.min.js') !!}

<!-- STYLESWITCHER - REMOVE -->
{{--<script async type="text/javascript" src="{{asset('smarty/plugins/styleswitcher/styleswitcher.js')}}"></script>--}}
<script>
    $(window).resize(function(){
        $('.product-attr').css('width','100%');
    });

</script>

@yield('scripts')
<!-- PAGE LEVEL SCRIPTS -->
{{--<script type="text/javascript" src="{{asset('smarty/js/view/demo.shop.js')}}"></script>--}}
</body>
</html>