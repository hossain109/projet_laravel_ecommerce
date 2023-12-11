<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function list(){

        $brands = Brand::getBrands();

        $data['header_title']='Brand';
        return view('admin.brand.list',$data,['brands'=>$brands]);
    }

    public function add(){

        $brand = new Brand();

        $data['header_title']='Add Product';

        return view('admin.brand.add',$data,['brand'=>$brand]);
    }

    public function store(Request $request){
        //dd($request->brand);
        $name = trim($request->brand);
        $brand = new Brand();
        $brand->name = $name;
        $brand->status = $request->status;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_des;
        $brand->meta_keywords = $request->meta_keywords;
        $brand->is_delete = 0;

        $brand->created_by= Auth::user()->id;
        
        $slug = Str::slug($name."-");

        $slugResult = Brand::checkSlug($slug);

        if(empty($slugResult)){
            $brand->slug = $slug;
        }else{
            $newSlug = $slug.'-'.$brand->id;
            $brand->slug = $newSlug;
        }
        
        $brand->save();

        return redirect('admin/brand/list')->with('success',"Brand successfully created.");;

    }

    public function modify(Brand $brand){

        $data['header_title']="Modify Product";

        return view('admin.brand.add',['brand'=>$brand],$data);
    }

    public function update(Brand $brand,Request $request){

        $name = trim($request->brand);
        $brand->name = $name;
        $brand->status = $request->status;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_des;
        $brand->meta_keywords = $request->meta_keywords;
        $brand->is_delete = 0;

        $brand->created_by= Auth::user()->id;

        $slug = Str::slug($name."-");

        $slugResult = Brand::checkSlug($slug);

        if(empty($slugResult)){
            $brand->slug = $slug;
        }else{
            $newSlug = $slug.'-'.$brand->id;
            $brand->slug = $newSlug;
        }
        
        $brand->save();
         return redirect('admin/brand/list')->with('success',"Brand successfully updated.");
    }

    public function destroy(Brand $brand){
        $brand->delete();
        return redirect()->back()->with('success',"Brand successfully deleted.");
    }
}
