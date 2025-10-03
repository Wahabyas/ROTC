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
                             <h2 class="pageheader-title"><i class="fa fa-fw fa-book"></i>  Section Data </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                    <?php 
                    include '../init/model/config/connection2.php';
                    $GET_roomid = intval($_GET['student']);
                    $room_number = $_GET['student-number'];
                    $sql = "SELECT * FROM `room` WHERE `room_id`= ? AND Room_name = ?";
                    $stmt = $conn->prepare($sql); 
                    $stmt->bind_param("is", $GET_roomid, $room_number);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($row = $result->fetch_assoc()) {
                     $Subject_id = $row['room_id'];
                     $Subject_name = $row['Room_name'];
                     $Sec = $row['section'];
                     

                   ?>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" >
                                  
                        <?php 
                                                $conn = new class_model();
                                                $user_id = $_SESSION['user_id'];
                                                $student = $conn->fetchAll_student();
                                                $userz = $conn->fetchAll_user();
                                                $userStrand = $conn->user_account($user_id);
                                                $schedz = $conn->fetchAll_chedbysec($Sec);
                                               ?>
                                        <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <?php foreach($userz as $wow) {?>
                                    <?php if($wow['Section'] === $row['section']) { ?>
                                <h5 class="card-header">Their Adviser is <?=$wow['complete_name'] ?> </h5>
                                <?php }else{

                                } ?>
                                <?php } $Count=1; ?>
                                <div class="card-body">
                                     <div id="message"></div>
                                     <div class="form-group row">
                                    <div class="table-responsive">
                                    
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">ID No.</th>
                                                    <th scope="col">Complete Name</th>
                                                    <th scope="col">Strand</th>
                                                    <th scope="col">Section</th>
                                                    <th scope="col">Year</th>
                                                    <th scope="col">Contact</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Account</th>
                                                 
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                               <?php foreach ($student as $rowr) { ?>
                                                <?php if($rowr['account_status']=== 'Active' &&  $rowr['Graduate'] === '' ) { ?>
                                                    <?php if( $rowr['Section'] ===  $row['section']) { ?>
                                                <tr>
                                                <td><?= $Count++ ?></td>
                                                    <td><?= $rowr['studentID_no']; ?></td>
                                                    <td><?= $rowr['first_name'] .' '. $rowr['middle_name'].' '.$rowr['last_name']; ?></td>
                                                    <td><?= $rowr['course']; ?></td>
                                                    <td><?= $rowr['Section']; ?></td>
                                                    <td><?= $rowr['year_level']; ?></td>
                                                    <td><?= $rowr['mobile_number']; ?></td>
                                                    <td><?= $rowr['email_address']; ?></td>
                                                    <td>
                                                     <?php 
                                                      if($rowr['account_status'] === 'Active'){
                                                         echo '<span class="badge bg-success text-white">Active</span>';
                                                         }else if($rowr['account_status'] === 'Inactive'){
                                                         echo '<span class="badge bg-danger text-white">Inactive</span>';
                                                       }
                                                      ?>
                                                    </td>

                                                  </tr>
                                                  <?php }else{

} ?>
                                                  <?php }else{

                                                  } ?>
                                            <?php }?>
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
                             <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" >
                                  
                                        <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                              
                                   <!-- ============================================================== ANOTHER TABLE FOR SCHEDULE -->
                                
                                <?php $Count=1; ?>
                                <div class="card-body">
                                     <div id="message"></div>
                                     <div class="form-group row">
                                    <div class="table-responsive">
                                    
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Their Teacher.</th>
                                                    <th scope="col">Their Subject</th>
                                                    <th scope="col">Schedule</th>
                                                    <th scope="col">Semester</th>
                                                    <th scope="col">Section</th>
                                                   
                                                 
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                           
                                            <?php foreach($schedz as $rowr) {?>
                                                <tr>
                                                <td><?= $Count++ ?></td>
                                                    <td><?= $rowr['Day']; ?></td>
                                                    <td><?= $rowr['Subject']; ?></td>
                                                    <td><?= $rowr['Hours']; ?></td>
                                                    <td><?= $rowr['Sem']; ?></td>
                                                    <td><?= $rowr['Section']; ?></td>
                                                    
                                                  </tr>
                                            <?php }?>
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
                        </div>
                    </div>
                    <?php } ?>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    
    
   
   
    <script src="../assets/vendor/custom-js/jquery.multi-select.html"></script>
    <script src="../assets/libs/js/main-js.js"></script>
    <script src="../assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="../assets/vendor/datatables/js/data-table.js"></script>

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