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
if (isset($_POST['Club_member_name'], $_POST['Club_name'], $_POST['Position'],$_POST['Club_adviser'])) {
    $conn = new class_model();
    $Club_member_name = trim($_POST['Club_member_name']);
    $Club_name = trim($_POST['Club_name']);
    $Position = trim($_POST['Position']);
    $Club_adviser = trim($_POST['Club_adviser']);
    $Account_status = trim($_POST['Account_status']);

    // Moved inside the condition where the form is submitted
    $SUBcode = 'CODE-' . createRandomIDnumber();

    $clubmember = $conn->add_clubmember($Club_member_name,$Club_name,$Position,$Club_adviser,$Account_status);

    if ($clubmember == TRUE) {
        echo '<div class="alert alert-custom-success">Add Club Member Successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Add Subject Failed!</div>';
    }

    echo '<script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
}
?>
