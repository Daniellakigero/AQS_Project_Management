<html>
<head>
    <title>Create a New Project</title>
</head>
<body>
    <div class="container">
        <h2>Create a New Project</h2>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form for creating a project with a file upload -->
        <form action="{{route('project_create')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="project_name" class="form-label">Project Name</label>
                <input type="text" class="form-control" id="project_name" name="project_name" required>
            </div>

            <div class="mb-3">
                <label for="project_description" class="form-label">Project Description</label>
                <textarea class="form-control" id="project_description" name="project_description" rows="4" required></textarea>
                <label for="project_description" class="form-label">Or Upload Project (Text or PDF)</label>
                <input type="file" class="form-control" id="project_file" name="project_file" accept=".txt,.pdf">
            </div>

            <div class="mb-3">
                <label for="project_category" class="form-label">Project Category</label>
                <input type="text" class="form-control" id="project_category" name="project_category" required>
            </div>

            <div class="mb-3">
                <label for="client" class="form-label">Client</label>
                <input type="text" class="form-control" id="client" name="client" required>
            </div>
            <!-- The hod_id will be automatically filled from the session -->
            <button type="submit" class="btn btn-primary">Create Project</button>
        </form>
    </div>
</body>
</html>
