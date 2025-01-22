<?php 
include '../config/db.php';

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $center_code = $_POST['centreCode'];
    $center_name = $_POST['centreName'];
    $center_location = $_POST['centreLocation'];

    $sql = $conn->prepare("UPDATE centre_master
SET centre_name = ?, centre_location = ?
WHERE centre_code = ?;") ;
$sql->bind_param("sss",  $center_name, $center_location, $center_code) ;


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
        'message'=> 'center update successfully'
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