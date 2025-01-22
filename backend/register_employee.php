<?php
include '../config/db.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect the form data
    $profile_picture ='';
    $name = $conn->real_escape_string($_POST['emp_name']);
    $dob = $conn->real_escape_string($_POST['emp_dob']);
    $gender = $conn->real_escape_string($_POST['emp_gender']);
    $marital_status = $conn->real_escape_string($_POST['emp_marital_status']);
    $email = $conn->real_escape_string($_POST['emp_email']);
    $phone = $conn->real_escape_string($_POST['emp_phone']);
    $alt_phone = $conn->real_escape_string($_POST['emp_alt_phone']);
    $address = $conn->real_escape_string($_POST['emp_address']);
    $city = $conn->real_escape_string($_POST['emp_city']);
    $pincode = $conn->real_escape_string($_POST['emp_pincode']);
    $designation = $conn->real_escape_string($_POST['emp_designation']);
    $department = $conn->real_escape_string($_POST['emp_department']);
    $join_date = $conn->real_escape_string($_POST['emp_joining_date']);
    $salary = $conn->real_escape_string($_POST['emp_salary']);
    $incentive = $conn->real_escape_string($_POST['emp_incentive']);
    $center_id = $conn->real_escape_string($_POST['emp_center_id']);
    $status = $conn->real_escape_string($_POST['emp_status']);
    $acc_name = $conn->real_escape_string($_POST['emp_acc_name']);
    $bank_name = $conn->real_escape_string($_POST['emp_bank_name']);
    $branch = $conn->real_escape_string($_POST['emp_branch']);
    $ifsc = $conn->real_escape_string($_POST['emp_ifsc']);
    $bank_no = $conn->real_escape_string($_POST['emp_bank_no']);
    $username = $conn->real_escape_string($_POST['emp_username']);
    $password = $conn->real_escape_string($_POST['emp_password']);
    $empcode = $conn->real_escape_string($_POST['empcode']);
    $role_id = $conn->real_escape_string($_POST['role']);

    // Construct the SQL query (ensure variables are properly quoted for strings)
    $sql = "INSERT INTO `employee_master` (
        `ename`, 
        `designation`, 
        `department`, 
        `role`, 
        `emp_joining_date`, 
        `emp_dob`, 
        `emp_gender`, 
        `marital_status`, 
        `emp_email`, 
        `emp_phone_no`, 
        `emp_alt_contact_no`, 
        `emp_address`, 
        `emp_city`, 
        `emp_pincode`, 
        `emp_salary`, 
        `centre_id`, 
        `incentive`, 
        `emp_status`, 
        `bank_name`, 
        `bank_branch`, 
        `bank_account_name`, 
        `bank_account_no`, 
        `ifsc_code`, 
        `login_name`, 
        `password`, 
        `profile_picture`, 
        `EmpCode`
    ) VALUES (
        '$name', 
        '$designation', 
        '$department', 
        '$role_id', 
        '$join_date', 
        '$dob', 
        '$gender', 
        '$marital_status', 
        '$email', 
        '$phone', 
        '$alt_phone', 
        '$address', 
        '$city', 
        '$pincode', 
        '$salary', 
        '$center_id', 
        '$incentive', 
        '$status', 
        '$bank_name', 
        '$branch', 
        '$acc_name', 
        '$bank_no', 
        '$ifsc', 
        '$username', 
        '$password', 
        '$profile_picture', 
        '$empcode'
    )";

    // Execute the query and check if it was successful
    if ($conn->query($sql) === TRUE) {
        echo 1;  // Success
    } else {
        echo 2;  // Failure
    }
} else {
    // If the request method is not POST, do nothing or show an error
    echo "Invalid request method";
}
?>


