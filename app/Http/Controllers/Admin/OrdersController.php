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

use Mail;

class OrdersController extends Controller
{
    public function index(){
        $all_orders = Order::all();
        $to_processing = Order::where('status','=','Обрабатывается')->orderBy('created_at','desk')->get();
        $in_processing = Order::where('status','=','Обработан')->orderBy('created_at','desk')->get();
        $end_processing = Order::where('status','=','Отправлен')->orderBy('created_at','desk')->get();
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
        foreach ($in_processing as $key => $order) {
            $in_processing[$key]->user = User::find($order->user_id);
            if ($order->paid) {
                $in_processing[$key]->paid = 'Да';
            } else {
                $in_processing[$key]->paid = 'Нет';
            }

            switch ($order->pay_type) {
                case 'cash':
                    $in_processing[$key]->pay_type = 'При получении';
                    break;
                case 'liqpay':
                    break;
                case 'balance':
                    $in_processing[$key]->pay_type = 'С баланаса';
                    break;
                case 'webmoney':
                    break;
                default:
                    $in_processing[$key]->pay_type = 'Неизвестно';
                    break;
            }
        }
        foreach ($end_processing as $key => $order) {
            $end_processing[$key]->user = User::find($order->user_id);
            if ($order->paid) {
                $end_processing[$key]->paid = 'Да';
            } else {
                $end_processing[$key]->paid = 'Нет';
            }

            switch ($order->pay_type) {
                case 'cash':
                    $end_processing[$key]->pay_type = 'При получении';
                    break;
                case 'liqpay':
                    break;
                case 'balance':
                    $end_processing[$key]->pay_type = 'С баланаса';
                    break;
                case 'webmoney':
                    break;
                default:
                    $end_processing[$key]->pay_type = 'Неизвестно';
                    break;
            }
        }

        $data = [
            'all_orders' => $all_orders,
            'to_processing' => $to_processing,
            'in_processing' => $in_processing,
            'end_processing' => $end_processing,
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
        $order->status = 'Обрабатывается';
        $order->to_processing = 1;
        $order->save();
        $request->session()->flash('alert-success', 'Cтатус обновлен!');
        return redirect()->back();
    }
     public function processingStatus(Request $request, $id){
        $order = Order::findOrFail($id);
        $order->status = 'Обработан';
        $order->to_processing = 1;
        $order->save();
        $request->session()->flash('alert-success', 'Cтатус обновлен!');
        $products = OrderedProducts::where('order_id','=',$order->id)->get();
        $products_mail = [];
        foreach ($products as $key=>$item){
            $products[$key] = Products::find($item->product_id);
            $products[$key]->amount = $item->amount;
        }
        foreach ($products as $product){
            $product_mail = [
                'title' => $product->description->name,
                'amount' => $product->amount,
                'price' => currencyWithoutPrefix($product->price)
            ];
            $product_mail['total_price'] = $product_mail['price'] * $product_mail['amount'];
            $products_mail[] = $product_mail;
        }
        $order_info = unserialize($order->delivery_address);
        $total = currencyWithoutPrefix($order->to_pay);
        mail_send('mail/order_processed', ['total'=>$total, 'products' => $products_mail], $order_info['email'], 'Ваш заказ обработан!');
        return redirect()->back();
    }

    public function completeStatus(Request $request, $id){
        $order = Order::findOrFail($id);
        $order->status = 'Отправлен';
        $order->to_processing = 0;
        $order_data = unserialize($order->delivery_address);
        $order_data['express'] = $request->express_number;
        $order_data = serialize($order_data);
        $order->delivery_address =  $order_data;
        $order->save();
        $request->session()->flash('alert-success', 'Cтатус обновлен!');

        $products = OrderedProducts::where('order_id','=',$order->id)->get();
        $products_mail = [];
        foreach ($products as $key=>$item){
            $products[$key] = Products::find($item->product_id);
            $products[$key]->amount = $item->amount;
        }
        foreach ($products as $product){
            $product_mail = [
                'title' => $product->description->name,
                'amount' => $product->amount,
                'price' => currencyWithoutPrefix($product->price)
            ];
            $product_mail['total_price'] = $product_mail['price'] * $product_mail['amount'];
            $products_mail[] = $product_mail;
        }
        $order_info = unserialize($order->delivery_address);
        $express = $order_info['express'];
        $total = currencyWithoutPrefix($order->to_pay);

        mail_send('mail/order_ship', ['total'=>$total, 'products' => $products_mail, 'express'=>$express],$order_info['email'],  'Ваш заказ успешно отправлен!');

        return redirect()->back();
    }

}
