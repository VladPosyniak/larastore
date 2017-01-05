<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['id','user_id','status','delivery_address','pay_type','to_processing','code','currency'];

    public function items(){
        return $this->hasMany('larashop\OrderedProducts', 'id');
    }
}
