@extends('frontend.layout.master')
@section('content')
    <div class="col-sm-4 col-sm-offset-1">
		<div class="login-form"><!--login form-->
			<h2>Login to your account</h2>
			<form action="#" method="POST">
				<input type="email" placeholder="Email Address" name="email"/>
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