<?php
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

// Initialize response variables
$statusMessage = "No RFID data received";
$rfid = "";

// Get RFID data from GET request
if (isset($_GET['rfid'])) {
    $rfid = trim($_GET['rfid']); // Get the RFID value from query parameter

    // Check if the RFID exists in the registrants table
    $sql = "SELECT status, gender FROM registered_rfid WHERE rfid = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("SQL prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $rfid);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // RFID found, get the current status
        $stmt->bind_result($status, $gender);
        $stmt->fetch();

        // Toggle status between 0 and 1
        $newStatus = ($status == 0) ? 1 : 0;
        // Update status in the registrants table
        $updateSql = "UPDATE registered_rfid SET status = ? WHERE rfid = ?";
        $updateStmt = $conn->prepare($updateSql);
        
        if (!$updateStmt) {
            die("SQL prepare failed: " . $conn->error);
        }

        $updateStmt->bind_param("is", $newStatus, $rfid);
        if ($updateStmt->execute()) {
            // Insert a new entry in the entries table
            $insertSql = "INSERT INTO entries (rfid, status, gender) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($insertSql);
            
            if (!$insertStmt) {
                die("SQL prepare failed: " . $conn->error);
            }

            $insertStmt->bind_param("sis", $rfid, $newStatus, $gender);
            if ($insertStmt->execute()) {
                $statusMessage = "RFID tapped successfully. Status updated to: $newStatus";
            } else {
                $statusMessage = "Error inserting entry: " . $insertStmt->error;
            }
            $insertStmt->close();
        } else {
            $statusMessage = "Error updating registrant status: " . $updateStmt->error;
        }
        $updateStmt->close();
    } else {
        // RFID not found in the registrants table
        $notFoundSql = "INSERT INTO entries (rfid) VALUES( ? )";
        $notFoundStmt = $conn->prepare($notFoundSql);

        if (!$notFoundStmt) {
            die("SQL prepare failed: " . $conn->error);
        }
        $notFoundStmt->bind_param("s", $rfid);
        if ($notFoundStmt->execute()) {
            $statusMessage = "RFID CARD not found";
        } else {
            $statusMessage = "Error inserting entry: " . $notFoundStmt->error;
        }
        $notFoundStmt->close();
        
    }

    $stmt->close();
}

// Close the database connection
$conn->close();

// Return status message as JSON (for easier frontend consumption)
echo json_encode(["message" => $statusMessage]);
?>
