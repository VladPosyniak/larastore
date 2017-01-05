<?php
use larashop\Currency;
use larashop\Language;
function currency($value, $currency = null) //принимает в качестве аргумента доллары и переводит их в валюту, которая стоит у пользователя вида: 25 грн.
{
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
