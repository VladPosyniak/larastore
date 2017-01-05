<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Http\Request;

Route::get('/', ['uses' => 'HomeController@index']);

Route::get('/test', ['uses' => 'PurchaseController@showMail']);

Route::get('/np_sync', ['uses' => 'PurchaseController@npSync']);

Route::get('/sitemap.xml', ['uses' => 'HomeController@indexSitemap']);

Route::get('/catalog', ['uses' => 'CatalogController@index']);
Route::get('/catalog/{class_name}', ['uses' => 'CatalogController@classes']);
Route::get('/catalog/{class_name}/{category}', ['uses' => 'CatalogController@category']);
Route::get('/product/{id}', ['uses' => 'CatalogController@product']);

Route::get('/liqpay', ['uses' => 'OrdersController@liqpay']);


// orders

Route::get('/checkout', ['uses' => 'OrdersController@checkout']);
Route::post('/checkout', ['uses' => 'OrdersController@processing']);
Route::post('/liqpay-success/{id}', ['uses' => 'OrdersController@liqpaySuccess']);
Route::post('/event-create', ['uses' => 'OrdersController@eventCreate']);
Route::get('/event-create-success', ['uses' => 'OrdersController@eventCreateSuccess']);

// /orders

// profile
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile/settings', ['uses' => 'ProfileController@settings']);
    Route::post('/profile/settings', ['uses' => 'ProfileController@updateSettings']);
    Route::post('/changepassword', ['uses' => 'ProfileController@changePassword']);
    Route::get('/profile/history', ['uses' => 'ProfileController@history']);
    Route::post('/profile/createaddress', ['uses' => 'ProfileController@createAddress']);
    Route::post('/profile/updateaddress', ['uses' => 'ProfileController@changeAddress']);
    Route::get('/profile/getaddress/{id}', ['uses' => 'ProfileController@getAddress']);

    Route::get('/profile/coupons', ['uses' => 'ProfileController@coupons']);
    Route::get('/profile/orders', ['uses' => 'ProfileController@orders']);
});

// /profile


Route::get('/gallery', ['uses' => 'HomeController@showGallery']);

Route::get('/info', ['uses' => 'HomeController@showInfo']);

Route::get('/check', ['uses' => 'HomeController@showCheck']);

Route::get('checkQuery', function () {
    if (Input::get('code')) {
        return redirect('check/' . Input::get('code'));
    } else {
        return Redirect::back();
    }
});

//локалицзация
Route::get('setlocale/{locale}', ['uses' => 'LocaleController@setLocale']);
//конец локализации
//выбор валюты
Route::get('setcurrency/{currency}', ['uses' => 'CurrencyController@setCurrency']);
//конец выбора валюты

//Route::get('/check/{id}', ['uses' => 'HomeController@showCheckByCode']);
//Route::post('/comment/{id}', ['uses' => 'HomeController@storeComment']);

//Route::get('/purchase', ['uses' => 'PurchaseController@index']);
//Route::post('/purchase', ['uses' => 'PurchaseController@store']);

//Route::get('/getUnit/{id}', ['uses' => 'PurchaseController@npGetUnit']);

//Route::get('/setting/set', ['uses' => 'PurchaseController@settingSet']);
//Route::get('/setting/get', ['uses' => 'PurchaseController@settingGet']);

//Route::patch('basket/add/{id}', ['uses' => 'BasketController@storeProduct']);
//Route::get('basket', ['uses' => 'BasketController@index']);
//Route::delete('basket/empty', ['uses' => 'BasketController@destroy']);
//Route::delete('basket/remove/{id}', ['uses' => 'BasketController@destroyElement']);
//Route::post('basket/update/{id}', ['uses' => 'BasketController@update']);
//Route::patch('basket/delivery', ['uses' => 'BasketController@updateDelivery']);
//Route::patch('basket/fast', ['uses' => 'BasketController@updateFast']);
//Route::patch('basket/gift', ['uses' => 'BasketController@updateGift']);

//Route::get('/basket', 'BasketController@show');

//payment/privat24
//Route::any('payment/privat24', ['uses' => 'PurchaseController@showPrivat24']);
//Route::any('payment/liqpay', ['uses' => 'PurchaseController@showLiqpay']);

//getUnit
//npGetCity

Route::get('/admin', function () {
    return redirect('admin/dashboard');
});


Route::group(['middleware' => ['auth','manager']], function () {

    //delivery
    Route::get('delivery/message', ['uses' => 'DeliveryController@index']);
    Route::post('delivery/message', ['uses' => 'DeliveryController@store']);

    Route::get('delivery/author', ['uses' => 'DeliveryController@author']);


    Route::get('delivery/subscribers', ['uses' => 'DeliveryController@subscribers']);
    Route::delete('delivery/subscribers/unsubscribe/{email}', ['uses' => 'DeliveryController@unsubscribe']);

    Route::get('delivery/campaigns', ['uses' => 'DeliveryController@campaigns']);
    Route::delete('delivery/campaigns/delete/{id}', ['uses' => 'DeliveryController@deleteCampaign']);
    Route::get('delivery/campaigns/reports/{id}', ['uses' => 'DeliveryController@campaignReports']);
    Route::get('delivery/campaigns/create', ['uses' => 'DeliveryController@createCampaign']);
    Route::post('delivery/campaigns/create', ['uses' => 'DeliveryController@storeCampaign']);
    Route::get('delivery/campaigns/send/{id}', ['uses' => 'DeliveryController@sendCampaign']);


    Route::get('admin/dashboard', ['uses' => 'Admin\DashboardController@dashboard']);

    Route::get('admin/content/cat', ['uses' => 'ContentController@indexCat']);
    Route::get('admin/content/cat/add', ['uses' => 'ContentController@createCat']);
    Route::post('admin/content/cat/add', ['uses' => 'ContentController@storeCat']);
    Route::patch('admin/content/cat/sort', ['uses' => 'ContentController@sortCat']);
    Route::get('admin/content/cat/edit/{id}', ['uses' => 'ContentController@editCat']);
    Route::patch('admin/content/cat/edit/{id}', ['uses' => 'ContentController@updateCat']);
    Route::delete('admin/content/cat/delete/{id}', ['uses' => 'ContentController@destroyCat']);
    Route::get('admin/content/cat/delete', function (Request $request) {
        $request->session()->flash('alert-success', 'Категория успешно удалена!');
        return redirect('admin/content/cat');
    });

    Route::get('admin/content/sliders', ['uses' => 'Admin\SliderController@sliders']);
    Route::get('admin/content/sliders/create', ['uses' => 'Admin\SliderController@create']);
    Route::post('admin/content/sliders/store', ['uses' => 'Admin\SliderController@store']);
    Route::get('admin/content/sliders/edit/{id}', ['uses' => 'Admin\SliderController@edit']);
    Route::post('admin/content/sliders/update/{id}', ['uses' => 'Admin\SliderController@update']);

    Route::get('admin/content/classes', ['uses' => 'Admin\ClassController@indexClass']);
    Route::get('admin/content/classes/add', ['uses' => 'Admin\ClassController@createClass']);
    Route::post('admin/content/classes/add', ['uses' => 'Admin\ClassController@storeClass']);
    Route::patch('admin/content/classes/sort', ['uses' => 'Admin\ClassController@sortClass']);
    Route::get('admin/content/classes/edit/{id}', ['uses' => 'Admin\ClassController@editClass']);
    Route::patch('admin/content/classes/edit/{id}', ['uses' => 'Admin\ClassController@updateClass']);
    Route::delete('admin/content/classes/delete/{id}', ['uses' => 'Admin\ClassController@destroyClass']);
    Route::get('admin/content/classes/delete', function (Request $request) {
        $request->session()->flash('alert-success', 'Категория успешно удалена!');
        return redirect('admin/content/classes');
    });

    Route::get('admin/content/prod', ['uses' => 'ContentController@indexProduct']);
    Route::get('admin/content/product/add', ['uses' => 'ContentController@createProduct']);
    Route::post('admin/content/product/add', ['uses' => 'ContentController@storeProduct']);
    Route::post('admin/content/product/getParameters', 'Admin\ProductController@getParameters');
    Route::post('admin/content/product/createParameter', 'Admin\ProductController@createParameter');
    Route::patch('admin/content/product/sort', ['uses' => 'ContentController@sortProduct']);
    Route::get('admin/content/product/edit/{id}', ['uses' => 'ContentController@editProduct']);
    Route::patch('admin/content/product/edit/{id}', ['uses' => 'ContentController@updateProduct']);
    Route::delete('admin/content/product/delete/{id}', ['uses' => 'ContentController@destroyProduct']);
    Route::get('admin/content/product/delete', function (Request $request) {
        $request->session()->flash('alert-success', 'Продукт успешно удалён!');
        return redirect('admin/content/prod');
    });


    Route::get('admin/personal', ['uses' => 'Admin\DashboardController@editPersonal']);
    Route::patch('admin/personal', ['uses' => 'Admin\DashboardController@updatePersonal']);

    Route::get('admin/content/filter-groups',['uses' => 'Admin\FilterController@filterGroups']);
    Route::get('admin/content/filter-groups/create',['uses' => 'Admin\FilterController@filterGroupsCreate']);
    Route::post('admin/content/filter-groups/store',['uses' => 'Admin\FilterController@filterGroupsStore']);
    Route::get('admin/content/filter-groups/edit/{id}',['uses' => 'Admin\FilterController@filterGroupsEdit']);
    Route::patch('admin/content/filter-groups/update/{id}',['uses' => 'Admin\FilterController@filterGroupsUpdate']);
    Route::get('admin/content/filter-groups/delete/{id}',['uses' => 'Admin\FilterController@filterGroupsDelete']);

    Route::get('admin/content/filters',['uses' => 'Admin\FilterController@filters']);
    Route::get('admin/content/filters/create',['uses' => 'Admin\FilterController@filterCreate']);
    Route::post('admin/content/filters/store',['uses' => 'Admin\FilterController@filterStore']);
    Route::get('admin/content/filters/edit/{id}',['uses' => 'Admin\FilterController@filterEdit']);
    Route::patch('admin/content/filters/update/{id}',['uses' => 'Admin\FilterController@filterUpdate']);
    Route::get('admin/content/filters/delete/{id}',['uses' => 'Admin\FilterController@filterDelete']);



    Route::group(['middleware' => 'admin'], function () { //страницы доступные только адмнистрацие
        Route::get('admin/settings/main', ['uses' => 'Admin\ConfigController@index']);
        Route::patch('admin/settings/main', ['uses' => 'Admin\ConfigController@update']);
        Route::get('admin/settings/payment', ['uses' => 'Admin\ConfigController@payment']);
        Route::patch('admin/settings/payment', ['uses' => 'Admin\ConfigController@updatePayment']);
        Route::get('admin/settings/seo', ['uses' => 'Admin\ConfigController@seo']);
        Route::patch('admin/settings/seo', ['uses' => 'Admin\ConfigController@updateSeo']);

        Route::get('admin/integration', ['uses' => 'Admin\IntegrationController@index']);
        Route::patch('admin/integration', ['uses' => 'Admin\IntegrationController@update']);

        Route::get('admin/clients/{id}',['uses'=>'Admin\ClientsController@edit']);
        Route::patch('admin/clients/{id}',['uses'=>'Admin\ClientsController@update']);

    });


    Route::get('admin/clients', ['uses' => 'ClientsController@index']);
    Route::get('admin/clients/{id}', ['uses' => 'ClientsController@edit']);
    Route::patch('admin/clients/{id}', ['uses' => 'ClientsController@update']);
    Route::delete('admin/clients/{id}', ['uses' => 'ClientsController@destroy']);

    Route::get('admin/orders', ['uses' => 'Admin\OrdersController@index']);
    Route::get('admin/orders/show/{id}', ['uses' => 'Admin\OrdersController@show']);
    Route::get('admin/orders/changestatus/{id}/wait', ['uses' => 'Admin\OrdersController@waitStatus']);
    Route::get('admin/orders/changestatus/{id}/processing', ['uses' => 'Admin\OrdersController@processingStatus']);
    Route::get('admin/orders/changestatus/{id}/complete', ['uses' => 'Admin\OrdersController@completeStatus']);


//    Route::get('orders/edit/{id}', ['uses' => 'OrdersController@edit']);
//    Route::patch('orders/{id}', ['uses' => 'OrdersController@update']);
//    Route::delete('orders/{id}', ['uses' => 'OrdersController@destroy']);
//    Route::get('orders/{id}/print', ['uses' => 'OrdersController@showPrint']);
//    Route::patch('orders/{id}/status/new', ['uses' => 'OrdersController@updateStatusNew']);
//    Route::patch('orders/{id}/status/paid', ['uses' => 'OrdersController@updateStatusPaid']);
//    Route::patch('orders/{id}/status/sent', ['uses' => 'OrdersController@updateStatusSent']);
//    Route::patch('orders/{id}/ttn', ['uses' => 'OrdersController@updateTtn']);

//    Route::patch('order/{id}/delivery', ['uses' => 'OrdersController@updateDelivery']);
//    Route::get('order/{id}/cart', ['uses' => 'OrdersController@showCart']);
//
//    Route::patch('order/{id}/fast', ['uses' => 'OrdersController@updateFast']);
//    Route::patch('order/{id}/gift', ['uses' => 'OrdersController@updateGift']);
//    Route::delete('order/{id}/remove', ['uses' => 'OrdersController@destroyElement']);
//    Route::post('order/{id}/update', ['uses' => 'OrdersController@updateQty']);

//    Route::get('order/download/{id}', ['uses' => 'OrdersController@showFile']);

    //Binotel
//    Route::get('binotel', ['uses' => 'Binotel\BinotelController@index']);

    //storeItem
//    Route::post('order/{id}/store', ['uses' => 'OrdersController@storeItem']);

    //    Route::get('content/options', ['uses' => 'ContentController@indexOptions']);
//    Route::get('content/options/add', ['uses' => 'ContentController@createOptions']);
//    Route::patch('content/options/add', ['uses' => 'ContentController@storeOptions']);
//    Route::get('content/options/edit/{id}', ['uses' => 'ContentController@editOptions']);
//    Route::post('content/options/edit/{id}', ['uses' => 'ContentController@updateOptions']);
//    Route::delete('content/options/delete/{id}', ['uses' => 'ContentController@destroyOptions']);


//    Route::get('content/gallery', ['uses' => 'ContentController@indexGallery']);
//    Route::patch('content/gallery/add', ['uses' => 'ContentController@storeImage']);
//    Route::delete('content/gallery/delete/{id}', ['uses' => 'ContentController@destroyImage']);
//    Route::patch('content/gallery/sort', ['uses' => 'ContentController@sortImage']);

//    Route::get('content/comments', ['uses' => 'ContentController@indexComments']);
//    Route::patch('content/comments/{id}', ['uses' => 'ContentController@updateCommentsApprove']);
//    Route::delete('content/comments/{id}', ['uses' => 'ContentController@destroyComments']);

//    Route::get('stat', ['uses' => 'DashboardController@showStat']);
    //    Route::get('admin/settings/social', ['uses' => 'Admin\ConfigController@social']);
//    Route::patch('admin/settings/social', ['uses' => 'Admin\ConfigController@updateSocial']);
    //updatePersonalMupdatePersonalMail
    Route::patch('admin/personalMail', ['uses' => 'Admin\DashboardController@updatePersonalMail']);

//    Route::get('content/info', ['uses' => 'ContentController@indexInfo']);

    //ContentController@updateInfo
//    Route::patch('content/info/update', ['uses' => 'ContentController@updateInfo']);

//    Route::get('money', ['uses' => 'MoneyController@index']);
//    Route::patch('money', ['uses' => 'MoneyController@update']);


});

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

Route::get('registration', 'Auth\AuthController@getRegister');
Route::post('registration', 'Auth\AuthController@postRegister');


Route::get('/socialite/{provider}', 'SocialAuthController@redirect');
Route::get('/socialite/{provider}/callback', 'SocialAuthController@callback');

// Password reset link request routes...
Route::get('forgot', 'Auth\PasswordController@getEmail');
Route::post('forgot', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//short link for group or user
Route::get('{id}.html', ['uses' => 'SearchController@ShortLinkHtml']);
Route::get('{id}', ['uses' => 'SearchController@ShortLinkCategory']);
