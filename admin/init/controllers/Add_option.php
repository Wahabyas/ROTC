<?php
require_once "../model/class_model.php";

if (isset($_POST['Document_name'])) {
    $conn = new class_model();
    $Document_name = trim($_POST['Document_name']);
    $Price = trim($_POST['Price']);
    $Document = $conn->edit_Document($Document_name,$Price);

    if ($Document == true) {
        echo '<div class="alert alert-success">Add Document Successfully!</div>';
        echo '<script> setTimeout(function() { window.history.go(-1); }, 1000); </script>';
    } else {
        echo '<div class="alert alert-danger">Add Document Failed!</div>';
        echo '<script> setTimeout(function() { window.history.go(-1); }, 1000); </script>';
    }
}
?>
