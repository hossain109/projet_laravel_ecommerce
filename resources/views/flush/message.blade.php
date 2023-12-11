@if ($errors->any())
@foreach ($errors->all() as $error)
    <div class="alert alert-danger" role="alert">{{$error}}</div>
@endforeach
@endif

@if(session()->has('success'))
    <div class="alert alert-success text-center" role="alert">
         {{ session()->get('success') }}
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger text-center" role="alert">
         {{ session()->get('error') }}
    </div>
@endif
    
