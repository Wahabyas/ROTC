<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../model/class_model.php";

if (isset($_POST['studentName1'], $_POST['IsD'])) {
    $conn = new class_model();
    $activedate = $conn->fetchAll_Activedate(); // Call the function
 
    
    if (!$conn) {
        echo '<div class="alert alert-danger">Database connection failed!</div>';
        exit;
    }

    $studentName = htmlspecialchars(trim($_POST['studentName1']));
    $id = htmlspecialchars(trim($_POST['IsD']));
    $status = 1;
   
    // Add attendance with status and check result
    $result = $conn->add_attendance($id, $status,$activedate);

    if ($result === true) {
        echo '<div class="alert alert-custom-success">Add Attendance Successfully!</div><script> setTimeout(function() {  window.history.go(0); }, 1000); </script>';
    } else {
        echo '<div class="alert alert-danger">Failed to add attendance.</div>';
    }
} else {
    echo '<div class="alert alert-danger">Required fields missing!</div>';
}
?>
