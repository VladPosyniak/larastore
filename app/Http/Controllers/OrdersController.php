<?php
namespace larashop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use LisDev\Delivery\NovaPoshtaApi2;
use larashop\Clients;
use larashop\Coupons;
use larashop\Options;
use larashop\Order;
use larashop\OrderedProducts;
use larashop\OrderFiles;
use larashop\OrderItems;
use larashop\Products;
use larashop\Purchase;
use larashop\User;
use larashop\UserAddress;
use larashop\UserEvent;
use LiqPay;
use Mail;
use Input;
use Setting;
use Validator;

class OrdersController extends Controller
{
    public function checkout()
    {


        if (!Auth::check()){
            return view('orders.message',['message' => 'Для оформелния заказа нужно быть зарегистрированым пользоветелем. Пожалуйста <a href="'.url('/login').'">войдите в профиль</a>, или <a href="'.url('/registration').'">зарегистрируйтесь</a>.']);
        }

        if (isset($_COOKIE['basket'])) {
            $orders = $_COOKIE['basket'];
            $orders = json_decode($orders);
//            return $orders[0]->item_id;
            if (!isset($orders[0]->item_id)) {
                return view('orders.message', ['message' => '<strong>Вы не добавили в корзину ни одного товара!</strong> Пожалуйста вернитесь в <a href="' . url('catalog') . '">каталог</a> и выберите товар.']);
            }
        } else {
            return view('orders.message', ['message' => '<strong>Вы не добавили в корзину ни одного товара!</strong> Пожалуйста вернитесь в <a href="' . url('catalog') . '">каталог</a> и выберите товар.']);
        }


        $products = [];
        $total = 0;
        foreach ($orders as $order) {
            $product = Products::find(explode(':', $order->item_id)[0]);
            $product->amount = $order->amount;
            foreach (explode(',', explode(':', $order->item_id)[1]) as $option_id) {
                if ($option_id != '') {
                    $filter = Options::find($option_id);
                    if ($filter === null) {
                        setcookie("basket", "", 1, '/');
                        return view('orders.message', ['message' => '<strong>Такой опции не существует!</strong> Пожалуйста вернитесь в <a href="' . url('catalog') . '">каталог</a> и выберите товар.']);
                    }
                    $product->price = $product->price + $filter['price'];
                    $product->options = $product->options . $filter['value'] . ',';
                }
            }
            $products[] = $product;

            $total = $total + ($product->price * $order->amount);
        }

        if (Auth::check()) {
            $addresses = UserAddress::where('user_id', '=', Auth::user()->id)->get();
            $coupons = Coupons::where('user_id', '=', Auth::user()->id)->get();
        } else {
            $coupons = [];
            $addresses = [];
        }
        $areas = $this->get_areas();

        return view('orders.checkout', ['products' => $products, 'total' => $total, 'addresses' => $addresses,'areas' => $areas, 'coupons' => $coupons]);
    }

    public function get_areas(){
        $np = new NovaPoshtaApi2(config('app.nova_poshta_api'), 'ru');
        $areas = $np->getAreas();
        unset($areas[0]);
        $result_array = [];
        foreach($areas as $key => $area)
        {
            if(isset($area['DescriptionRu'])) $result_array[$key] = $area['DescriptionRu'];
        }
        return $result_array;
    }

    public function get_cities(Request $request){

        $area_number = $request->area;
        $np = new NovaPoshtaApi2(config('app.nova_poshta_api'), 'ru');
        $areas = $np->getAreas();
        $all_cities = $np->getCities();
        $all_cities =  $np->findCityByRegionRef($all_cities, $areas[$area_number]['Ref']);
        $result_array = [];
        foreach($all_cities as $key => $city)
        {
            $result_array[$key] = $city['DescriptionRu'];
        }

        $result = json_encode($result_array);

        echo $result;
    }

    public function get_posts(Request $request){
        $area_number = $request->area;
        $city_number = $request->city;

        $np = new NovaPoshtaApi2(config('app.nova_poshta_api'), 'ru');
        $areas = $np->getAreas();
        $all_cities = $np->getCities();
        $all_cities =  $np->findCityByRegionRef($all_cities, $areas[$area_number]['Ref']);
        $city = $all_cities[$city_number]['Ref'];
        $result_array = $np->getWarehouses($city)["data"];

        $result = json_encode($result_array);

        echo $result;    
    }

   


    public function processing(Request $request)
    {


        if (!Auth::check()) {
            return view('orders.message', ['message' => 'Вы должны <a href="' . url('/login') . '">войти в свой профиль</a> для того, чтоб совершить покупку.']);
        }

        $data = Validator::make($request->all(), [
            'name' => 'min:6|required',
            'email' => 'required',
            'phone' => 'min:9|required',
            'address' => 'min:10|required',
            'city' => 'required',
            'zipcode' => 'integer',
            'country' => 'min:3',
            'payment_method' => 'integer|required',
            'coupon' => 'integer'
        ]);

        if ($data->fails()) {
            return redirect()->back()->withInput()->withErrors($data);
        }


        if (isset($_COOKIE['basket'])) {
            $orders = $_COOKIE['basket'];
            $orders = json_decode($orders);
//            return $orders[0]->item_id;
            if (!isset($orders[0]->item_id)) {
                return view('orders.message', ['message' => '<strong>Вы не добавили в корзину ни одного товара!</strong> Пожалуйста вернитесь в <a href="' . url('catalog') . '">каталог</a> и выберите товар.']);
            }
        } else {
            return view('orders.message', ['message' => '<strong>Вы не добавили в корзину ни одного товара!</strong> Пожалуйста вернитесь в <a href="' . url('catalog') . '">каталог</a> и выберите товар.']);
        }

        $products = [];
        $total = 0;
        foreach ($orders as $order) {
            $product = Products::find(explode(':', $order->item_id)[0]);
            $product->amount = $order->amount;
            foreach (explode(',', explode(':', $order->item_id)[1]) as $option_id) {
                if ($option_id != '') {
                    $filter = Options::find($option_id);
                    if ($filter === null) {
                        setcookie("basket", "", 1, '/');
                        return view('orders.message', ['message' => '<strong>Такой опции не существует!</strong> Пожалуйста вернитесь в <a href="' . url('catalog') . '">каталог</a> и выберите товар.']);
                    }
                    $product->price = $product->price + $filter['price'];
                    $product->options = $product->options . $filter['id'] . ',';
                }
            }
            $products[] = $product;

            $total = $total + ($product->price * $order->amount);
        }

        $to_pay = $total;
        $total = currencyWithoutPrefix($total);


        $payment_button = '';
        $to_processing = 0;
        $pay_type = '';
        $order_status = '';
        $paid = 0;

        $coupon = Coupons::where([
            ['id', '=', $request->input('coupon')],
            ['user_id', '=', Auth::user()->id]
        ])->get();
        $coupon_percent = 0;


        $order = new Order();
        $order->user_id = Auth::user()->id;

        if (isset($coupon[0])) {
            $order->coupon_id = $coupon[0]->id;
            $coupon_percent = $coupon[0]->discount / 100;
        }

        switch ($request->input('payment_method')) {
            case 1:
                $pay_type = 'cash';
                $to_processing = 1;
                $order_status = 'Обрабатывается';
                break;
            case 2:
                $pay_type = 'liqpay';
                $order_status = 'ожидает оплаты заказа';

                break;
            case 3:
                $pay_type = 'balance';
                if ($this->balancePay($to_pay - $to_pay * $coupon_percent)) {
                    $to_processing = 1;
                    $order_status = 'Обрабатывается';
                    $paid = 1;
                } else {
                    return view('orders.message', ['message' => 'На вашем балансе недостаточно денег!']);
                }
                break;
            case 4:
                $pay_type = 'webmoney';
                return $this->webmoney();
                break;

            default:
                return redirect()->back()->withInput();
        }


        $uniqCode = $this->uniqCode();

        $order->currency = currentCurrency();
        $order->code = $uniqCode;
        $order->status = $order_status;
        $order->pay_type = $pay_type;
        $order->to_processing = $to_processing;
        $order->paid = $paid;
        $order->to_pay = $to_pay - ($to_pay * $coupon_percent);
        $order->delivery_address = serialize(array(
            'city' => $request->input('city'),
            'secession' => $request->input('secession'),
            'region' => $request->input('region'),
//            'address' => $request->input('address'),
//            'country' => $request->input('country'),
//            'postal_code' => $request->input('zipcode'),
//            'company' => $request->input('company'),
//            'comment' => $request->input('comment'),
            'name' => $request->input('name'),            
            'phone' => $request->input('phone'),            
            'email' => $request->input('email')
        ));
        $order->save();

        foreach ($products as $product) {
            $order_product = new OrderedProducts();
            $order_product->order_id = $order->id;
            $order_product->product_id = $product->id;
            $order_product->amount = $product->amount;
            $order_product->options = $product->options;
            $order_product->save();
        }

        setcookie ("basket", "", 1,'/');

        switch ($request->input('payment_method')) {
            case 1:
                $ordered_products = OrderedProducts::where('order_id', '=', $order->id)->get();
                foreach ($ordered_products as $ordered_product) {
                    $product = Products::find($ordered_product->product_id);
                    $product->quantity = $product->quantity - $ordered_product->amount;
                    $product->save();
                }

                //todo
                $order_string = var_export($order['attributes'], true);
                $products_string = var_export($ordered_products[0], true);

                $order_data = $order['attributes'];

                $products_arr = [];
                foreach ($products as $product){
                    $products_arr[] = Products::find($product->id);
                }

                Mail::send('mail/order_in_process', [], function($message) use($request)
                {
                    $message->to($request->input('email'), $request->input('name'))->subject('Ваш заказ в обработке!');
                });
                //todo

                return view('orders.ordered', ['message' => 'Заказ успешно оформлен! Данные о заказе отправлены вам на почту.', 'payment' => 'Ожидайте звонка!']);
                break;
            case 2:
                return view('orders.ordered', ['message' => 'Заказ будет обработан после оплаты!', 'payment' => $this->liqpay($total - $total * $coupon_percent, currentCurrency(), $uniqCode)]);

                break;
            case 3:
                $ordered_products = OrderedProducts::where('order_id', '=', $order->id)->get();
                foreach ($ordered_products as $ordered_product) {
                    $product = Products::find($ordered_product->product_id);
                    $product->quantity = $product->quantity - $ordered_product->amount;
                    $product->save();
                }
                //todo
                return view('orders.ordered', ['message' => 'Заказ успешно оформлен! Данные о заказе отправлены вам на почту.', 'payment' => 'Ожидайте звонка!']);
                break;
            default:
                return redirect()->back()->withInput();
        }

    }


    private function uniqCode()
    {
        $accept = '';
        for ($code = str_random(5); $accept === false; $code = str_random(5)) {
            if (Order::where('code', '=', strtoupper($code))->get() == null) {
                $accept = true;
            } else {
                $accept = false;
            }
        }
        return strtoupper($code);
    }

    public function webmoney()
    {
        $x2 = new WMX2(
            [
                'reqn' => '',
                'payee' => '',
                'amount' => '',
                'description' => '',
                'tranID' => '',
            ]
        );

        $result = $x2->withdraw();
        if ($result === 0) {
            return true;
        } else {
            return false;
        }
    }

    public function liqpay($amount, $currency, $order_id)
    {
        $liqpay = new LiqPay(Setting::get('ligpay.publicKey'), Setting::get('ligpay.privateKey'));
        $html = $liqpay->cnb_form(array(
            'version' => '3',
            'amount' => $amount,
            'currency' => $currency,     //Можно менять  'EUR','UAH','USD','RUB','RUR'
            'order_id' => $order_id,
            'action' => 'pay',
            'sandbox' => Setting::get('liqpay.testmode'),
            'result_url' => url('/liqpay-success/' . $order_id),
            'description' => 'Оплата товара'
        ));

        return $html;
    }

    public function liqpaySuccess($id)
    {
        $data = json_decode(base64_decode($_POST['data']));
        $private_key = Setting::get('ligpay.privateKey');
        $signature = base64_encode(sha1($private_key . $_POST['data'] . $private_key, 1));
        if ($signature === $_POST['signature'] && $data->status === 'success' || $data->status === 'sandbox') {
            $order = Order::where('code','=',$id)->first();
            if ($order->paid != 1) {
                $order->paid = 1;
                $order->to_processing = 1;
                $order->status = 'Обрабатывается';
                $order->save();

                $ordered_products = OrderedProducts::where('order_id', '=', $id)->get();
                foreach ($ordered_products as $ordered_product) {
                    $product = Products::find($ordered_product->product_id);
                    $product->quantity = $product->quantity - $ordered_product->amount;
                    $product->save();
                }

                return view('orders.ordered', ['message' => 'Заказ успешно оплачен! Данные о заказе отправлены вам на почту.', 'payment' => 'Ожидайте доставку!']);
            } else {
                return view('orders.ordered', ['message' => 'Заказ успешно оплачен! Данные о заказе отправлены вам на почту.', 'payment' => 'Ожидайте доставку!']);
            }


        } else {
            return view('orders.ordered', ['message' => 'Что-то пошло не так!.', 'payment' => 'Поробуйте ещё раз.']);
        }
    }


    public function balancePay($cost)
    {
        if ((int)$cost > Auth::user()->balance) {
            return false;
        }
        $user = User::findOrFail(Auth::user()->id);
        $user->balance = $user->balance - (int)$cost;
        $user->save();
        return true;
    }

    public function eventCreate(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'date' => 'required',
                'name' => 'required'
            ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $event = new UserEvent();
            $event->name = $request->name;
            $event->date = $request->date;
            $event->user_id = Auth::user()->id;
            $event->save();

            $coupon = new Coupons();
            $coupon->discount = 10;
            $coupon->user_id = Auth::user()->id;
            $coupon->expiration_date = new Date('next year');
            $coupon->save();

            return redirect('/event-create-success');
        }
    }

    public function eventCreateSuccess()
    {
        return view('orders.eventCreated');
    }



}
