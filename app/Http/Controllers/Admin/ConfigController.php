<?php
namespace larashop\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Image;
use larashop\Http\Controllers\Controller;
use larashop\Purchase;
use Setting;
use Validator;


class ConfigController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
        $data = ['NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.settings.config')->with($data);
    }


    public function update(Request $request)
    {

        //

        $validator = Validator::make($request->all(), [
            'logo' => 'mimes:jpeg,bmp,png',
            'favicon' => 'mimes:ico',
            'mainprod' => 'mimes:jpeg,bmp,png',
            'sitename' => 'required',
            'email' => 'required|email',
//            'maintitle' => 'required',
//            'mainwords' => 'required',
//            'maindesc' => 'required',
//            'galtitle' => 'required',
//            'galwords' => 'required',
//            'galdesc' => 'required',
//            'infotitle' => 'required',
//            'infowords' => 'required',
//            'infodesc' => 'required',
//            'mainprodtitle' => 'required',
//            'mainproddesc' => 'required',
//            'mainprodlink' => 'required'
        ]);

        if ($validator->fails()) {
            $request->session()->flash('alert-danger', $validator->errors()->first());
            return back()->withErrors($validator)->withInput();
        } else {
            $logoName = Setting::get('config.logo');

            $logoReq = $request->file('logo');

            $favicon = $request->file('favicon');

            if (isset($logoReq)) {
                $extension = $logoReq->getClientOriginalExtension();
                $logo = Image::make($logoReq);

                // resize image
                $logo->fit(224, 80);

                // save image
                $string = str_random(40);
                $logoName = $string . '.' . $extension;
                $logo->save('files/img/' . $logoName);
            }

            if (isset($favicon)) {
                $favicon->move(public_path(""),'favicon.ico');
            }

            $mainprodName = Setting::get('config.mainprod');
            $mainprodReq = $request->file('mainprod');
            if (isset($mainprodReq)) {
                $mainprodextension = $mainprodReq->getClientOriginalExtension();
                $mainprod = Image::make($mainprodReq)->fit(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // save image
                $mainprodstring = str_random(40);
                $mainprodName = $mainprodstring . '.' . $mainprodextension;
                $mainprod->save('files/img/' . $mainprodName);
            }

            Setting::set('config.logo', $logoName);
            Setting::set('config.mainprod', $mainprodName);
            //sitecolor
            Setting::set('config.sitecolor', $request->sitecolor);
            Setting::set('config.sitename', $request->sitename);
            Setting::set('config.sitedesc', $request->sitedesc);
            Setting::set('config.email', $request->email);
            Setting::set('config.maintitle', $request->maintitle);
            Setting::set('config.mainwords', $request->mainwords);
            Setting::set('config.maindesc', $request->maindesc);
            Setting::set('config.galtitle', $request->galtitle);
            Setting::set('config.galwords', $request->galwords);
            Setting::set('config.galdesc', $request->galdesc);
            Setting::set('config.infotitle', $request->infotitle);
            Setting::set('config.infowords', $request->infowords);
            Setting::set('config.infodesc', $request->infodesc);
            Setting::set('config.mainprodtitle', $request->mainprodtitle);
            Setting::set('config.mainproddesc', $request->mainproddesc);
            Setting::set('config.mainprodlink', $request->mainprodlink);
            Setting::set('view.theme_color', $request->theme_color);
            Setting::set('view.theme_smoothscroll', $request->theme_smoothscroll);
            Setting::save();

            $request->session()->flash('alert-success', 'Конфигурация сохранена!');
            return redirect('admin/settings/main');
        }
    }

    public function payment()
    {
        $data = ['NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.settings.payment')->with($data);
    }

    public function updatePayment(Request $request)
    {
        $validator = Validator::make($request->all(),
            [

        ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {



            Setting::set('ligpay.publicKey',trim($request->liqpay_publicKey));
            Setting::set('ligpay.privateKey',trim($request->liqpay_privateKey));
            if ($request->liqpay_testmode === 'on'){
                Setting::set('liqpay.testmode',1);
            }
            else{
                Setting::set('liqpay.testmode',0);
            }

            Setting::save();
            $request->session()->flash('alert-success', 'Конфигурация сохранена!');
            return redirect('admin/settings/payment');
        }
    }

    public function social()
    {
        $data = ['NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.settings.social')->with($data);
    }

    public function updateSocial(Request $request){
        $validator = Validator::make($request->all(),
            [

            ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {



            Setting::set('socialite.vkontakte-client_id',trim($request->vk_id));
            Setting::set('socialite.vkontakte-client_secret',trim($request->vk_key));
            Setting::save();
            $request->session()->flash('alert-success', 'Конфигурация сохранена!');
            return redirect('admin/settings/payment');
        }
    }

    public function seo(){
        $data = ['NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.settings.seo')->with($data);
    }

    public function updateSeo(Request $request){
        $validator = Validator::make($request->all(),
            [

            ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {
            Setting::set('seo.home_title', $request->home_title);
            Setting::set('seo.home_keywords', $request->home_keywords);
            Setting::set('seo.home_description', $request->home_description);
            Setting::set('seo.catalog_description', $request->catalog_description);
            Setting::set('seo.catalog_keywords', $request->catalog_keywords);
            Setting::set('seo.catalog_title', $request->catalog_title);
            Setting::save();
            $request->session()->flash('alert-success', 'Конфигурация сохранена!');
            return redirect('admin/settings/seo');

        }
    }

}
