<?php

include './config/db.php';
function getUser(){
    global $conn;
$sql = "SELECT * FROM `employee_master` ORDER BY center_code DESC";
$stmt = $conn->query($sql);
$user = $stmt->fetch_all(MYSQLI_ASSOC);

$output = '';

if(count($user) > 0){
    $output .= '<table> <thead> <tr> <th> id </th>
                <th> name </th>
                <th> email </th> 
                <th> designation </th>
                <th> department </th>
                <th> center </th> 
                <th> edit </th> 
               
                </thead> <tbody> 
                 <tr>';
                foreach($user as $row){
                    $output .= 
                    '<td>'. $row['empid'] . '</td>
                    <td> '.$row['ename'] . '</td>
                    <td> '. $row['designation'] . '</td>
                    <td>' . $row['department'] . '</td>
                    <td>' . $row['centre_id'] . '</td>
                    <td> <button class="edit-btn btn btn-primary" data-id="' . $row['empid'] . '">Edit</button></td>
            

                    </tbody>
                    </table>';
                }
}else{
    $output .= '<p> No records </p>';
}
echo $output;
}
getUser();
