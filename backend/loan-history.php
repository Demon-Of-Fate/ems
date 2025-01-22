<?php

include "../config/db.php";


if($_SERVER['REQUEST_METHOD']=="POST"){



    $emp_id = $_POST['empid'];
    
    $sql= "SELECT * FROM `loan_payment` WHERE emp_id = $emp_id ";       
    $output ='';
   
    $result =  $conn->query($sql);
    if($result->num_rows > 0){
         $result->fetch_assoc();

        foreach( $result as $row){
            
            $emi_id = $row['loan_emi_id'];
            $date =  $row['date_of_emi_payment'];
            $amount = $row['emi_amount'];
            $balance = $row['balance'];
            
            $output .= "<tr>
                            <td>  $emi_id  </td>
                            <td>  $date </td>
                            <td>  $amount  </td>
                            <td>  $balance  </td>
                            
                    </tr>";
       
    }
   
    echo $output;
        

        



        
    }
    else{
      $output .= "<p> There are no records of loan payment</p>";
    echo $output;
    }
}
else{
    echo json_encode(["error" => "invalid request"]);
    exit;
}   
