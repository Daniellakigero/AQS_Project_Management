<form method="POST" action="{{ route('team.update') }}">
    @csrf
    @method('PUT')
    <div>
        <label>Team ID:</label>
        <input type="text" name="team_id" required>
    </div>
    
    <!-- Full Name -->
    <div>
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" required>
    </div>
    
    <!-- ID Number -->
    <div>
        <label for="id_number">ID Number:</label>
        <input type="text" id="id_number" name="id_number" value="{{ old('id_number') }}" required>
    </div>
    
    <!-- Nationality -->
    <div>
        <label for="nationality">Nationality:</label>
        <input type="text" id="nationality" name="nationality" value="{{ old('nationality') }}" required>
    </div>
    
    <!-- Email -->
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    </div>
    
    <!-- Gender -->
    <div>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
        </select>
    </div>

    <!-- Submit Button -->
    <div>
        <button type="submit">Update</button>
    </div>
</form>
