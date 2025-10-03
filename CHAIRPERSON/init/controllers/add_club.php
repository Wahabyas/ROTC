<?php
  require_once "../model/class_model.php";

 function createRandomIDnumber() {
 	$chars = "003232303232023232023456789";
 	srand((double)microtime()*1000000);
 	$i = 0;
 	$ran = '' ;
 	while ($i <= 7) {

 		$num = rand() % 33;

 		$tmp = substr($chars, $num, 1);

 		$ran = $ran . $tmp;

 		$i++;

 	}
 	return $ran;
 }
 $SUBcode ='CODE-'.createRandomIDnumber();

	if(ISSET($_POST)){
		$conn = new class_model();
		$ClubName= trim($_POST['ClubName']);	
		$Clubadviser = trim($_POST['Clubadviser']);
	

		$club = $conn->add_club($ClubName,$SUBcode,$Clubadviser);
		if ($club == TRUE) {
			echo '<div class="alert alert-custom-success">Add Club Successfully!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
		} else {
			echo '<div class="alert alert-danger">Add Student Failed!</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
		}
		
	}
?>

