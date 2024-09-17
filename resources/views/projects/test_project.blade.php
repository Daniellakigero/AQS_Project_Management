<form action="{{ route('project_update', ['id' => $project->id ?? '']) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- This will tell Laravel to treat the request as a PUT request -->

    <!-- Manually enter the Project ID -->
    <label for="project_id">Project ID:</label>
    <input type="text" id="project_id" name="id" required>
    <br>

    <label for="project_name">Project Name:</label>
    <input type="text" id="project_name" name="project_name" required>
    <br>

    <label for="project_description">Project Description:</label>
    <textarea id="project_description" name="project_description"></textarea>
    <br>

    <label for="project_file">Upload Project File (PDF/TXT):</label>
    <input type="file" id="project_file" name="project_file">
    <br>

    <label for="project_category">Project Category:</label>
    <input type="text" id="project_category" name="project_category" required>
    <br>

    <label for="client">Client Name:</label>
    <input type="text" id="client" name="client" required>
    <br>

    <button type="submit">Update Project</button>
</form>
