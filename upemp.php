<?php
include './config/db.php';
  if (isset($_POST['emp_name'])) {
       
    $emp_name = $_POST['emp_name'];
    $emp_dob = $_POST['emp_dob'];
    $gender = $_POST['gender'];
    $marital_status = $_POST['marital_status'];
    $emp_email = $_POST['emp_email'];
    $emp_phone = $_POST['emp_phone'];
    $alternate_contact_phone = $_POST['alternate_contact_phone'];
    $emp_address = $_POST['emp_address'];
    $emp_city = $_POST['emp_city'];
    $emp_pincode = $_POST['emp_pincode'];
    $emp_designation = $_POST['emp_designation'];
    
    $emp_dept = $_POST['emp_dept'];
    $emp_joining = $_POST['emp_joining'];
    $emp_salary = $_POST['emp_salary'];
    $incentive = $_POST['incentive'];
    $login_name = $_POST['login_name'];
    $password = $_POST['password'];
    $bank_account_no = $_POST['bank_no'];
    $bank_name = $_POST['bank_name'];
    $bank_branch = $_POST['bank_branch'];
    $ifsc_code = $_POST['ifsc_code'];
    $center_id = $_POST['center_id'];
    $bank_no = $_POST['bank_no'];
    $emp_status = $_POST['emp_status'];
    $bank_ac_name = $_POST['bank_ac_name'];
    $role = $_POST['role'];
    $eid = $_POST['empid'];
    // Assuming 'id' is passed via GET
    
    // SQL query to update employee details
    $update_sql = "UPDATE `employee_master` SET 
`ename` = '$emp_name',
`designation` = '$emp_designation',
`role` = '$role',
`emp_joining_date` = '$emp_joining',
`emp_dob` = '$emp_dob',
`emp_gender` = '$gender',
`marital_status` = '$marital_status',
`emp_email` = '$emp_email',
`emp_phone_no` = '$emp_phone',
`emp_alt_contact_no` = '$alternate_contact_phone',
`emp_address` = '$emp_address',
`emp_city` = '$emp_city',
`emp_pincode` = '$emp_pincode',
`emp_salary` = '$emp_salary',
`centre_id` = '$center_id',
`incentive` = '$incentive',
`emp_status` = '$emp_status',
`bank_name` = '$bank_name',
`bank_branch` = '$bank_branch',
`bank_account_name` = '$bank_ac_name',
`bank_account_no` = '$bank_account_no',
`ifsc_code` = '$ifsc_code',
`login_name` = '$login_name',
`password` = '$password',
`department` = '$emp_dept'

WHERE `empid` = '$eid'";


    // Execute the update query
    if ($conn->query($update_sql) === TRUE) {
        echo "updated";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}