<?php
include '../config/db.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $emp_id= $_POST['employee_id'];


$query = "SELECT * FROM `loan_master` WHERE employee_id = $emp_id AND loan_status = 'active' ";
$result = $conn->query($query);
if($result->num_rows > 0) {
    echo json_encode([
        "success" => false,
        "message" => "This employee already have an active loan"
    ]);
    exit;


} 




    $loan_amount= $_POST['loan_amount'];
    $loan_bal_amount= $_POST['loan_balance'];
    $start_date = $_POST['start_date'];
    $emi_amount = $_POST['emi_amount'];
    $no_of_emi= $_POST['num_of_emis'];
    $error ='';

    if(empty($emp_id) || empty($loan_amount) ||  empty($loan_bal_amount) ||empty($start_date) || empty($emi_amount) || empty($no_of_emi)){

        echo $error = json_encode([
            "success" => false,
            "message" => "all filed are required"
        ]);
        exit;
    }
    if($no_of_emi > 12){
        echo $error = json_encode([
            "success" => false,
            "message"=> "loan duraion shoiuld be less than 12"]);
        exit;

    }

    if(empty($error)){
        $sql="INSERT INTO `loan_master`
(employee_id, loan_amount, start_date, num_of_emi,  emi_amount, loan_bal_amount)
VALUES 
($emp_id, $loan_amount, '$start_date', $no_of_emi, '$emi_amount', $loan_bal_amount);
";

if($conn->query($sql) === True){
    echo json_encode([
        "success" => true,
        "message" =>"Loan is successfully saved in database" 
    ]);
}
else{
    echo json_encode([
        "success" => false,
        "message" => "database error" 
    ]);
}
    
    }
         

   
}

else {
    // If the request method is not POST, do nothing or show an error
    echo json_encode([ "success" => false, 
     "message" =>  "Invalid request method"]);
} 