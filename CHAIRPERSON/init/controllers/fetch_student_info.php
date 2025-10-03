<?php
// Database connection
header('Content-Type: application/json'); // Ensure JSON header
  require_once "../model/config/connection2.php";



if ($conn->connect_error) {
    // Return JSON response for connection error
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit; // Exit script
}

if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];
    
    // SQL query to find the student's name by their ID
    $query = "SELECT student_id, first_name, middle_name, last_name FROM tbl_student WHERE studentID_no = ?";
    $stmt = $conn->prepare($query);
    
    if ($stmt === false) {
        // Return JSON response if statement preparation fails
        echo json_encode(["error" => "Failed to prepare statement: " . $conn->error]);
        exit; // Exit script
    }
    
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $stmt->bind_result($ID, $first_name, $middle_name, $last_name);
    $result = $stmt->fetch();
    $stmt->close();

    if ($result) {
        // Return the full name and ID as a JSON response
        echo json_encode([
            "name" => $first_name . " " . $middle_name . " " . $last_name,
            "ID" => $ID
        ]);
    } else {
        // Return JSON response if no student is found
        echo json_encode(["error" => "No student found with this ID."]);
    }
} else {
    // Return JSON response if student_id is not set
    echo json_encode(["error" => "No student ID provided."]);
}

$conn->close();
?>
