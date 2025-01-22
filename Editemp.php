<?php
include './config/db.php';

// Assuming form data is sent via POST
$empid = $_POST['empid'];  
$emp_name = $conn->real_escape_string($_POST['emp_name']);
$emp_dob = $conn->real_escape_string($_POST['emp_dob']);
$gender = $conn->real_escape_string($_POST['emp_gender']);
$marital_status = $conn->real_escape_string($_POST['emp_marital_status']);
$emp_email = $conn->real_escape_string($_POST['emp_email']);
$emp_phone = $conn->real_escape_string($_POST['emp_phone']);
$emp_alt_phone = $conn->real_escape_string($_POST['emp_alt_phone']);
$emp_address = $conn->real_escape_string($_POST['emp_address']);
$emp_city = $conn->real_escape_string($_POST['emp_city']);
$emp_pincode = $conn->real_escape_string($_POST['emp_pincode']);
$emp_designation = $conn->real_escape_string($_POST['emp_designation']);
$emp_department = $conn->real_escape_string($_POST['emp_department']);
$emp_joining_date = $conn->real_escape_string($_POST['emp_joining_date']);
$emp_salary = $conn->real_escape_string($_POST['emp_salary']);
$incentive = $conn->real_escape_string($_POST['emp_incentive']);
$center_id = $conn->real_escape_string($_POST['emp_center_id']);
$emp_status = $conn->real_escape_string($_POST['emp_status']);
$acc_name = $conn->real_escape_string($_POST['emp_acc_name']);
$bank_name = $conn->real_escape_string($_POST['emp_bank_name']);
$branch = $conn->real_escape_string($_POST['emp_branch']);
$ifsc = $conn->real_escape_string($_POST['emp_ifsc']);
$bank_no = $conn->real_escape_string($_POST['emp_bank_no']);
$username = $conn->real_escape_string($_POST['emp_username']);
$password = $conn->real_escape_string($_POST['emp_password']);
$role = $conn->real_escape_string($_POST['role']);
$empcode = $conn->real_escape_string($_POST['empcode']);  // added role

// Prepare the SQL UPDATE statement
$sql = "UPDATE employee_master SET
    ename = '$emp_name',
    emp_dob = '$emp_dob',
    emp_gender = '$gender',
    marital_status = '$marital_status',
    emp_email = '$emp_email',
    emp_phone_no = '$emp_phone',
    emp_alt_contact_no = '$emp_alt_phone',
    emp_address = '$emp_address',
    emp_city = '$emp_city',
    emp_pincode = '$emp_pincode',
    designation = '$emp_designation',
    department = '$emp_department',
    emp_joining_date = '$emp_joining_date',
    emp_salary = '$emp_salary',
    incentive = '$incentive',
    centre_id = '$center_id',
    emp_status = '$emp_status',
    role = '$role',
    bank_account_name = '$acc_name',
    bank_name = '$bank_name',
    bank_branch = '$branch',
    ifsc_code = '$ifsc',
    bank_account_no = '$bank_no',
    login_name = '$username',
    password = '$password',
    EmpCode ='$empcode'
WHERE empid = $empid";

// Execute the query
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
