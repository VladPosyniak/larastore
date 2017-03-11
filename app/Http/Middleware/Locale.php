<?php

namespace larashop\Http\Middleware;

use Closure;
use App;
use Config;
use Illuminate\Support\Facades\Auth;
use Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        if (Auth::check()){
//            if (in_array(Auth::user()->locale, Config::get('app.locales'))) {  # Проверяем, что у пользователя в сессии установлен доступный язык
//                $locale = Auth::user()->locale;
//
//                App::setLocale($locale);                                  # Устанавливаем локаль приложения
//
//                return $next($request);                                   # И позволяем приложению работать дальше
//            }
//        }
//        $raw_locale = Session::get('locale');     # Если пользователь уже был на нашем сайте,
//        # то в сессии будет значение выбранного им языка.
//
//        if (in_array($raw_locale, Config::get('app.locales'))) {  # Проверяем, что у пользователя в сессии установлен доступный язык
//            $locale = $raw_locale;      # И присваиваем значение переменной $locale.
//        }
//        elseif (in_array(mb_strtoupper(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)), Config::get('app.locales'))) { #пробуем узнать язык браузера
//            $locale = mb_strtoupper(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
//        }
//        else{
//            $locale = Config::get('app.locale'); # В ином случае присваиваем ей язык по умолчанию
//        }
//
//
//        App::setLocale($locale);                                  # Устанавливаем локаль приложения

        return $next($request);                                   # И позволяем приложению работать дальше


    }
}
