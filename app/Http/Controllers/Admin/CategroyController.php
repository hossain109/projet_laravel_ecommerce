<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategroyController extends Controller
{
    public function list(){
      
        $categories = Category::getCateogries();
   
        $data['header_title']='Category';
        return view('admin.category.list',$data,['categories'=>$categories]);
    }

    public function add(){
        $category = new Category();
        $data['header_title']='Add new categroy';
        return view('admin.category.add',$data,['category'=>$category]);
    }

    public function store(CategoryRequest $request){
       
        $category = new Category();

        $request->validated();

        $category->category = $request->category;
        $category->status = $request->status;
        $category->meta_title = trim($request->meta_title);
        $category->meta_des = trim($request->meta_des);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->created_by = Auth::user()->id;
       // $category->save();
        //do slug
        $title=$request->category;
        $slug = Str::slug($title,'-');
        $slugResult = Category::checkSlug($slug);
        if(empty($slugResult)){
            $category->slug= $slug;
            
        }else{
            $newSlug = $slug.'-'.$category->id;
            $category->slug = $newSlug;
            //$category->save();
        }
        $category->save();
         return redirect('admin/category/list')->with('success',"Category successfully created.");
    }

    public function modify(Category $category){

        $data['header_title']="Modify Category";

        return view('admin.category.add',['category'=>$category],$data);
    }

    public function update(Category $category,CategoryRequest $request){

        $request->validated();

        $category->category = $request->category;
        $category->status = $request->status;
        $category->meta_title = trim($request->meta_title);
        $category->meta_des = trim($request->meta_des);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->created_by = Auth::user()->id;
        $category->save();

        $title=$request->category;
        $slug = Str::slug($title,'-');
        $slugResult = Category::checkSlug($slug);
        if(empty($slugResult)){
            $category->slug= $slug;
            $category->save();
        }else{
            $newSlug = $slug.'-'.$category->id;
            $category->slug = $newSlug;
            $category->save();
        }
         return redirect('admin/category/list')->with('success',"Category successfully updated.");
    }

    public function destroy(Category $category){
        $category->delete();
        return redirect()->back()->with('success',"Category successfully deleted.");
    }

}
