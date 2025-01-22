<?php
include '../config/db.php';

header('Contnet-Type: application/Json ');

try{
    // $role_id = $_POST['roleid'];
    $role_name = $_POST['rolename'];

    if(empty($role_name)){
        echo json_encode([
            'success' => false,
            'message' => 'role name is required'
        ]);

        exit;
    }

    $sql = "INSERT INTO role (userrole)
VALUES 
    (?); ";

   $stmt = $conn->prepare($sql);
   $stmt->bind_param("s",  $role_name);

   if($stmt->execute()){
    echo json_encode([
        'success' => true,
        'message' => 'the role is added in database'
    ]);
    exit;
   }
   else{
    echo json_encode([
        'success' => false,
        'message' => 'sorry something went wrong'

    ]);
    exit;
   }

}
catch(Exception $e){
    error_log("Center Addition Error: " . $e->getMessage(), 0);
    
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while processing your request'
    ]);
    exit;

}