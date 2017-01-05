<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class OptionGroups extends Model
{
    protected $table = 'option_groups';

    protected $fillable = ['product_id','name'];
}
