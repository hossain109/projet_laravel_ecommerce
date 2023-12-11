@extends('admin.layouts.app')
<!-- Content Wrapper. Contains page content -->
@section('content')
<div class="content-wrapper">
    <div class="card mt-5 ">
        <div class="card-header">
          @include('flush.message')
          <h3 class="card-title">Product List</h3>
          <a href="{{url('admin/product/add')}}" class=" float-right btn btn-primary">Add New Product</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Created BY</th>
                <th>Created Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
              <tr>
              <td>{{$product->id}}</td>
                  <td>{{$product->title}}</td>
                  <td>{{$product->createdBy}}</td>
                  <td>{{date('d-m-Y',strtotime($product->created_at))}}</td>
                  <td>{{$product->status?'Active':'Inactive'}}</td>
                  <td>   
                    <a class="btn btn-info" href="{{route('product.modify',$product)}}">Modification</a>
                    <form action="{{route('product.delete',$product)}}" method="post" class="d-inline">
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
          {{$products->links()}}
        </div>
      </div>
      <div>
       
      </div>
         
</div>

@endsection
@section('script')

@endsection