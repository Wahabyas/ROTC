<?php
  require_once "../model/class_model.php";;
	if(ISSET($_POST)){
		$conn = new class_model();
		$Subj_id = trim($_POST['Subj_id']);
		$Subjects = $conn->delete_subjects($Subj_id);
		if($Subjects == TRUE){
		    echo '<div class="alert alert-success">Delete Subject Successfully!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';

		  }else{
			echo '<div class="alert alert-danger">Delete Subject Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
		}
	}
?>

