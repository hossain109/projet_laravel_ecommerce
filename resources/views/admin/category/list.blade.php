@extends('admin.layouts.app')
<!-- Content Wrapper. Contains page content -->
@section('content')
<div class="content-wrapper">
    <div class="card mt-5 ">
        <div class="card-header">
          @include('flush.message')
          <h3 class="card-title">Category List</h3>
          <a href="{{url('admin/category/add')}}" class=" float-right btn btn-primary">Add New Category</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Category</th>
                <th>Meta Title</th>
                <th>Meta Description</th>
                <th>Meta Keywords</th>
                <th>Created BY</th>
                <th>Created Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
              <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->category}}</td>
                <td>{{$category->meta_title}}</td>
                <td>{{$category->meta_des}}</td>
                <td>{{$category->meta_keywords}}</td>
                <td>{{$category->created_by_name}}</td>
                <td>{{ date('d-m-Y',strtotime($category->created_at)) }}</td>
                <td>{{$category->status?'Active':'Inactive'}}</td>
                <td>
                  <a class="btn btn-primary" href="{{route('category.modify',$category)}}">Modification</a>
                  <form action="{{route('category.delete',$category)}}" method="post" class="d-inline">
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
          {{$categories->links()}}
        </div>
      </div>
      <div>
       
      </div>
         
</div>

@endsection
@section('script')

@endsection