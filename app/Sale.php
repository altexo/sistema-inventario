<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use SoftDeletes;

    protected $table = 'sales';

    //   public function products(){
    //  	return $this->belongsToMany('App\Product')
    //  			->using('App\SalesDetails')
    //  			 ->withPivot([
    //                         'created_by',
    //                         'updated_by',
    //                     ]);
    //  }
     public function products(){
       return $this->belongsToMany('App\Product', 'sales_details')->withPivot('quantity', 'sale_price')
       ->withTimestamps();;
     }
   

}
