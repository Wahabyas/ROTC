<?php
// update_year_level.php

// Include your database connection file or establish a connection here
$conn = new mysqli("localhost", "root", "", "mshs-protal");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get selected student IDs and new year level from the AJAX request
    $studentIds = $_POST['student_ids'];
    $newYearLevel = $_POST['new_year_level'];

    // Update the year level for each selected student
    foreach ($studentIds as $studentId) {
        // Sanitize inputs to prevent SQL injection (you can use prepared statements for better security)
        $studentId = mysqli_real_escape_string($conn, $studentId);
        $newYearLevel = mysqli_real_escape_string($conn, $newYearLevel);

        // Perform the update query
        $updateQuery = "UPDATE tbl_student SET Graduate = '$newYearLevel' WHERE student_id = '$studentId'";

        // Execute the update query
        $result = mysqli_query($conn, $updateQuery);

        // Check for errors and handle accordingly
        if (!$result) {
            echo "Error updating year level for student with ID: $studentId";
            die();
        }
    }
	
	echo '<div class="alert alert-success">Year level is updataed Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
	
} else {
    // If the request method is not POST, return an error message
	echo '<div class="alert alert-danger">Updating year level Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
}
?>
