<?php
require_once "../model/class_model.php";

if (isset($_POST['docname'])) {
    $conn = new class_model();
    $id = trim($_POST['docname']);
    $cours = $conn->delete_option($id);

    if ($cours == TRUE) {
        echo '<div class="alert alert-danger">Delete Document Option Successfully!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
    } else {
        echo '<div class="alert alert-danger">Delete Course Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
    }
}
?>