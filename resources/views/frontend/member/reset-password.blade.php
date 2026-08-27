@extends('frontend.layout.master')
@section('content')

    <div class="col-sm-4 col-sm-offset-1">
        <div class="login-form">
            <form action="{{ route('update.password', $user->id) }}" method="POST">
                @csrf

                <h2>Reset Password</h2>

                <input type="password" name="password" placeholder="New password" required >
                <input type="password" name="password_confirmation" placeholder="Confirm password" required>

                <button type="submit"> Reset Password </button>
            </form>
        </div>
    </div>

@endsection