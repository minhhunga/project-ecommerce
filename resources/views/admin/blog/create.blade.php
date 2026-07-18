@extends('admin.layout.master')
@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
            {{session('success')}}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Thất bại!</h4> 
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>

    @endif
    <div class="container-fluid">
        <h2>Create Blog</h2>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        
                        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-material">
                            @csrf
                            
                            <div class="form-group"> 
                                <label class="col-md-4">Title</label>
                                <div class="col-md-12">
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control ">
                                </div>
                            </div>

                            <div class="form-group"> 
                                <label class="col-md-4">Image</label>
                                <div class="col-md-12">
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group"> 
                                <label class="col-md-4">Description</label>
                                <div class="col-md-12">
                                    <input type="text" name="description" value="{{ old('description') }}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group"> 
                                <label class="col-md-4">Content</label>
                                <div class="col-md-12">
                                    <textarea name="content" class="form-control" id="demo" rows="5">{{ old('content') }}</textarea>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Create Blog</button>
                                </div>
                            </div> 

                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection