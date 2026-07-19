@extends('frontend.layout.master')
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
			<h4><i class="icon fa fa-check"></i> Thông báo!</h4>
			<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
	@endif

    <div class="col-sm-4">
		<div class="signup-form"><!--sign up form-->
			<h2>New User Signup!</h2>
			<form action="{{ route('register.post') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<input type="text" placeholder="Full Name" name="name" value="{{ old('name') }}"/>
				<input type="email" placeholder="Email Address" name="email" value="{{ old('email') }}"/>
				<input type="password" placeholder="Password" name="password"/>
				<input type="number" placeholder="Phone" name="phone" value="{{ old('phone') }}"/>
				<input type="file" class="form-control form-control-line" name="avatar"/>
				<button type="submit" class="btn btn-default">Signup</button>
			</form>
		</div><!--/sign up form-->
	</div>
@endsection