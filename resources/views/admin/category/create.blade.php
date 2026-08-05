@extends('admin.layout.master')
@section('content')
    
    @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
    <div class="container-fluid">
        <h2>Create Category</h2>
        <div class="row">
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        
                        <form action="{{ route('category.create') }}" method="POST" class="form-horizontal form-material">
                            @csrf
                            
                            <div class="form-group"> 
                                <label class="col-md-12">Name</label>
                                <div class="col-md-12">
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Create Category</button>
                                </div>
                            </div> 

                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection