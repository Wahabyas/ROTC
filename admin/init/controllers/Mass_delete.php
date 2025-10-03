<?php
// Mass_delete.php

// Include your database connection file or establish a connection here
$conn = new mysqli("localhost", "root", "", "mshs-protal");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get selected student IDs from the AJAX request
    $studentIds = $_POST['student_ids'];

    // Loop through each selected student ID and delete the corresponding record
    foreach ($studentIds as $studentId) {
        // Sanitize inputs to prevent SQL injection
        $studentId = mysqli_real_escape_string($conn, $studentId);

        // Construct the delete query
        $deleteQuery = "DELETE FROM tbl_student WHERE student_id = '$studentId'";

        // Execute the delete query
        $result = mysqli_query($conn, $deleteQuery);

        // Check for errors and handle accordingly
        if (!$result) {
            echo "Error deleting student with ID: $studentId";
            die();
        }
    }
	
	echo '<div class="alert alert-success">Selected students deleted successfully.</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
	
} else {
    // If the request method is not POST, return an error message
	echo '<div class="alert alert-danger">Action Failed</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
}
?>
