<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
     use SoftDeletes;

     protected $table = 'products';

     public function sales(){
     	return $this->belongsToMany('App\Sales')
     			->using('App\SalesDetails')
     			->withPivot([
                            'created_by',
                            'updated_by',
                        ]);
     }


}
