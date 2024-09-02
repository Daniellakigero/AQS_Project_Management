<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an employee's account</title>
</head>
<body>
    <form method="POST" action="{{ route('createEmployee') }}">
        @csrf
        <div>
            <label>Name:</label>
            <input type="text" name="emp_name" required>
        </div>
        <div>
            <label>Email Personal:</label>
            <input type="email" name="email_personal" required>
        </div>
<div>
            <label>Email Company:</label>
            <input type="email" name="email_company" required>
        </div>
<div>
            <label>Phone Number:</label>
            <input type="text" name="phone_number" required>
        </div>
<div>
            <label>Verification_code:</label>
            <input type="text" name="verification_code" required>
        </div>
        <div>
            <button type="submit">Send</button>
        </div>
    </form>

    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
