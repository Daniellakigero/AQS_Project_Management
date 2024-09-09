<form method="POST" action="{{ route('team.delete') }}">
    @csrf
    @method('DELETE')
    <div>
        <label>Team ID:</label>
        <input type="text" name="team_id" required>
    </div>
    
    <!-- Submit Button -->
    <div>
        <button type="submit">Delete</button>
    </div>
</form>
