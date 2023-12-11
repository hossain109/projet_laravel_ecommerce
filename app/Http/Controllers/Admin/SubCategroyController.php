<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubCategroyController extends Controller
{
    public function list(){

        $subcategories = Subcategory::query()
        ->select('subcategories.*','users.name as user_name','categories.category as category_name')
        ->join('users','users.id',"=","subcategories.created_by")
        ->join('categories','categories.id','=','subcategories.category_id')
        ->where('subcategories.is_delete','=',0)
        ->orderBy('subcategories.id','desc')
        ->paginate(20)
        ;

        $data['header_title']='Sub Categorie';
        return view('admin.subcategory.list',$data,['subcategories'=>$subcategories]);
    }

    public function add(){
        
        //create a function in model subcategory
        $categories = Subcategory::getRecord();

        $subcategory = new Subcategory();
        $data['header_title']='Add new Sub categroy';
        return view('admin.subcategory.add',$data,['subcategory'=>$subcategory,'categories'=>$categories]);
    }

    public function store(SubcategoryRequest $request){
       
        $subcategory = new Subcategory();

        $request->validated();

        $subcategory->subcategory = $request->subcategory;
        $subcategory->status = $request->status;
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_des = trim($request->meta_des);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->category_id=trim($request->category);
        $subcategory->created_by = Auth::user()->id;
        //$subcategory->save();
         //do slug
        $title=$request->subcategory;
        $slug = Str::slug($title,'-');
        $slugResult = Subcategory::checkSlug($slug);
        if(empty($slugResult)){
            $subcategory->slug= $slug;
            //$subcategory->save();
        }else{
            $newSlug = $slug.'-'.$subcategory->id;
            $subcategory->slug = $newSlug;
            //$subcategory->save();
        }
        
        $subcategory->save();

         return redirect('admin/subcategory/list')->with('success',"Subategory successfully created.");
    }

    public function modify(Subcategory $subcategory){

        $categories = Subcategory::getRecord();

        $data['header_title']="Modify Subategory";

        return view('admin.subcategory.add',['subcategory'=>$subcategory,'categories'=>$categories],$data);
    }

    public function update(Subcategory $subcategory,SubcategoryRequest $request){

        $request->validated();

        $subcategory->subcategory = $request->subcategory;
        $subcategory->status = $request->status;
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_des = trim($request->meta_des);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->category_id=trim($request->category);
        $subcategory->created_by = Auth::user()->id;
        $subcategory->save();
                 //do slug
        $title=$request->subcategory;
        $slug = Str::slug($title,'-');
                 $slugResult = Subcategory::checkSlug($slug);
        if(empty($slugResult)){
            $subcategory->slug= $slug;
            $subcategory->save();
        }else{
            $newSlug = $slug.'-'.$subcategory->id;
            $subcategory->slug = $newSlug;
            $subcategory->save();
        }

         return redirect('admin/subcategory/list')->with('success',"Subcategory successfully updated.");
    }

    public function destroy(Subcategory $subcategory){
   
        $subcategory->delete();
        return redirect()->back()->with('success',"Subcategory successfully deleted.");
    }

    //findout subcategories for by axios
    public function getSubcateories(Request $request){
       $categoryid = $request->input('data');

        $subcategoriesByCategory = Subcategory::select('subcategories.id','subcategories.subcategory')
                                                ->join('users','users.id','=','subcategories.created_by')
                                                ->where('subcategories.category_id','=',$categoryid)
                                                ->where('subcategories.is_delete','=',0)
                                                ->where('subcategories.status','=',1)
                                                ->orderBy('subcategories.subcategory','asc')
                                                ->get();

                                                return $subcategoriesByCategory;

    }

}