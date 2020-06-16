<?php

namespace App\Helpers;

use PhpParser\Node\Expr\Cast\Double;

class InStock{
    public static function calculateInStock(Double $actual,Double $addition){

        return $actual + $addition;


    }
}