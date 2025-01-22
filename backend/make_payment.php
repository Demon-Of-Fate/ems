<?php
include '../config/db.php';

header('Content-Type: application/json');
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $empid = $_POST['emp_id'];
    $loan_amount = $_POST['loan_amount'];
    $emi_amount = $_POST['emi_amount'];
    $date  = $_POST['payment_date'];
    $loan_status = $_POST['loan_status'];
    $balance = $_POST['current_balance'];
    $loan_id = $_POST['loan_id'];


    if($loan_amount == 0){
        echo json_encode([
        'success' => false,
        'message' => 'please check!, the employee have 0 loan']);
         exit;
    }



    if(empty($empid) || empty($emi_amount) || empty($date)){
        echo json_encode(["error" => "Please fill all fields"]);
        exit;
    }
    if($balance == 0){
        $loan_status = 'inacive';
    }
    if($balance < 0 ){
        echo json_encode([
            "success" => false,
            "message" => "you are entering negative number"]);
            exit;
    }
    else{

        $query = "UPDATE loan_master
        SET loan_bal_amount = '$balance', loan_status = '$loan_status'
        WHERE loan_id = $loan_id;";

        $sql = "INSERT INTO loan_payment (emp_id, emi_amount, date_of_emi_payment,  balance) VALUES ($empid,$emi_amount , '$date',$balance); ";
      if($conn->query($sql) && $conn->query($query) == TRUE){


 echo json_encode([ 
                    'success' => true ,
                    'message' => 'Payment recorded successfully'
     
    ]);


    }else{
        echo json_encode([
            "success" => false,
            "message"=> "database error"]);
            exit;
    }
    

}
exit;

}else{
    echo json_encode(["success" => false ,  "message"=> "Invalid Request"]);
}