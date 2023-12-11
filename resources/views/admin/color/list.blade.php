@extends('admin.layouts.app')
<!-- Content Wrapper. Contains page content -->
@section('content')
<div class="content-wrapper">
    <div class="card mt-5 ">
        <div class="card-header">
          @include('flush.message')
          <h3 class="card-title">Color List</h3>
          <a href="{{url('admin/color/add')}}" class=" float-right btn btn-primary">Add New Color</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Color</th>
                <th>Color code</th>
                <th>Created BY</th>
                <th>Created Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($colors as $color)
                <tr>
                    <td>{{$color->id}}</td>
                    <td>{{$color->name}}</td>
                    <td>{{$color->code}}</td>
                    <td>{{$color->created_by_name}}</td>
                    <td>{{date('d-m-Y',strtotime($color->created_at))}}</td>
                    <td>{{$color->status?'Active':'Inactive'}}</td>
                    <td>
                      <a class="btn btn-primary" href="{{route('color.modify',$color)}}">Modification</a>
                      <form action="{{route('color.delete',$color)}}" method="post" class="d-inline">
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
          {{$colors->links()}}
        </div>
      </div>
      <div>
       
      </div>
         
</div>

@endsection
@section('script')

@endsection