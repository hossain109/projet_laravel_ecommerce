<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    static public function CheckImage($productId){
        return self::where('product_images.product_id','=',$productId)->delete();
    }

    //get image from folder
    // public function getImageFolder(){
    //     if(!empty($this->name) && file_exists('upload/images',$this->name)){
    //         return url('upload/images',$this->name);
    //     }
    //     else{
    //         return "";
    //     }
    // }
}
