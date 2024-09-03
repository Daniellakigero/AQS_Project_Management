<form method="POST" action="{{ route('employee.update') }}">
    @csrf
    @method('PUT')
    <div>
        <label>emp_id:</label>
        <input type="text" name="emp_id" required>
    </div>
    <div>
        <label>Name:</label>
        <input type="text" name="emp_name" required>
    </div>
    <div>
        <label>Email Personal:</label>
        <input type="email" name="email_personal" required>
    </div>
    <div>
        <label>Email Company:</label>
        <input type="email" name="email_company" required>
    </div>
    <div>
        <label>Phone Number:</label>
        <input type="text" name="phone_number" required>
    </div>
    <div>
        <label>Verification Code:</label>
        <input type="text" name="verification_code" required>
    </div>
    <div>
        <button type="submit">Send</button>
    </div>
</form>
