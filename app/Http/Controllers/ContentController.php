<?php
namespace larashop\Http\Controllers;

use DB;
use File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use larashop\Categories;
use larashop\CategoryDescription;
use larashop\ClassDescription;
use larashop\Classes;
use larashop\Comments;
use larashop\Favourite;
use larashop\Filters;
use larashop\Gallery;
use larashop\Info;
use larashop\Language;
use larashop\Options;
use larashop\Parameters;
use larashop\ParametersDescription;
use larashop\ParametersValues;
use larashop\ProductDescription;
use larashop\ProductFilter;
use larashop\ProductImage;
use larashop\ProductOptions;
use larashop\Products;
use larashop\Purchase;
use larashop\recommendsProducts;
use Validator;

//use Input;

class ContentController extends Controller
{


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

        $data = ['NewOrderCounter' => Purchase::Neworders()->count(), 'classes' => Classes::all(), 'languages' => Language::all()];

        return view('admin.content.categoryCreate')->with($data);
    }

    public function editCat($id)
    {

        //
        $cat = Categories::findOrFail($id);
        $classes = Classes::all();
        $currentClass = Classes::find($cat->class_id);

        $descriptions = [];
        foreach (Language::all() as $language) {
            foreach ($cat->all_descriptions as $description) {
                if ($language->id === $description->language_id) {
                    $descriptions[$language->code] = $description;
                }
            }
        }

        $data = [
            'cat' => $cat,
            'NewOrderCounter' => Purchase::Neworders()->count(),
            'classes' => $classes,
            'currentClass' => $currentClass,
            'languages' => Language::all(),
            'descriptions' => $descriptions
        ];
        return view('admin.content.categoryEdit')->with($data);
    }

    public function updateCat(Request $request, $id)
    {

        $cat = Categories::findOrFail($id);

        if (isset($request->cover)) {
            File::delete('files/cats/img/' . $cat->cover);
        }

        $cover = $request->file('cover');

        //dd(Input::file());
        isset($cover) ? $extension = $cover->getClientOriginalExtension() : null;

        //$extension = $cover->getClientOriginalExtension();
        $rules = [
            'urlhash' => 'required|min:2|max:255',
            'cover' => 'mimes:jpeg,bmp,png',
            'class' => 'required|integer',
        ];
        foreach (Language::all() as $language) {
            $rules['name_' . $language->code] = 'required|min:3';
            $rules['description_' . $language->code] = 'required';
            $rules['title_' . $language->code] = 'required';
            $rules['keywords_' . $language->code] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

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
                'cover' => $coverdb,
                'urlhash' => $request->urlhash,
                'class_id' => $request->class,
            );
            $cat->update($arr);

            foreach (Language::all() as $language) {
                $cat_description = CategoryDescription::where(
                    [
                        ['language_id', '=', $language->id],
                        ['category_id', '=', $id]
                    ]
                )->first();
                $cat_description->name = $request->{'name_' . $language->code};
                $cat_description->title = $request->{'title_' . $language->code};
                $cat_description->description = $request->{'description_' . $language->code};
                $cat_description->keywords = $request->{'keywords_' . $language->code};
                $cat_description->update();
            }

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

        $rules = [
            'urlhash' => 'required|min:2|max:255',
            'cover' => 'mimes:jpeg,bmp,png',
            'class' => 'required|integer',
        ];
        foreach (Language::all() as $language) {
            $rules['name_' . $language->code] = 'required|min:3';
            $rules['description_' . $language->code] = 'required';
            $rules['title_' . $language->code] = 'required';
            $rules['keywords_' . $language->code] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

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


            foreach (Language::all() as $lang) {
                $category_description = new CategoryDescription();
                $category_description->language_id = $lang->id;
                $category_description->category_id = $category->id;
                $category_description->name = $request->{'name_' . $lang->code};
                $category_description->description = $request->{'description_' . $lang->code};
                $category_description->title = $request->{'title_' . $lang->code};
                $category_description->keywords = $request->{'keywords_' . $lang->code};
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

        ClassDescription::where('category_id', '=', $id)->delete();

        $cat->delete();


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

//        получаем нужные данные
        $cats = Categories::orderBy('sort_id', 'asc')->get();
        $prods = Products::orderBy('sort_id', 'asc')->get();
        $classes = Classes::orderBy('id', 'asc')->get();
        $languages = Language::all();
        $filters = Filters::orderBy('id')->get();
        $options = Options::all();
//        преобразуем их в нужный вид
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
//          создаем массив с данными
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

        //
        $cover = $request->file('cover');
        $languages = Language::all();

        isset($cover) ? $extension = $cover->getClientOriginalExtension() : null;
        ($request->isset == 'true') ? $isset = 1 : $isset = 0;

        $rules = [
            'cover' => 'mimes:jpeg,bmp,png|required',
            'quantity' => 'integer',
            'price' => 'required|integer',
            'price_old' => 'integer',
            'category' => 'integer',
            'filters' => 'array',
            'related' => 'array',
            'product_images' => 'array'
        ];
        foreach (Language::all() as $language) {
            $rules['parameter_id_' . $language->code] = 'array';
            $rules['parameter_value_' . $language->code] = 'array';
            $rules['title_' . $language->code] = 'required';
            $rules['keywords_' . $language->code] = 'required';
            $rules['name_' . $language->code] = 'required';
            $rules['description_' . $language->code] = 'required';
            $rules['description_full_' . $language->code] = 'required';
            $rules['description_meta_' . $language->code] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {

            $coverdb = Null;
            if (isset($cover)) {
                $img = Image::make($cover);
                // resize image
                $img->fit(700, 700, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                // save image
                $string = str_random(40);
                $img->save('files/products/img/' . $string . '.' . $extension);
                // resize image
                $img_small = Image::make($cover)->fit(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img_medium = Image::make($cover)->fit(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // save image
                $img_medium->save('files/products/img/medium'.$string.'.'.$extension);
                $img_small->save('files/products/img/small/' . $string . '.' . $extension);
                $coverdb = $string . '.' . $extension;
            }


            $class_id = Categories::find($request->categories_id);
            $class_id = $class_id->class_id;


            if ($request->price_old !== '') {
                $price_old = toUSD($request->price_old, 'UAH');
            } else {
                $price_old = null;
            }
            $arr = array(
                'cover' => $coverdb,
                'price' => toUSD($request->price, 'UAH'),
                'price_old' => $price_old,
                'isset' => $isset,
                'categories_id' => $request->categories_id,
                'class_id' => $class_id,
                'quantity' => $request->quantity
            );

            $product = Products::create($arr);
            $product->recommendProds()->attach($request->related);

            if (isset($request->product_images)) {
                if (is_array($request->product_images)) {
                    $product_images = $request->product_images;
                } else {
                    $product_images = [];
                    $product_images[0] = $request->product_images;
                }

                foreach ($product_images as $image) {
                    $image = Image::make($image);
                    $image->fit(700, 700, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $string = str_random(40);


                    $image_small = Image::make($image)->fit(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $img_medium = Image::make($image)->fit(400, 400, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });

                    // save image
                    $image->save('files/products/img/' . $string . '.' . $extension);
                    $image_small->save('files/products/img/small/' . $string . '.' . $extension);
                    $img_medium->save('files/products/img/medium/' . $string . '.' . $extension);

                    $product_image = new ProductImage();
                    $product_image->url = $string . '.' . $extension;
                    $product_image->product_id = $product->id;
                    $product_image->save();

                }
            }

            foreach ($languages as $language) {
//                return $request->{'name_'.$language->code};
                $product_description = new ProductDescription();
                $product_description->product_id = $product->id;
                $product_description->language_id = $language->id;
                $product_description->name = $request->{'name_' . $language->code};
                $product_description->title = $request->{'title_' . $language->code};
                $product_description->keywords = $request->{'keywords_' . $language->code};
                $product_description->description = $request->{'description_' . $language->code};
                $product_description->description_full = $request->{'description_full_' . $language->code};
                $product_description->description_meta = $request->{'description_meta_' . $language->code};
                $product_description->save();
            }


            foreach ($languages as $language) {
                if (is_array($request->{'parameter_id_' . $language->code}) && is_array($request->{'parameter_value_' . $language->code})) {
                    $parameters = array_combine($request->{'parameter_id_' . $language->code}, $request->{'parameter_value_' . $language->code});
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
        $myopt = $product->productOptions;
        $filters = Filters::orderBy('id')->get();

        $my_parameters = $product->productParameters;
        $myfilters = $product->productFilters;
        $cats = Categories::orderBy('sort_id', 'asc')->get();
        $prods = Products::orderBy('sort_id', 'asc')->get();
        $myprod = $product->recommendProd;

        $parameters = [];
        foreach (Language::all() as $language) {
            $parameters[$language->code] = ParametersDescription::where('language_id', '=', $language->id)->get();
        }

        $opt_arr = [];
        foreach ($options as $key => $value) {
            $opt_arr[$value->id] = $value->name;
        }
        $filters_arr = [];
        foreach ($filters as $key => $value) {
            $filters_arr[$value->id] = $value->description_ru->value;
        }
        $myopt_arr = [];
        foreach ($myopt as $key => $value) {
            array_push($myopt_arr, $value->pivot->option_id);
        }
        foreach ($my_parameters as $key => $parameter) {
            $my_parameters[$key]->parameter_info = Parameters::find($parameter->parameters_id);
        }
        $myfilters_arr = [];
        foreach ($myfilters as $key => $value) {
            array_push($myfilters_arr, $value->filter_id);
        }
        $prods_arr = [];
        foreach ($prods as $key => $value) {
            $prods_arr[$value->id] = $value->description->name;
        }
        $cats_arr = [];
        foreach ($cats as $key => $value) {
            $cats_arr[$value->id] = $value->description->name;
        }
        $myprods_arr = [];

        foreach ($myprod as $key => $value) {

            //$myprods_arr[] = $value->id;
            array_push($myprods_arr, $value->product_id_recommend);
        }

        $parameters_description = [];
        foreach (Language::all() as $language) {
            $parameters_description[$language->code] = DB::table('parameters')
                ->join('parameters_values', 'parameters.id', '=', 'parameters_values.parameters_id')
                ->where('parameters_values.items_id', '=', $id)
                ->where('parameters_values.language_id', '=', $language->id)
                ->join('parameters_description', 'parameters_description.parameter_id', '=', 'parameters_values.parameters_id')
                ->where('parameters_description.language_id', '=', $language->id)
                ->select('parameters_description.title', 'parameters_description.unit', 'parameters_values.value')->get();
        }

        $product_description = [];
        foreach (Language::all() as $language) {
            $product_description[$language->code] = ProductDescription::where([
                ['product_id', '=', $id],
                ['language_id', '=', $language->id]
            ])->first();
        }


        ($product->isset == 'false') ? $product->isset = Null : $product->isset;

        //dd($product->isset);
        $data = [
            'CatList' => $cats_arr,
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
            'languages' => Language::all(),
            'parameters_description' => $parameters_description,
            'product_description' => $product_description
        ];

        return view('admin.content.productEdit')->with($data);
    }

    public function updateProduct(Request $request, $id)
    {

//        return dd($request->all());
//        foreach (ProductImage::where('product_id', '=', $id)->get()->all() as $image) {
//            if (!in_array($image->id, $request->images_old)) {
//                ProductImage::find($image->id)->delete();
//                return 'sada';
//            }
//            else{
//                return 'bad';
//            }
//        }



        $product = Products::findOrFail($id);

        $cover = $request->file('cover');

        //dd(Input::file());
        isset($cover) ? $extension = $cover->getClientOriginalExtension() : null;
        ($request->isset == 'true') ? $isset = 1 : $isset = 0;

        //$extension = $cover->getClientOriginalExtension();

        $rules = [
            'cover' => 'mimes:jpeg,bmp,png',
            'quantity' => 'integer',
            'price' => 'required|integer',
            'price_old' => 'integer',
            'category' => 'integer',
            'filters' => 'array',
            'related' => 'array',
            'product_images' => 'array'
        ];
        foreach (Language::all() as $language) {
            $rules['parameter_id_' . $language->code] = 'array';
            $rules['parameter_value_' . $language->code] = 'array';
            $rules['title_' . $language->code] = 'required';
            $rules['keywords_' . $language->code] = 'required';
            $rules['name_' . $language->code] = 'required';
            $rules['description_' . $language->code] = 'required';
            $rules['description_full_' . $language->code] = 'required';
            $rules['description_meta_' . $language->code] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {

            if ($cover) {
                if (isset($product->cover)) {
                    File::delete('files/cats/img/' . $product->cover);
                    File::delete('files/cats/img/small/' . $product->cover);
                    File::delete('files/cats/img/medium/' . $product->cover);
                }
                $img = Image::make($cover);

                // resize image
                $img->fit(700, 700);

                // save image
                $string = str_random(40);
                $img->save('files/products/img/' . $string . '.' . $extension);

                // resize image
                $img_small = Image::make($cover)->fit(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img_medium = Image::make($cover)->fit(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // save image
                $img_small->save('files/products/img/small/' . $string . '.' . $extension);
                $img_medium->save('files/products/img/medium/' . $string . '.' . $extension);

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
            $arr_product = array(
                'cover' => $coverdb,
                'price' => toUSD($request->price, 'UAH'),
                'price_old' => $price_old,
                'isset' => $isset,
                'categories_id' => $request->categories_id,
                'class_id' => $class_id,
                'quantity' => $request->quantity
            );
            $arr_description = [];
            foreach (Language::all() as $language) {
                $arr_description['name'] = $request->{'name_' . $language->code};
                $arr_description['title'] = $request->{'title_' . $language->code};
                $arr_description['keywords'] = $request->{'keywords_' . $language->code};
                $arr_description['description'] = $request->{'description_' . $language->code};
                $arr_description['description_full'] = $request->{'description_full_' . $language->code};
                $arr_description['description_meta'] = $request->{'description_meta_' . $language->code};
                $product_description = ProductDescription::where(
                    [
                        ['product_id', '=', $id],
                        ['language_id', '=', $language->id]
                    ])->first();
                $product_description->update($arr_description);
            }

            $product->update($arr_product);

            $product->recommendProds()->detach();
            $product->recommendProds()->attach($request->related);

            $product->productOptions()->detach();
            $product->productOptions()->attach($request->opts);

            $delete_parameters = ParametersValues::where('items_id', '=', $product->id)->delete();

            foreach (Language::all() as $language) {
                if (is_array($request->{'parameter_id_' . $language->code}) && is_array($request->{'parameter_value_' . $language->code})) {
                    $parameters = array_combine($request->{'parameter_id_'.$language->code}, $request->{'parameter_value_'.$language->code});
                    foreach ($parameters as $param => $value) {
                        $parameters = new ParametersValues();
                        $parameters->parameters_id = $param;
                        $parameters->items_id = $product->id;
                        $parameters->value = $value;
                        $parameters->language_id = $language->id;
                        $parameters->save();
                    }
                }
            }

            ProductFilter::where('product_id', '=', $product->id)->delete();
            if (isset($request->filters)) {
                foreach ($request->filters as $filter) {
                    $new_filter = new ProductFilter();
                    $new_filter->product_id = $product->id;
                    $new_filter->filter_id = $filter;
                    $new_filter->save();
                }
            }

            if ($request->images_old === null){
                $request->images_old = [];
            }

            foreach (ProductImage::where('product_id', '=', $id)->get()->all() as $image) {
                if (!in_array($image->id, $request->images_old)) {
                    File::delete('/files/products/img/small/'.$image->url);
                    File::delete('/files/products/img/medium/'.$image->url);
                    File::delete('/files/products/img/'.$image->url);
                    $image->delete();
                }
            }
            if (is_array($request->product_images)){
                foreach ($request->product_images as $image){
                    $extension = $image->getClientOriginalExtension();
                    $image = Image::make($image);
                    $image->fit(700, 700, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $image_small = Image::make($image)->fit(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $img_medium = Image::make($image)->fit(400, 400, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $string = str_random(40);
                    // save image
                    $image->save('files/products/img/' . $string . '.' . $extension);
                    $image_small->save('files/products/img/small/' . $string . '.' . $extension);
                    $img_medium->save('files/products/img/medium/' . $string . '.' . $extension);

                    $product_image = new ProductImage();
                    $product_image->url = $string . '.' . $extension;
                    $product_image->product_id = $product->id;
                    $product_image->save();
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
            File::delete('files/cats/img/medium/' . $prod->cover);
        }
        foreach ($prod->images as $image){
            File::delete('files/cats/img/' . $image->url);
            File::delete('files/cats/img/small/' . $image->url);
            File::delete('files/cats/img/medium/' . $image->url);
            $image->delete();
        }

        $product_description = ProductDescription::where('product_id', '=', $prod->id)->get();
        foreach ($product_description as $item) {
            $desc = ProductDescription::find($item->id);
            $desc->delete();
        }
        Favourite::where('product_id','=',$id)->delete();
        ParametersValues::where('items_id','=',$id)->delete();
        ProductFilter::where('product_id','=',$id)->delete();
        ProductOptions::where('product_id','=',$id)->delete();
        recommendsProducts::where('product_id','=',$id)->delete();

        $prod->delete();

        $request->session()->flash('alert-success', 'Товар успешно удален!');
        return redirect()->back();


    }

}
