<?php
// Database connection
include './config/db.php';

// Get email id from AJAX request
$emailid = $_POST['emp_email']; // Assuming the email ID is passed as a parameter in the GET request

// Query to fetch employee data for the specific email
$query = "SELECT 
            `empid`, `ename`, `designation`, `role`, `emp_joining_date`, 
            `emp_dob`, `emp_gender`, `marital_status`, `emp_email`, 
            `emp_phone_no`, `emp_alt_contact_no`, `emp_address`, 
            `emp_city`, `emp_pincode`, `emp_salary`, `centre_id`, 
            `incentive`, `emp_status`, `bank_name`, `bank_branch`, 
            `bank_account_name`, `bank_account_no`, `ifsc_code`, 
            `login_name`, `password`, `profile_picture`, `department` 
          FROM `employee_master` 
          WHERE `emp_email` = '$emailid'";

// Execute query
$result = mysqli_query($conn, $query);

// Check if a row is returned
if(mysqli_num_rows($result) > 0) {
    // Fetch the data and send as JSON response
    $employeeData = mysqli_fetch_assoc($result);
    echo json_encode($employeeData);
} else {
    // If no data found
    echo json_encode(["message" => "No employee found with the given email."]);
}

// Close connection
mysqli_close($conn);
?>
