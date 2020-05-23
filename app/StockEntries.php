<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StockEntries extends Model
{
    use SoftDeletes;

    protected $table = 'stock_entries';

    public function products(){
    	return $this->hasMany('App\Products');
    }
}
