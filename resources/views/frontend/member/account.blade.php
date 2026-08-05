@extends('frontend.layout.master')
@section('content')
    <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Account</h2>
            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="{{ url('/frontend/account/update') }}">account</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="{{ url('/frontend/account/my-product') }}">My product</a></h4>
                    </div>
                </div>
                
            </div><!--/category-products-->
          
        </div>
    </div>
    <div class="col-sm-9">
        <div class="blog-post-area">
            <h2 class="title text-center">Update user</h2>
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
                <div class="signup-form"><!--sign up form-->
                    <h2>User Update!</h2>

                    <form action="{{ route('account.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-12">Name</label>
                            <div class="col-sm-12">
                                <input name="name" type="text" placeholder="Name" value="{{ $getuser['name'] }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Email</label>
                            <div class="col-sm-12">
                                <input name="email" type="email" placeholder="Email Address" value="{{ $getuser['email'] }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Password</label>
                            <div class="col-sm-12">
                                <input name="password" type="password" placeholder="Password" value=""/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Select Country</label>
                            <div class="col-sm-12">
                                <select class="form-control form-control-line" name="id_country">
                                    <option value="">Please select</option>
                                    @foreach($country as $item): ?>
                                        <option value="{{ $item->id }}"
                                            {{ $getuser->id_country == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Phone No</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" value="{{ $getuser['phone'] }}" name="phone">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Upload file</label>
                            <div class="col-md-12">
                                <input type="file" class="form-control form-control-line" name="avatar">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-default">Update profile</button>
                    </form>

                </div>
        </div>
    </div>
@endsection