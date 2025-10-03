<?php
require_once "../model/class_model.php";

if (!empty($_POST)) {
    $conn = new class_model();

    $Day = trim($_POST['Day']);
    $Units = trim($_POST['Units']);
    $Subject = trim($_POST['Subject']);
    $Hours = trim($_POST['Hours']);
    $Section = trim($_POST['Section']);
    $Semester = trim($_POST['Semester']);
    $Room = trim($_POST['room']);
    $sched_id = trim($_POST['sched_isd']);

    try {
        $result = $conn->edit_schedule($Units,$Day,$Subject,$Hours,$Semester,$Section,$Room,$sched_id);

        if ($result) {
            echo '<div class="alert alert-custom-success">Edit Teaching load Successfully!</div>';
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
