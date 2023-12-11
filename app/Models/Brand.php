<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    static function getBrands(){
        
        return self:: query()
        ->select('brands.*', 'users.name as created_by_name')
        ->join('users','users.id','=','brands.created_by')
        ->where('brands.is_delete','=',0)
        ->orderBy('brands.id','desc')
        ->paginate(20);
    }


    static public function getActiveBrands(){
      return  self::query()
                ->select('brands.name','brands.id')
                ->join('users','users.id','=','brands.created_by')
                ->where('brands.is_delete','=',0)
                ->where('brands.status','=',1)
                ->orderBy('brands.name','asc')
                ->get()
                ;
    }

    static function checkSlug($slug){

        return self::where('slug','=',$slug)->count();
    }
}
