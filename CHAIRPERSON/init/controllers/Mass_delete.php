<?php



$conn = new mysqli("localhost", "root", "", "mshs-protal");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $studentIds = $_POST['student_ids'];

   
    foreach ($studentIds as $studentId) {
     
        $studentId = mysqli_real_escape_string($conn, $studentId);

     
        $deleteQuery = "DELETE FROM schedule WHERE sched_id = '$studentId'";

      
        $result = mysqli_query($conn, $deleteQuery);

       
        if (!$result) {
            echo "Error deleting student with ID: $studentId";
            die();
        }
    }
	
	echo '<div class="alert alert-success">Selected students deleted successfully.</div><script> setTimeout(function() {  window.history.go(-1); }, 1000); </script>';
	
} else {
   
	echo '<div class="alert alert-danger">Action Failed</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
}
?>
