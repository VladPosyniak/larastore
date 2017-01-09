<nav class="navbar navbar-default navbar-fixed-top" style="    border-bottom: 1px #EEEEEE solid;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{!! URL::to('/') !!}"><img src="{{$logoMain or Null}}" class="img-def" id="logo">
            </a>
        </div>
        <div id="navbar2" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li ><a href="{!! URL::to('/catalog') !!}"><i class="fa fa-gift"></i> Каталог</a></li>
                <li ><a href="{!! URL::to('/gallery') !!}"><i class="fa fa-camera"></i> Галерея</a></li>
                <li ><a href="{!! URL::to('/info') !!}"> <i class="fa fa-info-circle"></i> Информация</a></li>
                <li ><a href="{!! URL::to('/check') !!}"><i class="fa fa-paper-plane"></i> Отследить </a></li>
                <li ><a href="{!! URL::to('/purchase') !!}"><i class="fa fa-shopping-cart"></i> Оформить заказ
                    @if ($totalNavLabel != 0)
                    <span class='badge' style="background-color:#FD5F6F;">{{$totalNavLabel}} </span>
                    @endif
                </a></li>


            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
</nav>