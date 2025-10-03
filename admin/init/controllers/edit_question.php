<?php
  require_once "../model/class_model.php";

	if(ISSET($_POST)){
		$conn = new class_model();

		$Question = trim($_POST['question']);
		$Question_id = trim($_POST['student_id']);

		$question = $conn->edit_Question($Question,$Question_id);
		if($question  == TRUE){
		    echo '<div class="alert alert-success">Edit Question Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
		  }else{
			echo '<div class="alert alert-danger">Edit Student Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
		}
	}
?>

