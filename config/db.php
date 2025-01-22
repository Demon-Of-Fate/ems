<?php
$servername = "localhost"; // Server name
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "ems1"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    // echo "Success"; 
}
