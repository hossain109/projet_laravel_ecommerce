@extends('admin.layouts.app')
<!-- Content Wrapper. Contains page content -->
@section('content')
<div class="content-wrapper">
    <div class="card m-2">
        <div class="card-header">
            <h3 class="card-title">
                @if ($user->id)
                    Modify Admin
                @else
                Add New Admin
                @endif
                </h3>
        </div>
    @include('flush.message')
    <form action="{{route($user->exists?'admin.update':'admin.store',$user)}}" method="post">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"   value="{{old('name',$user->name)}}">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password"   placeholder="Enter password" >
        <p>{{$user->id?'Do you want to change password ? pls add !':''}}</p>
    </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email"   placeholder="Enter email" value="{{old('email',$user->email)}}">
      </div>
      <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="1" {{ $user->status == 1 ?'selected':''}} >Active</option>
            <option value="0" {{ $user->status == 0 ? 'selected':''}}>Inactive</option>
        </select>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">
       
       @if ($user->id)
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