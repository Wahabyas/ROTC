<?php
require_once "../model/class_model.php";

if (!empty($_POST)) {
    $conn = new class_model();

    $Subject_name = trim($_POST['Subject_name']);
    $Subject_code = trim($_POST['Subject_code']);
    $Subject_strand = trim($_POST['Subject_strand']);
    $Subj_id = trim($_POST['Subj_id']);
    $units = trim($_POST['units']);
    $Sub_Descriptions = trim($_POST['Sub_Description']);

    try {
        $result = $conn->edit_subjects($Subject_name,$Sub_Descriptions,$units, $Subject_code, $Subject_strand, $Subj_id);

        if ($result) {
            echo '<div class="alert alert-custom-success">Edit Subject Successfully!</div>';
            echo '<script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
        } else {
            echo '<div class="alert alert-danger">Edit Student Failed!</div>';
            echo '<script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
        }
    } catch (Exception $e) {
        echo '<div class="alert alert-danger">An error occurred: ' . $e->getMessage() . '</div>';
        echo '<script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
    }
}
?>
