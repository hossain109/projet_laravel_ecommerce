@extends('admin.layouts.app')
<!-- Content Wrapper. Contains page content -->
@section('content')
<div class="content-wrapper">
    <div class="card m-2">
        <div class="card-header">
            <h3 class="card-title">
                @if ($product->id)
                    Modify Product
                @else
                Add New Product
                @endif
                </h3>
        </div>
    @include('flush.message')

    <form action="{{route($product->exists?'product.update':'product.store',$product)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="title">Title<span style="color:red">*</span></label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter product"   value="{{old('title',$product->title)}}">
          </div>
    
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="sku">SKU<span style="color:red">*</span></label>
            <input type="text" class="form-control" id="sku" name="sku" placeholder="Enter sku"   value="{{old('sku',$product->sku)}}">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="category_id">Category<span style="color:red">*</span></label>
            <select name="category_id" id="category_id" class="form-control">
              <option value="">Select category</option>
              @foreach ($categories as $category)
                  <option {{($category->id==$product->category_id)?'selected':'' }} value="{{$category->id}}">{{$category->category}}</option>
              @endforeach
            </select>
          </div>
    
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="subcategory_id">Sub category<span style="color:red">*</span></label>

            @if ($product->exists)
              <select name="subcategory_id" id="subcategory_id" class="form-control">
               @foreach ($subcategories as $subcategory)
                 <option value="{{$subcategory->id}}" {{($subcategory->id == $product->subcategory_id)?'selected':''}}>{{$subcategory->subcategory}}</option>
               @endforeach
              </select>
            @else
            <select name="subcategory_id" id="subcategory_id" class="form-control">
              {{-- <option value="{{$subcategory->id}}">{{$subcategory->subcategory}}</option> --}}
            </select>
            @endif

            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="brand_id">Brand name<span style="color:red">*</span></label>
            <select name="brand_id" id="brand_id" class="form-control">
              @foreach ($brands as $brand)
                <option {{($brand->id == $product->brand_id)?'selected':''}} value="{{$brand->id}}">{{$brand->name}}</option>
              @endforeach
              {{-- <option value="{{$brand->id}}">{{$brand->name}}</option> --}}
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="color">Color<span style="color:red">*</span></label>
            @foreach ($colors as $color)
            @php
                $checked = '';
            @endphp
                @foreach ($colorsByProduct as $item)
                  @if ($item->color_id == $color->id)
                      @php
                      $checked='checked';
                      @endphp
                  @endif
                @endforeach
            <div>
              <label for=""><input type="checkbox" {{ $checked }} name="color_id[]" id=""  value="{{$color->id}}">{{$color->name}}</label>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="size">Size<span style="color:red">*</span></label>
            <div>
              <table class="table table-striped">
                <thead>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Action</th>
                </thead>
                <tbody class="addtable">
                  <tr>
                    <td><input type="text" name="size[100][name]" id="" required placeholder="Enter size" class="form-control"></td>
                    <td><input type="text" name="size[100][price]" id="" required placeholder="Enter price" class="form-control"></td>
                    <td>
                      <button class="btn btn-primary addsize">Add</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="old_price">Old price ($)<span style="color:red">*</span></label>
            <input type="number" value="{{$product->old_price}}" name="old_price" id="old_price" class="form-control" placeholder="Enter old price" required>
          </div>
    
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="price">Price ($)<span style="color:red">*</span></label>
            <input type="number" value="{{$product->price}}" name="price" id="price" class="form-control" placeholder="Enter pirce" required>
            </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <label for="image">Image</label>
          <input type="file" name="image[]" class="form-control" style="padding: 5px" multiple>
        </div>
      </div>
          {{-- funcion of model product --}}
            @if (!empty($product->getImages))
            <div class="row" id="sortable">
              @foreach ($product->getImages as $image)
                    <div class="col-md-3 text-center sortable_image" id="{{$image->id}}">
                      <img class="w-100 img-thumbnail" src="{{asset('upload/images/'.$image->name) }}" alt="image">
                      <a class="btn btn-danger btn-sm text-center" onclick="return confirm('Are you sure want to delete')" href="{{ route('product.product_image',$image)}}">Delete</a>
                    </div>
              @endforeach
            </div>
            @endif
      <hr>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="short_description">Short description <span style="color:red">*</span></label>
            <textarea name="short_description"  id="short_description" class="form-control editor " cols="30" rows="3" placeholder="Enter a short description" required>{{$product->short_description}}</textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="description">Description <span style="color:red">*</span></label>
            <textarea name="description" id="description" class="form-control editor" cols="30" rows="3" placeholder="Enter a description" required>{{$product->description}}</textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="additional_description">Additional description <span style="color:red">*</span></label>
            <textarea name="additional_description"  id="additional_description" class="form-control editor" cols="30" rows="3" placeholder="Enter a additional description" required>{{$product->aditional_description}}</textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="shipping_returns">Shipping Returns <span style="color:red">*</span></label>
            <textarea name="shipping_returns" id="shipping_returns" class="form-control editor" cols="30" rows="3" placeholder="Enter a shipping returns" required>{{$product->shipping_returns}}</textarea>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="status">Status<span style="color:red">*</span></label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{$product->status ==1?'selected':''}}  >Active</option>
                <option value="0" {{$product->status ==0?'selected':''}}>Inactive</option>
            </select>
          </div>
        </div>
      </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">
       
       @if ($product->id)
           Modify
       @else
            Submit
       @endif
    </button>
    </div>
  </form>
</div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{url('public/assets/tinymce-jquery.min.js')}}"></script>
<script src="{{url('public/assets/jquery-ui.js')}}"></script>
<script type="text/javascript">
let categoryId="";
function optionValue(value){
  categoryId = value
  return categoryId
}
//default value call
// var  targetIdValue = $("#category_id").val();
// optionValue(targetIdValue)
// loadTarget();
//onchange value call
$("#category_id").change(function () {
    targetIdValue = $("#category_id").val();
    optionValue(targetIdValue);
    loadTarget()
  
}); 

function loadTarget(){
  let url =  'http://localhost/projet_ecommerce/admin/getSubcateory';
  let data = categoryId;
  axios.post(url,{data})
      .then((response)=>{
        if(response.status==200){
          let subcategories = response.data;
          let mystring="";
          subcategories.map((item)=>{
          mystring +=  `<option value=${item.id}>${item.subcategory}</option>`;
          })
          //empty before append
          $('#subcategory_id').empty();
          $('#subcategory_id').append(mystring)
          
        }else{
          console.log('error')
        }
      })
      .catch((error)=>{
        console.log(error)
      })
}

//add size
var i = 101;
$(".addsize").on('click',function(){
  var html =  '<tr id="delete'+i+'">\n\
              <td><input type="text" name="size['+i+'][name]" required placeholder="Enter size" name="" id="" class="form-control"></td>\n\
              <td><input type="text" name=size['+i+'][price] required placeholder="Enter price" name="" id="" class="form-control"></td>\n\
              <td>\n\
                <button id="'+i+'"  class="btn btn-danger deletesize">Delete</button>\n\
              </td>\n\
            </tr>'

            i++;
            $(".addtable").append(html);
});


//delete item
$('body').delegate('.deletesize', 'click',function(){
  var row = $(this).attr('id');
  $("#delete"+row).remove();
});
//editor
$('').tinymce({
        height: 500,
        menubar: false,
        plugins: [
           'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
           'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
           'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
      });

//sortable
$(document).ready(function(){
  $( "#sortable" ).sortable({
      update:function(event,ui){
       // console.log("marche")
        var photo_id = new Array();
        $('.sortable_image').each(function(){
          var id = $(this).attr('id');
         photo_id.push(id);
        });
        //send ajax request for update
      let url = 'http://localhost/projet_ecommerce/admin/product_image_shortable';
      axios.post(url,{photo_id})
      .then((response)=>{
        if(response.status==200){
          console.log(response.data)
        }else{
          //console.log('error')
        }
      })
      .catch((error)=>{
       // console.log(error)
      })
      }
    });
});


</script>
@endsection