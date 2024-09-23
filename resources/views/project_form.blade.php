<!DOCTYPE html>
<html>
<head>
    <title>Project Creation</title>
    <!-- Add Bootstrap CSS for styling (optional) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Create Project</h2>

        <form action="" method="POST" id="project-form">
            @csrf

            <div class="form-group">
                <label for="project_name">Project Name</label>
                <input type="text" name="project_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date (Optional)</label>
                <input type="date" name="end_date" class="form-control">
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" name="status" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="emp_ids">Assign Employees</label>
                <select name="emp_ids[]" class="form-control" id="employee-select" multiple required>
                    <!-- Options will be populated by JavaScript -->
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Project</button>
        </form>
    </div>

    <!-- Add jQuery and Bootstrap JS for functionality (optional) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch the employee data
            fetch('http://127.0.0.1:8000/project_create')
                .then(response => response.json())
                .then(data => {
                    // Populate the select dropdown
                    const select = document.getElementById('employee-select');
                    data.forEach(employee => {
                        const option = document.createElement('option');
                        option.value = employee.emp_id;
                        option.textContent = employee.emp_name;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching employee data:', error));
        });
    </script>
</body>
</html>
