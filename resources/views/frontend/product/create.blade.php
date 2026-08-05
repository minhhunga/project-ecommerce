@extends('frontend.layout.master')
@section('content')
    <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Account</h2>
            <div class="panel-group category-products" id="accordian">
                <!--category-productsr-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="#">account</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="{{ route('product.list') }}">My product</a></h4>
                    </div>
                </div>
            </div>
            <!--/category-products-->
        </div>
    </div>
    <div class="col-sm-9">
        <div class="blog-post-area">

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
                    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h2 class="title text-center">Create Products</h2>
            <div class="signup-form"><!--sign up form-->
                <h2>Create Product</h2>
                
                <form action="{{ route('product.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-12">
                        <input name="name" type="text" value="{{ old('name') }}" placeholder="Name">
                    </div>

                    <div class="form-group col-md-12">
                        <input name="price" type="text" value="{{ old('price') }}" placeholder="Price">
                    </div>

                    <div class="form-group col-md-12">
                        <select name="id_category">
                            <option value="">Please select category</option>
                            @foreach($categories as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <select name="id_brand" >
                            <option value="">Please select brand</option>
                            @foreach($brands as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <select name="status" id="status">
                            <option value="0">New</option>
                            <option value="1">Sale</option>
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <input id="sale" name="sale" type="text" value="0" placeholder="Sale %" style="display:none">
                    </div>

                    <div class="form-group col-md-12">
                        <input name="company" id="company_profile" class="form-control" value="{{ old('company') }}" placeholder="Company"></input>
                    </div>

                    <div class="form-group col-md-12">
                        <input type="file" id="files" name="image[]" multiple>
                    </div>

                    <div class="form-group col-md-12">
                        <textarea name="detail" type="text" value="{{ old('detail') }}" placeholder="Detail"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-default">Add Product</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#status').change(function(){

            if($(this).val()==1){

                $('#sale').show();

            }else{

                $('#sale').hide();

                $('input[name="sale"]').val(0);

            }

        });
    </script>    
@endsection