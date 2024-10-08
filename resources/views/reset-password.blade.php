<!-- resources/views/auth/reset-password.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" required>
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
