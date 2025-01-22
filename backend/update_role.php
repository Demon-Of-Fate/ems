<?php 
include '../config/db.php';

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == "POST"){
   
    $role_id = $_POST["roleid"];
    $role_name = $_POST['rolename'];

    $sql = $conn->prepare("UPDATE role
SET userrole = ?
WHERE userid = ?;") ;
$sql->bind_param("ss",  $role_name,  $role_id) ;


if(!$sql->execute()){
     echo json_encode([
         'success' => false,
        'message'=> 'database error'
    ]);
 exit;
}
else{
    echo json_encode([
        'success' => true,
        'message'=> 'role update successfully'
    ]);
    exit;
  
}
}else{
    echo json_encode([
        'success' => false,
        'message'=> 'invalid request'
    ]);
    exit;
}