<?php
// Start the session
session_start();

// Include database connection
include '../config/db.php';

// Set proper headers
header('Content-Type: application/json');

// Get email and password from POST request
$email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
$password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';

// Check if email and password are provided
if (empty($email) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Email or password is missing.']);
    exit;
}

// Query the database
$query = "SELECT *
          FROM `employee_master` 
          WHERE `login_name` = '$email' AND `password` = '$password'";

$result = mysqli_query($conn, $query);

// Check if query executed successfully
if (!$result) {
    echo json_encode(['status' => 'error', 'message' => 'Database query failed.']);
    exit;
}

// Check if a row was found
if (mysqli_num_rows($result) > 0) {
    // Fetch employee data
    $employeeData = mysqli_fetch_assoc($result);

    
    $_SESSION['email'] = $employeeData['emp_email'];
    $_SESSION['id'] = $employeeData['empid'];
    $_SESSION['role'] = $employeeData['role'];
    $_SESSION['department'] = $employeeData['department'];
    $_SESSION['center'] = $employeeData['centre_id'];
    $_SESSION['username'] = $employeeData['login_name'];
    $_SESSION['ename'] = $employeeData['ename'];
    $_SESSION['logged_in'] = true;
    
    $_SESSION['designation'] = $employeeData['designation'];
    $_SESSION['emp_joining_date'] = $employeeData['emp_joining_date'];
    $_SESSION['emp_dob'] = $employeeData['emp_dob'];
    $_SESSION['emp_gender'] = $employeeData['emp_gender'];
    $_SESSION['marital_status'] = $employeeData['marital_status'];
    $_SESSION['emp_phone_no'] = $employeeData['emp_phone_no'];
    $_SESSION['emp_alt_contact_no'] = $employeeData['emp_alt_contact_no'];
    $_SESSION['emp_address'] = $employeeData['emp_address'];
    $_SESSION['emp_city'] = $employeeData['emp_city'];
    $_SESSION['emp_pincode'] = $employeeData['emp_pincode'];
    $_SESSION['emp_salary'] = $employeeData['emp_salary'];
    $_SESSION['incentive'] = $employeeData['incentive'];
    $_SESSION['emp_status'] = $employeeData['emp_status'];
    $_SESSION['bank_name'] = $employeeData['bank_name'];
    $_SESSION['bank_branch'] = $employeeData['bank_branch'];
    $_SESSION['bank_account_name'] = $employeeData['bank_account_name'];
    $_SESSION['bank_account_no'] = $employeeData['bank_account_no'];
    $_SESSION['ifsc_code'] = $employeeData['ifsc_code'];
    $_SESSION['password'] = $employeeData['password'];
    $_SESSION['profile_picture'] = $employeeData['profile_picture'];
    $_SESSION['escode'] = $employeeData['EmpCode'];
 
    // Send success response
    echo json_encode(['status' => 'success', 'message' => 'Login successful.', 'data' => $employeeData]);
} else {
    // Login failed
    echo json_encode(['status' => 'error', 'message' => 'Invalid email or password.']);
}

// Close the database connection
mysqli_close($conn);
?>
