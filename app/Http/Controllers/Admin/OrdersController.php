<?php

namespace larashop\Http\Controllers\Admin;

use Illuminate\Http\Request;
use larashop\Coupons;
use larashop\OptionGroups;
use larashop\Options;
use larashop\Order;
use larashop\Http\Requests;
use larashop\Http\Controllers\Controller;
use larashop\OrderedProducts;
use larashop\Products;
use larashop\User;

class OrdersController extends Controller
{
    public function index(){
        $all_orders = Order::all();
        $to_processing = Order::where('to_processing','=',1)->orderBy('created_at','desk')->get();
        foreach ($to_processing as $key => $order) {
            $to_processing[$key]->user = User::find($order->user_id);
            if ($order->paid) {
                $to_processing[$key]->paid = 'Да';
            } else {
                $to_processing[$key]->paid = 'Нет';
            }

            switch ($order->pay_type) {
                case 'cash':
                    $to_processing[$key]->pay_type = 'При получении';
                    break;
                case 'liqpay':
                    break;
                case 'balance':
                    $to_processing[$key]->pay_type = 'С баланаса';
                    break;
                case 'webmoney':
                    break;
                default:
                    $to_processing[$key]->pay_type = 'Неизвестно';
                    break;
            }
        }
        foreach ($all_orders as $key => $order) {
            $all_orders[$key]->user = User::find($order->user_id);
            if ($order->paid) {
                $all_orders[$key]->paid = 'Да';
            } else {
                $all_orders[$key]->paid = 'Нет';
            }

            switch ($order->pay_type) {
                case 'cash':
                    $all_orders[$key]->pay_type = 'При получении';
                    break;
                case 'liqpay':
                    break;
                case 'balance':
                    $all_orders[$key]->pay_type = 'С баланаса';
                    break;
                case 'webmoney':
                    break;
                default:
                    $all_orders[$key]->pay_type = 'Неизвестно';
                    break;
            }
        }

        $data = [
            'all_orders' => $all_orders,
            'to_processing' => $to_processing
        ];

        return view('admin.orders.orders',$data);
    }

    public function show($id){
        $order = Order::findOrFail($id);
        $products = OrderedProducts::where('order_id','=',$id)->get();


        foreach ($products as $key=>$item){
            $products[$key]->data = Products::find($item->product_id);
            $option = '';
            foreach (explode(',',$item->options) as $opt_id){
                if ($opt_id != ''){
                    $opt = Options::find($opt_id);
                    $group = OptionGroups::find($opt['option_group_id']);
                    $option = $option.$group['name'].' : '.$opt['value'].'; ';

                    $products[$key]->data->price = $products[$key]->data->price + $opt['price'];
                }

            }
            $products[$key]->options = $option;
        }

        switch ($order->pay_type) {
            case 'cash':
                $order->pay_type = 'Наличными';
                break;
            case 'liqpay':
                break;
            case 'balance':
                $order->pay_type = 'С баланаса';
                break;
            case 'webmoney':
                break;
            default:
                $order->pay_type = 'Неизвестно';
                break;
        }

        $customer = User::find($order->user_id);

        $address = unserialize($order->delivery_address);

        if($order->coupon_id === null){
            $coupon = 'Нет';
        }
        else{
            $coupon = Coupons::find($order->coupon_id);
            $coupon = $coupon->discount.'%';
        }

        $data = [
            'order' => $order,
            'customer' => $customer,
            'address' => $address,
            'items' => $products,
            'coupon' => $coupon
        ];
        return view('admin.orders.order',$data);
    }

    public function waitStatus(Request $request, $id){
        $order = Order::findOrFail($id);
        $order->status = 'Ожидает обработки';
        $order->to_processing = 1;
        $order->save();
        $request->session()->flash('alert-success', 'Cтатус обнолен!');
        return redirect()->back();
    }
    public function processingStatus(Request $request, $id){
        $order = Order::findOrFail($id);
        $order->status = 'Обрабатывается';
        $order->to_processing = 1;
        $order->save();
        $request->session()->flash('alert-success', 'Cтатус обнолен!');
        return redirect()->back();
    }
    public function completeStatus(Request $request, $id){
        $order = Order::findOrFail($id);
        $order->status = 'Обработан';
        $order->to_processing = 0;
        $order->save();
        $request->session()->flash('alert-success', 'Cтатус обнолен!');
        return redirect()->back();
    }

}
