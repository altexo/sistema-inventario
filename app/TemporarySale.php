<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemporarySale extends Model
{
    protected $table = "temporary_sale";

    public function product(){
        return $this->belongsTo('App\Product');
    }
}
