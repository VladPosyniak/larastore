<?php
namespace larashop\Http\Controllers;

use Cart;
use Illuminate\Support\Facades\DB;
use larashop\Categories;
use larashop\Comments;
use larashop\Gallery;
use larashop\Info;
use larashop\Products;
use larashop\Sliders;
use Setting;
use Visitor;

class HomeController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function totalNavLabel()
    {
        return Cart::count();
    }

    public function index()
    {

        Visitor::log();
        $products = Products::orderBy('sort_id', 'desc')->take(12)->get();
        foreach ($products as $key => $product) {
            $products[$key]['name'] = Products::find($product->id)->description->name;
        }
        $cats = Categories::orderBy('sort_id', 'asc')->get();
        $newProds = Products::orderBy('created_at', 'desc')->take(10)->get();
        foreach ($newProds as $key => $product) {
            $newProds[$key]['name'] = Products::find($product->id)->description->name;
        }

        $attr = DB::table('products')
            ->join('parameters_values', 'parameters_values.items_id', '=', 'products.id')
            ->where('parameters_values.language_id','=',currentLanguageId())
            ->join('parameters_description','parameters_description.parameter_id','=','parameters_values.parameters_id')
            ->where('parameters_description.language_id','=',currentLanguageId())
            ->select('parameters_description.title', 'parameters_values.value', 'parameters_description.unit', 'products.id')->get();

        //dd(Setting::get('config.maintitle'));

        (Setting::get('config.mainprod', Null)) ? $mainProdImg = asset('/files/img/' . Setting::get('config.mainprod')) : $mainProdImg = asset('dist/img/photo4.jpg');

        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');

        $sliders_all = Sliders::all();
        $sliders = [];
        foreach ($sliders_all as $key => $slider){
            $sliders[$slider->identificator] = $slider;
            $sliders[$slider->identificator]->data = unserialize($slider->data);
        };
        $data = [
            'cats' => $cats,
            'totalNavLabel' => $this->totalNavLabel(),
            'mainProdImg' => $mainProdImg,
            'logoMain' => $logoMain,
            'products' => $products,
            'newProds' => $newProds,
            'attr' => $attr,
            'sliders' => $sliders,
        ];
        return view('home')->with($data);

    }
}
