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
                             <h2 class="pageheader-title"><i class="fas fa-calendar mr-2"></i> Date </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Date</li>
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
                                <h5 class="card-header" >Date Information</h5>
                                <div class="card-body">
                                     <div id="message"></div>
                                    <div class="table-responsive">
                                        <a href="add-AcademicYear.php" class="btn btn-sm" style="background-color:rgb(235, 151, 42) !important;
                                        color: rgb(243, 245, 238) !important;"><i class="fas fa-chart-line mr-2" data-toggle="tooltip" data-original-title="Edit Academic-Year"></i> Add Date</a>  <br><br>
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Date</th>
                                                 
                                                  
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php 
                                                $conn = new class_model();
                                                $Announcement = $conn->fetchAll_Date();
                                                $count=1;
                                               ?>
                                               <?php foreach ($Announcement as $row) { ?>
                                                <tr>
                                                    <td><?= $count++; ?></td>
                                                    <td><?= $row['Date']; ?></td>
                                                    
                                                    <td>
                                                     <?php 
                                                      if($row['Status'] === 1){
                                                         echo '<span class="badge bg-success text-white">Active</span>';
                                                         }else if($row['Status'] === 0){
                                                         echo '<span class="badge bg-danger text-white">Inactive</span>';
                                                       }
                                                      ?>
                                                    </td>
                                                   
                                                    <td class="align-right">
                                                      
                                                        <a href="javascript:;" data-id="<?= $row['Date_id']; ?>" class="text-secondary font-weight-bold text-xs delete" data-toggle="tooltip" data-original-title="Delete Academic-Year">
                                                          <i class="fa fa-trash-alt"></i>  </a> 
                                                        </a> 
                                                        </a>
                                                      </td>
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

                var Academic_id = $(this).attr("data-id");
                // console.log("================get course_id================");
                // console.log(course_id);
                if (confirm("Are you sure want to remove this data?")) {
                    $.ajax({
                        url: "../init/controllers/delete_academicyear.php",
                        method: "POST",
                        data: {
                            Academic_id:Academic_id
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

</body>
 
</html>