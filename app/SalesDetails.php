<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SalesDetails extends Pivot
{
    use SalesDetails;

    protected $table = 'sales_details';
}
