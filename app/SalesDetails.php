<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SalesDetails extends Model
{
    use SoftDeletes;

    protected $table = 'sales_details';
}
