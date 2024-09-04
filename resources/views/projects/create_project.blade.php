<!-- resources/views/projects/create_project.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register a New Project</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Register a New Project</h2>
        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div>
                <label for="project_name">Project Name:</label>
                <input type="text" name="project_name" id="project_name" required>
            </div>
        
            <div>
                <label for="description">Description:</label>
                <textarea name="description" id="description" required></textarea>
            </div>
        
            <div>
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" required>
            </div>
        
            <div>
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date">
            </div>
        
            <div>
                <label for="status">Status:</label>
                <input type="text" name="status" id="status" required>
            </div>
        
            <div>
                <label for="assign_to">Assign To:</label>
                <select name="assign_to[]" id="assign_to" multiple required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->emp_id }}">{{ $employee->emp_name }}</option>
                    @endforeach
                </select>
            </div>
        
            <button type="submit">Register Project</button>
        </form>
        
    </div>
</body>
</html>
