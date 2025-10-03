<?php
require_once "../model/class_model.php";

if (isset($_POST['Question'])) {
    $conn = new class_model();
    $Question = trim($_POST['Question']);
 
    $Document = $conn->Add_question($Question);

    if ($Document == true) {
        echo '<div class="alert alert-success">Add Question Successfully!</div>';
        echo '<script> setTimeout(function() { window.history.go(-1); }, 1000); </script>';
    } else {
        echo '<div class="alert alert-danger">Add Document Failed!</div>';
        echo '<script> setTimeout(function() { window.history.go(-1); }, 1000); </script>';
    }
}
?>
