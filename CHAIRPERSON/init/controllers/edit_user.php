<?php
  require_once "../model/class_model.php";
	if(ISSET($_POST)){
		$conn = new class_model();

		$complete_name = trim($_POST['complete_name']);
		$desgination = trim($_POST['desgination']);
		$email_address = trim($_POST['email_address']);
		$phone_number = trim($_POST['phone_number']);
		$Role = trim($_POST['Role']);
		$Sectionz = trim($_POST['Sectionz']);
		$STRAND = trim($_POST['STRAND']);
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$status = trim($_POST['sttatus']);
		$user_id = trim($_POST['user_id']);

		$user = $conn->edit_user($complete_name, $desgination, $email_address, $phone_number, $username, $password, $status,$Sectionz,$STRAND,$Role, $user_id);
		if($user == TRUE){
		    echo '<div class="alert alert-success">Edit User Successfully!</div><script> setTimeout(function() {  window.history.go(0); }, 10000); </script>';

		  }else{
			echo '<div class="alert alert-danger">Edit User Failed!</div><script> setTimeout(function() {  window.history.go(0); }, 1000); </script>';
		}
	}
?>

