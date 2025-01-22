<?php
require './config/db.php';
 $sql = "SELECT * FROM `emp_salary` WHERE emp_id = 12";
 $stmt = $conn->query($sql);
 $result = $stmt->fetch_all(MYSQLI_ASSOC);
 foreach($result as $row){
      echo $gross_salary = (int)$row['month_of_salary'];  echo " <br>";
      echo $present = (int)$row['days_present'];  echo " <br>";
      echo $absent = (int)$row['days_absent'];  echo " <br>";
      echo $half_days = (int)$row['half_days'];  echo " <br>";
            //half-deductions
            $half_days_deduction = $daily_wage/2 * $half_days;
            echo $half_days_deduction; echo " <br>";      
      echo $late_mark = (int)$row['late_marks_days'];  echo " <br>";
      
      //late mark deduction 
      $late_mark_deduction = $late_mark *100 ; 
      echo $late_mark_deduction; echo " <br>";
      echo $extra_days = (int)$row['extra_working_days'];  echo " <br>";
      echo $advance_deduction = (float)$row['advance_salary_deduction'];  echo " <br>";
      echo $arrears_addition = (float)$row['arrears_addition'];
      echo $arrears_deduction = (float)$row['arrears_deduction'];  echo " <br>";
       
           
      echo " <br>"; echo " <br>";


      // daliy wage
       $daily_wage = $gross_salary / 30;
      echo  $daily_wage; echo " <br>";

      //absence deduction
      $absence_deduction = $daily_wage * $absent;
      echo $absence_deduction; echo " <br>";



      //total salary deduction
      $total_deduction = $absence_deduction + $half_days_deduction + $late_mark_deduction + $advance_deduction + $arrears_deduction;
      echo $total_deduction; echo " <br>";
      echo " <br>";
      echo " <br>";

      //extra days
      $extra = $daily_wage * $extra_days;
      echo $extra;  echo " <br>";

      //total addition
      $total_addition = $extra + $arrears_addition;
      echo $total_addition ;  echo " <br>"; echo " <br>";

      //net salary 
      $net_salary = $gross_salary - $total_deduction + $total_addition;
      echo $net_salary;




 }
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
    <h1>Calculte salary of employee</h1>
    <p>emp Id : <?= $row['emp_id'] ?></p>
    <p> month of salary :  <?= $row['month_of_salary'] ?>  </p>
    <p>present days :   <?= $row['days_present'] ?> </p>
    <p>absent days  :  <?= $row['days_absent'] ?></p>
    <p>half days   :  <?= $row['half_days'] ?></p>
    <p>half days deducted :  <?= $row['half_days_deducted'] ?></p>
    <p> late marks days :  <?= $row['late_marks_days'] ?></p>
    <p>late mark days deducted :  <?= $row['late_mark_days_deducted'] ?></p>
    <p>Extra working days :  <?= $row['extra_working_days'] ?></p>
    <p>advance salary deduction :  <?= $row['advance_salary_deduction'] ?></p>
    <p>arrears addition :  <?= $row['arrears_addition'] ?></p>
    <p>arrears deduction :  <?= $row['arrears_deduction'] ?></p>
    <p>gross salary :  <?= $row['emp_id'] ?></p>
    <p>total deduction :  <?= $row['emp_id'] ?></p>
    <p>total addition :  <?= $row['emp_id'] ?></p>
    <p>net salary :  <?= $row['emp_id'] ?></p>
   
    
</body>
</html> 