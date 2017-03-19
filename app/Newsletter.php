<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    //
    protected $table = 'newsletter';
    protected $primaryKey = 'id';
    protected $fillable = ['email'];
    public $timestamps = false;

}
