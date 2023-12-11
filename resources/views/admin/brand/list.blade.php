@extends('admin.layouts.app')
<!-- Content Wrapper. Contains page content -->
@section('content')
<div class="content-wrapper">
    <div class="card mt-5 ">
        <div class="card-header">
          @include('flush.message')
          <h3 class="card-title">Brand List</h3>
          <a href="{{url('admin/brand/add')}}" class=" float-right btn btn-primary">Add New Brand</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Brand</th>
                <th>Slug</th>
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
                @foreach ($brands as $brand)
                <tr>
                    <td>{{$brand->id}}</td>
                    <td>{{$brand->name}}</td>
                    <td>{{$brand->slug}}</td>
                    <td>{{$brand->meta_title}}</td>
                    <td>{{$brand->meta_description}}</td>
                    <td>{{$brand->meta_keywords}}</td>
                    <td>{{$brand->created_by_name}}</td>
                    <td>{{date('d-m-Y',strtotime($brand->created_at))}}</td>
                    <td>{{$brand->status?'Active':'Inactive'}}</td>
                    <td>
                      <a class="btn btn-primary" href="{{route('brand.modify',$brand)}}">Modification</a>
                      <form action="{{route('brand.delete',$brand)}}" method="post" class="d-inline">
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
          {{$brands->links()}}
        </div>
      </div>
      <div>
       
      </div>
         
</div>

@endsection
@section('script')

@endsection