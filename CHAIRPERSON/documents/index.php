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
                <!-- pagehader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                             <h2 class="pageheader-title"><i class="fa fa-fw fa-tachometer-alt"></i> Dashboard </h2><div class="page-breadcrumb">
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
                <!-- ============================================================== -->
                <!-- pagehader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- metric -->

                               <?php 
                                    $conn = new class_model();
                                    $cstudent = $conn->count_numberofstudents();
                                    $profile=$conn->user_profile($user_id);
                                    $Strand = $profile['desgination'];
                                    $Fullname = $profile['complete_name'];
                                 
                                    $countStdbyDEACTIVATE=$conn->count_numberofstudentbyDEACTIVATED();
                                   
                            ?>
                            
                   
                    <!-- /. metric -->
                    <!-- metric -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                              <?php 
                                    $conn = new class_model();
                                    $cstudent = $conn->count_numberoftotalreceived();
                               ?>
                               <?php foreach ($cstudent as $row): ?>
                                <div class="d-inline-block">
                                    <h5 class="text-muted">NAME OF OFFICER</h5>
                                    <h2 class="mb-0"><?= $Fullname ?></h2>
                                </div>
                                <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                                    <i class="fa fa-check fa-fw fa-sm text-info"></i>
                                </div>
                                 <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                 
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                              <?php 
                                    $conn = new class_model();
                                    $cstudent = $conn->count_numberoftotalrequest();
                               ?>
                               <?php foreach ($cstudent as $row): ?>
                                <div class="d-inline-block">
                                    <h5 class="text-muted">PLATOON</h5>
                                    <h2 class="mb-0"><?= $Strand ?></h2>
                                </div>
                                <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                                <i class="fas fa-book-open fa-3x text-success"></i>
                                </div>
                                 <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                    <!-- /. metric -->
                    <!-- metric -->
              
                  
                  
             
                    <!-- /. metric -->
                    <!-- metric -->
                 
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mx-auto">
    <div style="background-color: white; border-radius: 4em; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);" class="text-center">
        <div class="card-body">
        <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                <!-- Change the icon to a megaphone -->
                <i class="fa fa-envelope fa-fw fa-sm text-info"></i>
            </div>
            <?php
                $user_id = $_SESSION['user_id'];
                $studentid = $conn->user_profile($user_id);
                $role = $studentid['role'];
                $Announcement = $conn->fetchAll_Announcement();
                $nothing = "Empty Massage";
            ?>
            <div class="d-inline-block">
                <?php foreach ($Announcement as $row) : ?>
                    <?php if($row['Announcement_to']===$role || $row['Announcement_to'] ==='ALL' || $row['Announcement_to'] === 'EMPLOYEES' ){ ?>
                        <h5 class="text-muted"><?=$row['Announcement_title'] ?></h5>
                        <h4>From : <?=$row['Announcement_from'] ?></h4>
                        <h3 class="mb-0"><?=$row['Announcement_desc'] ?></h3>
                    <?php }else{
                          
                    } ?>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>

                    <!-- /. metric -->
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>

    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 js-->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstrap bundle js-->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- chartjs js-->
    <script src="../assets/vendor/charts/charts-bundle/Chart.bundle.js"></script>
    <script src="../assets/vendor/charts/charts-bundle/chartjs.js"></script>
   
    <!-- main js-->
    <script src="../assets/libs/js/main-js.js"></script>
     <!-- dashboard sales js-->
    <script src="../assets/libs/js/dashboard-sales.js"></script>
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