@extends('frontend.layout.master')
@section('content')

	@if(session('successfull'))
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i> Thông báo!</h4>
			{{session('successfull')}}
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

    <div class="col-sm-4 col-sm-offset-1">
		<div class="login-form"><!--login form-->
			<h2>Login to your account</h2>
			<form action="{{ route('login.post') }}" method="POST">
				@csrf
				<input type="email" placeholder="Email Address" name="email" value="{{ old('email') }}"/>
				<input type="password" placeholder="Password" name="password"/>
				<span>
					<input type="checkbox" class="checkbox"> 
					Keep me signed in
				</span>
				<button type="submit" class="btn btn-default">Login</button>
			</form>
		</div><!--/login form-->
	</div>
@endsection