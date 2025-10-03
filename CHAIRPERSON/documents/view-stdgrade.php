       <?php include('main_header/header.php');?>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
         <?php include('left_sidebar/sidebar.php');?>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
            <style>
        /* Custom styles for Grade Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    
        
        @media print {
            body * {
                visibility: hidden;
                flex: glow 1;
            flex: basis 200;
            }
            #gradeTable, #gradeTable * {
                visibility: visible;
            flex: glow 1;
            flex: basis 200;
            }

            #gradeTable {
                position: absolute;
                left: 0;
                top: 0;
                flex: glow 1;
            flex: basis 200;
            }
        }
    </style>
               <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                             <h2 class="pageheader-title"><i class="fa fa-fw fa-user-graduate"></i>  Edit Student </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Student</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
            <!-- metric -->
            <div class="col-xl-12 cl-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="calendar-container chart-container">
                            <h3>Adjustable Calendar</h3>
                            <div id="calendar"></div> <!-- Calendar container -->
                        </div>  
                    </div>
                </div>
            </div>
            <!-- /. metric -->
        </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                    <?php 
                    include '../init/model/config/connection2.php';
                    
                   
                    $connz = new class_model();
                   
                    $GET_studid = intval($_GET['student']);
                    $student_number = $_GET['student-number'];
                    $sql = "SELECT * FROM `tbl_student` WHERE `student_id`= ? AND studentID_no = ?";
                    $stmt = $conn->prepare($sql); 
                    $stmt->bind_param("is", $GET_studid, $student_number);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {

                     $first_name = $row['first_name'];
                     $middle_name = $row['middle_name'];
                     $last_name = $row['last_name'];
                     $courses = $row['course'];
                     $year_level = $row['year_level'];
                     $date_ofbirth = strftime('%Y-%m-%d', strtotime($row['date_ofbirth']));
                     $gender = $row['gender'];
                     $complete_address = $row['complete_address'];
                     $email_address = $row['email_address'];
                     $mobile_number = $row['mobile_number'];
                     $username = $row['username'];
                     $password = $row['password'];
                     $section = $row['Section'];
                     $account_status = $row['account_status']; 
                     $Graduate = $row['Graduate']; 
                     $student_id = $row['student_id'];  
                     $LRN= $row['studentID_no'];
                     $conn = new class_model();
                     $grades = $conn->viewAll_Grades($LRN);
                     
                    }
                    $id = $connz->get_attendance_by_student($student_id);
                   ?>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card influencer-profile-data">
                                        <div class="card-body">
                                        <div class="row">
            <!-- metric -->
           
        
                                        </div>
                                    </div>
                             </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          var firstName = $('#firstName').text();
          var lastName = $('#lastName').text();
          var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
          var profileImage = $('#profileImage').text(intials);
        });
    </script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [
            <?php 
                // Check if $id is an array and contains data
                if (is_array($id) && !empty($id)) {
                    $number = 1;
                    foreach ($id as $ids) {
                        // Ensure the 'Date' field is not empty
                        if (!empty($ids['Date'])) { 
            ?>
                            ,{ 
                                title: 'Present Day(s) <?php echo $number; ?>', 
                                start: '<?php echo $ids['Date']; ?>', 
                                color: '#28a745'
                            }<?php if ($number < count($id)) echo ','; // Add comma except for the last item ?>  
            <?php 
                            $number++; 
                        }
                    }
                } else {
                    // Handle case when $id is empty or not an array
                    echo "console.error('No attendance data available');";
                }
            ?>
        ],
        dateDidMount: function(info) {
            // Highlight Saturdays
            if (info.date.getDay() === 6) {
                info.el.classList.add('saturday');
            }
        }
    });
    calendar.render();
});  </script>
<style>
    /* Basic styling for the calendar */
    .calendar-container {
        padding: 10px;
    }
    #calendar {
        max-width: 100%;
    
    }
    .saturday {
        background-color: #f0f0f0; /* Highlight for Saturdays */
    }
    .fc-daygrid-event {
    width: 100% !important;    /* Full width of the cell */
    height: 100% !important;   /* Full height of the cell */
    padding: 0;                /* Remove internal padding */
    margin: 0;                 /* Remove margin between cells */
    border: none;              /* Remove border for seamless appearance */
    background-color: #28a745; /* Customize the color as needed */
    color: white;              /* Event text color */
    display: flex;             /* Center the text */
    align-items: center;       /* Center vertically */
    justify-content: center;   /* Center horizontally */
    font-weight: bold;         /* Make the text stand out */
}   
</style>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/parsley/parsley.js"></script>
    <script src="../assets/libs/js/main-js.js"></script>
   
     <script type="text/javascript">
        $(document).ready(function(){
          var firstName = $('#firstName').text();
          var lastName = $('#lastName').text();
          var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
          var profileImage = $('#profileImage').text(intials);
        });
    </script>
    
</body>
 
</html>