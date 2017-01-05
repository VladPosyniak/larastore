<?php

namespace larashop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use larashop\User;
use Session;
use larashop\Http\Requests;

class LocaleController extends Controller
{
    public function setLocale($locale){
        if (in_array($locale, \Config::get('app.locales'))) {   # Проверяем, что у пользователя выбран доступный язык
            Session::put('locale', $locale);                    # И устанавливаем его в сессии под именем locale

            if(Auth::check()) {
                $user = User::find(Auth::user()->id);
                $user->locale = $locale;
                $user->save();
            }
        }

        return redirect()->back();                              # Редиректим пользователя назад
    }
}
