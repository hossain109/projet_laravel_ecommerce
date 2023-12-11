<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category','meta_keywords','created_by','meta_title','meta_des','status'];

    // public function getSlug(){
    //     return Str::slug($this->category);
    // }
    static public function checkSlug($slug){
        return Category::where('categories.slug','=',$slug)->count();
    }
    
    static public function getCateogries(){
        return self::select('categories.*', 'users.name as created_by_name')
                ->join('users','users.id','=','categories.created_by')
                ->where('categories.is_delete','=',0)
                ->orderBy('categories.id','desc')
                ->paginate(20);
    }
    static public function getActiveCateogries(){
        return self::select('categories.*')
                ->join('users','users.id','=','categories.created_by')
                ->where('categories.status','=',1)
                ->where('categories.is_delete','=',0)
                ->orderBy('categories.category','asc')
                ->paginate(20);
    }

    static public function getRecordMenu(){

        return self::select('categories.*', 'users.name as created_by_name')
        ->join('users','users.id','=','categories.created_by')
        ->where('categories.is_delete','=',0)
        ->where('categories.status','=',1)
        ->get();
    }

    public function subcategory(){
        return $this->hasMany(Subcategory::class)->where('subcategories.status','=',1)
                                                ->where('subcategories.is_delete','=',0);
    }

    public function product(){
        return $this->hasMany(Product::class)->where('products.status','=',1)
                                            ->where('products.is_delete','=',0)
                                            ->paginate(10)
                                            ;
    }

    static public function getCategoryBySlug($slug){

        return self::select('categories.*')
                    ->join('users','users.id','=','categories.created_by')
                    ->where('categories.slug','=',$slug)
                    ->where('categories.is_delete','=',0)
                    ->where('categories.status','=',1)
                    ->first()
                    ;
    }
    
}
