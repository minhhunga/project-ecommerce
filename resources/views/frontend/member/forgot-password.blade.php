@extends('frontend.layout.master')
@section('content')
	<div class="col-sm-4 col-sm-offset-1">
		<div class="login-form">
			<h2>Forgot Password</h2>

			@if(session('success'))
				<p style="color: green;">
					{{ session('success') }}
				</p>
			@endif

			@if(session('error'))
				<p style="color: red;">
					{{ session('error') }}
				</p>
			@endif

			<form action="{{ route('send.reset.link') }}" method="POST">
				@csrf
				<input type="email"	name="email" placeholder="Nhập email" required>
				<button type="submit" class="btn btn-default"> Gửi mail </button>
			</form>
		</div>
	</div>
@endsection

