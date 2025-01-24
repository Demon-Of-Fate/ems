<?php

include "../config/db.php";


if($_SERVER['REQUEST_METHOD']=="POST"){

   
    
    $sql= "SELECT
    l.loan_id,
    e.ename,
    l.loan_amount,
    l.interest_rate,
    l.start_date,
    l.loan_duration,
    l.num_of_emi,
    l.loan_status,
    l.emi_amount,
    l.created_at,
    l.updated_at,
    l.loan_bal_amount
FROM
    loan_master l
JOIN
    employee_master e ON l.employee_id = e.empid;
";       
    $output ='';
   
    $result =  $conn->query($sql);
    if($result->num_rows > 0){
         $result->fetch_assoc();
            $id = 0 ;

        foreach( $result as $row){
            

            $id = ++$id;
            $emp_name = $row['ename'];
            $loan_amount = $row['loan_amount'];
            $num_of_emi = $row['num_of_emi'];
            $balance = $row['loan_bal_amount'];
            $total_paid_amount = $loan_amount - $balance; 
            $date =  $row['start_date'];
            
            $output .= "<tr> 
                            <td>  $id  </td>
                            <td>  $emp_name </td>
                            <td>  $loan_amount  </td>
                            <td>  $num_of_emi  </td>
                            <td>  $total_paid_amount </td>
                            <td>  $balance  </td>
                            <td>  $date  </td>
                            
                    </tr> ";
       
    }
   
    echo $output;
        

        



        
    }
    else{
      $output .= "<p> no records </p>";
    echo $output;
    }
}
else{
    echo json_encode([
        "success" => false,
        "message" => "invalid request"]);
    exit;
}   
