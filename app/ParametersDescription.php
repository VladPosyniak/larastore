<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class ParametersDescription extends Model
{
    protected $table = 'parameters_description';
    protected $fillable = ['title','language_id','parameter_id','unit'];
}
