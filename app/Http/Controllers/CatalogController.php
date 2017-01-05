<?php
namespace larashop\Http\Controllers;

use Cart;
use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use larashop\Categories;
use larashop\Classes;
use larashop\FilterGroup;
use larashop\OptionGroups;
use larashop\Options;
use larashop\Products;
use larashop\recommendsProducts;
use Setting;
use Visitor;

class CatalogController extends Controller
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

    public function index(Request $request)
    {

        //
        Visitor::log();
        $cats = Categories::orderBy('sort_id', 'asc')->get();
        $products = Products::orderBy('sort_id', 'asc')->paginate(30);
        foreach ($products as $key => $product) {
            $products[$key]['name'] = Products::find($product->id)->description->name;
        }
        $classes = Classes::all();

        $attr = DB::table('products')
            ->join('parameters_values', 'parameters_values.items_id', '=', 'products.id')
            ->where('parameters_values.language_id','=',currentLanguageId())
            ->join('parameters_description','parameters_description.parameter_id','=','parameters_values.parameters_id')
            ->where('parameters_description.language_id','=',currentLanguageId())
            ->select('parameters_description.title', 'parameters_values.value', 'parameters_description.unit', 'products.id')->get();

        $filter_groups = FilterGroup::all();
        $filters = [];
        foreach ($filter_groups as $filter_group) {
            $filters[] = FilterGroup::find($filter_group->id)->filterId;
        }


        (Setting::get('config.mainprod', Null)) ? $mainProdImg = asset('/files/img/' . Setting::get('config.mainprod')) : $mainProdImg = asset('dist/img/photo4.jpg');

        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');

//        $topProds = DB::table('order_items')->select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->orderBy('total', 'desc')->take('3')
//            //->lists('total','product_id')
//            ->get();
//        $topProdsArr = [];
//        foreach ($topProds as $topprod) {
//
//            if (!in_array($topprod->product_id, ['fast', 'np', 'gift'])) {
//
//
//                if (strpos($topprod->product_id, '0000')) {
//                    //dd('consist');
//                    $pID = explode('0000', $topprod->product_id);
//                    //$topprod->product_id = $pID[0];
//                    $prodID = $pID[0];
//
//                } else {
//                    $prodID = $topprod->product_id;
//                }
//
//
//                $prodName = Products::findOrFail($prodID);
//
//                //echo $prodName->name;
//
//
//                array_push($topProdsArr, ['name' => $prodName->name, 'cover' => $prodName->cover, 'link' => $prodName->urlhash, 'price' => $prodName->price]);
//            }
//            // code...
//
//        }

        //dd(collect($topProdsArr));

        $data =
            [
                'cats' => $cats,
                'products' => $products,
                'PageDescr' => Setting::get('config.maindesc'),
                'PageWords' => Setting::get('config.mainwords'),
                'PageAuthor' => '',
                'PageTitle' => Setting::get('config.maintitle'),
                'mainProdImg' => $mainProdImg,
                'logoMain' => $logoMain,
//                'topProds' => $topProdsArr,
            'totalNavLabel' => $this->totalNavLabel(),
            'filtersGroups' => $filter_groups,
            'filters' => $filters,
            'classes' => $classes,
            'attr' => $attr];

        if ($request->ajax()) {
            $template = $request->input('template');
            $filtersId = $request->input('filters');
            $minPrice = toUSD(intval($request->input('minPrice')));
            $maxPrice = toUSD(intval($request->input('maxPrice')));
            $filters = [];
            if ($filtersId !== null) {
                if (count($filtersId) !== 1) {
                    foreach ($filtersId as $filter) {
                        $filters[] = json_decode(json_encode(DB::table('product_filter')
                            ->where('filter_id', '=', $filter)
                            ->join('products', 'products.id', '=', 'product_filter.product_id')
                            ->where([
                                ['price', '>=', $minPrice],
                                ['price', '<=', $maxPrice]])
                            ->join('products_description', 'products_description.product_id', '=', 'products.id')
                            ->where('products_description.language_id', '=', currentLanguageId())
                            ->get()), True);
                    }


                    $page = 1; // Get the current page or default to 1
                    $perPage = 50;
                    $offset = ($page * $perPage) - $perPage;

                    $result = [
                        'products' => new LengthAwarePaginator(array_slice($this->convergence($filters), $offset, $perPage, true), count($this->convergence($filters)), $perPage, $page, ['path' => $request->url(), 'query' => $request->query()]),
                        'attr' => $attr
                    ];
                    return response()->json(view()->make('catalog.products_smarty' . $template, $result)->render());

                } else {
                    $filters[] = json_decode(json_encode(DB::table('product_filter')
                        ->where('filter_id', '=', $filtersId[0])
                        ->join('products', 'products.id', '=', 'product_filter.product_id')
                        ->where([
                            ['price', '>=', $minPrice],
                            ['price', '<=', $maxPrice]])
                        ->join('products_description', 'products_description.product_id', '=', 'products.id')
                        ->where('products_description.language_id', '=', currentLanguageId())
                        ->get()), True);

                    $page = 1; // Get the current page or default to 1
                    $perPage = 50;
                    $offset = ($page * $perPage) - $perPage;

                    $result = [
                        'products' => new LengthAwarePaginator(array_slice($filters[0], $offset, $perPage, true), count($filters[0]), $perPage, $page, ['path' => $request->url(), 'query' => $request->query()]),
                        'attr' => $attr
                    ];
                    return response()->json(view()->make('catalog.products_smarty' . $template, $result)->render());
//                    return dd($filters);
                }
            }
            $data = [
                'products' => Products::where([
                    ['price', '>=', $minPrice],
                    ['price', '<=', $maxPrice]
                ])
                    ->join('products_description', 'products_description.product_id', '=', 'products.id')
                    ->where('products_description.language_id', '=', currentLanguageId())
                    ->paginate(30),
                'attr' => $attr
            ];
            return response()->json(view()->make('catalog.products_smarty' . $template, $data)->render());
        }

        return view('catalog.catalog_smarty')->with($data);
    }


    public function category($class_name, $category, Request $request)
    {

        Visitor::log();

        $attr = DB::table('products')
            ->join('parameters_values', 'parameters_values.items_id', '=', 'products.id')
            ->where('parameters_values.language_id','=',currentLanguageId())
            ->join('parameters_description','parameters_description.parameter_id','=','parameters_values.parameters_id')
            ->where('parameters_description.language_id','=',currentLanguageId())
            ->select('parameters_description.title', 'parameters_values.value', 'parameters_description.unit', 'products.id')->get();

        $currentCategory = Categories::where('urlhash', $category)->first();
        $currentClass = Classes::where('urlhash', $class_name)->first();
        if ($currentCategory === null) {
            return redirect(url('/catalog'));
        }
        if ($currentCategory->class_id !== $currentClass->id) {
            return redirect(url('/catalog'));
        }

        $cats = Categories::orderBy('sort_id', 'asc')->get();
        $products = Products::orderBy('sort_id', 'asc')->where('categories_id', $currentCategory->id)->paginate(30);

        (Setting::get('config.mainprod', Null)) ? $mainProdImg = asset('/files/img/' . Setting::get('config.mainprod')) : $mainProdImg = asset('dist/img/photo4.jpg');

        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');

//        $topProds = DB::table('order_items')->select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->orderBy('total', 'desc')->take('3')
//            //->lists('total','product_id')
//            ->get();
//        $topProdsArr = [];
//        foreach ($topProds as $topprod) {
//
//            if (!in_array($topprod->product_id, ['fast', 'np', 'gift'])) {
//
//
//                if (strpos($topprod->product_id, '0000')) {
//                    //dd('consist');
//                    $pID = explode('0000', $topprod->product_id);
//                    //$topprod->product_id = $pID[0];
//                    $prodID = $pID[0];
//
//                } else {
//                    $prodID = $topprod->product_id;
//                }
//
//
//                $prodName = Products::findOrFail($prodID);
//
//                //echo $prodName->name;
//
//
//                array_push($topProdsArr, ['name' => $prodName->name, 'cover' => $prodName->cover, 'link' => $prodName->urlhash, 'price' => $prodName->price]);
//            }
//            // code...
//
//        }

        //dd(collect($topProdsArr));

        $data = [
            'cats' => $cats,
            'products' => $products,
            'PageDescr' => Setting::get('config.maindesc'),
            'PageWords' => Setting::get('config.mainwords'),
            'PageAuthor' => '',
            'PageTitle' => Setting::get('config.maintitle'),
            'mainProdImg' => $mainProdImg,
            'logoMain' => $logoMain,
//            'topProds' => $topProdsArr,
            'totalNavLabel' => $this->totalNavLabel(),
            'currentClass' => $currentClass,
            'currentCat' => $currentCategory,
            'attr' => $attr];

        if ($request->ajax()) {
            $template = $request->input('template');
            return response()->json(view()->make('catalog.products_smarty' . $template, $data)->render());
        }

        return view('catalog.category_smarty')->with($data);
    }


    private function convergence($array, $id = null)
    {
        $result = [];
        $array_count = count($array);
        foreach ($array[$array_count - 1] as $key => $value) {
            $next_array = $array;
            unset($next_array[$array_count - 1]);
            if ($id != null) {
                if ($value['id'] == $id) {
                    if (empty($next_array)) {
                        $result[] = $value;
                        return $result;
                    } else {
                        $next_result = $this->convergence($next_array, $id);
                        $result = array_merge($result, $next_result);
                    }
                }
            } else {
                $next_result = $this->convergence($next_array, $value['id']);
                $result = array_merge($result, $next_result);
            }
        }
        return $result;
    }

    public function classes($class_name, Request $request)
    {


        Visitor::log();

        $currentClass = Classes::where('urlhash', $class_name)->first();

        $filter_groups = FilterGroup::where('filter_class_id', $currentClass->id)->get();
        $filters = [];
        foreach ($filter_groups as $filter_group) {
            $filters[] = FilterGroup::find($filter_group->id)->filterId;
        }

        $attr = DB::table('products')
            ->join('parameters_values', 'parameters_values.items_id', '=', 'products.id')
            ->where('parameters_values.language_id','=',currentLanguageId())
            ->join('parameters_description','parameters_description.parameter_id','=','parameters_values.parameters_id')
            ->where('parameters_description.language_id','=',currentLanguageId())
            ->select('parameters_description.title', 'parameters_values.value', 'parameters_description.unit', 'products.id')->get();

        $cats = Categories::orderBy('sort_id', 'asc')->get();
        $products = Products::orderBy('sort_id', 'asc')->where('class_id', $currentClass->id)->paginate(30);

        (Setting::get('config.mainprod', Null)) ? $mainProdImg = asset('/files/img/' . Setting::get('config.mainprod')) : $mainProdImg = asset('dist/img/photo4.jpg');

        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');

//        $topProds = DB::table('order_items')->select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->orderBy('total', 'desc')->take('3')
//            //->lists('total','product_id')
//            ->get();
//        $topProdsArr = [];
//        foreach ($topProds as $topprod) {
//
//            if (!in_array($topprod->product_id, ['fast', 'np', 'gift'])) {
//
//
//                if (strpos($topprod->product_id, '0000')) {
//                    //dd('consist');
//                    $pID = explode('0000', $topprod->product_id);
//                    //$topprod->product_id = $pID[0];
//                    $prodID = $pID[0];
//
//                } else {
//                    $prodID = $topprod->product_id;
//                }
//
//
//                $prodName = Products::findOrFail($prodID);
//
//                //echo $prodName->name;
//
//
//                array_push($topProdsArr, ['name' => $prodName->name, 'cover' => $prodName->cover, 'link' => $prodName->urlhash, 'price' => $prodName->price]);
//            }
//            // code...
//
//        }

        //dd(collect($topProdsArr));

        $data = ['cats' => $cats,
            'products' => $products,
            'PageDescr' => Setting::get('config.maindesc'),
            'PageWords' => Setting::get('config.mainwords'),
            'PageAuthor' => '',
            'PageTitle' => Setting::get('config.maintitle'),
            'mainProdImg' => $mainProdImg,
            'logoMain' => $logoMain,
//            'topProds' => $topProdsArr,
            'totalNavLabel' => $this->totalNavLabel(),
            'currentClass' => $currentClass,
            'filtersGroups' => $filter_groups,
            'filters' => $filters,
            'attr' => $attr];


        if ($request->ajax()) {
            $template = $request->input('template');
            $filtersId = $request->input('filters');
            $minPrice = intval($request->input('minPrice'));
            $maxPrice = intval($request->input('maxPrice'));
            $filters = [];
            if ($filtersId !== null) {
                if (count($filtersId) !== 1) {
                    foreach ($filtersId as $filter) {
                        $filters[] = json_decode(json_encode(DB::table('product_filter')
                            ->where('filter_id', '=', $filter)
                            ->join('products', 'products.id', '=', 'product_filter.product_id')
                            ->where([
                                ['price', '>=', $minPrice],
                                ['price', '<=', $maxPrice]])
                            ->join('products_description', 'products_description.product_id', '=', 'products.id')
                            ->where('products_description.language_id', '=', currentLanguageId())
                            ->get()), True);
                    }


                    $page = 1; // Get the current page or default to 1
                    $perPage = 50;
                    $offset = ($page * $perPage) - $perPage;

                    $result = [
                        'products' => new LengthAwarePaginator(array_slice($this->convergence($filters), $offset, $perPage, true), count($this->convergence($filters)), $perPage, $page, ['path' => $request->url(), 'query' => $request->query()]),
                        'attr' => $attr
                    ];
                    return response()->json(view()->make('catalog.products_smarty' . $template, $result)->render());

                } else {
                    $filters[] = json_decode(json_encode(DB::table('product_filter')
                        ->where('filter_id', '=', $filtersId[0])
                        ->join('products', 'products.id', '=', 'product_filter.product_id')
                        ->where([
                            ['price', '>=', $minPrice],
                            ['price', '<=', $maxPrice]])
                        ->join('products_description', 'products_description.product_id', '=', 'products.id')
                        ->where('products_description.language_id', '=', currentLanguageId())
                        ->get()), True);

                    $page = 1; // Get the current page or default to 1
                    $perPage = 50;
                    $offset = ($page * $perPage) - $perPage;

                    $result = [
                        'products' => new LengthAwarePaginator(array_slice($filters[0], $offset, $perPage, true), count($filters[0]), $perPage, $page, ['path' => $request->url(), 'query' => $request->query()]),
                        'attr' => $attr
                    ];
                    return response()->json(view()->make('catalog.products_smarty' . $template, $result)->render());
//                    return dd($filters);
                }
            }
            $data = [
                'products' => Products::where([
                    ['price', '>=', $minPrice],
                    ['price', '<=', $maxPrice],
                    ['class_id', $currentClass->id]
                ])
                    ->join('products_description', 'products_description.product_id', '=', 'products.id')
                    ->where('products_description.language_id', '=', currentLanguageId())
                    ->paginate(30),
                'attr' => $attr
            ];
            return response()->json(view()->make('catalog.products_smarty' . $template, $data)->render());
        }
        return view('catalog.class_smarty')->with($data);

    }


    public function product($id)
    {


        Visitor::log();
        $currentProduct = Products::find($id);
        $currentCategory = Categories::find($currentProduct->categories_id);
        $currentClass = Classes::find($currentProduct->class_id);

        $attr = DB::table('products')->where('products.id', '=', $id)
            ->join('parameters_values', 'parameters_values.items_id', '=', 'products.id')
            ->where('parameters_values.language_id','=',currentLanguageId())
            ->join('parameters_description','parameters_description.parameter_id','=','parameters_values.parameters_id')
            ->where('parameters_description.language_id','=',currentLanguageId())
            ->select('parameters_description.title', 'parameters_values.value', 'parameters_description.unit', 'products.id')->get();

        $opt_groups = OptionGroups::where('product_id', $id)->get();
        foreach ($opt_groups as $key => $group) {
            $opt = Options::where('option_group_id', '=', $group->id)->get();
            $opt_groups[$key]->options = $opt;
        }

        if ($currentCategory === null) {
            return redirect(url('/catalog'));
        }
        if ($currentCategory->class_id !== $currentClass->id) {
            return redirect(url('/catalog'));
        }
        if ($currentProduct === null) {
            return redirect(url('/catalog'));
        }
//        if($currentProduct->class_id !== $currentClass->id || $currentProduct->category_id !== $currentCategory->id){
//            return redirect(url('/catalog'));
//        }

        $cats = Categories::orderBy('sort_id', 'asc')->get();

        (Setting::get('config.mainprod', Null)) ? $mainProdImg = asset('/files/img/' . Setting::get('config.mainprod')) : $mainProdImg = asset('dist/img/photo4.jpg');

        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');

        $relatedProductsId = recommendsProducts::where('product_id', '=', $currentProduct->id)->get();
        $relatedProducts = [];
        foreach ($relatedProductsId as $prod) {
            $relatedProducts[] = Products::find($prod->product_id_recommend);
        }


        $data = [
            'cats' => $cats,
            'PageDescr' => Setting::get('config.maindesc'),
            'PageWords' => Setting::get('config.mainwords'),
            'PageAuthor' => '',
            'PageTitle' => Setting::get('config.maintitle'),
            'mainProdImg' => $mainProdImg,
            'logoMain' => $logoMain,
//            'topProds' => $topProdsArr,
            'relatedProducts' => $relatedProducts,
            'totalNavLabel' => $this->totalNavLabel(),
            'currentClass' => $currentClass,
            'currentCat' => $currentCategory,
            'currentProd' => $currentProduct,
            'attr' => $attr,
            'opt_groups' => $opt_groups
        ];


        return view('catalog.product_smarty')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {

        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {

        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {

        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {

        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {

        //

    }
}
