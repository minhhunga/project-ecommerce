@extends('frontend.layout.master')
@section('content')
    <div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="#" method="POST">
							<input type="text" placeholder="Full Name" name="name"/>
							<input type="email" placeholder="Email Address" name="email"/>
							<input type="password" placeholder="Password" name="password"/>
                            <input type="number" placeholder="Phone" name="phone"/>
                            <input type="file" class="form-control form-control-line" name="avatar"/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
@endsection