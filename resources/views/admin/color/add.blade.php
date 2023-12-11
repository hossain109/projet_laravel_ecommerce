@extends('admin.layouts.app')
<!-- Content Wrapper. Contains page content -->
@section('content')
<div class="content-wrapper">
    <div class="card m-2">
        <div class="card-header">
            <h3 class="card-title">
                @if ($color->id)
                    Modify Color
                @else
                Add New Color
                @endif
                </h3>
        </div>
    @include('flush.message')
    <form action="{{route($color->exists?'color.update':'color.store',$color)}}" method="post">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="color">Color Name<span style="color:red">*</span></label>
        <input type="text" class="form-control" id="color" name="color" placeholder="Enter color"   value="{{old('color',$color->name)}}">
      </div>
      <div class="form-group">
        <label for="code">Color Code<span style="color:red">*</span></label>
        <input type="color" class="form-control" id="code" name="code" placeholder="Enter color code"   value="{{old('code',$color->code)}}">
      </div>
      <div class="form-group">
        <label for="status">Status<span style="color:red">*</span></label>
        <select name="status" id="status" class="form-control">
            <option value="1" {{ $color->status == 1 ?'selected':''}} >Active</option>
            <option value="0" {{ $color->status == 0 ? 'selected':''}}>Inactive</option>
        </select>
      </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">
       
       @if ($color->id)
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