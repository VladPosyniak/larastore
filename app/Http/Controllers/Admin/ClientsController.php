<?php

namespace larashop\Http\Controllers\Admin;

use Illuminate\Http\Request;

use larashop\Http\Requests;
use larashop\Http\Controllers\Controller;
use larashop\User;

class ClientsController extends Controller
{
    public function edit($id){
        $user = User::find($id);
        return view('admin.client',['user' => $user]);
    }

    public function update($id){

    }
}
