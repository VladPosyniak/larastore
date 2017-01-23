@extends('layout.main')

@section('seo')

@endsection

@section('page')

    <section class="page-header page-header-xs">
        <div class="container">

            <!-- breadcrumbs -->
            <ol class="breadcrumb breadcrumb-inverse">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">Settings</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->


    <!-- -->
    <section>
        <div class="container">

            <section class="heading-title heading-arrow-bottom margin-bottom-40">
                <div class="container">

                    <div class="text-center">
                        <h3>Your<span> settings</span></h3>
                        <p>Here you can customise your account, change password and create several addresses.</p>
                    </div>

                </div>
            </section>

            <!-- RIGHT -->
            <div class="col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4 margin-bottom-80">

                <ul class="nav nav-tabs nav-top-border">
                    <li class="active"><a href="#info" data-toggle="tab">Personal Info</a></li>
                    <li><a href="#password" data-toggle="tab">Password</a></li>
                    <li><a href="#address" data-toggle="tab">Addresses</a></li>
                </ul>

                <div class="tab-content margin-top-20">

                    <!-- PERSONAL INFO TAB -->
                    <div class="tab-pane fade in active" id="info">
                        <form role="form" action="{{url('/profile/settings')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text" name="name" placeholder="" value="{{Auth::user()->name}}"
                                       class="form-control @if ($errors->has('name')) error @endif">
                                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label">Mobile Number</label>
                                <input type="text" name="phone" placeholder="" value="{{Auth::user()->phone}}"
                                       class="form-control @if ($errors->has('phone')) error @endif">
                                @if ($errors->has('phone')) <p
                                        class="help-block">{{ $errors->first('phone') }}</p> @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="email" name="email" placeholder="" value="{{Auth::user()->email}}"
                                       class="form-control @if ($errors->has('email')) error @endif">
                                @if ($errors->has('email')) <p
                                        class="help-block">{{ $errors->first('email') }}</p> @endif
                            </div>
                            <div class="margiv-top10">
                                <input type="submit" value="Save Changes" class="btn btn-primary">
                            </div>
                        </form>

                    </div>
                    <!-- /PERSONAL INFO TAB -->


                    <!-- PASSWORD TAB -->
                    <div class="tab-pane fade" id="password">

                        <form action="{{url('/changepassword')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="control-label">Current Password</label>
                                <input type="password" name="old_password" class="form-control">
                                <small>Если вы зашли через соц. сеть - оставляем поле пустым.</small>
                            </div>
                            <div class="form-group">
                                <label class="control-label">New Password</label>
                                <input type="password" name="password1" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Re-type New Password</label>
                                <input type="password" name="password2" class="form-control">
                            </div>

                            <div class="margiv-top10">
                                <input type="submit" value="Change password" class="btn btn-primary">
                            </div>

                        </form>

                    </div>
                    <!-- /PASSWORD TAB -->

                    <!-- ADDRESS TAB -->
                    <div class="tab-pane fade" id="address">

                        <div class="row">

                            <!-- tabs -->
                            <div class="col-md-3 col-sm-3 nopadding">
                                <ul class="nav nav-tabs nav-stacked">
                                    @foreach($addresses as $address)
                                        <li @if($address == $addresses->first()) class="active"@endif>
                                            <a href="#address_{{$address->id}}" data-toggle="tab">
                                                {{$address->address_name}}
                                            </a>
                                        </li>
                                    @endforeach
                                    <li>
                                        <a href="#new_address" data-toggle="tab">
                                            Create new address
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!-- tabs content -->
                            <div class="col-md-9 col-sm-9 nopadding">
                                <div class="tab-content tab-stacked">
                                    @foreach($addresses as $address)
                                        <div id="address_{{$address->id}}"
                                             class="tab-pane @if($address == $addresses->first()) active @endif">
                                            <form role="form" action="{{url('/profile/updateaddress')}}" method="post">
                                                {{csrf_field()}}
                                                <input type="hidden" name="address_id" value="{{$address->id}}">
                                                <div class="form-group">
                                                    <label class="control-label">Address name *</label>
                                                    <input type="text" name="address_name"
                                                           value="{{$address->address_name}}" placeholder=""
                                                           class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">County *</label>
                                                    <input type="text" name="country" value="{{$address->country}}"
                                                           placeholder=""
                                                           class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">City *</label>
                                                    <input type="text" name="city" value="{{$address->city}}"
                                                           placeholder=""
                                                           class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Postal code *</label>
                                                    <input type="text" name="postal_code"
                                                           value="{{$address->postal_code}}" placeholder=""
                                                           class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Company </label>
                                                    <input type="text" name="company" value="{{$address->company}}"
                                                           placeholder=""
                                                           class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Address *</label>
                                                    <input type="text" name="address" value="{{$address->address}}"
                                                           placeholder=""
                                                           class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Comment</label>
                                                    <textarea name="comment" rows="4"
                                                              class="form-control required">{{$address->comment}}</textarea>
                                                </div>
                                                <div class="margiv-top10">
                                                    <input type="submit" value="Change address" class="btn btn-primary">
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach

                                    <div id="new_address" class="tab-pane active">
                                        <h4>The creation of a new address</h4>
                                        <form role="form" action="{{url('/profile/createaddress')}}" method="post">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label class="control-label">Address name *</label>
                                                <input type="text" name="address_name" placeholder=""
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">County *</label>
                                                <input type="text" name="country" placeholder=""
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">City *</label>
                                                <input type="text" name="city" placeholder=""
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Postal code *</label>
                                                <input type="text" name="postal_code" placeholder=""
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Company </label>
                                                <input type="text" name="company" placeholder=""
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Address *</label>
                                                <input type="text" name="address" placeholder=""
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Comment</label>
                                                <textarea name="comment" rows="4"
                                                          class="form-control required"></textarea>
                                            </div>
                                            <div class="margiv-top10">
                                                <input type="submit" value="Create address" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /ADDRESS TAB -->

                </div>

            </div>


            <!-- LEFT -->
            <div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8">


                <!-- SIDE NAV -->
                <ul class="side-nav list-group margin-bottom-60" id="sidebar-nav">
                    {{--<li class="list-group-item"><a href="{{url('/profile/history')}}"><i class="fa fa-history"></i> ORDER--}}
                    {{--HISTORY</a></li>--}}
                    <li class="list-group-item active"><a href="{{url('/profile/settings')}}"><i
                                    class="fa fa-gears"></i>
                            SETTINGS</a></li>
                    <li class="list-group-item "><a href="{{url('/profile/coupons')}}"><i class="fa fa-ticket"></i>
                            COUPONS</a></li>
                    <li class="list-group-item"><a href="{{url('/profile/orders')}}"><i class="fa fa-archive"></i>
                            ORDERS</a></li>
                    <li class="list-group-item"><a href="{{url('/profile/favourites')}}"><i
                                    class="fa fa-star"></i>
                            FAVOURITES</a></li>
                </ul>

            </div>

        </div>
    </section>
    <!-- / -->

@endsection