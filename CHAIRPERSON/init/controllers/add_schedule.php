<?php
  require_once "../model/class_model.php";

	if(ISSET($_POST)){
		$conn = new class_model();
		$Day = trim($_POST['Day']);
		$Units = trim($_POST['Units']);	
		$Subject = trim($_POST['Subject']);	
		$Hours = trim($_POST['Hours']);
		$Semester = trim($_POST['Semester']);
		$section = trim($_POST['Section']);
		$Room = trim($_POST['Room']);
	

		$schedule = $conn->add_schedule($Units,$Day,$Subject,$Hours,$Semester,$section,$Room);
		if ($schedule == TRUE) {
			echo '<div class="alert alert-custom-success">Add Teachig load Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
		} else {
			echo '<div class="alert alert-danger">Add Student Failed!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
		}
		
	}
?>

