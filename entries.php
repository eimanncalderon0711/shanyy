<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rfid_project";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get the latest entry
$sql = "SELECT id, rfid, status, gender FROM entries ORDER BY id DESC LIMIT 1";

$result = $conn->query($sql);

// Initialize response array
$response = [];

    // Check if there are rows
if ($result->num_rows > 0) {
    // Fetch the latest entry
    $response = $result->fetch_assoc();
} 
else {
    // No entries found
    $response["message"] = "No entries found";
}


// Close the database connection
$conn->close();

// Return the result as JSON
echo json_encode($response);
?>

