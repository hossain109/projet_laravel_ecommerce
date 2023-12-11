<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    static public function checkDetails($productID){
        return self::where('product_details.product_id','=',$productID)->delete();
    }
    static public function getProductDetails(){
        return self::all();
    }
}
