<?php
require_once "../model/class_model.php";

if (!empty($_POST)) {
    $conn = new class_model();

    $section = trim($_POST['section']);
    $section_code = trim($_POST['section_code']);
    $room_name = trim($_POST['room_name']);
    $room_id = trim($_POST['room_id']);

    try {
        $result = $conn->edit_room($section,$section_code,$room_name,$room_id);

        if ($result) {
            echo '<div class="alert alert-custom-success">Edit Section Successfully!</div>';
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