<?php
  require_once "../model/class_model.php";

	if(ISSET($_POST)){
		$conn = new class_model();

		$to = trim($_POST['to1']);
		$title = trim($_POST['title1']);
		$announcement = trim($_POST['Announcement1']);
		$from = trim($_POST['From1']);
		$announcement_id = trim($_POST['student_id']);

		$course = $conn->add_announcement($to,$title,$announcement,$from,$announcement_id);
		if($course == TRUE){
		    echo '<div class="alert alert-success">Edit Student Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';

		  }else{
			echo '<div class="alert alert-danger">Edit Student Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
		}
	}
?>

