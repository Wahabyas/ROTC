<?php
session_start();
include '../model/class_model.php';
include '../model/config/connection2.php';
$student_id = $_SESSION['student_id'];
$coond = new class_model();
$student = $coond->student_profile($student_id);
$stdname = $student['first_name'];
$stdmid = $student['middle_name'];
$stdlast = $student['last_name'];
$LRN = $student['studentID_no'];
if(isset($_POST['view'])){
    if($_POST["view"] != ''){
        $stmt = $conn->prepare("UPDATE problem SET `notif` = 1 WHERE `notif`= '".$stdname.' '.$stdmid.' '.$stdlast."'");
        $stmt->execute();
        $stmt->close();
    }
    $stmt = $conn->prepare('SELECT * FROM problem ORDER BY Prob_ID DESC LIMIT 10000000');
    $stmt->execute();
    $result = $stmt->get_result();
    $output = '';
    if($result->num_rows > 0){
        $output .= '<div id="notificationContainer" style="max-height: 300px; overflow-y: auto;">';
        $output .= '<ul id="notificationList" style="list-style: none; padding: 0;">';
        while ($row = $result->fetch_assoc()) {
        if($row['Stdname'] === $stdname.' '.$stdmid.' '.$stdlast){
            $output .= '
                <li style="background-color:#23b294;width:100%">
                    <a class="nav-item href="Problemdetails.php" style="margin-left:10px;">
                        <b><a  href="Problemdetails.php"><i class="fa fa-fw fa-file"></i>Your Lacking:<b style="color:#8B0000;"> '.$row["Lackings"].'</b></b></a>
                        <p style="margin-left:14px;font-size:15px"><i class=""></i> From Your Teacher: <i style="color:black;">'.$row["Officers"].'<br>('.$row["Subject"].')'.'</i></p>
                        <p style="margin-left:14px;font-size:11px"><i class="fa fa-calendar"></i> Deadline: <i>'.$row["Submitdate"].'</i></p>
                        <p style ="border-bottom:1px dotted green;width:100%;"></p>
                    </a>
                </li>';
        } else {
           ;
        }
        }
        $output .= '<li><i style="color:black;" href="#" class="text-bold text-italic">Nothing follows</i></li>';
    } else {
    }
    $stmt = $conn->prepare("SELECT * FROM problem WHERE `notif`= '".$stdname.' '.$stdmid.' '.$stdlast."'");
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->num_rows;
    $stmt->close();

    $data = array(
        'notification' => $output,
        'unseen_notification'  => $count
    );

    echo json_encode($data);
}
?>
