<?php

namespace App;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements Searchable
{
     use SoftDeletes;

     protected $table = 'products';

   //   public function sales(){
   //   	return $this->belongsToMany('App\Sales')
   //   			->using('App\SalesDetails')
   //   			->withPivot([
   //                          'created_by',
   //                          'updated_by',
   //                      ]);
   //   }

   public function sales(){
      return $this->belongsToMany('App\Sale', 'sales_details');
    }
     public function getSearchResult(): SearchResult
     {
     //    $url = route('sales.sale', $this->id);
          
        return new SearchResult($this, $this->name);
     }


}
