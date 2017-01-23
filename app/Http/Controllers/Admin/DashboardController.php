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

}
