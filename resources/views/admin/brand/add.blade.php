@extends('admin.layouts.app')
<!-- Content Wrapper. Contains page content -->
@section('content')
<div class="content-wrapper">
    <div class="card m-2">
        <div class="card-header">
            <h3 class="card-title">
                @if ($brand->id)
                    Modify Brand
                @else
                Add New Brand
                @endif
                </h3>
        </div>
    @include('flush.message')
    <form action="{{route($brand->exists?'brand.update':'brand.store',$brand)}}" method="post">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="brand">Brand Name<span style="color:red">*</span></label>
        <input type="text" class="form-control" id="brand" name="brand" placeholder="Enter brand"   value="{{old('brand',$brand->name)}}">
      </div>
      <div class="form-group">
        <label for="status">Status<span style="color:red">*</span></label>
        <select name="status" id="status" class="form-control">
            <option value="1" {{ $brand->status == 1 ?'selected':''}} >Active</option>
            <option value="0" {{ $brand->status == 0 ? 'selected':''}}>Inactive</option>
        </select>
      </div>
      <div class="form-group">
        <label for="meta_title">Meta Title</label>
        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter meta title"   value="{{old('meta_title',$brand->meta_title)}}">
      </div>
      <div class="form-group">
        <label for="meta_des">Meta Description</label>
        <textarea class="form-control" id="meta_des" name="meta_des" placeholder="Enter meta description"    cols="30" rows="3">{{old('meta_des',$brand->meta_description)}}</textarea>
      </div>
      <div class="form-group">
        <label for="meta_keywords">Meta Keywords</label>
        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter meta keywords"   value="{{old('meta_keywords',$brand->meta_keywords)}}">
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">
       
       @if ($brand->id)
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