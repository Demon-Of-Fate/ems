<?php
include '../config/db.php';

// Set the content type header to application/json
header('Content-Type: application/json');
if($_SERVER['REQUEST_METHOD'] == "POST"){
// $ename = "rohan";

    $ename = $_POST["empname"];
    if(empty($ename)){
        echo json_encode(value: [
            "success" => false,
            "message" => "please select a employee"]);
        exit;

    }else{
         $sql = "SELECT * FROM `employee_master` WHERE ename = '$ename' ";
    $result = $conn->query($sql);

    $emp = $result->fetch_assoc();

    $name = $emp["ename"];
    $empid = $emp["empid"];
    $department = $emp['department'];
    $designation = $emp['designation'];
    $email = $emp['emp_email'];
    $center = $emp['centre_id'];


    $data = [
        "success" => true,
        "name" => $name,
        "empid" => $empid,
        "department" => $department,
        "designation"=> $designation,
        "email"=> $email,
        "center"=> $center
    ];
    $json = json_encode($data);

    echo $json;
    }

   

}else{
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method"]);
}