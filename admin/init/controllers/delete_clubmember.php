<?php
  require_once "../model/class_model.php";
	if(ISSET($_POST)){
		$conn = new class_model();
		$club_id = trim($_POST['club_id']);
		$club = $conn->delete_clubmember($club_id);
		if($club == TRUE){
		    echo '<div class="alert alert-danger">Delete Club member Successfully!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';

		  }else{
			echo '<div class="alert alert-danger">Delete Subject Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
		}
	}
?>

