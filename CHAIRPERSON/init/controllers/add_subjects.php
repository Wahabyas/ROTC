<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../model/class_model.php";

function createRandomIDnumber() {
    $chars = "003232303232023232023456789";
    $ran = '';

    for ($i = 0; $i <= 7; $i++) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $ran .= $tmp;
    }

    return $ran;
}

// Changed to check specific POST variables
if (isset($_POST['subject_name'], $_POST['subject_strand'], $_POST['UNIT'])) {
    $conn = new class_model();
    $subject_name = trim($_POST['subject_name']);
    $subject_strand = trim($_POST['subject_strand']);
    $UNIT = trim($_POST['UNIT']);
    $Sub_Description= trim($_POST['Sub_Description']);

    // Moved inside the condition where the form is submitted
    $SUBcode = 'CODE-' . createRandomIDnumber();

    $course = $conn->add_subjects($UNIT, $subject_name,$Sub_Description, $SUBcode, $subject_strand);

    if ($course == TRUE) {
        echo '<div class="alert alert-custom-success">Add Subject Successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Add Subject Failed!</div>';
    }

    echo '<script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
}
?>
