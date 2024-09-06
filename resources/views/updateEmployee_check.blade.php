<form method="POST" action="{{ route('employee.update') }}">
    @csrf
    @method('PUT')
    
    <!-- Employee ID -->
    <div>
        <label>Employee ID:</label>
        <input type="text" name="emp_id" required>
    </div>
    
    <!-- Full Name -->
    <div>
        <label>Full Name:</label>
        <input type="text" name="emp_fullname" required>
    </div>
    
    <!-- Personal Email -->
   
    
    <!-- Company Email -->
    <div>
        <label>Email Company:</label>
        <input type="email" name="email_company" required>
    </div>
    
    <!-- Department -->
    <div>
        <label>Department:</label>
        <input type="text" name="department" required>
    </div>
    
    <!-- Position -->
    <div>
        <label>Position:</label>
        <input type="text" name="position" required>
    </div>
    
    <!-- Default Password -->
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
</form>
