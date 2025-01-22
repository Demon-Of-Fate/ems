<?php
include '../config/db.php';

header('Content-Type: application/json');

try {
    $center_code = $_POST['centreCode'] ?? '';
    $center_name = $_POST['centreName'] ?? '';
    $center_location = $_POST['centreLocation'] ?? '';

    if(empty($center_code) || empty($center_name) || empty($center_location)) {
        echo json_encode([
            'success' => false,
            'message' => 'All fields are required'
        ]);
        exit;
    }

    // Sanitize inputs
    $center_code = strip_tags(trim($center_code));
    $center_name = strip_tags(trim($center_name));
    $center_location = strip_tags(trim($center_location));

    // SQL query
    $sql = "INSERT INTO centre_master (centre_name, centre_code, centre_location) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $center_name, $center_code, $center_location);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Center successfully added'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Database error: ' . $conn->error
        ]);
    }
} catch (Exception $e) {
    // Log error to file
    error_log("Center Addition Error: " . $e->getMessage(), 0);
    
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while processing your request'
    ]);
}

// Close the statement and connection
$stmt->close();
$conn->close();