<?php
require_once "../model/class_model.php";

if (isset($_POST['control_no'], $_POST['studentID_no'], $_POST['course'], $_POST['document_name'], $_POST['no_ofcopies'], $_POST['Price'], $_POST['date_request'], $_POST['student_id'])) {
    $conn = new class_model();

    $control_no = trim($_POST['control_no']);
    $studentID_no = trim($_POST['studentID_no']);
    $course = trim($_POST['course']);
    $document_name = trim($_POST['document_name']);
    $no_ofcopies = trim($_POST['no_ofcopies']);
    $Price = trim($_POST['Price']);
    $date_request = trim($_POST['date_request']);
    $received = "Received";
    $student_id = trim($_POST['student_id']);

   

    $request = $conn->add_request($course, $control_no, $studentID_no, $document_name, $no_ofcopies, $Price, $date_request, $received, $student_id);

    if ($request === TRUE) {
        echo '<div class="alert alert-success">Add Request Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
    } else {
        echo '<div class="alert alert-danger">Add Request Failed!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
    }
} else {
    echo '<div class="alert alert-danger">Invalid or incomplete POST data!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
}
?>
