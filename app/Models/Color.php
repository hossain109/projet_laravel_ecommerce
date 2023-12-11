<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    static function getColors(){
        
        return self:: query()
        ->select('colors.*', 'users.name as created_by_name')
        ->join('users','users.id','=','colors.created_by')
        ->where('colors.is_delete','=',0)
        ->orderBy('colors.id','desc')
        ->paginate(20);
    }


    static public function getActiveColors(){
        return  self::query()
                  ->select('colors.*')
                  ->join('users','users.id','=','colors.created_by')
                  ->where('colors.is_delete','=',0)
                  ->where('colors.status','=',1)
                  ->orderBy('colors.name','asc')
                  ->get()
                  ;
      }


    static function checkSlug($slug){

        return self::where('slug','=',$slug)->count();
    }
    // public function getProductColor(){
    //     return $this->hasMany(ProductColor::class);
    // }
}
