<?php
use larashop\Currency;
use larashop\Language;
function currency($value, $currency = null) //принимает в качестве аргумента доллары и переводит их в валюту, которая стоит у пользователя вида: 25 грн.
{
    return $value.' грн.';
    $available_currency = [];
    foreach (Currency::all() as $item) {
        $available_currency[] = $item->name;
    }

    $current_currency = '';

    if ($currency === null) {
        if (Auth::check() && Auth::user()->currency != '' && in_array(Auth::user()->currency, $available_currency)) {
            $current_currency = Currency::where('name', '=', Auth::user()->currency)->first();
            $price = $value * $current_currency['coefficient'];
            $prefix = $current_currency['prefix'];
        } elseif (Session::get('currency') != '' && in_array(Session::get('currency'), $available_currency)) {
            $current_currency = Currency::where('name', '=', Session::get('currency'))->first();
            $price = $value * $current_currency['coefficient'];
            $prefix = $current_currency['prefix'];
        } else {
            $current_currency = Currency::where('name', '=', 'USD')->first();
            $price = $value;
            $prefix = '$';
        }
    } else {
        $current_currency = Currency::where('name', '=', $currency)->first();
        $price = $value * $current_currency['coefficient'];
        $prefix = $current_currency['prefix'];
    }

    if($current_currency->name === 'UAH' || $current_currency->name === 'RUB'){
         return round($price,0). ' ' . $prefix;
    }
    else{
        return round($price, 2) . ' ' . $prefix;
    }

}

function currencyWithoutPrefix($value, $currency = null)
{
    return $value;
    $available_currency = [];
    foreach (Currency::all() as $item) {
        $available_currency[] = $item->name;
    }
    $current_currency = '';

    if ($currency === null){
        if (Auth::check() && Auth::user()->currency != '' && in_array(Auth::user()->currency, $available_currency)) {
            $current_currency = Currency::where('name', '=', Auth::user()->currency)->first();
            $price = $value * $current_currency['coefficient'];
        } elseif (Session::get('currency') != '' && in_array(Session::get('currency'), $available_currency)) {
            $current_currency = Currency::where('name', '=', Session::get('currency'))->first();
            $price = $value * $current_currency['coefficient'];
        } else {
            $current_currency = Currency::where('name', '=', 'USD')->first();
            $price = $value;
        }
    }
    else{
        $current_currency = Currency::where('name', '=', $currency)->first();
        $price = $value * $current_currency['coefficient'];
    }

    if($current_currency->name === 'UAH' || $current_currency->name === 'RUB'){
        return round($price,0);
    }
    else{
        return round($price, 2);
    }
}

function currencyPrefix()
{
    return 'грн';

//
    $available_currency = [];
    foreach (Currency::all() as $item) {
        $available_currency[] = $item->name;
    }

    if (Auth::check() && Auth::user()->currency != '' && in_array(Auth::user()->currency, $available_currency)) {
        $prefix = Currency::where('name', '=', Auth::user()->currency)->first();
        $prefix = $prefix->prefix;
    } elseif (Session::get('currency') != '') {
        $prefix = Currency::where('name', '=', Session::get('currency'))->first();
        $prefix = $prefix->prefix;
    } else {
        $prefix = 'USD';
    }

    return $prefix;
}

function currentCurrency()
{
    return 'UAH';
//
    $available_currency = [];
    foreach (Currency::all() as $item) {
        $available_currency[] = $item->name;
    }

    if (Auth::check() && Auth::user()->currency != '' && in_array(Auth::user()->currency, $available_currency)) {
        $current_currency = Currency::where('name', '=', Auth::user()->currency)->first();
        $currency = $current_currency->name;
    } elseif (Session::get('currency') != '' && in_array(Session::get('currency'), $available_currency)) {
        $current_currency = Currency::where('name', '=', Session::get('currency'))->first();
        $currency = $current_currency->name;
    } else {
        $currency = 'USD';
    }
    return $currency;
}

function toUSD($value, $currency = null)
{

    return $value;

    $available_currency = [];
    foreach (Currency::all() as $item) {
        $available_currency[] = $item->name;
    }

    if ($currency === null) {
        if (Auth::check() && Auth::user()->currency != '' && in_array(Auth::user()->currency, $available_currency)) {
            $current_currency = Currency::where('name', '=', Auth::user()->currency)->first();
            $price = $value / $current_currency['coefficient'];
        } elseif (Session::get('currency') != '' && in_array(Session::get('currency'), $available_currency)) {
            $current_currency = Currency::where('name', '=', Session::get('currency'))->first();
            $price = $value / $current_currency['coefficient'];
        } else {
            $price = $value;
        }
    }
    else{
        $current_currency = Currency::where('name', '=', $currency)->first();
        $price = $value / $current_currency['coefficient'];
    }
    return round($price, 2);
}

function currentLanguageId(){
    $language = Language::where('code','=',App::getLocale())->first();
    return $language->id;
}

function mail_send($view, $data, $email, $subject){
    $message = (string)View::make($view, $data);

    $headers = 'From: noreply@shmot.top' . "\r\n" .
        'Reply-To: patch4mee@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion(). "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    mail($email, $subject, $message, $headers);
}