<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //check slug exist or not in database

    static function checkSlug($slug){
        return self::where('slug',"=", $slug)->count();
    }

    protected $fillable = [
        'title',
        'slug',
        'old_price',
        'price',
        'short_description',
        'description',
        'aditional_description',
        'shipping_returns',
        'status',
        'is_delete',
        'category_id',
        'subcategory_id',
        'brand_id'

    ];

    static public function getProductBySlug($slug){
        return self::select('products.*')
                    ->join('users',"users.id",'=','products.created_by')
                    ->where('products.slug','=',$slug)
                    ->where('products.status','=',1)
                    ->where('products.is_delete','=',0)
                    ->first()
                    ;

    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function getColors(){
        return $this->hasMany(ProductColor::class);
    }

    public function image(){
        return $this->hasMany(ProductImage::class)->orderBy('orderBy','asc');
    }

    public function productSize(){
        return $this->hasMany(ProductDetail::class);
    }

}
