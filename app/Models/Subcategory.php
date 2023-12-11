<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    static public function checkSlug($slug){
        return self::where('subcategories.slug','=',$slug)->count();
    }

    public static function getRecord(){

        return category::query()
        ->select('categories.*','users.name')
        ->join('users','users.id','=','categories.created_by')
        ->where('categories.is_delete','=',0)
        ->orderBy('categories.id','desc')
        ->get();

    }

    static public function getActiveSubcategories(){

        return Subcategory::select()
                        ->select('subcategories.*','users.name')
                        ->join('users','users.id','=','subcategories.created_by')
                        ->where('subcategories.is_delete','=',0)
                        ->where('subcategories.status','=',1)
                        ->orderBy('subcategories.id','asc')
                        ->get();
    }

    static public function getSubCategoryBySlug($subSlug){

        return self::select('subcategories.*')
                    ->join('users','users.id','=','subcategories.created_by')
                    ->where('subcategories.slug','=',$subSlug)
                    ->where('subcategories.is_delete','=',0)
                    ->where('subcategories.status','=',1)
                    ->first()
                    ;
    }


    protected $fillable = [
        'subcategory',
        'meta_keywords',
        'created_by',
        'meta_title',
        'meta_des',
        'status',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->hasMany(Product::class)->where('products.status','=',1)
                                            ->where('products.is_delete','=',0)
                                            ->paginate(10)
                                            ;
    }
}
