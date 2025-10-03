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
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                             <h2 class="pageheader-title"><i class="fa fa-fw fa-check-square"></i> My Schedule </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Document</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
               
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Document  Information</h5>
                                <div class="card-body">
                                     <div id="message"></div>
                                    <div class="table-responsive">
                                      
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Units</th>
                                                    <th scope="col">Your Subject</th>
                                                    <th scope="col">Your teacher</th>
                                                    <th scope="col">Schedule</th>
                                                    <th scope="col">Your Semester</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $student_id = $_SESSION['student_id'];
                                                $conn = new class_model();
                                                $Student = $conn->student_account($student_id);
                                                $schedule = $conn->fetchAll_schedule();
                                                $StudentSection = $Student['Section'];
                                                
                                               ?>
                                               <?php foreach ($schedule as $row) { ?>
                                                <?php if($row['Section'] === $StudentSection ){ ?>
                                                <tr>
                                                    <td><?= $row['Units']; ?></td>
                                                    <td><?= $row['Subject']; ?></td>
                                                    <td><?= $row['Day']; ?></td>
                                                    <td><?= $row['Hours']; ?></td>
                                                    <td><?= $row['Sem']; ?></td>
                                                    <?php }?>
                                                </tr>
                                             <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end responsive table -->
                        <!-- ============================================================== -->
                    </div>
               
            </div>
            
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/custom-js/jquery.multi-select.html"></script>
    <script src="../assets/libs/js/main-js.js"></script>
    <script src="../assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="../assets/vendor/datatables/js/data-table.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          var firstName = $('#firstName').text();
          var lastName = $('#lastName').text();
          var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
          var profileImage = $('#profileImage').text(intials);
        });
    </script>
    <script>
    $(document).ready(function() {

        load_data();

        var count = 1;

        function load_data() {
            $(document).on('click', '.delete', function() {

                var document_id = $(this).attr("data-id");
                // console.log("================get course_id================");
                // console.log(course_id);
                if (confirm("Are you sure want to remove this data?")) {
                    $.ajax({
                        url: "../init/controllers/delete_document.php",
                        method: "POST",
                        data: {
                            document_id: document_id
                        },
                      success: function(response) {

                          $("#message").html(response);
                          },
                          error: function(response) {
                            console.log("Failed");
                          }
                    })
                }
            });
        }

    });
</script>
<script>
$(document).ready(function(){
 
 function load_unseen_notification_1(view = '')
 {
  $.ajax({
   url:"../init/controllers/fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
     $('.dropdown-menu_1').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count_1').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification_1();

 $(document).on('click', '.dropdown-toggle1', function(){
  $('.count_1').html('');
  load_unseen_notification_1('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification_1(); 
 }, 4000);
 
});
</script>

<script>
$(document).ready(function(){
 
 function load_unseen_notification_2(view = '')
 {
  $.ajax({
   url:"../init/controllers/fetchprob.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
     $('.dropdown-menu_2').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count_2').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification_2();

 $(document).on('click', '.dropdown-toggle2', function(){
  $('.count_2').html('');
  load_unseen_notification_2('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification_2(); 
 }, 5000);
 
});
</script>
</body>
 
</html>