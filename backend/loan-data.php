<?php

include "../config/db.php";
header('Content-Type: application/json');
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $eid = $_POST['eid'];
    

    if(empty($eid)){
        echo json_encode([
            "success" => false,
            "error" => "please fill reqiuired fileds"
        ]);

    }

$sql = "SELECT * FROM `loan_master` WHERE employee_id = $eid";

$result = $conn->query($sql);
if($result->num_rows == 0){
     echo json_encode([
        "success" => false,
        "message" => "the requested user dont have loan data",
        "loan_bal_amount"=> 0
    
    ]);
}
else{
    $loan = $result->fetch_assoc();

    $loan_id = $loan["loan_id"];
    $loan_bal_amount = $loan["loan_bal_amount"];
    
    echo json_encode([
        "success" => true,
        "loan_id" => $loan_id,
        "loan_bal_amount" => $loan_bal_amount
    
    ]);

}

}
else{
    echo json_encode(['success' => false,
"message" => "Invalid request"]);
}


