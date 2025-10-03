<?php
  require_once "../model/class_model.php";


 

	if(ISSET($_POST)){
		$conn = new class_model();

		$first_name = trim($_POST['first_name']);
		$middle_name = trim($_POST['middle_name']);
		$last_name = trim($_POST['last_name']);
		$course = trim($_POST['course']);
	    $year_level = trim($_POST['year_level']);
		$date_ofbirth = trim($_POST['date_ofbirth']);
	    $gender = trim($_POST['gender']);
		$complete_address = trim($_POST['complete_address']);
	    $email_address = trim($_POST['email_address']);
		$mobile_number = trim($_POST['mobile_number']);
	    $username = trim($_POST['username']);
		$LRN = trim($_POST['LRN']);
		$IDNumber = trim($_POST['Password']);

		$status = "Active";

		$course = $conn->add_student($LRN, $first_name, $middle_name, $last_name, $course, $year_level, $date_ofbirth, $gender, $complete_address, $email_address, $mobile_number, $username,$IDNumber, $status);
		if($course == TRUE){
		    echo '<div class="alert alert-custom-success">Add Student Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';

		  }else{
			echo '<div class="alert alert-danger">Add Student Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
		}
	}
?>

