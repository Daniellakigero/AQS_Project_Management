<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Project</title>
</head>
<body>
    <form method="POST" action="{{ route('createProject') }}">
        @csrf
        <label for="project_name">Project Name:</label>
        <input type="text" name="project_name" id="project_name" required><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br>

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" required><br>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date"><br>

        <label for="status">Status:</label>
        <input type="text" name="status" id="status" required><br>
        <label for="created_by">Created By:</label>
        <input type="text" name="created_by" id="created_by" required><br>
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
