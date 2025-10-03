<?php

require_once "../model/class_model.php";

try {
    if (isset($_POST)) {
        $conn = new class_model();

        $files = addslashes(file_get_contents($_FILES['document_name']['tmp_name']));
        $document_name = "student_uploads/" . addslashes($_FILES['document_name']['name']);
        $image_size = $_FILES['document_name']['size'];
        move_uploaded_file($_FILES["document_name"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/MSHS-PORTAL/student/student_uploads/" . addslashes($_FILES["document_name"]["name"]));
        $document_description = trim($_POST['document_description']);
        $student_id = trim($_POST['student_id']);
        $RECORD_EXAMINER = trim($_POST['RECORD_EXAMINER']); // Add this line

        $doc = $conn->add_document($document_name, $RECORD_EXAMINER, $document_description, $image_size, $student_id); // Update this line

        if ($doc == TRUE) {
            echo '<div class="alert alert-success">Add Document Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
        } else {
            echo '<div class="alert alert-danger">Add Document Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
        }
    }
} catch (Exception $e) {
    // Handle the exception as needed
    echo '<div class="alert alert-danger">An error occurred: ' . $e->getMessage() . '</div>';
}
?>
