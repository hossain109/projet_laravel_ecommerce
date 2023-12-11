<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $fillable  = ["color_id,product_id"];

    static public function checkColor($productID){
        return self::where('product_colors.product_id',"=",$productID)->delete();
    }
    
    public function getProduct(){
        return $this->belongsTo(Product::class);
    }

    public function color(){
        return $this->belongsTo(Color::class)->where('colors.status',"=",1)->where('colors.is_delete','=',0);
    }
}
