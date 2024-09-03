<form method="POST" action="{{ route('employee.delete') }}">
    @csrf
    @method('DELETE')
    <div>
        <label>emp_id:</label>
        <input type="text" name="emp_id" required>
    </div>
    <div>
        <button type="submit">Delete Employee</button>
    </div>
</form>
