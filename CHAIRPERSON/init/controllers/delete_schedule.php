<?php
  require_once "../model/class_model.php";;
	if(ISSET($_POST)){
		$conn = new class_model();
		$schedule_id = trim($_POST['schedule_id']);
		$schedule = $conn->delete_schedule($schedule_id);
		if($schedule == TRUE){
		    echo '<div class="alert alert-success">Delete Teaching load Successfully!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';

		  }else{
			echo '<div class="alert alert-danger">Delete Subject Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
		}
	}
?>

