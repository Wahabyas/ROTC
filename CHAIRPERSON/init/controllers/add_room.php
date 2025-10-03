<?php
  require_once "../model/class_model.php";

	if(ISSET($_POST)){
		$conn = new class_model();
		$Section = trim($_POST['Section_name']);	
		$Section_code = trim($_POST['Section_code']);	
		$Room_name = trim($_POST['Room_name']);	
	

		$room = $conn->add_room($Section,$Section_code,$Room_name);
		if ($room == TRUE) {
			echo '<div class="alert alert-custom-success">Add Section Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
		} else {
			echo '<div class="alert alert-danger">Add Student Failed!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
		}
		
	}
?>

