<?php

namespace larashop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use larashop\Coupons;
use larashop\Favourite;
use larashop\Order;
use larashop\User;
use Validator;
use larashop\UserAddress;
use Jenssegers\Date\Date;
class ProfileController extends Controller
{
    public function settings()
    {
        $addresses = UserAddress::where('user_id','=',Auth::user()->id)->get();
        return view('profile.settings',['addresses'=>$addresses]);
    }

    public function updateSettings(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:6',
                'email' => 'required|email',
                'phone' => 'required'
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::find(Auth::user()->id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->city = $request->input('city');
        $user->country = $request->input('country');
        $user->postal_code = $request->input('postal_code');
        $user->company = $request->input('company');
        $user->address = $request->input('address');
        $user->save();

        return view('profile.message', ['message' => 'Данные успешно обновлены!']);

    }

    public function changePassword(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'password1' => 'required|min:6',
                'password2' => 'required|min:6'
            ]);


//        return Auth::user()->password.'<br>'.bcrypt($request->input('old_password'));
        if ($validator->fails()) {
            return view('profile.message', ['message' => 'Пароль должен быть не меньше 6 символов!']);
        }

        if ($request->input('old_password' != '')) {
            if (bcrypt($request->input('old_password')) !== Auth::user()->password) {
                return view('profile.message', ['message' => 'Введен не верный старый пароль!']);
            }
        }

        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->input('password1'));
        $user->save();

        return view('profile.message', ['message' => 'Данные успешно обновлены!']);

    }

    public function createAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_name' => 'required',
            'country' => 'required|min:3',
            'city' => 'required|min:3',
            'postal_code' => 'required|integer',
            'address' => 'required|min:6',
        ]);

        if ($validator->fails()){
            return view('profile.message',['message'=>'Somethings wrong!','errors' => $validator->messages()->all()]);
        }

        $address = new UserAddress();
        $address->user_id = Auth::user()->id;
        $address->address = $request->input('address');
        $address->address_name = $request->input('address_name');
        $address->country = $request->input('country');
        $address->city = $request->input('city');
        $address->postal_code = $request->input('postal_code');
        $address->company = $request->input('company');
        $address->comment = $request->input('comment');
        $address->saveOrFail();

        return view('profile.message',['message' => 'Адрес успешно создан! Вы можете использовать его при оформлении заказа']);

    }

    public function changeAddress(Request $request){
        $validator = Validator::make($request->all(), [
            'address_name' => 'required',
            'country' => 'required|min:3',
            'city' => 'required|min:3',
            'postal_code' => 'required|integer',
            'address' => 'required|min:6',
            'address_id' => 'required|integer'
        ]);

        if ($validator->fails()){
            return view('profile.message',['message'=>'Somethings wrong!','errors' => $validator->messages()->all()]);
        }

        $address = UserAddress::where([
            ['id','=',$request->input('address_id')],
            ['user_id','=',Auth::user()->id]
        ])->update([
            'address_name' => $request->input('address_name'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'country' => $request->input('country'),
            'postal_code' => $request->input('postal_code'),
            'company' => $request->input('company'),
            'comment' => $request->input('comment')

        ]);

        if ($address){
            return view('profile.message',['message' => 'Данные успешно измененны!']);
        }
        else{
            return view('profile.message',['message' => 'Something wrong! Try again.']);
        }

    }

    public function getAddress($id){
        $address = UserAddress::where('id','=',$id)->where('user_id','=',Auth::user()->id)->get();
        return response()->json($address);
    }

    public function coupons(){
        if (!Auth::check()){
            return redirect('/login');
        }

        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        $coupons = Coupons::where('user_id','=',Auth::user()->id)->get();
        foreach ($coupons as $key => $coupon){
            $coupons[$key]['expiration_date'] = new Date($coupon['expiration_date']);
        }

        return view('profile.coupons',['coupons' => $coupons,'months' => $months]);
    }


    public function orders(){
        $orders = Order::where('user_id','=',Auth::user()->id)->get();

        return view('profile.orders',['orders'=>$orders]);
    }

    public function favourites(){
        $products = Favourite::where('user_id','=',Auth::user()->id)
            ->join('products_description','products_description.product_id','=','favourite.product_id')
            ->where('language_id','=',currentLanguageId())
            ->join('products','products_description.product_id','=','products.id')
            ->get();


        return view('profile.favourites',['products' => $products]);
    }

    public function deleteFavourite($product){
        if (Auth::check()){
            $product = Favourite::where([
                ['product_id','=',$product],
                ['user_id','=',Auth::user()->id]
            ])->first();
            if ($product != null){
                $product->delete();
                return 1;
            }
            else{
                return 0;
            }
        }
        else{
            return 0;
        }

    }

    public function addFavourite($product){
        if (Auth::check()){
            $favourite = Favourite::where([
                ['product_id','=',$product],
                ['user_id','=',Auth::user()->id]
            ])->first();
            if ($favourite == null){
                $favourite = new Favourite();
                $favourite->product_id = $product;
                $favourite->user_id = Auth::user()->id;
                $favourite->save();
                return 1;
            }
            else{
                return 0;
            }
        }
        else{
            return 0;
        }
    }
}
