<?php

include "../config/db.php";


if($_SERVER['REQUEST_METHOD']=="POST"){



    $emp_id = $_POST['emp_id'];
    $emp_name = $_POST['emp_name'];
    // $emp_id = 12;
    
    $sql= "SELECT * FROM `loan_payment` WHERE emp_id = $emp_id ";       
    $output ='';
   
    $result =  $conn->query($sql);
    if($result->num_rows > 0){
         $result->fetch_assoc();
            $id = 0 ;

        foreach( $result as $row){
            

            $id = $id + 1;
            
            $date =  $row['date_of_emi_payment'];
            $amount = $row['emi_amount'];
            $balance = $row['balance'];
            
            $output .= "<tr> </br>
                            <td>  $id  </td></br>
                            <td>  $emp_name </td></br>
                            <td>  $amount  </td></br>
                            <td>  $balance  </td></br>
                            <td>  $date  </td></br>
                            
                    </tr> </br></br>";
       
    }
   
    echo $output;
        

        



        
    }
    else{
      $output .= "<p> There are no records of loan payment</p>";
    echo $output;
    }
}
else{
    echo json_encode([
        "success" => false,
        "message" => "invalid request"]);
    exit;
}   
