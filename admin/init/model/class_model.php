
<?php

	require 'config/connection.php';

	class class_model{

		public $host = db_host;
		public $user = db_user;
		public $pass = db_pass;
		public $dbname = db_name;
		public $conn;
		public $error;
 
		public function __construct(){
			$this->connect();
		}
 
		private function connect(){
			$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
			if(!$this->conn){
				$this->error = "Fatal Error: Can't connect to database".$this->conn->connect_error;
				return false;
			}
		}

		public function login($username, $password, $status, $role) {
			$stmt = $this->conn->prepare("SELECT * FROM `tbl_usermanagement` WHERE `username` = ? AND `password` = ? AND `status` = ? AND `role` = ?") or die($this->conn->error);
			$stmt->bind_param("ssss", $username, $password, $status, $role);
			
			if ($stmt->execute()) {
				$result = $stmt->get_result();
				$valid = $result->num_rows; // Check the number of rows
				if ($valid > 0) {
					$fetch = $result->fetch_array();
					return array(
						'user_id' => htmlentities($fetch['user_id']),
						'count' => $valid
					);
				} else {
					return array(
						'user_id' => null,
						'count' => 0 // Ensure it returns 0 for no results
					);
				}
			}
			
		}
		
		public function user_account($user_id){
			$stmt = $this->conn->prepare("SELECT * FROM `tbl_usermanagement` WHERE `user_id` = ?") or die($this->conn->error);
		    $stmt->bind_param("i", $user_id);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$fetch = $result->fetch_array();
				return array(
					'complete_name'=> $fetch['complete_name'],
					'role'=> $fetch['role']
					// 'last_name'=>$fetch['last_name']
				);
			}	
		}

		public function fetchAll_room(){ 
            $sql = "SELECT * FROM  room";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }
		  public function fetchAll_prob(){ 
            $sql = "SELECT * FROM problem ORDER BY `CREATIONS` desc ";
				$stmt = $this->conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

	    public function fetchAll_course(){ 
            $sql = "SELECT * FROM tbl_course";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

		  public function fetchAll_documents(){
			$sql = "SELECT * FROM `doc-name`";
			$stmt = $this->conn->prepare($sql);
		
			if ($stmt->execute()) {
				$result = $stmt->get_result();
				$data = array();
		
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
		
				$stmt->close();
				return $data;
			} else {
				// If there's an error, you might want to handle it or log it.
				echo "Error: " . $stmt->error;
				return false;
			}
		}

		public function count_numberofstudentbyACTIVATED() {
			$sql = "SELECT COUNT(student_id) as count_students 
			FROM tbl_student 
			WHERE account_status = 'Active'
			";
			$stmt = $this->conn->prepare($sql);
		
			$stmt->execute();
			$result = $stmt->get_result();
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}

		

	

		public function count_numberofTEACHERS() {
			$sql = "SELECT COUNT(user_id) as count_students 
					FROM tbl_usermanagement";
			$stmt = $this->conn->prepare($sql);
			
			$stmt->execute();
			$result = $stmt->get_result();
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}

		public function count_numberofstudentbyDEACTIVATED() {
			$sql = "SELECT COUNT(student_id) as count_students 
			FROM tbl_student 
			WHERE account_status = 'Inactive'
			";
			$stmt = $this->conn->prepare($sql);
		
			$stmt->execute();
			$result = $stmt->get_result();
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}
		


		public function user_profile($user_id){
			$stmt = $this->conn->prepare("SELECT * FROM `tbl_usermanagement` WHERE `user_id` = ?") or die($this->conn->error);
			$stmt->bind_param("i", $user_id);
			
			if($stmt->execute()){
				$result = $stmt->get_result();
				$fetch = $result->fetch_array();
				return array(
					'user_id' => $fetch['user_id'],
					'complete_name' => $fetch['complete_name'], 
					'desgination' => $fetch['desgination'],
					'email_address' => $fetch['email_address'],
					'phone_number' => $fetch['phone_number'],
					'username' => $fetch['username'],
					'password' => $fetch['password'],
					'status' => $fetch['status'],
					'STRAND' => $fetch['STRAND'],
					'role' => $fetch['role']        
				);
			}
		}
		
		

		  public function countAllCourses() {
			$sql = "SELECT COUNT(*) as course_count FROM tbl_course";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->get_result();		
			$row = $result->fetch_assoc();
		
			// Return the count
			return $row['course_count'];
		}
		
		public function countStudentsByCourse($courseName) {
			$sql = "SELECT COUNT(*) as student_count FROM tbl_student WHERE course = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("s", $courseName);
			$stmt->execute();
			$result = $stmt->get_result();
		
			// Fetch the count directly instead of fetching all rows
			$row = $result->fetch_assoc();
		
			// Return the count
			return $row['student_count'];
		}
		public function countallteacher() {
			$sql = "SELECT COUNT(*) AS teacher_count FROM tbl_usermanagement WHERE role = 'FACULTY' OR role = 'VISITING INSTRUCTOR'";
			$stmt = $this->conn->prepare($sql);
			
			// Check for errors during preparation
			if (!$stmt) {
				echo "Error: " . $this->conn->error;
				return false;
			}
			
			$stmt->execute();
		
			// Check for errors during execution
			if ($stmt->errno) {
				echo "Error: " . $stmt->error;
				return false;
			}
		
			$result = $stmt->get_result();
			
			// Check if the result set is empty
			if ($result->num_rows === 0) {
				echo "No records found.";
				return 0;
			}
			
			// Fetch the count directly instead of fetching all rows
			$row = $result->fetch_assoc();
			
			// Return the count
			return $row['teacher_count'];
		}
		

		public function countallsection() {
			$sql = "SELECT COUNT(*) AS room_count FROM room ";
			$stmt = $this->conn->prepare($sql);
			
			// Check for errors during preparation
			if (!$stmt) {
				echo "Error: " . $this->conn->error;
				return false;
			}
			
			$stmt->execute();
		
			// Check for errors during execution
			if ($stmt->errno) {
				echo "Error: " . $stmt->error;
				return false;
			}
		
			$result = $stmt->get_result();
			
			// Check if the result set is empty
			if ($result->num_rows === 0) {
				echo "No records found.";
				return 0;
			}
			
			// Fetch the count directly instead of fetching all rows
			$row = $result->fetch_assoc();
			
			// Return the count
			return $row['room_count'];
		}


		public function countAllStudents() {
			$sql = "SELECT COUNT(*) as student_count FROM tbl_student";
			$stmt = $this->conn->prepare($sql);
			
			if (!$stmt) {
				die("Error in preparing statement: " . $this->conn->error);
			}
			$stmt->execute();
			$result = $stmt->get_result();
			$row = $result->fetch_assoc();
			return $row['student_count'];
		}
		

		public function add_course($course_name, $course_decription){
	       $stmt = $this->conn->prepare("INSERT INTO `tbl_course` (course_name, course_decription) VALUES(?, ?)") or die($this->conn->error);
			$stmt->bind_param("ss", $course_name, $course_decription);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
		public function add_room($Section,$Section_code,$Room_name){
			$stmt = $this->conn->prepare("INSERT INTO `room` (`section`,`section_code`,`Room_name`) VALUES(?,?,?)") or die($this->conn->error);
			$stmt->bind_param("sss",$Section,$Section_code,$Room_name);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function edit_Document($Document_name,$Price){
			$stmt = $this->conn->prepare("INSERT INTO `doc-name` (docname,Price) VALUES( ?,?)") or die($this->conn->error);
			$stmt->bind_param("si", $Document_name,$Price);
		
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
				
			} else {
				echo "Error: " . $stmt->error;
				return false;
			}
		}

		public function Add_question($Question){
			$stmt = $this->conn->prepare("INSERT INTO `questions` (Question) VALUES( ?)") or die($this->conn->error);
			$stmt->bind_param("s",$Question);
		
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
				
			} else {
				echo "Error: " . $stmt->error;
				return false;
			}
		}


		public function edit_room($section,$section_code,$room_name,$room_id) {
			$sql = "UPDATE `room` SET  `section` = ?, `section_code` = ?, `Room_name` = ? WHERE `room_id` = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssi",$section,$section_code,$room_name,$room_id);
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
		public function edit_clubmember($club_memeber,$Clubname,$position,$clubadviser,$AAccount_status,$club_id) {
			$sql = "UPDATE `clubmembers` SET `club_memeber` = ?, `club_name` = ?,  `position` = ? , `Clubadviser` = ?, `Status` = ? WHERE `club_memberid` = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssssi", $club_memeber,$Clubname,$position,$clubadviser,$AAccount_status,$club_id);
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function edit_Announcement($to,$title,$Announcements,$from){
			$stmt = $this->conn->prepare("INSERT INTO `announcement` (Announcement_to,Announcement_title,Announcement_desc,Announcement_from) VALUES( ?,?,?,?)") or die($this->conn->error);
			$stmt->bind_param("ssss", $to,$title,$Announcements,$from);
		
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			} else {
				echo "Error: " . $stmt->error;
				return false;
			}
		}

		public function edit_acadyearlevel($acadyear, $status) {
			// Check if the connection is valid
			if ($this->conn->connect_error) {
				die("Connection failed: " . $this->conn->connect_error);
			}
		
			// Start a transaction
			$this->conn->begin_transaction();
		
			try {
				// First, set all Status values to 0
				$updateStmt = $this->conn->prepare("UPDATE tbl_date SET Status = 0");
				if (!$updateStmt) {
					throw new Exception("Error: " . $this->conn->error);
				}
				$updateStmt->execute();
				$updateStmt->close();
		
				// Now, insert the new record
				$insertStmt = $this->conn->prepare("INSERT INTO tbl_date (Date, Status) VALUES (?, ?)");
				if (!$insertStmt) {
					throw new Exception("Error: " . $this->conn->error);
				}
				$insertStmt->bind_param("si", $acadyear, $status);
		
				// Execute the statement and handle success/failure
				if ($insertStmt->execute()) {
					$insertStmt->close();
					// Commit the transaction
					$this->conn->commit();
					return true;
				} else {
					throw new Exception("Error: " . $insertStmt->error);
				}
			} catch (Exception $e) {
				// Rollback the transaction in case of error
				$this->conn->rollback();
				echo $e->getMessage();
				return false;
			}
		}
		
		


		public function edit_course($course_name, $course_decription, $course_id){
			$sql = "UPDATE `tbl_course` SET  `course_name` = ?, `course_decription` = ?  WHERE course_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("ssi", $course_name, $course_decription, $course_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function delete_course($course_id){
			$sql = "DELETE FROM tbl_course WHERE course_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("i", $course_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function delete_room($room_id){
			$sql = "DELETE FROM room WHERE room_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("i",$room_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function delete_clubmember($club_id){
			$sql = "DELETE FROM clubmembers WHERE club_memberid = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("i",$club_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function delete_option($id) {
			$sql = "DELETE FROM `doc-name` WHERE docname = ?";
			$stmt = $this->conn->prepare($sql);
		
			if (!$stmt) {
				// Handle prepare error
				echo "Prepare failed: (" . $this->conn->errno . ") " . $this->conn->error;
				return false;
			}
		
			$stmt->bind_param("s", $id); // Assuming 'course_id' is a string, change to "i" if it's an integer
		
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
			} else {
				$stmt->close(); // Close the statement even in case of an error
				$this->conn->close();
				return false;
			}
		}
		public function delete_notif($id) {
			$sql = "DELETE FROM `problem` WHERE Prob_ID = ?";
			$stmt = $this->conn->prepare($sql);
		
			if (!$stmt) {
				// Handle prepare error
				echo "Prepare failed: (" . $this->conn->errno . ") " . $this->conn->error;
				return false;
			}
		
			$stmt->bind_param("s", $id); // Assuming 'course_id' is a string, change to "i" if it's an integer
		
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
			} else {
				$stmt->close(); // Close the statement even in case of an error
				$this->conn->close();
				return false;
			}
		}
		
		

		public function add_student( $first_name, $middle_name, $last_name, $course, $year_level, $date_ofbirth, $gender, $complete_address, $email_address, $mobile_number, $username,$IDNumber, $status){
			$stmt = $this->conn->prepare("INSERT INTO `tbl_student` ( `first_name`, `middle_name`, `last_name`, `course`, `year_level`, `date_ofbirth`, `gender`, `complete_address`, `email_address`, `mobile_number`, `username`, `password`, `account_status`) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)") or die($this->conn->error);
			$stmt->bind_param("sssssssssssss", $first_name, $middle_name, $last_name, $course, $year_level, $date_ofbirth, $gender, $complete_address, $email_address, $mobile_number, $username,$IDNumber, $status);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
 
	    public function fetchAll_student(){ 
            $sql = "SELECT * FROM  tbl_student ORDER BY date_created DESC limit 600";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

		  public function fetchAll_club(){ 
            $sql = "SELECT * FROM  club";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

		  public function fetchAll_clubmember(){ 
            $sql = "SELECT * FROM  clubmembers";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

		  public function fetchAll_Announcement(){ 
            $sql = "SELECT * FROM  announcement";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		  public function fetchAll_Date(){ 
            $sql = "SELECT * FROM  tbl_date";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

		  public function fetchAll_question(){ 
            $sql = "SELECT * FROM  questions";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }

	



		public function edit_student($first_name, $middle_name, $last_name, $course, $year_level, $date_ofbirth, $gender, $complete_address, $email_address, $mobile_number, $username, $password, $account_status,$Grad, $student_id){
			$sql = "UPDATE `tbl_student` SET   `first_name` = ?, `middle_name` = ?, `last_name` = ?, `course` = ?, `year_level` = ?, `date_ofbirth` = ?, `gender` = ?, `complete_address` = ?, `email_address` = ?, `mobile_number` = ?, `username` = ?, `password` = ?, `account_status` = ? , `Graduate` = ?  WHERE student_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("ssssssssssssssi", $first_name, $middle_name, $last_name, $course, $year_level, $date_ofbirth, $gender, $complete_address, $email_address, $mobile_number, $username, $password, $account_status,$Grad, $student_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function edit_doc($documentname, $Price, $id){
			$sql = "UPDATE `doc-name` SET   `docname` = ?, `Price` = ? WHERE id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("ssi", $documentname, $Price, $id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function add_announcement($to,$title,$announcement,$from,$announcement_id){
			$sql = "UPDATE `announcement` SET   `Announcement_to` = ?, `Announcement_title` = ?, `Announcement_desc` = ?, `Announcement_from` = ? WHERE Announcement_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("ssssi", $to,$title,$announcement,$from,$announcement_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
		public function edit_academicyears($acadyears,$noofteacher,$noofsection,$Academic_id){
			$sql = "UPDATE `tbl_academicyear` SET   `AcademicYear` = ?, `No_ofTeacher` = ?, `No_ofSection` = ? WHERE  AcademicYear_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssi", $acadyears,$noofteacher,$noofsection,$Academic_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function edit_Question($Question,$Question_id){
			$sql = "UPDATE `questions` SET   `Question` = ?  WHERE  question_ID  = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("si", $Question,$Question_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function delete_student($student_id){
			$stmt = $this->conn->prepare("DELETE FROM tbl_attendance WHERE student_id = ?");
			$stmt->bind_param("i", $student_id);
			$stmt->execute();
				$sql = "DELETE FROM tbl_student WHERE student_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i", $student_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

			public function delete_announcement($student_id){
				$sql = "DELETE FROM announcement WHERE Announcement_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i", $student_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

			public function delete_Academic($Academic_id) {
				$sql = "DELETE FROM tbl_date WHERE Date_id = ?";
				$stmt = $this->conn->prepare($sql);
			
				if (!$stmt) {
					return "Error preparing the SQL statement.";
				}
			
				$stmt->bind_param("i", $Academic_id);
			
				try {
					$stmt->execute();
					$stmt->close();
					$this->conn->close();
					return true;
				} catch (mysqli_sql_exception $e) {
					if ($e->getCode() == 1451) { // Foreign key constraint error code
						$stmt->close();
						$this->conn->close();
						return "foreign_key_error";
					} else {
						$stmt->close();
						$this->conn->close();
						return $e->getMessage();
					}
				}
			}
			

			public function delete_Question($Question_id){
				$sql = "DELETE FROM questions WHERE question_ID  = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i",$Question_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

		

	    public function fetchAll_document(){ 
            $sql = "SELECT * FROM  tbl_document";
				$stmt = $this->conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }



		public function delete_document($document_id){


			$sql="SELECT document_name FROM tbl_document WHERE document_id = ?";
				$stmt2=$this->conn->prepare($sql);
				$stmt2->bind_param("i", $document_id);
				$stmt2->execute();
				$result2=$stmt2->get_result();
				$row=$result2->fetch_assoc();
				$imagepath=$_SERVER['DOCUMENT_ROOT']."/mshs-protal/student/".$row['document_name'];
				unlink($imagepath);

				$sql = "DELETE FROM tbl_document WHERE document_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i", $document_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

	    public function fetchAll_documentrequest(){ 
            $sql = "SELECT * FROM  tbl_documentrequest";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		public function edit_request($control_no, $studentID_no, $document_name, $no_ofcopies, $date_request, $date_releasing, $processing_officer, $status, $request_id){
			$sql = "UPDATE `tbl_documentrequest` SET  `control_no` = ?, `studentID_no` = ?, `document_name` = ?, `no_ofcopies` = ?, `date_request` = ?, `date_releasing` = ?, `processing_officer` = ?, `status` = ?  WHERE request_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("ssssssssi", $control_no, $studentID_no, $document_name, $no_ofcopies, $date_request, $date_releasing, $processing_officer, $status, $request_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function delete_request($request_id){
				$sql = "DELETE FROM tbl_documentrequest WHERE request_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i", $request_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

    public function fetchAll_payment(){ 
            $sql = "SELECT *,CONCAT(tbl_student.first_name, ', ' ,tbl_student.middle_name, ' ' ,tbl_student.last_name) as student_name FROM  tbl_payment INNER JOIN tbl_student ON tbl_student.student_id =  tbl_payment.student_id ORDER BY tbl_payment.student_id DESC";
				$stmt = $this->conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		  public function edit_payment($control_no, $total_amount, $amount_paid, $date_ofpayment, $proof_ofpayment, $status, $payment_id){
			$sql = "UPDATE `tbl_payment` SET  `control_no` = ?, `total_amount` = ?, `amount_paid` = ?, `date_ofpayment` = ?, `proof_ofpayment` = ?, `status` = ?  WHERE payment_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("ssssssi", $control_no, $total_amount, $amount_paid, $date_ofpayment, $proof_ofpayment, $status, $payment_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function delete_payment($payment_id){
				$sql = "DELETE FROM tbl_payment WHERE payment_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i", $payment_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

			public function add_user($CODE,$complete_name, $designation, $email_address, $phone_number, $username,$password, $status, $Strand,$Role){
				$stmt = $this->conn->prepare("INSERT INTO `tbl_usermanagement` (`CODE`,`complete_name`, `desgination`, `email_address`, `phone_number`, `username`, `password`, `status`, `STRAND`,`role`) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?,?)") or die($this->conn->error);
				$stmt->bind_param("ssssssssss",$CODE,$complete_name, $designation, $email_address, $phone_number, $username,$password, $status, $Strand,$Role);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

	    public function fetchAll_user(){ 
            $sql = "SELECT * FROM  tbl_usermanagement";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

	    public function edit_user($complete_name, $desgination, $email_address, $phone_number, $username, $password, $status,$STRAND,$Role, $user_id){
			$sql = "UPDATE `tbl_usermanagement` SET  `complete_name` = ?, `desgination` = ?, `email_address` = ?, `phone_number` = ?, `username` = ?, `password` = ?, `status` = ?, `STRAND` = ?, `role` = ? WHERE user_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssssssssi", $complete_name, $desgination, $email_address, $phone_number, $username, $password, $status,$STRAND,$Role, $user_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

	   public function delete_user($user_id){
				$sql = "DELETE FROM tbl_usermanagement WHERE user_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i", $user_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

	    public function count_numberofstudents(){ 
            $sql = "SELECT COUNT(student_id) as count_students FROM tbl_student";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

	   

		 public function count_numberoftotalpending(){ 
            $sql = "SELECT COUNT(request_id) as count_pending FROM tbl_documentrequest WHERE status = 'Pending'";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		   public function count_numberoftotalpaid(){ 
            $sql = "SELECT COUNT(request_id) as count_paid FROM tbl_documentrequest WHERE status = 'Paid'";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

	


		 public function count_groupbymonth(){ 
            $sql = "SELECT COUNT(total_amount) as p_amountcount, SUM(total_amount) as p_amountsum, DATE_FORMAT(date_ofpayment, '%M') as month_s FROM tbl_payment GROUP BY DATE_FORMAT(date_ofpayment, '%M') ORDER BY DATE_FORMAT(date_ofpayment, '%M') ASC";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }


	 public function count_groupbycourse(){ 
            $sql = "SELECT count(course) as count_coursename,course FROM tbl_student GROUP BY course";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

	}	
?>