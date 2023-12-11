@extends('admin.layouts.app')
<!-- Content Wrapper. Contains page content -->
@section('content')
<div class="content-wrapper">
    <div class="card mt-5 ">
        <div class="card-header">
          @include('flush.message')
          <h3 class="card-title">Sub Category List</h3>
          <a href="{{url('admin/subcategory/add')}}" class=" float-right btn btn-primary">Add New SubCategory</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Meta Title</th>
                <th>Meta Description</th>
                <th>Meta Keywords</th>
                <th>Created BY</th>
                <th>Created Data</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($subcategories as $subcategory)
              <tr>
                <td>{{$subcategory->id}}</td>
                <td>{{$subcategory->category->category}}</td>
                {{-- <td>{{$subcategory->category_name}}</td> --}}
                <td>{{$subcategory->subcategory}}</td>
                <td>{{$subcategory->meta_title}}</td>
                <td>{{$subcategory->meta_des}}</td>
                <td>{{$subcategory->meta_keywords}}</td>
                <td>{{$subcategory->user_name}}</td> {{--user_name is alias indatabase--}}
                <td>{{ date('d-m-Y',strtotime($subcategory->created_at)) }}</td>
                <td>{{$subcategory->status?'Active':'Inactive'}}</td>
                <td>
                  <a class="btn btn-primary" href="{{route('subcategory.modify',$subcategory)}}">Modification</a>
                  <form action="{{route('subcategory.delete',$subcategory)}}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div style="padding: 10px;float:right">
          {{$subcategories->links()}}
        </div>
      </div>
      <div>
       
      </div>
         
</div>

@endsection
@section('script')

@endsection