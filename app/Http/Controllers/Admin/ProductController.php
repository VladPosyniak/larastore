<?php

namespace larashop\Http\Controllers\Admin;

use Illuminate\Http\Request;
use larashop\Http\Controllers\Controller;
use larashop\Language;
use larashop\Parameters;
use larashop\ParametersDescription;
use larashop\ParametersValues;

class ProductController extends Controller
{
    public function getParameters(Request $request)
    {
        $parameters = Parameters::all();
        foreach ($parameters as $key => $parameter){
            $parameters[$key]->unit = Parameters::find($parameter->id)->description_ru->unit;
            $parameters[$key]->title = Parameters::find($parameter->id)->description_ru->title;
        }
        $language = Language::find($request->lang);

        return view('admin.content.parameters',['parameters'=>$parameters,'language'=>$language]);
    }

    public function createParameter(Request $request)
    {
        $parameter = new Parameters();
        $parameter->save();
        foreach (Language::all() as $language) {
            $parameter_description = new ParametersDescription();
            $parameter_description->language_id = $language->id;
            $parameter_description->parameter_id = $parameter->id;
            $parameter_description->title = $request->{'title_'.$language->code};
            $parameter_description->unit = $request->{'unit_'.$language->code};
            $parameter_description->save();
        }
        $parameter_description_ru = ParametersDescription::where('parameter_id','=',$parameter->id)->where('language_id','=',1)->first();
        return [$parameter->id, $parameter_description_ru->title, $parameter_description_ru->unit]; //возвращаем массив из id созданого параметра и название параметра
    }

}
