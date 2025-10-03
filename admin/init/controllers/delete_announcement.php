<?php
  require_once "../model/class_model.php";;
	if(ISSET($_POST)){
		$conn = new class_model();
		$student_id = trim($_POST['Announcement_id']);
		$student = $conn->delete_announcement($student_id);
		if($student == TRUE){
		    echo '<div class="alert alert-success">Delete Student Successfully!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';

		  }else{
			echo '<div class="alert alert-danger">Delete Student Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
		}
	}
?>

