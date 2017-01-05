<?php
namespace larashop\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use larashop\Clients;
use larashop\Http\Controllers\Controller;
use larashop\Order;
use larashop\OrderedProducts;
use larashop\Products;
use larashop\Purchase;
use larashop\User;
use larashop\Visitors;
use Validator;
use Visitor;

//use Tracker;

//use DateTime;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard()
    {


        Date::setLocale('ru');
        $current_date = Date::now();
        $clients_count = User::all()->count();
        $products_count = Products::all()->count();
        $orders_count = Order::all()->count();
        $orders = Order::orderBy('updated_at', 'desk')->take(10)->get();
        $unique_users = Visitors::all()->count();
        $online = Visitors::where('updated_at','>',new Carbon('yesterday'))->count();


        foreach ($orders as $key => $order) {
            $orders[$key]['updated_at'] = new Date($order['updated_at']);
            $orders[$key]['updated_at']->setLocale('ru');
            $orders[$key]['created_at'] = new Date($order['created_at']);
            $orders[$key]['created_at']->setLocale('ru');
        }

        foreach ($orders as $key => $order) {
            $orders[$key]['products'] = OrderedProducts::where('order_id', '=', $order->id);
        }


        $cash = 0;

        foreach (Order::where('paid', '=', 1)->get() as $order) {
            $cash = $cash + $order->to_pay;
        }

        $all_month_orders = [
            'January' => Order::whereBetween('created_at',[$current_date->year.'-01-01 00:00:00',$current_date->year.'-01-31 23:59:59'])->count(),
            'February' => Order::whereBetween('created_at',[$current_date->year.'-02-01 00:00:00',$current_date->year.'-02-31 23:59:59'])->count(),
            'March' => Order::whereBetween('created_at',[$current_date->year.'-03-01 00:00:00',$current_date->year.'-03-31 23:59:59'])->count(),
            'April' => Order::whereBetween('created_at',[$current_date->year.'-04-01 00:00:00',$current_date->year.'-04-31 23:59:59'])->count(),
            'May' => Order::whereBetween('created_at',[$current_date->year.'-05-01 00:00:00',$current_date->year.'-05-31 23:59:59'])->count(),
            'June' => Order::whereBetween('created_at',[$current_date->year.'-06-01 00:00:00',$current_date->year.'-06-31 23:59:59'])->count(),
            'July' => Order::whereBetween('created_at',[$current_date->year.'-07-01 00:00:00',$current_date->year.'-07-31 23:59:59'])->count(),
            'August' => Order::whereBetween('created_at',[$current_date->year.'-08-01 00:00:00',$current_date->year.'-08-31 23:59:59'])->count(),
            'September' => Order::whereBetween('created_at',[$current_date->year.'-09-01 00:00:00',$current_date->year.'-09-31 23:59:59'])->count(),
            'October' => Order::whereBetween('created_at',[$current_date->year.'-10-01 00:00:00',$current_date->year.'-10-31 23:59:59'])->count(),
            'November' => Order::whereBetween('created_at',[$current_date->year.'-11-01 00:00:00',$current_date->year.'-11-31 23:59:59'])->count(),
            'December' => Order::whereBetween('created_at',[$current_date->year.'-12-01 00:00:00',$current_date->year.'-12-31 23:59:59'])->count(),
        ];
//        return dd($all_month_orders);
        $data = [
            'clients_count' => $clients_count,
            'products_count' => $products_count,
            'orders_count' => $orders_count,
            'cash' => $cash,
            'orders' => $orders,
            'unique_users' => $unique_users,
            'online' => $online,
            'all_month_orders' => $all_month_orders
        ];

        return view('admin.dashboard_new', $data);
    }


    public function index()
    {

        //

        $clients = Clients::all();
        $purchase = Purchase::all();
        $products = Products::all();

        //$orders=Purchase::all();
        $ordersLim = Order::orderBy('id', 'desc')->take(5)->get();

//        foreach ($ordersLim as $order) {
//
//            if ($order->status == 'paid') {
//                $order->rowStyle = 'warning';
//            }
//            else if ($order->status == 'sent') {
//                $order->rowStyle = 'success';
//            }
//            else {
//                $order->rowStyle = '';
//            }
//
//            $ordertotalCount = 0;
//            $ordertotalSumm = 0;
//
//            $itemFast = false;
//            $itemGift = false;
//
////            foreach ($order->items as $item) {
////
////                if ($item->product_id == 'np') {
////                    $ordertotalSumm = $ordertotalSumm + (Setting::get('product.np'));
////                }
////                else if ($item->product_id == 'fast') {
////                    $itemFast = true;
////                    $ordertotalSumm = $ordertotalSumm + (Setting::get('product.fast'));
////                }
////                else if ($item->product_id == 'gift') {
////                    $itemGift = true;
////                    $ordertotalSumm = $ordertotalSumm + ((Setting::get('product.gift')) * $item->qty);
////                }
////                else {
////
////
////                    if (strpos($item->product_id, '0000') ) {
////                        //dd('consist');
////                        $pID=explode('0000', $item->product_id);
////                        $option=Options::findOrFail($pID[1]);
////                        $product=Products::findOrFail($pID[0]);
////                        $productPrice= $option->price;
////                        $item->productPrice = $productPrice;
////                        $item->productName = $product->name . ' (' . $option->name . ')' ;
////                        $item->productCover = $product->cover;
////                        $item->productUrlhash = $product->urlhash;
////
////                    }
////                    else {
////                        $productPrice = $item->product->price;
////                        $item->productPrice = $item->product->price;
////                        $item->productName = $item->product->name;
////                        $item->productCover = $item->product->cover;
////                        $item->productUrlhash = $item->product->urlhash;
////                    }
////
////
////
////                    $ordertotalCount = $ordertotalCount + $item->qty;
////                    $ordertotalSumm = $ordertotalSumm + ($item->productPrice * $item->qty);
////                }
////            }
//
////            $order->itemFast = $itemFast;
////            $order->itemGift = $itemGift;
////            $order->totalCount = $ordertotalCount;
////            $order->totalSumm = $ordertotalSumm;
//        }

        //dd($order->totalSumm);
//
//        $orders = Purchase::where('status', 'sent')->get();
//
//        $totalSumm = 0;
//        $totalCount = 0;
//
//        foreach ($orders as $order) {
//
//            foreach ($order->items as $item) {
//
//                if ($item->product_id == 'np') {
//                    $totalSumm = $totalSumm + (Setting::get('product.np'));
//                }
//                else if ($item->product_id == 'fast') {
//                    $totalSumm = $totalSumm + (Setting::get('product.fast'));
//                }
//                else if ($item->product_id == 'gift') {
//                    $totalSumm = $totalSumm + ((Setting::get('product.gift')) * $item->qty);
//                }
//                else {
//
//                    if (strpos($item->product_id, '0000') ) {
//                        //dd('consist');
//                        $pID=explode('0000', $item->product_id);
//                        $option=Options::findOrFail($pID[1]);
//                        $product=Products::findOrFail($pID[0]);
//                        $productPrice= $option->price;
//                        $item->productPrice = $productPrice;
//                        $item->productName = $product->name . ' (' . $option->name . ')' ;
//                        $item->productCover = $product->cover;
//                        $item->productUrlhash = $product->urlhash;
//
//                    }
//                    else {
//                        $productPrice = $item->product->price;
//                        $item->productPrice = $item->product->price;
//                        $item->productName = $item->product->name;
//                        $item->productCover = $item->product->cover;
//                        $item->productUrlhash = $item->product->urlhash;
//                    }
//
//
//                    $totalCount = $totalCount + $item->qty;
//                    $totalSumm = $totalSumm + ($item->productPrice * $item->qty);
//                }
//            }
//        }
//
//        $topProds = DB::table('order_items')->select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->orderBy('total', 'desc')->take('5')
//
//        //->lists('total','product_id')
//        ->get();
//
//        $topProdsArr = [];
//
//        //dd($topProds);
//
//        foreach ($topProds as $topprod) {
//
//            if (!in_array($topprod->product_id, ['fast', 'np', 'gift'])) {
//
//
//                    if (strpos($topprod->product_id, '0000') ) {
//                        //dd('consist');
//                        $pID=explode('0000', $topprod->product_id);
//                        //$topprod->product_id = $pID[0];
//                        $prodID=$pID[0];
//
//                    }
//                    else {
//                        $prodID = $topprod->product_id;
//                    }
//
//
//                $prodName = Products::findOrFail($prodID );
//
//                //echo $prodName->name;
//
//                array_push($topProdsArr, ['name' => $prodName->name, 'urlhash' => $prodName->urlhash, 'qty' => $topprod->total]);
//                // code...
//
//
//            }
//        }
//
//        /*OrderItems::whereNotIn('product_id', ['np','fast','gift'])
//            ->orderBy('qty')
//            ->groupBy('product_id')
//            ->get();*/
//
//        //dd($topProdsArr);
//        //$NewOrderCounter=Purchase::Neworders()->count();
//
//        $data = ['totalClients' => $clients->count() , 'totalPurchase' => $purchase->count() , 'totalPurchaseOk' => $purchase->where('status', 'sent')->count() , 'totalProducts' => $products->count() , 'totalMoney' => $totalSumm, 'totalCount' => $totalCount, 'orders' => $ordersLim, 'topProds' => $topProdsArr, 'NewOrderCounter' => Purchase::Neworders()->count() ];
//
        return view('admin.dashboard');
    }

    public function showStat()
    {

        //$sessions = Tracker::sessions(5 * 60 * 24)->all();

        $d1 = Visitor::range(Carbon::now()->format('Y-m-d'), Carbon::now()->format('Y-m-d'));
        $d2 = Visitor::range(Carbon::now()->subDay(1)->format('Y-m-d'), Carbon::now()->subDay(1)->format('Y-m-d'));
        $d3 = Visitor::range(Carbon::now()->subDay(2)->format('Y-m-d'), Carbon::now()->subDay(2)->format('Y-m-d'));
        $d4 = Visitor::range(Carbon::now()->subDay(3)->format('Y-m-d'), Carbon::now()->subDay(3)->format('Y-m-d'));
        $d5 = Visitor::range(Carbon::now()->subDay(4)->format('Y-m-d'), Carbon::now()->subDay(4)->format('Y-m-d'));

        //dd(Purchase::Neworders()->count());

        //dd(Config('mail.username'));

        //dd($d1);

        $data = [[Carbon::now()->subDay(4)->format('Y-m-d'), $d5], [Carbon::now()->subDay(3)->format('Y-m-d'), $d4], [Carbon::now()->subDay(2)->format('Y-m-d'), $d3], [Carbon::now()->subDay(1)->format('Y-m-d'), $d2], [Carbon::now()->format('Y-m-d'), $d1],
        ];

        return response()->json($data);
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

    }

    //DashboardController
    public function editPersonal()
    {

        //

        $user = Auth::user();

        $data = ['user' => $user, 'NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.personal')->with($data);
    }


//updatePersonalMail
    public function updatePersonalMail(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $validator = Validator::make($request->all(),
            ['email' => 'required|email']);

        if ($validator->fails()) {

            return back()->withErrors($validator);
        } else {

            $user->email = $request->email;
            $user->save();

            $request->session()->flash('alert-success', 'Конфигурация успешно обновлена!');
            return back();

        }
    }


    public function updatePersonal(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        //dd($request->password);

        Validator::extend('passcheck', function ($attribute, $value, $parameters) {
            return Hash::check($value, Auth::user()->getAuthPassword());
        });

        $validator = Validator::make($request->all(), ['password' => 'required|confirmed|min:6', 'old_password' => 'required|passcheck|min:6'], ['passcheck' => 'Your old password was incorrect']);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $user->password = bcrypt($request->password);
            $user->save();

            $request->session()->flash('alert-success', 'Конфигурация успешно обновлена!');
            return back();
        }
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //

    }
}
