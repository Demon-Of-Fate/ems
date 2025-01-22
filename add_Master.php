<?php
// Include database connection
include './config/db.php';

// Check if the designation is received for insert or update
if (isset($_POST['designation'])) {
    // Insert Operation
    $designation = $_POST['designation'];

    // Get the highest desigid value from the table
    $result = $conn->query("SELECT MAX(desigid) AS max_id FROM designation");
    $row = $result->fetch_assoc();

    // If no records exist, start desigid from 0
    $newDesigid = ($row['max_id'] === NULL) ? 0 : $row['max_id'] + 1; // Generate the new ID

    // SQL query to insert the designation with the generated desigid
    $sql = "INSERT INTO designation (desigid, designation) VALUES ('$newDesigid', '$designation')";

    if ($conn->query($sql) === TRUE) {
        // Success response in JSON format
        $response = array(
            'status' => 'success',
            'message' => 'Designation added successfully',
            'desigid' => $newDesigid,
            'designation' => $designation
        );
    } 
    // Send JSON response for insert
    echo json_encode($response);
    
    
}

// Check if designation is received for update
if (isset($_POST['desi']) && isset($_POST['id'])) {
    // Update Operation
    $designation = $_POST['desi'];
    $id = $_POST['id'];
    
    // Sanitize the input to prevent SQL injection
    $designation = $conn->real_escape_string($designation);
    $id = $conn->real_escape_string($id);
    
    // Create the SQL query for update
    $sql = "UPDATE designation SET designation = '$designation' WHERE desigid = '$id'";

    if ($conn->query($sql) === TRUE) {
        // Success response in JSON format
        $response = array(
            'status' => 'updated',
            'message' => 'Designation updated successfully',
            'desigid' => $id,
            'designation' => $designation
        );
    } else {
        // Error response in JSON format
        $response = array(
            'status' => 'error',
            'message' => 'Error: ' . $conn->error
        );
    }

    // Send JSON response for update
    echo json_encode($response);
  
} 
?>
