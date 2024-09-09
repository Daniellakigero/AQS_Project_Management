<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Team Member</title>
</head>
<body>
    <h1>Create Team Member</h1>

    <!-- Show success message -->
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <!-- Show validation errors -->
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('team.store') }}" method="POST">
        @csrf
        <label for="fullname">Fullname:</label>
        <input type="text" id="fullname" name="fullname" required><br><br>

        <label for="id_number">ID Number:</label>
        <input type="text" id="id_number" name="id_number" required><br><br>

        <label for="nationality">Nationality:</label>
        <input type="text" id="nationality" name="nationality" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br><br>

        <button type="submit">Create Team Member</button>
    </form>
</body>
</html>
