<?php include('main_header/header.php'); ?>
<!-- ============================================================== -->
<!-- end navbar -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- left sidebar -->
<!-- ============================================================== -->
<?php include('left_sidebar/sidebar.php'); ?>
<!-- ============================================================== -->
<!-- end left sidebar -->
<!-- ============================================================== -->
<!-- wrapper  -->
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <style>
        .saturday {
            background-color: #28a745 !important; /* Green background */
            color: white !important; /* Change text color for contrast */
        }
    </style>
    <div class="container-fluid dashboard-content">
        <?php 
            $student_id = $_SESSION['student_id'];
            $conn = new class_model();
            $user = $conn->student_profile($student_id);
            $id = $conn->get_attendance_by_student($student_id);
            $number = 1;
          
        ?>
        
        <!-- page header -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title"><i class="fa fa-fw fa-tachometer-alt"></i> Dashboard</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Home</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page header -->
        
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
        <div class="card">
                                <h5 class="card-header">Attendance</h5>
                                <div class="card-body">
                                    <div id="message"></div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                <th scope="col">number.</th>
                                                    <th scope="col">Date.</th>
                                                    <th scope="col">Status</th>                                       
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php  foreach ($id as $ids) { ?>
                                                <tr>
                                           <td> <?php echo $ids['attendance_id']; ?> </td>

                                           <td> <?php echo $ids['Date']; ?> </td>
                                           <td> <?php echo $ids['status']; ?> </td>

                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
    </div>
</div>
<!-- end wrapper -->

<!-- Optional JavaScript -->

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/custom-js/jquery.multi-select.html"></script>
    <script src="../assets/libs/js/main-js.js"></script>
    <script src="../assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="../assets/vendor/datatables/js/data-table.js"></script>
<!-- jQuery 3.3.1 -->
<script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>

<!-- Chart.js -->
<script src="../assets/vendor/charts/charts-bundle/Chart.bundle.js"></script>
<script src="../assets/vendor/charts/charts-bundle/chartjs.js"></script>
<!-- FullCalendar (ensure the CSS and JS for FullCalendar are included) -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<!-- main.js -->
<script src="../assets/libs/js/main-js.js"></script>
<!-- dashboard sales js -->
<script src="../assets/libs/js/dashboard-sales.js"></script>
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
                            { 
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
});

     
    // Notification load functions
    function load_unseen_notification_1(view = '') {
        $.ajax({
            url: "../init/controllers/fetch.php",
            method: "POST",
            data: {view: view},
            dataType: "json",
            success: function(data) {
                $('.dropdown-menu_1').html(data.notification);
                if(data.unseen_notification > 0) {
                    $('.count_1').html(data.unseen_notification);
                }
            }
        });
    }

    load_unseen_notification_1();
    $(document).on('click', '.dropdown-toggle1', function() {
        $('.count_1').html('');
        load_unseen_notification_1('yes');
    });
    setInterval(function() { 
        load_unseen_notification_1(); 
    }, 4000);

    function load_unseen_notification_2(view = '') {
        $.ajax({
            url: "../init/controllers/fetchprob.php",
            method: "POST",
            data: {view: view},
            dataType: "json",
            success: function(data) {
                $('.dropdown-menu_2').html(data.notification);
                if(data.unseen_notification > 0) {
                    $('.count_2').html(data.unseen_notification);
                }
            }
        });
    }

    load_unseen_notification_2();
    $(document).on('click', '.dropdown-toggle2', function() {
        $('.count_2').html('');
        load_unseen_notification_2('yes');
    });
    setInterval(function() { 
        load_unseen_notification_2(); 
    }, 5000);

</script>

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

</body>
</html>
