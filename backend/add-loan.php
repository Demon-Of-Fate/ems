<?php
include '../config/db.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $empid= $_POST['empid'];
    $loan_amount= $_POST['loan_amount'];
    $loan_status= $_POST['loan_status'];
    $loan_duration= $_POST['loan_duration'];
    $loan_bal_amount= $_POST['loan_bal_amount'];
    $start_date = $_POST['start_date'];
    $emi_amount = $_POST['emi_amount'];
    $no_of_emi= $_POST['no_of_emi'];
    $error ='';

    if(empty($empid) || empty($loan_amount) || empty($loan_status) ||empty($loan_duration) || empty($loan_bal_amount) ||empty($start_date) || empty($emi_amount) || empty($no_of_emi)){

        echo $error = json_encode([
            "success" => false,
            "message" => "all filed are required"
        ]);
        exit;
    }
    if($loan_duration > 12){
        echo $error = json_encode([
            "success" => false,
            "message"=> "loan duraion shoiuld be less than 12"]);
        exit;

    }
    if(empty($error)){
        $sql="INSERT INTO `loan_master`
(employee_id, loan_amount, start_date, loan_duration, num_of_emi, loan_status, emi_amount, loan_bal_amount)
VALUES
($empid, $loan_amount, '$start_date', $loan_duration, $no_of_emi, '$loan_status', '$emi_amount', $loan_bal_amount);
";

if($conn->query($sql)===True){
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
    echo "Invalid request method";
}