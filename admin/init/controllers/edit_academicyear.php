<?php
  require_once "../model/class_model.php";

	if(ISSET($_POST)){
		$conn = new class_model();

		$acadyears = trim($_POST['acadyears']);
		$noofteacher = trim($_POST['noofteacher']);
		$noofsection = trim($_POST['noofsection']);
	
		$Academic_id = trim($_POST['student_id']);

		$academi = $conn->edit_academicyears($acadyears,$noofteacher,$noofsection,$Academic_id);
		if($academi  == TRUE){
		    echo '<div class="alert alert-success">Edit Academic-Year Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
		  }else{
			echo '<div class="alert alert-danger">Edit Student Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
		}
	}
?>

