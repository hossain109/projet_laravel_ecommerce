<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function list(){

        $products = Product::query()
                ->select('products.*','users.name as createdBy')
                ->join('users','users.id','=','products.created_by')
                ->where('products.is_delete','=',0)
                ->orderBy('products.id','desc')
                ->paginate(20);

        $data['header_title']='Product';

        return view('admin.product.list',$data,['products'=>$products]);
    }

    public function add(){

        $product = new Product();

        $data['header_title']='Add Product';

        $categories = Category::getActiveCateogries();

        $brands = Brand::getActiveBrands();

        $colors = Color::getActiveColors();

        $colorsByProduct = $product->getColors();

        return view('admin.product.add',$data,['product'=>$product,'categories'=>$categories,'brands'=>$brands,'colors'=>$colors,'colorsByProduct'=>$colorsByProduct]);
    }

    public function store(Request $request){
       // dd($request);
        $title = trim($request->title);
        $product = new Product();
        $product->title = $title;
        $product->sku = trim($request->sku);
        $product->category_id = trim($request->category_id);
        $product->subcategory_id = trim($request->subcategory_id);
        $product->brand_id = trim($request->brand_id);
        //$product->color_id = trim($request->color_id);
        $product->old_price = trim($request->old_price);
        $product->price = trim($request->price);
        $product->status = trim($request->status);
        $product->short_description = trim($request->short_description);
        $product->description = trim($request->description);
        $product->aditional_description = trim($request->additional_description);
        $product->shipping_returns = trim($request->shipping_returns);
        $product->created_by= Auth::user()->id;
        //$product->save();
        
        $slug = Str::slug($title."-");

        $slugResult = Product::checkSlug($slug);

        if(empty($slugResult)){
            $product->slug = $slug;
           // $product->save();
        }else{
            $newSlug = $slug.'-'.$product->id;
            $product->slug = $newSlug;
           // $product->save();
        }

        $product->save();

        if(!empty($request->color_id)){
            foreach($request->color_id as $color){
                // $productColor = new ProductColor();
                // $productColor->color_id=$color;
                // $productColor->product_id = $product->id;
                // $productColor->save();
                ProductColor::insert([
                    'color_id'=>$color,
                    'product_id'=>$product->id
                ]);
            } 
        }
        //checking product details
        ProductDetail::checkDetails($product->id);

        if(!empty($request->size)){
            foreach ($request->size as $size) {
                if(!empty($size['name'])){
                    $saveSize = new ProductDetail();
                    $saveSize->name=$size['name'];
                    $saveSize->price=!empty($size['price'])?$size['price']:0;
                    $saveSize->product_id=$product->id;
                    $saveSize->save();
                }
            }
        }

                //image uploaded and image path insert into database
                if(!empty($product)){
                    if(!empty($request->image)){
                        foreach ($request->image as $value) {
                            if($value->isValid()){
                                $text = $value->getClientOriginalExtension();
                                $randomStr = $product->id.Str::random(10);
                                $filename = strtolower($randomStr).'.'.$text;
                                $value->move('upload/images',$filename);
                                //image insert into database
                                $productImage = new ProductImage();
                                $productImage->name= $filename;
                                $productImage->extension = $text;
                                $productImage->product_id=$product->id;
                                $productImage->save();
                            }
                        }
                    }
                }

        return redirect('admin/product/list')->with('success',"Product successfully created.");;

    }

    public function modify(Product $product){

        //dd($product->getImages);

        $data['header_title']="Modify Product";

        $categories = Category::getActiveCateogries();

        $categoryByProduct = $product->category;
        //find out subcategories by categoy
        $data['subcategories'] = $categoryByProduct->subcategory;

        $brands = Brand::getActiveBrands();

        $colors = Color::getActiveColors();

        $colorsByProduct =$product->getColors;    //get colors by product

        return view('admin.product.add',$data,['product'=>$product,'categories'=>$categories,'brands'=>$brands,'colors'=>$colors,'colorsByProduct'=>$colorsByProduct]);
    }

    public function update(Product $product,Request $request){
        //dd($product->subcategory_id);
        $title = trim($request->title);
       // $product = new Product();
        $product->title = $title;
        $product->sku = trim($request->sku);
        $product->category_id = trim($request->category_id);
        $product->subcategory_id = trim($request->subcategory_id);
        $product->brand_id = trim($request->brand_id);
        //$product->color_id = trim($request->color_id);
        $product->old_price = trim($request->old_price);
        $product->price = trim($request->price);
        $product->status = trim($request->status);
        $product->short_description = trim($request->short_description);
        $product->description = trim($request->description);
        $product->aditional_description = trim($request->additional_description);
        $product->shipping_returns = trim($request->shipping_returns);
        $product->created_by= Auth::user()->id;
        $product->save();
        //making slug
        $slug = Str::slug($title."-");
        $slugResult = Product::checkSlug($slug);
        if(empty($slugResult)){
            $product->slug = $slug;
            $product->save();
        }else{
            $newSlug = $slug.'-'.$product->id;
            $product->slug = $newSlug;
            $product->save();
        }
        //checking color
        ProductColor::checkColor($product->id);
        if(!empty($request->color_id)){
            foreach($request->color_id as $color){
                // $productColor = new ProductColor();
                // $productColor->color_id=$color;
                // $productColor->product_id = $product->id;
                // $productColor->save();
                ProductColor::insert([
                    'color_id'=>$color,
                    'product_id'=>$product->id
                ]);
            } 
        }

        //checking product details
        ProductDetail::checkDetails($product->id);

        if(!empty($request->size)){
            foreach ($request->size as $size) {
                if(!empty($size['name'])){
                    $saveSize = new ProductDetail();
                    $saveSize->name=$size['name'];
                    $saveSize->price=!empty($size['price'])?$size['price']:0;
                    $saveSize->product_id=$product->id;
                    $saveSize->save();
                }
            }
        }

        //checking image 
       // ProductImage::CheckImage($product->id);

        //image uploaded and image path insert into database
        if(!empty($product)){
            if(!empty($request->image)){
                foreach ($request->image as $value) {
                    if($value->isValid()){
                        $text = $value->getClientOriginalExtension();
                        $randomStr = $product->id.Str::random(10);
                        $filename = strtolower($randomStr).'.'.$text;
                        $value->move('upload/images',$filename);
                        //image insert into database
                        $productImage = new ProductImage();
                        $productImage->name= $filename;
                        $productImage->extension = $text;
                        $productImage->product_id=$product->id;
                        $productImage->save();
                    }
                }
            }
        }
       
         return redirect('admin/product/list')->with('success',"Product successfully updated.");
    }

    //delete product image on click image
    public function delete_product_image(ProductImage $image){

        //dd($image);
        if(!empty($image)){
            unlink('upload/images/'.$image->name);
        }
        $image->delete();
        return redirect()->back()->with("success","Product image successfully deleted");
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect()->back()->with('success',"Product successfully deleted.");
    }

    //drag and drop product image shortable
    public function productImageShortable(Request $request){
        $i=1;
        if(!empty($request->photo_id)){
            foreach ($request->photo_id as $photo_id) {
                $image = ProductImage::find($photo_id);
                $image->orderBy=$i;
                $image->save();
                $i++;
            }
        }
        if($i !=0) {$message="success";}
        else $message="failed";
        return $message;
    }
}
