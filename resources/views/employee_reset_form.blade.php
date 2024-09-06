<!DOCTYPE html>
<html>
<head>
    <title>Password Reset Form</title>
</head>
<body>
    <h1>Password Reset</h1>
    <form method="POST" action="{{ route('employee_authenticate') }}">
        @csrf
        <label for="default_password">Default Password:</label>
        <input type="password" id="default_password" name="defaultPassword" required>
        <br>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="newPassword" required>
        <br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
