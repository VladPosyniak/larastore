<?php

namespace larashop\Http\Controllers\Binotel;

use Illuminate\Http\Request;
use larashop\Purchase;
use larashop\Http\Requests;
use larashop\Http\Controllers\Controller;
use larashop\Http\Controllers\Binotel\BinotelApi;

class BinotelController extends Controller
{

    protected $key = '';
    protected $secret = '';
    protected $api;


    public function __construct()
    {
        parent::__construct();
        $this->api = new BinotelApi($this->key,$this->secret);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ['NewOrderCounter' => Purchase::Neworders()->count() ];
        return view('admin.binotel.binotel')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
