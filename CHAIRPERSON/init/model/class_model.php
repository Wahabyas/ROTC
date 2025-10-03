
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

		public function login($username, $password, $status,$role){
			$stmt = $this->conn->prepare("SELECT * FROM `tbl_usermanagement` WHERE `username` = ? AND `password` = ? AND `status` = ? AND `role` = ?") or die($this->conn->error);
			$stmt->bind_param("ssss", $username, $password, $status,$role);
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
 

	public function user_account($user_id) {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM `tbl_usermanagement` WHERE `user_id` = ?");
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $fetch = $result->fetch_array();
            return array(
                'complete_name' => $fetch['complete_name'],
                'STRAND' => $fetch['STRAND']
            );
        } else {
            return false; 
        }
    } catch (Exception $e) {
        return false;
    }
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

		public function add_course($course_name, $course_decription){
	       $stmt = $this->conn->prepare("INSERT INTO `tbl_course` (course_name, course_decription) VALUES(?, ?)") or die($this->conn->error);
			$stmt->bind_param("ss", $course_name, $course_decription);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
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
		public function get_attendance_by_student($student_id) {
			$stmt = $this->conn->prepare("
				SELECT 
					a.attendance_id,
					a.student_id,
					s.studentID_no,
					s.first_name,
					s.last_name,
					d.Date,
					a.status
				FROM tbl_attendance AS a
				JOIN tbl_student AS s ON a.student_id = s.student_id
				JOIN tbl_date AS d ON a.Date_id = d.Date_id
				WHERE a.student_id = ?
			") or die($this->conn->error);
		
			$stmt->bind_param("i", $student_id);
		
			if ($stmt->execute()) {
				$result = $stmt->get_result();
				$attendance_data = [];
		
				while ($fetch = $result->fetch_array()) {
					$attendance_data[] = array(
						'attendance_id' => $fetch['attendance_id'],
						'student_id' => $fetch['student_id'],
						'studentID_no' => $fetch['studentID_no'],
						'first_name' => $fetch['first_name'],
						'last_name' => $fetch['last_name'],
						'Date' => $fetch['Date'],
						'status' => $fetch['status']
					);
				}
		
				return $attendance_data;
			} else {
				return null;
			}
		}

		public function add_student($LRN, $first_name, $middle_name, $last_name, $course, $year_level, $date_ofbirth, $gender, $complete_address, $email_address, $mobile_number, $username,$IDNumber, $status){
			$stmt = $this->conn->prepare("INSERT INTO `tbl_student` (`studentID_no`, `first_name`, `middle_name`, `last_name`, `course`, `year_level`, `date_ofbirth`, `gender`, `complete_address`, `email_address`, `mobile_number`, `username`, `password`, `account_status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)") or die($this->conn->error);
			$stmt->bind_param("ssssssssssssss",$LRN, $first_name, $middle_name, $last_name, $course, $year_level, $date_ofbirth, $gender, $complete_address, $email_address, $mobile_number, $username,$IDNumber, $status);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function add_subjects($UNIT, $subject_name,$Sub_Description, $SUBcode, $subject_strand){
			$stmt = $this->conn->prepare("INSERT INTO `sub` (`units`, `Subject_name`, `Sub_des`, `Subject_code`, `Subject_strand`) VALUES (?, ?, ?, ?, ?)") or die($this->conn->error);
			$stmt->bind_param("sssss", $UNIT, $subject_name,$Sub_Description, $SUBcode, $subject_strand);
		
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
			} else {
				// Include error handling here
				echo "Error: " . $stmt->error;
				$stmt->close();
				$this->conn->close();
				return false;
			}
		}

		public function add_attendance($id, $status, $activedate) {
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		
			try {
				// Check if the attendance record already exists
				$checkStmt = $this->conn->prepare("SELECT * FROM `tbl_attendance` WHERE `student_id` = ? AND `Date_id` = ?");
				$checkStmt->bind_param("ii", $id, $activedate);
				$checkStmt->execute();
				$checkResult = $checkStmt->get_result();
		
				if ($checkResult->num_rows > 0) {
					// Attendance already recorded
					?>
					<script>
						$('#message').html('<div class="alert alert-danger">Already Recorded</div>');
						window.scrollTo(0, 0);
					</script>
					<?php
					return false; // Return false if already exists
				} else {
					// Prepare to insert new attendance record
					$stmt = $this->conn->prepare("INSERT INTO `tbl_attendance` (`student_id`, `status`, `Date_id`) VALUES (?, ?, ?)");
					if (!$stmt) {
						echo "Prepare failed: " . $this->conn->error;
						return false;
					}
		
					// Bind parameters
					$stmt->bind_param("iii", $id, $status, $activedate);
		
					// Execute the statement
					if ($stmt->execute()) {
						$stmt->close();
						return true; // Successfully added attendance
					} else {
						echo "Execute failed: " . $stmt->error;
						$stmt->close();
						return false; // Return false on execution failure
					}
				}
			} catch (mysqli_sql_exception $e) {
				echo "Exception caught: " . $e->getMessage(); // Log any exception messages
				return false; // Return false on exceptions
			}
		}
		
		

		
		

		public function add_clubmember($Club_member_name,$Club_name,$Position,$Club_adviser,$Account_status){
			$stmt = $this->conn->prepare("INSERT INTO `clubmembers` (`club_memeber`, `club_name`, `position`, `Clubadviser` , `Status`) VALUES (?, ?, ?, ?,?)") or die($this->conn->error);
			$stmt->bind_param("sssss",$Club_member_name,$Club_name,$Position,$Club_adviser,$Account_status);
		
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
			} else {
				// Include error handling here
				echo "Error: " . $stmt->error;
				$stmt->close();
				$this->conn->close();
				return false;
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

		
		public function add_club($ClubName,$SUBcode,$Clubadviser){
			$stmt = $this->conn->prepare("INSERT INTO `club` (`club_name`, `club_code`, `club_adviser`) VALUES(?, ?, ?)") or die($this->conn->error);
			$stmt->bind_param("sss",$ClubName,$SUBcode,$Clubadviser);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function add_schedule($Units,$Day,$Subject,$Hours,$Semester,$section,$Room){
			$stmt = $this->conn->prepare("INSERT INTO `schedule` (`Units` , `Day`, `Subject` , `Hours`, `Sem`,`Section`,`Room`) VALUES(?, ?, ?,?,?,?,?)") or die($this->conn->error);
			$stmt->bind_param("sssssss",$Units,$Day,$Subject,$Hours,$Semester,$section,$Room);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
 
	    public function fetchAll_student(){ 
            $sql = "SELECT * FROM tbl_student ORDER BY date_created DESC limit 600";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }


		  public function viewAll_Grades($LRN) {
			$sql = "SELECT * FROM grades WHERE student_lrn = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("s",$LRN);
			if ($stmt->execute()) {
				
				$result = $stmt->get_result(); 
				$data = $result->fetch_all(MYSQLI_ASSOC); 
				$this->conn->close();
				return $data; 
			} else {
				return false;
			}
		}
		

		  public function fetchAll_subjects(){ 
            $sql = "SELECT * FROM  sub";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
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

		  public function fetchAll_Announcement(){ 
            $sql = "SELECT * FROM announcement";
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

		  public function fetchAll_schedule(){ 
            $sql = "SELECT * FROM  schedule";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
		  }
		  public function fetchALL_sched($student_number) {
			$sql = "SELECT * FROM schedule WHERE Day = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("s", $student_number);
			if ($stmt->execute()) {
				$result = $stmt->get_result(); 
				$data = $result->fetch_all(MYSQLI_ASSOC); 
				$this->conn->close();
				return $data; 
			} else {
				return false;
			}
		}

		public function fetchclubmember($club_name) {
			$sql = "SELECT * FROM clubmembers WHERE `club_name` = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("s", $club_name);
			if ($stmt->execute()) {
				$result = $stmt->get_result(); 
				$data = $result->fetch_all(MYSQLI_ASSOC); 
				$this->conn->close();
				return $data; 
			} else {
				return false;
			}
		}


		  
		public function edit_student($LRN,$first_name, $middle_name, $last_name, $course,$Section, $year_level, $date_ofbirth, $gender, $complete_address, $email_address, $mobile_number, $username, $password, $account_status, $student_id){
			$sql = "UPDATE `tbl_student` SET   `studentID_no` = ?,`first_name` = ?, `middle_name` = ?, `last_name` = ?, `course` = ?, `Section` = ?, `year_level` = ?, `date_ofbirth` = ?, `gender` = ?, `complete_address` = ?, `email_address` = ?, `mobile_number` = ?, `username` = ?, `password` = ?, `account_status` = ? WHERE student_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssssssssssssssi",$LRN,$first_name, $middle_name, $last_name, $course,$Section, $year_level, $date_ofbirth, $gender, $complete_address, $email_address, $mobile_number, $username, $password, $account_status, $student_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function edit_subjects($Subject_name,$Sub_Descriptions,$units, $Subject_code, $Subject_strand, $Subj_id) {
			$sql = "UPDATE `sub` SET `Subject_name` = ?, `Sub_des` = ?, `units` = ?, `Subject_code` = ?, `Subject_strand` = ? WHERE `Subj_id` = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssssi", $Subject_name,$Sub_Descriptions,$units, $Subject_code, $Subject_strand, $Subj_id);
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
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

		public function edit_club($club_name,$club_code,$club_adviser,$club_id) {
			$sql = "UPDATE `club` SET `club_name` = ?, `club_code` = ?, `club_adviser` = ? WHERE `club_id` = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssi", $club_name,$club_code,$club_adviser,$club_id);
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

		public function edit_schedule($Units,$Day,$Subject,$Hours,$Semester,$Section,$Room,$sched_id) {
			$sql = "UPDATE `schedule` SET `Units` = ?, `Day` = ?, `Subject` = ?, `Hours` = ?, `Sem` = ?, `Section` = ? , `Room` = ? WHERE `sched_id` = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssssssi",$Units,$Day,$Subject,$Hours,$Semester,$Section,$Room,$sched_id);
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function delete_student($student_id){
				$sql = "DELETE FROM tbl_student WHERE student_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i", $student_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}
			public function delete_subjects($Subj_id){
				$sql = "DELETE FROM `sub` WHERE Subj_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i",$Subj_id);
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

			public function delete_club($club_id){
				$sql = "DELETE FROM club WHERE club_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i",$club_id);
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

			public function delete_schedule($schedule_id) {
				$sql = "DELETE FROM schedule WHERE sched_id = ?";
				$stmt = $this->conn->prepare($sql);
			
				if (!$stmt) {
					// Handle the error (log, throw exception, etc.)
					return false;
				}
				$stmt->bind_param("i", $schedule_id);
				$success = $stmt->execute();
				$stmt->close();
				$this->conn->close();
				return $success;
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
				$imagepath=$_SERVER['DOCUMENT_ROOT']."/Student-Documents-Processing-Management-System/student/".$row['document_name'];
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

			public function fetchAll_Activedate() { 
				// Corrected SQL query without quotes around the column name
				$sql = "SELECT * FROM tbl_date WHERE Status = 1"; 
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result(); 
			
				$output = '';
			
				// Check if there are results
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						// Append each active date to the output string
						$output .= $row['Date_id'] ; // Added a line break for better readability
					}
				} else {
					$output = "No active dates found."; // Message if no active dates exist
				}
				
				return $output; // Return the formatted string
			}
			
			

	

		public function delete_request($request_id){
				$sql = "DELETE FROM tbl_documentrequest WHERE request_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i",$request_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

    public function fetchAll_payment(){ 
    $sql = "SELECT *,
            CONCAT(tbl_student.first_name, ', ' ,tbl_student.middle_name, ' ' ,tbl_student.last_name) as student_name 
            FROM tbl_payment 
            INNER JOIN tbl_student ON tbl_student.student_id = tbl_payment.student_id 
            GROUP BY tbl_payment.control_no
            ORDER BY tbl_payment.student_id DESC";

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
				$stmt->bind_param("i",$payment_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

			public function add_user($CODE,$complete_name, $designation, $email_address, $phone_number, $username, $password, $status, $Strand,$Role){
				$stmt = $this->conn->prepare("INSERT INTO `tbl_usermanagement` (`CODE`,`complete_name`, `desgination`, `email_address`, `phone_number`, `username`, `password`, `status`, `STRAND`,`role`) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?,?)") or die($this->conn->error);
				$stmt->bind_param("ssssssssss",$CODE,$complete_name, $designation, $email_address, $phone_number, $username, $password, $status, $Strand,$Role);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

			public function fetchAll_Facultybyexaminer($sec){ 
				$sql = "SELECT * FROM  tbl_usermanagement WHERE `Section` = ?";
					$stmt = $this->conn->prepare($sql);
					$stmt->bind_param("s", $sec); 
					$stmt->execute();
					$result = $stmt->get_result();
					$fetch = $result->fetch_array();
					return array(
					'complete_name' => $fetch['complete_name'],
					);	
			  }

			  public function fetchAll_chedbysec($Sec){ 
				$sql = "SELECT * FROM  schedule WHERE `Section` = ?";
					$stmt = $this->conn->prepare($sql);
					$stmt->bind_param("s", $Sec); 
					$stmt->execute();
					$result = $stmt->get_result();
					$data = array();
					while ($row = $result->fetch_assoc()) {
						$data[] = $row;
				 }
			  return $data;
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

	      public function edit_user($complete_name, $desgination, $email_address, $phone_number, $username, $password, $status,$Sectionz,$STRAND,$Role, $user_id){
			$sql = "UPDATE `tbl_usermanagement` SET  `complete_name` = ?, `desgination` = ?, `email_address` = ?, `phone_number` = ?, `username` = ?, `password` = ?, `status` = ?, `Section` = ?, `STRAND` = ?, `role` = ? WHERE user_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("ssssssssssi", $complete_name, $desgination, $email_address, $phone_number, $username, $password, $status,$Sectionz,$STRAND,$Role, $user_id);
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

	    public function count_numberoftotalrequest(){ 
            $sql = "SELECT COUNT(request_id) as count_request FROM tbl_documentrequest";
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

		 public function count_numberoftotalreceived(){ 
            $sql = "SELECT COUNT(request_id) as count_received FROM tbl_documentrequest WHERE status = 'Received'";
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

		public function user_profile($user_id){
    $stmt = $this->conn->prepare("SELECT * FROM `tbl_usermanagement` WHERE `user_id` = ?") or die($this->conn->error);
    $stmt->bind_param("i", $user_id);
    
    if($stmt->execute()){
        $result = $stmt->get_result();
        $fetch = $result->fetch_array();
        return array(
            'user_id' => $fetch['user_id'],
            'complete_name' => $fetch['complete_name'], // Remove extra space
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

public function count_numberofstudentbyTVL() {
	$sql = "SELECT COUNT(student_id) as count_students 
	FROM tbl_student 
	WHERE account_status = 'Active' AND Graduate = '' 
	AND (course = 'TVL-Sports' OR course = 'TVL-HE' OR course = 'TVL-ICT' OR course = 'AFA')
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