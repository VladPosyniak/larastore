<?php

namespace larashop\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use larashop\Categories;
use larashop\ProductDescription;
use Validator;
use Visitor;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        Visitor::log();

        $validator = Validator::make($request->all(), [
            'category' => 'integer'
        ]);

        if ($validator->fails()) {
            return redirect(url('search'))->withErrors($validator);
        } else {

            $keyword = '%' . $request->keyword . '%';
            $products = ProductDescription::orderBy('name', 'asc')->where(
                [
                    ['language_id', '=', currentLanguageId()],
                    ['name', 'like', $keyword],
                ])->get();
            foreach ($products as $key => $product) {
                $products[$key]['id'] = $product->product->id;
                $products[$key]['cover'] = $product->product->cover;
                $products[$key]['price'] = $product->product->price;

                if ($request->has('category')) {
                    $category = (int)$request->category;
                    if ($product->product->categories_id !== $category) {
                        unset($products[$key]);
                    }
                }
            }
        }


        $attr = DB::table('products')
            ->join('parameters_values', 'parameters_values.items_id', '=', 'products.id')
            ->where('parameters_values.language_id', '=', currentLanguageId())
            ->join('parameters_description', 'parameters_description.parameter_id', '=', 'parameters_values.parameters_id')
            ->where('parameters_description.language_id', '=', currentLanguageId())
            ->select('parameters_description.title', 'parameters_values.value', 'parameters_description.unit', 'products.id')->get();

        $data = [
            'products' => $products,
            'attr' => $attr,
            'categories' => Categories::all(),
            'keyword' => $request->keyword,
            'current_category' => $request->category

        ];

        return view('search', $data);
    }
}
