<?php
require_once "../model/class_model.php";

if (isset($_POST['to'])) {
    $conn = new class_model();
    $to = trim($_POST['to']);
    $title = trim($_POST['title']);
    $Announcements = trim($_POST['Announcement']);
    $from = trim($_POST['from']);


    $Announcement = $conn->edit_Announcement($to,$title,$Announcements,$from);

    if ($Announcement == true) {
        echo '<div class="alert alert-success">Add Document Successfully!</div>';
        echo '<script> setTimeout(function() { window.history.go(-1); }, 1000); </script>';
    } else {
        echo '<div class="alert alert-danger">Add Document Failed!</div>';
        echo '<script> setTimeout(function() { window.history.go(-1); }, 1000); </script>';
    }
}
?>
