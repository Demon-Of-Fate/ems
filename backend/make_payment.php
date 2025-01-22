<?php
include '../config/db.php';

header('Content-Type: application/json');
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $empid = $_POST['emp_id'];
    $emi_amount = $_POST['payment_amount'];
    $date  = $_POST['payment_date'];
    $loan_amount = $_POST['loan_amount'];
    $balance = $_POST['loan_bal'];
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
    else{
        $query = "UPDATE loan_master
        SET loan_bal_amount = '$balance'
        WHERE loan_id = $loan_id;";

        $sql = "INSERT INTO loan_payment (emp_id, emi_amount, date_of_emi_payment,  balance)
VALUES ($empid,$emi_amount , '$date',$balance);
";
      if($conn->query($sql) && $conn->query($query) == TRUE){


 echo json_encode([ 'success' => true ,
                     'message' => 'Payment recorded successfully'
     
    ]);


    }else{
        echo json_encode([
            "success" => false,
            "message"=> "database error"]);
    }

}
exit;

}else{
    echo json_encode(["success" => false ,  "message"=> "Invalid Request"]);
}