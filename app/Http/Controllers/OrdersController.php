<?php
namespace larashop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
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
use Pusha\LaravelWebMoney\WMX2;
use Setting;
use Validator;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //

        $orders = Purchase::all();

        foreach ($orders as $order) {

            if ($order->status == 'paid') {
                $order->rowStyle = 'warning';
            } else if ($order->status == 'sent') {
                $order->rowStyle = 'success';
            } else {
                $order->rowStyle = '';
            }

            $totalCount = 0;
            $totalSumm = 0;

            $itemFast = false;
            $itemGift = false;

            foreach ($order->items as $item) {

                /*    if (!in_array($item->product_id, ['np','fast', 'gift']))
                {
                $totalCount=$totalCount+$item->qty;
                $totalSumm=$totalSumm+($item->product->price*$item->qty);
                }*/

                if ($item->product_id == 'np') {
                    $totalSumm = $totalSumm + (Setting::get('product.np'));
                } else if ($item->product_id == 'fast') {
                    $itemFast = true;
                    $totalSumm = $totalSumm + (Setting::get('product.fast'));
                } else if ($item->product_id == 'gift') {
                    $itemGift = true;
                    $totalSumm = $totalSumm + ((Setting::get('product.gift')) * $item->qty);
                } else {


                    if (strpos($item->product_id, '0000')) {
                        //dd('consist');
                        $pID = explode('0000', $item->product_id);
                        $option = Options::findOrFail($pID[1]);
                        $product = Products::findOrFail($pID[0]);
                        $productPrice = $option->price;
                        $item->productPrice = $productPrice;
                        $item->productName = $product->name . ' (' . $option->name . ')';

                    } else {
                        $productPrice = $item->product->price;
                        $item->productPrice = $item->product->price;
                        $item->productName = $item->product->name;
                    }


                    $totalCount = $totalCount + $item->qty;
                    $totalSumm = $totalSumm + ($productPrice * $item->qty);
                }
            }
            $order->itemFast = $itemFast;
            $order->itemGift = $itemGift;
            $order->totalCount = $totalCount;
            $order->totalSumm = $totalSumm;

            //$totalCount=$orderItems->sum('qty');

            /*$totalSumm=0;
            foreach ($orderItems as $value) {
            # code...
            
            
            if ($value->product_id == 'np') {$totalSumm=$totalSumm+Setting::get('product.np');}
            else if ($value->product_id == 'fast') {$totalSumm=$totalSumm+Setting::get('product.fast');}
            else if ($value->product_id == 'gift') {$totalSumm=$totalSumm+(Setting::get('product.gift')*$value->qty);}
            else {
            
            //echo   $value->qty."__";
            $totalSumm=$totalSumm+($value->product->price*$value->qty);
            }
            
            }*/
            // code...

        }

        $data = ['orders' => $orders, 'NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.orders')->with($data);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function storeItem(Request $request, $id)
    {
        $order = Purchase::findOrFail($id);
        $validator = Validator::make($request->all(), ['qty' => 'required|integer']);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {

            $item = new OrderItems;

            if ($request->options != '0') {

                $item->product_id = $request->item . '0000' . $request->options;

            } else {
                $item->product_id = $request->item;

            }
            $item->order_id = $id;
            $item->qty = $request->qty;


            $item->save();

            $request->session()->flash('alert-success', 'Заказ отредактирован!');
            return redirect('orders/edit/' . $id);
        }
    }

    public function checkout()
    {


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


        return view('orders.checkout', ['products' => $products, 'total' => $total, 'addresses' => $addresses, 'coupons' => $coupons]);
    }


    public function processing(Request $request)
    {

//        return dd($request->all());

        if (!Auth::check()) {
            return view('orders.message', ['message' => 'Вы должны <a href="' . url('/login') . '">войти в свой профиль</a> для того, чтоб совершить покупку.']);
        }

        $data = Validator::make($request->all(), [
            'name' => 'min:6|required',
            'email' => 'required',
            'phone' => 'min:9|required',
            'address' => 'min:10|required',
            'city' => 'required',
            'zipcode' => 'integer|required',
            'country' => 'required|min:3',
            'payment_method' => 'integer|required',
            'coupon' => 'integer'
        ]);

        if ($data->fails()) {
            return redirect()->back()->withErrors($data);
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
                $order_status = 'Ожидает обработки';
                break;
            case 2:
                $pay_type = 'liqpay';
                $order_status = 'ожидает оплаты заказа';

                break;
            case 3:
                $pay_type = 'balance';
                if ($this->balancePay($to_pay - $to_pay * $coupon_percent)) {
                    $to_processing = 1;
                    $order_status = 'ожидает обработки';
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


        $order->currency = currentCurrency();
        $order->code = $this->uniqCode();
        $order->status = $order_status;
        $order->pay_type = $pay_type;
        $order->to_processing = $to_processing;
        $order->paid = $paid;
        $order->to_pay = $to_pay - ($to_pay * $coupon_percent);
        $order->delivery_address = serialize(array(
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'country' => $request->input('country'),
            'postal_code' => $request->input('zipcode'),
            'company' => $request->input('company'),
            'comment' => $request->input('comment'),
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

        switch ($request->input('payment_method')) {
            case 1:
                $ordered_products = OrderedProducts::where('order_id', '=', $order->id)->get();
                foreach ($ordered_products as $ordered_product) {
                    $product = Products::find($ordered_product->product_id);
                    $product->quantity = $product->quantity - $ordered_product->amount;
                    $product->save();
                }
                return view('orders.ordered', ['message' => 'Заказ успешно оформлен! Данные о заказе отправлены вам на почту.', 'payment' => 'Ожидайте звонка!']);
                break;
            case 2:
                return view('orders.ordered', ['message' => 'Заказ будет обработан после оплаты!', 'payment' => $this->liqpay($total - $total * $coupon_percent, currentCurrency(), $order->id)]);

                break;
            case 3:
                $ordered_products = OrderedProducts::where('order_id', '=', $order->id)->get();
                foreach ($ordered_products as $ordered_product) {
                    $product = Products::find($ordered_product->product_id);
                    $product->quantity = $product->quantity - $ordered_product->amount;
                    $product->save();
                }
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
        $private_key = Setting::get('ligpay.privateKey');
        $signature = base64_encode(sha1($private_key . $_POST['data'] . $private_key, 1));
        if ($signature === $_POST['signature']) {
            $order = Order::find($id);
            if ($order->paid != 1) {
                $order->paid = 1;
                $order->to_processing = 1;
                $order->status = 'Ожидает обработки';
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
            return view('orders.ordered', ['message' => 'Несовпадение данных.', 'payment' => 'Поробуйте ещё раз.']);
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


    public function drawingUp(Request $request)
    {
        $data = $request->all();
        return dd($data);
    }

    public function store(Request $request)
    {

        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //
        $order = Purchase::findOrFail($id);

        ($order->delivery_type == 'np') ? $delivery_type = 'Склад Новая Почта' : $delivery_type = 'Курьерская доставка по адресу';

        //'nal','privat24','privat_terminal','liqpay'
        switch ($order->pay_type) {
            case 'nal':
                $pay_type = 'Наличными';
                // code...
                break;

            case 'privat24':
                $pay_type = 'Privat24. Через онлайн-систему для владельцев карт ПриватБанка.';
                // code...
                break;

            case 'privat_terminal':
                $pay_type = 'На карту. Через пополнение карты, например через терминал самообслуживания.';

                //Через пополнение карты, например через терминал самообслуживания.
                // code...
                break;

            case 'liqpay':
                $pay_type = 'LiqPay. Через онлайн систему для владельце карт других банков. (+10% комиссия)';
                // code...
                break;

            default:
                $pay_type = 'Не указано';
                // code...
                break;
        }

        $totalCount = 0;
        $totalSumm = 0;
        foreach ($order->items as $item) {

            /*    if (!in_array($item->product_id, ['np','fast', 'gift']))
            {
            $totalCount=$totalCount+$item->qty;
            $totalSumm=$totalSumm+($item->product->price*$item->qty);
            }*/

            if ($item->product_id == 'np') {
                $totalSumm = $totalSumm + (Setting::get('product.np'));
            } else if ($item->product_id == 'fast') {
                $totalSumm = $totalSumm + (Setting::get('product.fast'));
            } else if ($item->product_id == 'gift') {
                $totalSumm = $totalSumm + ((Setting::get('product.gift')) * $item->qty);
            } else {


                if (strpos($item->product_id, '0000')) {
                    //dd('consist');
                    $pID = explode('0000', $item->product_id);
                    $option = Options::findOrFail($pID[1]);
                    $product = Products::findOrFail($pID[0]);
                    $productPrice = $option->price;
                    $item->productPrice = $productPrice;
                    $item->productName = $product->name . ' (' . $option->name . ')';
                    $item->productCover = $product->cover;
                    $item->productUrlhash = $product->urlhash;

                } else {
                    $productPrice = $item->product->price;
                    $item->productPrice = $item->product->price;
                    $item->productName = $item->product->name;
                    $item->productCover = $item->product->cover;
                    $item->productUrlhash = $item->product->urlhash;
                }


                $totalCount = $totalCount + $item->qty;
                $totalSumm = $totalSumm + ($item->productPrice * $item->qty);
            }
        }

        if ($order->status == 'paid') {
            $pay_status = 'Оплачено, ожидает отправку.';
        } else if ($order->status == 'sent') {
            $pay_status = 'Отправлено получателю.';
        } else {
            $pay_status = 'Новый заказ, ожидает оплату.';
        }

        $data = ['order' => $order, 'delivery_type' => $delivery_type, 'pay_type' => $pay_type, 'pay_status' => $pay_status, 'totalCount' => $totalCount, 'totalSumm' => $totalSumm, 'NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.order')->with($data);;
    }

    public function showFile($id)
    {

        $file = OrderFiles::where('hash', '=', $id)->firstOrFail();

        $filePath = 'files/uploads/' . $file->hash . '.' . $file->extension;

        $headers = array(
            'Content-Type' => $file->mime
        );

        return response()->download($filePath, $file->name, $headers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //

        $order = Purchase::findOrFail($id);

        $totalCount = 0;
        $totalSumm = 0;
        foreach ($order->items as $item) {

            /*    if (!in_array($item->product_id, ['np','fast', 'gift']))
            {
            $totalCount=$totalCount+$item->qty;
            $totalSumm=$totalSumm+($item->product->price*$item->qty);
            }*/

            if ($item->product_id == 'np') {
                $totalSumm = $totalSumm + (Setting::get('product.np'));
            } else if ($item->product_id == 'fast') {
                $totalSumm = $totalSumm + (Setting::get('product.fast'));
            } else if ($item->product_id == 'gift') {
                $totalSumm = $totalSumm + ((Setting::get('product.gift')) * $item->qty);
            } else {


                if (strpos($item->product_id, '0000')) {
                    //dd('consist');
                    $pID = explode('0000', $item->product_id);
                    $option = Options::findOrFail($pID[1]);
                    $product = Products::findOrFail($pID[0]);
                    $productPrice = $option->price;
                    $item->productPrice = $productPrice;
                    $item->productName = $product->name . ' (' . $option->name . ')';
                    $item->productCover = $product->cover;
                    $item->productUrlhash = $product->urlhash;

                } else {
                    $productPrice = $item->product->price;
                    $item->productPrice = $item->product->price;
                    $item->productName = $item->product->name;
                    $item->productCover = $item->product->cover;
                    $item->productUrlhash = $item->product->urlhash;
                }


                $totalCount = $totalCount + $item->qty;
                $totalSumm = $totalSumm + ($item->productPrice * $item->qty);
            }
        }

        $dNP = true;
        $dADR = false;

        if ($order->items()->where('product_id', 'np')->exists()) {
            $dNP = false;
            $dADR = true;
        }

        $privat24 = false;
        $privat_terminal = false;
        $liqpay = false;

        switch ($order->pay_type) {
            case 'privat24':
                // code...
                $privat24 = true;
                break;

            case 'privat_terminal':
                // code...
                $privat_terminal = true;
                break;

            case 'liqpay':
                // code...
                $liqpay = true;
                break;

            default:
                // code...
                break;
        }

        $prods = Products::all();
        $prods_arr = [];
        foreach ($prods as $key => $value) {
            $prods_arr[$value->id] = $value->name;
        }

        $options = Options::all();
        $opt_arr = [];
        $opt_arr[0] = 'Нет';
        foreach ($options as $key => $value) {
            $opt_arr[$value->id] = $value->name;
        }


        $data = [
            'Options' => $opt_arr,
            'order' => $order, 'totalCount' => $totalCount, 'totalSumm' => $totalSumm, 'dNP' => $dNP, 'dADR' => $dADR, 'Prods' => $prods_arr, 'privat24' => $privat24, 'privat_terminal' => $privat_terminal, 'liqpay' => $liqpay, 'NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.orderEdit')->with($data);;
    }

    //showCart
    public function showCart($id)
    {
        $order = Purchase::findOrFail($id);

        $totalCount = 0;
        $totalSumm = 0;
        foreach ($order->items as $item) {

            /*    if (!in_array($item->product_id, ['np','fast', 'gift']))
            {
            $totalCount=$totalCount+$item->qty;
            $totalSumm=$totalSumm+($item->product->price*$item->qty);
            }*/

            if ($item->product_id == 'np') {
                $totalSumm = $totalSumm + (Setting::get('product.np'));
            } else if ($item->product_id == 'fast') {
                $totalSumm = $totalSumm + (Setting::get('product.fast'));
            } else if ($item->product_id == 'gift') {
                $totalSumm = $totalSumm + ((Setting::get('product.gift')) * $item->qty);
            } else {

                if (strpos($item->product_id, '0000')) {
                    //dd('consist');
                    $pID = explode('0000', $item->product_id);
                    $option = Options::findOrFail($pID[1]);
                    $product = Products::findOrFail($pID[0]);
                    $productPrice = $option->price;
                    $item->productPrice = $productPrice;
                    $item->productName = $product->name . ' (' . $option->name . ')';
                    $item->productCover = $product->cover;
                    $item->productUrlhash = $product->urlhash;

                } else {
                    $productPrice = $item->product->price;
                    $item->productPrice = $item->product->price;
                    $item->productName = $item->product->name;
                    $item->productCover = $item->product->cover;
                    $item->productUrlhash = $item->product->urlhash;
                }


                $totalCount = $totalCount + $item->qty;
                $totalSumm = $totalSumm + ($item->productPrice * $item->qty);
            }
        }

        $data = ['order' => $order, 'totalCount' => $totalCount, 'totalSumm' => $totalSumm, 'NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.cartOrder')->with($data);
    }

    //updateDelivery
    public function updateDelivery(Request $request, $id)
    {
        $status = $request->status;

        $order = Purchase::findOrFail($id);

        if ($status == 'true') {

            if ($order->items()->where('product_id', 'np')->exists()) {
                $item = OrderItems::where('product_id', 'np')->where('order_id', $id);
                $item->delete();
            } //$cart=Cart::search(['id'=>'np']);

            else {

                $newItem = new OrderItems;
                $newItem->order_id = $id;
                $newItem->product_id = 'np';
                $newItem->save();
            }
        } else if ($status == 'false') {
            $item = OrderItems::where('product_id', 'np')->where('order_id', $id);
            $item->delete();

            //return $cart;

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function updateFast(Request $request, $id)
    {

        $order = Purchase::findOrFail($id);

        if ($order->items()->where('product_id', 'fast')->exists()) {
            $item = OrderItems::where('product_id', 'fast')->where('order_id', $id);
            $item->delete();
        } //$cart=Cart::search(['id'=>'np']);

        else {

            $newItem = new OrderItems;
            $newItem->order_id = $id;
            $newItem->product_id = 'fast';
            $newItem->save();
        }
    }

    public function updateGift(Request $request, $id)
    {
        $order = Purchase::findOrFail($id);

        if ($order->items()->where('product_id', 'gift')->exists()) {
            $item = OrderItems::where('product_id', 'gift')->where('order_id', $id);
            $item->delete();
        } //$cart=Cart::search(['id'=>'np']);

        else {

            $newItem = new OrderItems;
            $newItem->order_id = $id;
            $newItem->qty = 1;
            $newItem->product_id = 'gift';
            $newItem->save();
        }
    }

    public function update(Request $request, $id)
    {

        //
        $order = Purchase::findOrFail($id);

        $validator = Validator::make($request->all(), ['name' => 'required|min:2|max:255', 'tel' => 'required|min:2', 'email' => 'required|email']);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {

            $client = Clients::findOrFail($order->client_id);

            $client->update(['name' => $request->name, 'tel' => $request->tel, 'email' => $request->email]);

            $order->update(['code' => $request->code, 'delivery_type' => $request->delivery_type, 'pay_type' => $request->pay_type, 'delivery_city' => $request->delivery_city, 'delivery_np' => $request->delivery_np, 'delivery_adr' => $request->delivery_adr, 'comment' => $request->comment, 'ttn' => $request->ttn]);

            $request->session()->flash('alert-success', 'Заказ отредактирован!');
            return redirect('orders/' . $id);
        }
    }

    //updateQty
    public function updateQty(Request $request, $id)
    {
        $item = OrderItems::where('order_id', $id)->where('id', $request->el)->first();
        $item->update(['qty' => $request->qty]);
    }

    //updateStatusNew
    public function updateStatusNew(Request $request, $id)
    {

        //
        $order = Purchase::findOrFail($id);
        $order->status = 'new';
        $order->save();

        $client = $order->client;
        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');

        $data = ['orderCode' => $order->code, 'logoMain' => $logoMain, 'appURL' => config('app.url')];
        Mail::queue('mail.new', $data, function ($message) use ($client) {
            $message->from(Setting::get('config.email'), Setting::get('config.sitename'));
            $message->subject(Setting::get('config.sitename') . ' - ОЖИДАЕМ ОПЛАТЫ');
            $message->to($client['email']);
        });

        $request->session()->flash('alert-success', 'Статус изменён!');
        return back();
    }

    public function updateStatusPaid(Request $request, $id)
    {

        //
        $order = Purchase::findOrFail($id);
        $order->status = 'paid';
        $order->save();
        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');
        $client = $order->client;
        $data = ['orderCode' => $order->code, 'logoMain' => $logoMain, 'appURL' => config('app.url')];
        Mail::queue('mail.paid', $data, function ($message) use ($client) {
            $message->from(Setting::get('config.email'), Setting::get('config.sitename'));
            $message->subject(Setting::get('config.sitename') . ' - ОПЛАТА ПРИНЯТА');
            $message->to($client['email']);
        });

        $request->session()->flash('alert-success', 'Статус изменён!');
        return back();
    }

    public function updateStatusSent(Request $request, $id)
    {

        //
        $order = Purchase::findOrFail($id);
        $order->status = 'sent';
        $order->save();

        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');

        $client = $order->client;
        $data = ['order' => $order, 'orderCode' => $order->code, 'logoMain' => $logoMain, 'appURL' => config('app.url')];
        Mail::queue('mail.sent', $data, function ($message) use ($client) {
            $message->from(Setting::get('config.email'), Setting::get('config.sitename'));
            $message->subject(Setting::get('config.sitename') . ' - ЗАКАЗ ОТПРАВЛЕН');
            $message->to($client['email']);
        });

        $request->session()->flash('alert-success', 'Статус изменён!');
        return back();
    }

    public function updateTtn(Request $request, $id)
    {

        //
        $order = Purchase::findOrFail($id);
        $order->ttn = $request->ttn;
        $order->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function showPrint($id)
    {
        $order = Purchase::findOrFail($id);

        ($order->delivery_np == 'np') ? $delivery_type = 'Склад Новая Почта' : $delivery_type = 'Курьерская доставка по адресу';

        //'nal','privat24','privat_terminal','liqpay'
        switch ($order->pay_type) {
            case 'nal':
                $pay_type = 'Наличными';
                // code...
                break;

            case 'privat24':
                $pay_type = 'Privat24. Через онлайн-систему для владельцев карт ПриватБанка.';
                // code...
                break;

            case 'privat_terminal':
                $pay_type = 'На карту. Через пополнение карты, например через терминал самообслуживания.';

                //Через пополнение карты, например через терминал самообслуживания.
                // code...
                break;

            case 'liqpay':
                $pay_type = 'LiqPay. Через онлайн систему для владельце карт других банков. (+10% комиссия)';
                // code...
                break;

            default:
                $pay_type = 'Не указано';
                // code...
                break;
        }

        $totalCount = 0;
        $totalSumm = 0;
        foreach ($order->items as $item) {

            /*    if (!in_array($item->product_id, ['np','fast', 'gift']))
            {
            $totalCount=$totalCount+$item->qty;
            $totalSumm=$totalSumm+($item->product->price*$item->qty);
            }*/

            if ($item->product_id == 'np') {
                $totalSumm = $totalSumm + (Setting::get('product.np'));
            } else if ($item->product_id == 'fast') {
                $totalSumm = $totalSumm + (Setting::get('product.fast'));
            } else if ($item->product_id == 'gift') {
                $totalSumm = $totalSumm + ((Setting::get('product.gift')) * $item->qty);
            } else {


                if (strpos($item->product_id, '0000')) {
                    //dd('consist');
                    $pID = explode('0000', $item->product_id);
                    $option = Options::findOrFail($pID[1]);
                    $product = Products::findOrFail($pID[0]);
                    $productPrice = $option->price;
                    $item->productPrice = $productPrice;
                    $item->productName = $product->name . ' (' . $option->name . ')';
                    $item->productCover = $product->cover;
                    $item->productUrlhash = $product->urlhash;

                } else {
                    $productPrice = $item->product->price;
                    $item->productPrice = $item->product->price;
                    $item->productName = $item->product->name;
                    $item->productCover = $item->product->cover;
                    $item->productUrlhash = $item->product->urlhash;
                }


                $totalCount = $totalCount + $item->qty;
                $totalSumm = $totalSumm + ($item->productPrice * $item->qty);
            }
        }

        if ($order->status == 'paid') {
            $pay_status = 'Оплачено, ожидает отправку.';
        } else if ($order->status == 'sent') {
            $pay_status = 'Отправлено получателю.';
        } else {
            $pay_status = 'Новый заказ, ожидает оплату.';
        }

        $data = ['order' => $order, 'delivery_type' => $delivery_type, 'pay_type' => $pay_type, 'pay_status' => $pay_status, 'totalCount' => $totalCount, 'totalSumm' => $totalSumm];
        return view('admin.orderPrint')->with($data);;
    }

    public function destroyElement(Request $request, $id)
    {

        //dd($request->el);

        $item = OrderItems::where('order_id', $id)->where('id', $request->el)->first();
        $item->delete();
    }

    //destroyElement
    public function destroy($id)
    {

        //
        $order = Purchase::findOrFail($id);
        $order->delete();
    }
}
