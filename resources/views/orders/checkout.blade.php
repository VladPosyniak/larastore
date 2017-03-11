@extends('layout.main')

@section('seo')
    <title>{{trans('checkout.checkout')}}</title>
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


    <!-- CART -->
    <section>
        <div class="container">

        <!-- CHECKOUT -->
            <form class="row clearfix" method="post" action="{{url('/checkout')}}">
                {{csrf_field()}}
                <div class="col-lg-7 col-sm-7">
                    <div class="heading-title">
                        <h4>{{trans('checkout.ship')}}</h4>
                    </div>


                    <!-- BILLING -->
                    <fieldset class="margin-top-60">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="billing_name">{{trans('checkout.name')}} *</label>
                                <input id="billing_name" name="name"
                                       value="@if(isset(Auth::user()->name)) {{Auth::user()->name}} @endif" type="text"
                                       class="form-control  @if($errors->has('name')) error @endif" required/>
                                <span>{{$errors->first('name')}}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label for="billing_email">{{trans('checkout.email')}} *</label>
                                <input id="billing_email" name="email"
                                       value="@if(isset(Auth::user()->email)) {{Auth::user()->email}} @endif"
                                       type="email"
                                       class="form-control  @if($errors->has('email')) error @endif" required/>
                                <span>{{$errors->first('email')}}</span>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <label for="billing_phone">{{trans('checkout.phone')}} *</label>
                                <input id="billing_phone" name="phone"
                                       value="@if(isset(Auth::user()->phone)) {{Auth::user()->phone}} @endif"
                                       type="text"
                                       class="form-control  @if($errors->has('phone')) error @endif" required/>
                                <span>{{$errors->first('phone')}}</span>
                            </div>
                        </div>


                        @if(Auth::check())
                            <div class="callout callout-theme-color" style="border-radius: 3px">
                                <div class="row text-center">
                                    <div class="col-md-12">

                                        <label for="billing_country">{{trans('checkout.address_select')}}:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">{{trans('checkout.to')}}</span>
                                            <select id="billing_country" class="form-control address-select">
                                                <option value="">{{trans('checkout.select')}}...</option>
                                                @foreach($addresses as $address)
                                                    <option value="{{$address->id}}">{{$address->address_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endif

                        <select class="form-control areas">
                            <option value="">Область</option>
                            @for ($i = 1; $i < count($areas); $i++)
                                 <option value="{{$i}}">{{$areas[$i]}}</option>
                            @endfor
                        </select>

                        <div class="city_block" hidden>
                            <br>
                            <select class="form-control city">
                                <option value="">Город</option>
                            </select>
                        </div>

                        <div class="post_block" hidden>
                            <br>
                            <select class="form-control post" hidden="hidden">
                                <option value="">Отделение</option>
                            </select>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-lg-12">
                                <label for="address">{{trans('checkout.address')}} *</label>
                                <input value="{{old('address')}}" id="address" name="address" type="text"
                                       class="form-control  @if($errors->has('address')) error @endif" required/>
                                <span>{{$errors->first('address')}}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label for="city">{{trans('checkout.city')}} *</label>
                                <input value="{{old('city')}}" id="city" name="city"
                                       class="form-control  @if($errors->has('city')) error @endif" required/>
                                <span>{{$errors->first('city')}}</span>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="company">{{trans('checkout.company')}}</label>
                                <input value="{{old('company')}}" id="company" name="company"
                                       type="text" class="form-control @if($errors->has('company')) error @endif"/>
                                <span>{{$errors->first('company')}}</span>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label for="zipcode">{{trans('checkout.index')}}</label>
                                <input value="{{old('zipcode')}}" id="zipcode" name="zipcode"
                                       type="text"
                                       class="form-control  @if($errors->has('zipcode')) error @endif"/>
                                <span>{{$errors->first('zipcode')}}</span>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="country">{{trans('checkout.country')}}</label>
                                <input value="{{old('country')}}" id="country" name="country"
                                       type="text"
                                       class="form-control  @if($errors->has('country')) error @endif"/>
                                <span>{{$errors->first('country')}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="comment">{{trans('checkout.comment')}}</label>
                                <input value="{{old('comment')}}" id="comment" name="comment" type="text"
                                       class="form-control  @if($errors->has('comment')) error @endif"/>
                                <span>{{$errors->first('comment')}}</span>
                            </div>
                        </div>


                        <hr/>
                    </fieldset>
                    <!-- /BILLING -->
                </div>


                <div class="col-lg-5 col-sm-5">


                    <div class="heading-title">
                        <h4>{{trans('checkout.payment')}}</h4>
                    </div>

                    <!-- PAYMENT METHOD -->
                    <fieldset class="margin-top-60">
                        <div class="toggle-transparent toggle-bordered-full clearfix">
                            <div class="toggle active">
                                <div class="toggle-content">

                                    <div class="row nomargin-bottom">
                                        <div class="col-lg-12 nomargin clearfix">
                                            <label class="radio pull-left nomargin-top">
                                                <input id="payment_check" name="payment_method" type="radio" value="1"
                                                       checked="checked"/>
                                                <i></i> <span class="weight-300">{{trans('checkout.money')}}</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-12 nomargin clearfix">
                                            <label class="radio pull-left">
                                                <input id="payment_card" name="payment_method" type="radio" value="2"/>
                                                <i></i> <span class="weight-300">{{trans('checkout.credit')}}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <!-- /PAYMENT METHOD -->

                    <div class="toggle-transparent toggle-bordered-full clearfix">
                        <div class="toggle active">
                            <div class="toggle-content">
                                <label for="coupon">{{trans('checkout.coupons')}}:</label>
                                <select id="coupon" name="coupon" class="form-control address-select">
                                    <option value="">{{trans('checkout.select')}}...</option>
                                    @foreach($coupons as $coupon)
                                        <option value="{{$coupon->id}}">-{{$coupon->discount}}%</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>


                    <!-- TOTAL / PLACE ORDER -->
                    <div class="toggle-transparent toggle-bordered-full clearfix">
                        <div class="toggle active">
                            <div class="toggle-content">

                                @foreach($products as $product)
                                    <div style="margin-bottom: 5px;">
                                                                            <span class="clearfix">
											<span class="pull-right">{{currency($product->price)}}</span>
											<strong class="pull-left">{{$product->description->name}} {{$product->amount}}
                                                x @foreach(explode(',',$product->options) as $item) <span
                                                        class="label label-success">{{$item}}</span> @endforeach</strong>
										</span>
                                    </div>
                                @endforeach

                                <hr/>

                                <span class="clearfix">
											<span class="pull-right size-20">{{currency($total)}}</span>
											<strong class="pull-left">{{trans('checkout.total')}}:</strong>
										</span>

                                <hr/>

                                <button class="btn btn-primary btn-lg btn-block size-15"><i
                                            class="fa fa-mail-forward"></i>
                                    {{trans('checkout.order')}}
                                </button>
                            </div>
                        </div>
                        <br>
                        <div class="toggle-transparent toggle-bordered-full clearfix">
                            <div class="alert alert-warning margin-bottom-30"><!-- WARNING -->
                                <strong>Мы не используем вашу личную информацию в приступных целях и не распростроняем
                                    её третьим лицам. Подробнее в <a href="#">пользовательском соглашении.</a></strong>
                            </div>
                        </div>

                    </div>
                    <!-- /TOTAL / PLACE ORDER -->
                {{--@if(!Auth::check())--}}
                {{--<!-- CREATE ACCOUNT -->--}}
                {{--<div class="toggle-transparent toggle-bordered-full margin-top-30 clearfix">--}}
                {{--<div class="toggle active">--}}
                {{--<div class="toggle-content">--}}

                {{--<div class="clearfix">--}}
                {{--<label class="checkbox pull-left">--}}
                {{--<input id="accountswitch" name="create-account" type="checkbox" value="1"/>--}}
                {{--<i></i> <span class="weight-300">Create an account for later use</span>--}}
                {{--</label>--}}
                {{--</div>--}}


                {{--<!-- CREATE ACCOUNT FORM -->--}}
                {{--<div id="newaccount" class="margin-top-10 margin-bottom-30 softhide">--}}

                {{--<div class="row nomargin-bottom">--}}
                {{--<div class="col-md-6 col-sm-6">--}}
                {{--<label for="account:password">Password *</label>--}}
                {{--<input id="account:password" name="password1" type="password"--}}
                {{--class="form-control"/>--}}
                {{--</div>--}}
                {{--<div class="col-md-6 col-sm-6">--}}
                {{--<label for="account:password2">Confirm Password *</label>--}}
                {{--<input id="account:password2" name="password2" type="password"--}}
                {{--class="form-control"/>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<small class="text-warning">NOTE: Email address will be used to login</small>--}}

                {{--</div>--}}
                {{--<!-- /CREATE ACCOUNT FORM -->--}}
                {{--@endif--}}

                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                <!-- /CREATE ACCOUNT -->

            </form>
            <!-- /CHECKOUT -->

        </div>
    </section>
    <!-- /CART -->
    <script type="text/javascript" src="{{asset('smarty/plugins/jquery/jquery-2.1.4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('smarty/js/view/demo.shop.js')}}"></script>

    <script>
        $('.areas').change(function(e){
            var selected = $('.areas').val();
            if(selected !== ''){
                $.ajax({
                  method: "GET",
                  url: "/ship/get_cities/",
                  data:{area:selected}
                })
              .done(function( msg ) {
                cities = JSON.parse(msg);
                cities_handler(cities);
              });
            }
        });

        var addressId = null;
        $('.address-select').click(function () {

            if (addressId !== $(".address-select").val()) {
                addressId = $(".address-select").val();

                $.getJSON('profile/getaddress/' + addressId, function (data) {
                    $('#address').val(data[0].address);
                    $('#city').val(data[0].city);
                    $('#zipcode').val(data[0].postal_code);
                    $('#country').val(data[0].country);
                    $('#company').val(data[0].company);
                    $('#comment').val(data[0].comment);
                })
            }
        })

        function cities_handler(cities){
            $(cities).each(function(element){
                city = cities[element];
                $('.city').append('<option value="'+element+'">'+city+'</option>');
                $('.city_block').show();
            });

            $('.city').change(function(e){
                var city = $('.city').val(),
                area = $('.areas').val();

                if(city !== '' && area !== ''){
                    $.ajax({
                      method: "GET",
                      url: "/ship/get_posts/",
                      data:{area:area, city:city}
                    })
                  .done(function( msg ) {
                    posts = JSON.parse(msg);
                    post_handler(posts);
                  });
                }
            });
        }

        function post_handler(posts){
            $(posts).each(function(element){
                post = posts[element];
                $('.post').append('<option value="'+element+'">'+post["DescriptionRu"]+'</option>');
                $('.post_block').show();
            });
        }
    </script>

@endsection