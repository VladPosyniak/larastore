<?php
namespace larashop\Http\Controllers;

use DB;
use File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use larashop\Categories;
use larashop\CategoryDescription;
use larashop\Classes;
use larashop\Comments;
use larashop\Filters;
use larashop\Gallery;
use larashop\Info;
use larashop\Language;
use larashop\Options;
use larashop\Parameters;
use larashop\ParametersValues;
use larashop\ProductDescription;
use larashop\ProductFilter;
use larashop\Products;
use larashop\Purchase;
use Validator;

//use Input;

class ContentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //


    }


    public function indexOptions()
    {

        $options = Options::all();

        $data = ['options' => $options,
            'NewOrderCounter' => Purchase::Neworders()->count()];

        return view('admin.content.options')->with($data);


    }


    public function createOptions()
    {

        $data = [
            'NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.content.optionsCreate')->with($data);
    }


    public function storeOptions(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required|min:2|max:255', 'price' => 'required']);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {


            Options::create([

                'name' => $request->name,
                'price' => $request->price

            ]);
            $request->session()->flash('alert-success', 'Опция успешно создана!');
            return redirect('content/options');

        }
    }


    public function editOptions($id)
    {


        $option = Options::findOrFail($id);

        $data = ['option' => $option,
            'NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.content.optionsEdit')->with($data);

    }


    public function updateOptions(Request $request, $id)
    {

        $option = Options::findOrFail($id);
        $validator = Validator::make($request->all(), ['name' => 'required|min:2|max:255', 'price' => 'required']);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {
            $option->update([

                'name' => $request->name,
                'price' => $request->price

            ]);

            $request->session()->flash('alert-success', 'Опция успешно сохранена!');
            return redirect('content/options');

        }


    }


    public function destroyOptions($id)
    {
        $option = Options::findOrFail($id);

        $option->delete();

    }


    public function indexCat()
    {

        //

        $cats = Categories::orderBy('sort_id', 'asc')->get();

        $data = ['cats' => $cats, 'NewOrderCounter' => Purchase::Neworders()->count()];

        return view('admin.content.category')->with($data);
    }

    public function createCat()
    {

        $data = ['NewOrderCounter' => Purchase::Neworders()->count(), 'classes' => Classes::all(),'languages' => Language::all()];

        return view('admin.content.categoryCreate')->with($data);
    }

    public function editCat($id)
    {

        //
        $cat = Categories::findOrFail($id);
        $classes = Classes::where('id', '<>', $cat->class_id)->get();
        $currentClass = Classes::find($cat->class_id);
        $data = ['cat' => $cat, 'NewOrderCounter' => Purchase::Neworders()->count(), 'classes' => $classes, 'currentClass' => $currentClass];
        return view('admin.content.categoryEdit')->with($data);
    }

    public function updateCat(Request $request, $id)
    {

        $cat = Categories::findOrFail($id);

//        if (isset($cat->cover)) {
//            File::delete('files/cats/img/' . $cat->cover);
//        }

        $cover = $request->file('cover');

        //dd(Input::file());
        isset($cover) ? $extension = $cover->getClientOriginalExtension() : null;

        //$extension = $cover->getClientOriginalExtension();

        $validator = Validator::make($request->all(), ['name' => 'required|min:2|max:255',
            'description' => 'required|min:2|max:255',
            'urlhash' => 'required|min:2|max:255',
            'cover' => 'mimes:jpeg,bmp,png',
            'class' => 'required|integer',
            'title' => 'required',
            'keywords' => 'required'
        ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {
            $coverdb = $cat->cover;
            if (isset($cover)) {
                $img = Image::make($cover);

                // resize image
                $img->fit(200, 200);

                // save image
                $string = str_random(40);
                $img->save('files/cats/img/' . $string . '.' . $extension);

                $coverdb = $string . '.' . $extension;
            }
            $arr = array(
                'name' => $request->name,
                'description' => $request->description,
                'cover' => $coverdb,
                'urlhash' => $request->urlhash,
                'class_id' => $request->class,
                'keywords' => $request->keywords,
                'title' => $request->title
            );
            $cat->update($arr);

            $request->session()->flash('alert-success', 'Категория успешно обновлена!');
            return redirect('admin/content/cat');
        }
    }

    public function storeCat(Request $request)
    {


        $cover = $request->file('cover');

        //dd(Input::file());
        isset($cover) ? $extension = $cover->getClientOriginalExtension() : null;

        //$extension = $cover->getClientOriginalExtension();

        $validator = Validator::make($request->all(), [
//            'name' => 'required|min:2|max:255',
//            'description' => 'required|min:2|max:255',
            'urlhash' => 'required|min:2|max:255',
            'cover' => 'mimes:jpeg,bmp,png',
            'class' => 'required|integer',
//            'title' => 'required',
//            'keywords' => 'required',
        ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {
            $coverdb = Null;
            if (isset($cover)) {
                $img = Image::make($cover);

                // resize image
                $img->fit(200, 200);

                // save image
                $string = str_random(40);
                $img->save('files/cats/img/' . $string . '.' . $extension);

                $coverdb = $string . '.' . $extension;
            }

            $category = new Categories();
            $category->urlhash = $request->urlhash;
            $category->class_id = $request->class;
            $category->cover = $coverdb;
            $category->save();


            foreach (Language::all() as $lang){
                $category_description = new CategoryDescription();
                $category_description->language_id = $lang->id;
                $category_description->category_id = $category->id;
                $category_description->name = $request->{'name_'.$lang->code};
                $category_description->description = $request->{'description_'.$lang->code};
                $category_description->title = $request->{'title_'.$lang->code};
                $category_description->keywords = $request->{'keywords_'.$lang->code};
                $category_description->save();
            }

            $request->session()->flash('alert-success', 'Категория успешно создана!');
            return redirect('admin/content/cat');
        }
    }

    public function sortCat(Request $request)
    {
        $i = 0;
        $tap = $request->item;
        foreach ($tap as $value) {

            // Execute statement:
            // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
            DB::table('categories')->where('id', $value)->update(['sort_id' => $i]);
            $i++;
        }

        //dd($tap);


    }

    public function destroyCat(Request $request, $id)
    {

        $cat = Categories::findOrFail($id);

        if (isset($cat->cover)) {
            File::delete('files/cats/img/' . $cat->cover);
        }

        $cat->delete();

        //$request->session()->flash('alert-success', 'Категория успешно удалена!');
        //return redirect('content/cat');


    }

    public function indexProduct()
    {

        //
        $products = Products::orderBy('sort_id', 'asc')->get();


        $data = ['products' => $products, 'NewOrderCounter' => Purchase::Neworders()->count()];

        return view('admin.content.product')->with($data);
    }

    public function createProduct()
    {

        //
        $cats = Categories::orderBy('sort_id', 'asc')->get();
        $prods = Products::orderBy('sort_id', 'asc')->get();
        $classes = Classes::orderBy('id', 'asc')->get();
        $languages = Language::all();
        $filters = Filters::orderBy('id')->get();

        $options = Options::all();
        $opt_arr = [];
        foreach ($options as $key => $value) {
            $opt_arr[$value->id] = $value->name;
        }

        $filters_arr = [];
        foreach ($filters as $key => $value) {
            $filters_arr[$value->id] = $value->description_ru->value;
        }

        $cats_arr = [];
        foreach ($cats as $key => $value) {
            $cats_arr[$value->id] = $value->description->name;
        }
        $classes_arr = [];
        foreach ($classes as $key => $value) {
            $classes_arr[$value->id] = $value->name;
        }
        $prods_arr = [];
        foreach ($prods as $key => $value) {
            $prods_arr[$value->id] = $value->description->name;
        }

        //dd($prods_arr);
        $data = [
            'CatList' => $cats_arr,
            'Classes' => $classes_arr,
            'Prods' => $prods_arr,
            'NewOrderCounter' => Purchase::Neworders()->count(),
            'opt_arr' => $opt_arr,
            'filters' => $filters_arr,
            'languages' => $languages
        ];
        return view('admin.content.productCreate')->with($data);
    }

    public function storeProduct(Request $request)
    {
//        return dd($request->all());
        //
        $cover = $request->file('cover');
        $languages = Language::all();

        //dd(Input::file());
        isset($cover) ? $extension = $cover->getClientOriginalExtension() : null;
        ($request->isset == 'true') ? $isset = 'true' : $isset = 'false';

        //$extension = $cover->getClientOriginalExtension();

        $validator = Validator::make($request->all(), [
//            'name' => 'required|min:2|max:255',
//            'description' => 'required|min:2',
//            'urlhash' => 'required|min:2|max:255',
            'cover' => 'mimes:jpeg,bmp,png',
            'quantity' => 'integer'
        ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {
            $coverdb = Null;
            if (isset($cover)) {

                $img = Image::make($cover);

                // resize image
                $img->fit(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // save image
                $string = str_random(40);
                $img->save('files/products/img/' . $string . '.' . $extension);

                // resize image
                $img_small = Image::make($cover)->fit(50, 50, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // save image
                $img_small->save('files/products/img/small/' . $string . '.' . $extension);

                $coverdb = $string . '.' . $extension;
            }

            $class_id = Categories::find($request->categories_id);
            $class_id = $class_id->class_id;

//            $class_id = $class_id->id;


            if ($request->price_old !== '') {
                $price_old = toUSD($request->price_old, 'UAH');
            } else {
                $price_old = null;
            }
            $arr = array(
//                'name' => $request->name,
//                'title' => $request->title,
//                'keywords' => $request->keywords,
//                'description' => $request->description,
//                'description_full' => $request->description_full,
//                'values' => $request->values,
                'cover' => $coverdb,
                'price' => toUSD($request->price, 'UAH'),
                'price_old' => $price_old,
//                'label' => $request->label,
                'isset' => $isset,
//                'urlhash' => $request->urlhash,
                'categories_id' => $request->categories_id,
                'class_id' => $class_id,
                'quantity' => $request->quantity
            );

            $product = Products::create($arr);
            $product->recommendProds()->attach($request->related);

            foreach ($languages as $language){
//                return $request->{'name_'.$language->code};
                $product_description = new ProductDescription();
                $product_description->product_id = $product->id;
                $product_description->language_id = $language->id;
                $product_description->name = $request->{'name_'.$language->code};
                $product_description->title = $request->{'title_'.$language->code};
                $product_description->keywords = $request->{'keywords_'.$language->code};
                $product_description->description = $request->{'description_'.$language->code};
                $product_description->description_full = $request->{'description_full_'.$language->code};
                $product_description->save();
            }


            foreach ($languages as $language){
                if (is_array($request->{'parameter_id_'.$language->code}) && is_array($request->{'parameter_value_'.$language->code})) {
                    $parameters = array_combine($request->{'parameter_id_'.$language->code}, $request->{'parameter_value_'.$language->code});
                    foreach ($parameters as $param => $value) {
                        $parameters = new ParametersValues();
                        $parameters->parameters_id = $param;
                        $parameters->language_id = $language->id;
                        $parameters->items_id = $product->id;
                        $parameters->value = $value;
                        $parameters->save();
                    }
                }
            }


            if (isset($request->filters)) {
                foreach ($request->filters as $filter) {
                    $new_filter = new ProductFilter();
                    $new_filter->product_id = $product->id;
                    $new_filter->filter_id = $filter;
                    $new_filter->save();
                }
            }


            $request->session()->flash('alert-success', 'Продукт успешно создан!');
            return redirect('admin/content/prod');
        }
    }

    public function sortProduct(Request $request)
    {
        $i = 0;
        $tap = $request->item;
        foreach ($tap as $value) {

            // Execute statement:
            // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
            DB::table('products')->where('id', $value)->update(['sort_id' => $i]);
            $i++;
        }

        //dd($tap);


    }

    public function editProduct($id)
    {

        //
        $product = Products::findOrFail($id);

        $options = Options::all();
        $opt_arr = [];
        foreach ($options as $key => $value) {
            $opt_arr[$value->id] = $value->name;
        }
        $filters = Filters::orderBy('id')->get();
        $filters_arr = [];
        foreach ($filters as $key => $value) {
            $filters_arr[$value->id] = $value->value;
        }


        $myopt = $product->productOptions;
        //dd($myopt->pivot->option_id);
        $myopt_arr = [];
        foreach ($myopt as $key => $value) {

            //$myprods_arr[] = $value->id;
            array_push($myopt_arr, $value->pivot->option_id);
        }

        $parameters = Parameters::all();

        $my_parameters = $product->productParameters;
        foreach ($my_parameters as $key => $parameter) {
            $my_parameters[$key]->parameter_info = Parameters::find($parameter->parameters_id);
        }


        $myfilters = $product->productFilters;
        $myfilters_arr = [];

        foreach ($myfilters as $key => $value) {

            //$myprods_arr[] = $value->id;
            array_push($myfilters_arr, $value->filter_id);
        }

        $myprod = $product->recommendProd;
        $myprods_arr = [];

        foreach ($myprod as $key => $value) {

            //$myprods_arr[] = $value->id;
            array_push($myprods_arr, $value->product_id_recommend);
        }

        $cats = Categories::orderBy('sort_id', 'asc')->get();
        $prods = Products::orderBy('sort_id', 'asc')->get();
        $cats_arr = [];
        foreach ($cats as $key => $value) {
            $cats_arr[$value->id] = $value->name;
        }
        $prods_arr = [];
        foreach ($prods as $key => $value) {
            $prods_arr[$value->id] = $value->name;
        }

        //dd($prods_arr);
        ($product->isset == 'false') ? $product->isset = Null : $product->isset;

        //dd($product->isset);
        $data = ['CatList' => $cats_arr,
            'Prods' => $prods_arr,
            'myProds' => $myprods_arr,
            'product' => $product,
            'NewOrderCounter' => Purchase::Neworders()->count(),
            'filters' => $filters_arr,
            'opt_arr' => $opt_arr,
            'myopt_arr' => $myopt_arr,
            'myfilters_arr' => $myfilters_arr,
            'parameters' => $parameters,
            'my_parameters' => $my_parameters,

        ];

        return view('admin.content.productEdit')->with($data);
    }

    public function updateProduct(Request $request, $id)
    {


        $product = Products::findOrFail($id);

        $cover = $request->file('cover');

        //dd(Input::file());
        isset($cover) ? $extension = $cover->getClientOriginalExtension() : null;
        ($request->isset == 'true') ? $isset = 'true' : $isset = 'false';

        //$extension = $cover->getClientOriginalExtension();

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:2',
            'cover' => 'mimes:jpeg,bmp,png',
            'quantity' => 'integer'
        ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {

            if ($cover) {
                if (isset($product->cover)) {
                    File::delete('files/cats/img/' . $product->cover);
                    File::delete('files/cats/img/small/' . $product->cover);
                }
                $img = Image::make($cover);

                // resize image
                $img->fit(900, 800);

                // save image
                $string = str_random(40);
                $img->save('files/products/img/' . $string . '.' . $extension);

                // resize image
                $img_small = Image::make($cover)->fit(50, 50, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // save image
                $img_small->save('files/products/img/small/' . $string . '.' . $extension);

                $coverdb = $string . '.' . $extension;
            } else {
                $coverdb = $product->cover;
            }
            $class_id = Categories::find($request->categories_id);
            $class_id = $class_id->class_id;


            if ($request->price_old != '' && $request->price_old > 0) {
                $price_old = toUSD($request->price_old, 'UAH');
            } else {
                $price_old = null;
            }
            $arr = array(
                'name' => $request->name,
                'title' => $request->title,
                'keywords' => $request->keywords,
                'description' => $request->description,
                'description_full' => $request->description_full,
                'cover' => $coverdb,
                'price' => toUSD($request->price, 'UAH'),
                'price_old' => $price_old,
                'label' => $request->label,
                'isset' => $isset,
                'categories_id' => $request->categories_id,
                'class_id' => $class_id,
                'quantity' => $request->quantity
            );

            $product->update($arr);

            $product->recommendProds()->detach();
            $product->recommendProds()->attach($request->related);

            $product->productOptions()->detach();
            $product->productOptions()->attach($request->opts);

            $delete_parameters = ParametersValues::where('items_id', '=', $product->id)->delete();

            if (is_array($request->parameter_id) && is_array($request->parameter_value)) {
                $parameters = array_combine($request->parameter_id, $request->parameter_value);
                foreach ($parameters as $param => $value) {
                    $parameters = new ParametersValues();
                    $parameters->parameters_id = $param;
                    $parameters->items_id = $product->id;
                    $parameters->value = $value;
                    $parameters->save();
                }
            }

            $delete_filters = ProductFilter::where('product_id', '=', $product->id)->delete();
            if (isset($request->filters)) {
                foreach ($request->filters as $filter) {
                    $new_filter = new ProductFilter();
                    $new_filter->product_id = $product->id;
                    $new_filter->filter_id = $filter;
                    $new_filter->save();
                }
            }


            $request->session()->flash('alert-success', 'Продукт успешно отредактирован!');
            return redirect('admin/content/prod');
        }
    }

    public function destroyProduct(Request $request, $id)
    {

        $prod = Products::findOrFail($id);

        if (isset($prod->cover)) {
            File::delete('files/cats/img/' . $prod->cover);
            File::delete('files/cats/img/small/' . $prod->cover);
        }

        $product_description = ProductDescription::where('product_id','=',$prod->id)->get();
        foreach ($product_description as $item){
            $desc = ProductDescription::find($item->id);
            $desc->delete();
        }

        $prod->delete();

        //$request->session()->flash('alert-success', 'Категория успешно удалена!');
        //return redirect('content/cat');


    }

}
