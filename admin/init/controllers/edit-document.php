<?php
  require_once "../model/class_model.php";

	if(ISSET($_POST)){
		$conn = new class_model();

		$documentname = trim($_POST['documentname']);
		$Price = trim($_POST['price']);
		$id = trim($_POST['id']);
		$course = $conn->edit_doc($documentname, $Price, $id);
		if($course == TRUE){
		    echo '<div class="alert alert-success">Edit Document Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';

		  }else{
			echo '<div class="alert alert-danger">Edit Student Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
		}
	}
?>

