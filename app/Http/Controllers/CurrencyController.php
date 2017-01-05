<?php

namespace larashop\Http\Controllers;

use Illuminate\Http\Request;
use larashop\Currency;
use larashop\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use larashop\User;

class CurrencyController extends Controller
{
    public function setCurrency($currency){
        $available_currency = [];
        foreach (Currency::all() as $item){
            $available_currency[] = $item->name;
        }

        if (in_array($currency, $available_currency)) {   # Проверяем, что у пользователя выбран доступный язык
            Session::put('currency', $currency);                    # И устанавливаем его в сессии под именем locale

            if(Auth::check()) {
                $user = User::find(Auth::user()->id);
                $user->currency = $currency;
                $user->save();
            }
        }

        setcookie ("basket", "", 1,'/');
        return redirect()->back();
    }
}
