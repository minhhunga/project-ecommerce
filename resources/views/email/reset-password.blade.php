
    <h2>Reset Password</h2>

    <p>Hello {{ $user->name }}</p>

    <p>Click vào link bên dưới để đổi mật khẩu:</p>

    <a href="{{ route('reset.password', $user->id) }}"> Reset Password </a>
