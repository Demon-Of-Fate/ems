<?php

include "../config/db.php";
header('Content-Type: application/json');
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $eid = $_POST['eid'];
    // $eid = 1;
    

    if(empty($eid)){
        echo json_encode([
            "success" => false,
            "message" => "please fill reqiuired fileds"
        ]);
        exit;
    }

$sql = "SELECT * FROM `loan_master` WHERE employee_id = $eid AND loan_status = 'active' ";

$result = $conn->query($sql);
if($result->num_rows == 0){
     echo json_encode([
        "success" => false,
        "message" => "the requested user dont have loan data or it is inactive.",
        "loan_bal_amount"=> 0
    
    ]);
    exit;
}
else{
    $loan = $result->fetch_assoc();

    $loan_id = $loan["loan_id"] ;
    $loan_bal_amount = $loan["loan_bal_amount"] ;
    $emi_amount = $loan["emi_amount"] ;
    $loan_status = $loan['loan_status'];

    $calculate_balance = $loan_bal_amount - $emi_amount;
    
    
    
    echo json_encode([
        "success" => true,
        "loan_id" => $loan_id,
        "loan_bal_amount" => $loan_bal_amount,
        "emi_amount" => $emi_amount,
        "loan_balance" => $calculate_balance,
        "loan_status" => $loan_status
    
    ]);
    exit;

}

}
else{
    echo json_encode(['success' => false,
"message" => "Invalid request"]);
}


