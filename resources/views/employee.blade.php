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
            <label>Full Name:</label>
            <input type="text" name="emp_fullname" required>
        </div>
       
        <div>
            <label>Email Company:</label>
            <input type="email" name="email_company" required>
        </div>
        <div>
            <label>Department:</label>
            <input type="text" name="department" required>
        </div>
        <div>
            <label>Position:</label>
            <input type="text" name="position" required>
        </div>
        <div>
            <label>Default Password:</label>
            <input type="password" name="defaultPassword" required>
        </div>
        <div>
            <label>Email Personal:</label>
            <input type="email" name="email_personal" required>
        </div>
        <div>
            <button type="submit">Send</button>
        </div>
        <div>
              <button type="submit" name="action" value="invite">Send Invitation</button>
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
