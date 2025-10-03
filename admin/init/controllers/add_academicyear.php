<?php
require_once "../model/class_model.php";

if (isset($_POST['acadyear'])) {
    // Sanitize input
    $acadyear = trim($_POST['acadyear']);
   $status = 1;

    // Instantiate the class_model object
    $conn = new class_model();

    // Call the edit_acadyearlevel function
    $acadyearlevel = $conn->edit_acadyearlevel($acadyear,$status);

    // Check the result and display appropriate message
    if ($acadyearlevel) {
        echo '<div class="alert alert-success">Add Date Successfully!</div>';
        echo '<script> setTimeout(function() { window.history.go(-1); }, 1000); </script>';
    } else {
        echo '<div class="alert alert-danger">Failed to add Date information!</div>';
        echo '<script> setTimeout(function() { window.history.go(-1); }, 1000); </script>';
    }
} else {
    // Handle case when form data is incomplete
    echo '<div class="alert alert-danger">Incomplete form data!</div>';
}
?>
