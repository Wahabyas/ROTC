<?php
require_once "../model/class_model.php";

if (isset($_POST)) {
    $conn = new class_model();

    $complete_name = trim($_POST['complete_name']);
    $desgination = trim($_POST['desgination']);
    $Role = trim($_POST['Role']);
    $email_address = trim($_POST['email_address']);
    $phone_number = trim($_POST['phone_number']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $status = trim($_POST['status2']);
    $STRAND = trim($_POST['STRAND']);
    $user_id = trim($_POST['user_id']);

    $user = $conn->edit_user($complete_name, $desgination, $email_address, $phone_number, $username, $password, $status, $STRAND, $Role, $user_id);
    if ($user == true) {
    
        echo '<div class="alert alert-success">Edit User Successfully!</div><script> setTimeout(function() { window.history.go(-1); }, 2000); </script>';
    } else {
        echo '<div class="alert alert-danger">Edit User Failed!</div><script> setTimeout(function() { window.history.go(0); }, 2000); </script>';
    }
}
?>
