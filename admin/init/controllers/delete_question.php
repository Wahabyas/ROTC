<?php
  require_once "../model/class_model.php";;
	if(ISSET($_POST)){
		$conn = new class_model();
		$Question_id = trim($_POST['Question_id']);
		$acadsyear = $conn->delete_Question($Question_id);
		if($acadsyear  == TRUE){
		    echo '<div class="alert alert-danger">Delete Academic-Year Successfully!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';

		  }else{
			echo '<div class="alert alert-danger">Delete Student Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
		}
	}
?>

