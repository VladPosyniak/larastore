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
                        <h4 class="letter-spacing-1">EXPLORE US</h4>
                        <ul class="list-unstyled footer-list half-paddings noborder">
                            <li><a class="block" href="{{url('/')}}"><i class="fa fa-angle-right"></i> Главная страница</a></li>
                            <li><a class="block" href="{{url('/catalog')}}"><i class="fa fa-angle-right"></i> Каталог</a></li>
                            <li><a class="block" href="{{url('/profile/settings')}}"><i class="fa fa-angle-right"></i> Настройки профиля</a></li>
                            <li><a class="block" href="{{url('/profile/orders')}}"><i class="fa fa-angle-right"></i> Мои заказы</a></li>
                            <li><a class="block" href="{{url('/profile/coupons')}}"><i class="fa fa-angle-right"></i> Купоны</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h4 class="letter-spacing-1">SECURE PAYMENT</h4>
                        <p>Donec tellus massa, tristique sit amet condim vel, facilisis quis sapien. Praesent id enim sit amet.</p>
                        <p>	<!-- see assets/images/cc/ for more icons -->
                            <img src="{{asset('smarty/images/cc/Visa.png')}}" alt="" />
                            <img src="{{asset('smarty/images/cc/Mastercard.png')}}" alt="" />
                            <img src="{{asset('smarty/images/cc/Maestro.png')}}" alt="" />
                            <img src="{{asset('smarty/images/cc/Maestro.png')}}" alt="" />
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
<!-- PAGE LEVEL SCRIPTS -->
{{--<script type="text/javascript" src="{{asset('smarty/js/view/demo.shop.js')}}"></script>--}}
</body>
</html>