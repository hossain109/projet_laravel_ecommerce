<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;


class ProductListController extends Controller
{
    public function displayProduct($slug,$subSlug=''){

        $category = Category::getCategoryBySlug($slug);
        $subcategory = Subcategory::getSubCategoryBySlug($subSlug);

        $product = Product::getProductBySlug($slug);

        if(!empty($category) && !empty($subcategory)){
            $data['meta_title']=$subcategory->meta_title;
            $data['meta_description']=$subcategory->meta_des;
            $data['meta_keywords']=$subcategory->meta_keywords;

            //search product par subcategory
            $data['products'] = $subcategory->product();
           // dd( $data['products']);
            
            $data['category']=$category;
            $data['subcategory']=$subcategory;
        }elseif(!empty($category)){
            $data['meta_title']=$category->meta_title;
            $data['meta_description']=$category->meta_des;
            $data['meta_keywords']=$category->meta_keywords;

            //search product par category
            $data['products'] = $category->product();

            $data['category']=$category;
        }elseif(!empty($product)){

            $data['product'] = $product;

            return view("product.product",$data);
        }
        else{
            abort(404);
        }

        return view('product.list',$data);
    }
  
}
