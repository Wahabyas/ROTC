<?php
require_once "../model/class_model.php";

if (!empty($_POST)) {
    $conn = new class_model();

    $club_name = trim($_POST['club_name']);
    $club_code = trim($_POST['club_code']);
    $club_adviser = trim($_POST['club_adviser']);
    $club_id = trim($_POST['club_id']);

    try {
        $result = $conn->edit_club($club_name,$club_code,$club_adviser,$club_id);

        if ($result) {
            echo '<div class="alert alert-custom-success">Edit Club Successfully!</div>';
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
