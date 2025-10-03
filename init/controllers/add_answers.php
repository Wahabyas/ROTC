<?php
require_once "../model/class_model.php";

if (isset($_POST['student_section'], $_POST['student_id'])) {
    $conn = new class_model();

    $student_section = trim($_POST['student_section']);
    $student_id = trim($_POST['student_id']);
    $student_teacher = trim($_POST['student_teacher']);
    $Academicyear= trim($_POST['Academicyear']);
    // Initialize an array to store the answers
    $answers = array();

    // Loop through each answer submitted
    foreach ($_POST as $key => $value) {
        // Check if the key starts with "answer"
        if (strpos($key, 'answer') === 0) {
            // Extract the question number from the key
            $question_number = substr($key, strlen('answer'));

            // Store the answer in the answers array
            $answers[$question_number] = trim($value);
        }
    }

    // Insert the student's answers into the database
    $inserted = $conn->insertStudentAnswers($student_id,$student_teacher , $student_section, $Academicyear, $answers);

    if ($inserted) {
        echo '<div class="alert alert-success">Student answers submitted successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Failed to submit student answers!</div>';
    }
} else {
    echo '<div class="alert alert-danger">Invalid or incomplete POST data!</div>';
}
?>
