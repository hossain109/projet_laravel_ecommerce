@extends('admin.layouts.app')
<!-- Content Wrapper. Contains page content -->
@section('content')
<div class="content-wrapper">
    <div class="card m-2">
        <div class="card-header">
            <h3 class="card-title">
                @if ($category->id)
                    Modify Category
                @else
                Add New Category
                @endif
                </h3>
        </div>
    @include('flush.message')
    <form action="{{route($category->exists?'category.update':'category.store',$category)}}" method="post">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="category">Category Name<span style="color:red">*</span></label>
        <input type="text" class="form-control" id="category" name="category" placeholder="Enter category"   value="{{old('category',$category->category)}}">
      </div>
      <div class="form-group">
        <label for="status">Status<span style="color:red">*</span></label>
        <select name="status" id="status" class="form-control">
            <option value="1" {{ $category->status == 1 ?'selected':''}} >Active</option>
            <option value="0" {{ $category->status == 0 ? 'selected':''}}>Inactive</option>
        </select>
      </div>
      <div class="form-group">
        <label for="meta_title">Meta Title</label>
        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter meta title"   value="{{old('meta_title',$category->meta_title)}}">
      </div>
      <div class="form-group">
        <label for="meta_des">Meta Description</label>
        <textarea class="form-control" id="meta_des" name="meta_des" placeholder="Enter meta description"    cols="30" rows="3">{{old('meta_des',$category->meta_des)}}</textarea>
      </div>
      <div class="form-group">
        <label for="meta_keywords">Meta Keywords</label>
        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter meta keywords"   value="{{old('meta_keywords',$category->meta_keywords)}}">
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">
       
       @if ($category->id)
           Modify
       @else
            Add
       @endif
    </button>
    </div>
  </form>
</div>
</div>
@endsection
@section('script')

@endsection