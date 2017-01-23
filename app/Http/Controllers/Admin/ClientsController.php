<?php

namespace larashop\Http\Controllers\Admin;

use Illuminate\Http\Request;
use larashop\Http\Controllers\Controller;
use larashop\Purchase;
use larashop\User;
use Validator;

class ClientsController extends Controller
{

    public function index()
    {

        //
        $clients = User::all();

        $data = ['clients' => $clients, 'NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.clients')->with($data);;
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.client', ['user' => $user]);
    }

    public function update($id, Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'name' => 'required|max:256',
                'email' => 'required|email|max:255',
                'role' => 'required'
            ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        elseif(User::where('email','=',$request->email)->count() > 1){
            $request->session()->flash('alert-danger', 'Пользователь с таким емейлом уже существует!');
            return redirect()->back();
        }
        else{
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role = $request->role;
            $user->save();

            $request->session()->flash('alert-success', 'Пользователь успешно отредактирован!');
            return redirect('admin/clients');
        }


    }
}
