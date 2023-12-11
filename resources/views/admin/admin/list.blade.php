@extends('admin.layouts.app')
<!-- Content Wrapper. Contains page content -->
@section('content')
<div class="content-wrapper">
    <div class="card mt-5 ">
        <div class="card-header">
          @include('flush.message')
          <h3 class="card-title">Admin List</h3>
          <a href="{{url('admin/admin/add')}}" class=" float-right btn btn-primary">Add New Admin</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($admins as $admin)
                  <tr>
                    <td>{{$admin->id}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>{{$admin->status?'Active':'Inactive'}}</td>
                    <td>
                      <a class="btn btn-primary" href="{{route('admin.modify',$admin)}}">Modification</a>
                      <form action="{{route('admin.delete',$admin)}}" method="post" class="d-inline">
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
        <!-- /.card-body -->
      </div>
</div>
@endsection
@section('script')

@endsection