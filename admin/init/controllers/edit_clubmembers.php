<?php
require_once "../model/class_model.php";

if (!empty($_POST)) {
    $conn = new class_model();

    $club_memeber = trim($_POST['club_memeber']);
    $position = trim($_POST['position']);
    $clubadviser = trim($_POST['Clubadviser']);
    $Clubname = trim($_POST['club_name']);
    $club_id = trim($_POST['club_id']);
    $AAccount_status= trim($_POST['AAccount_status']);

    try {
        $result = $conn->edit_clubmember($club_memeber,$Clubname,$position,$clubadviser,$AAccount_status,$club_id);

        if ($result) {
            echo '<div class="alert alert-success">Edit Student Successfully!</div>';
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
