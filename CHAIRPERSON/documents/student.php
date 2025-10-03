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
        <style>/* Custom success styles */
.alert-custom-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

/* Custom success text color */
.alert-custom-success .alert-heading {
    color: #0c5460;
}
</style>
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                             <h2 class="pageheader-title"><i class="fa fa-fw fa-user-graduate"></i> Student </h2>
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
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
               
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Student Information</h5>
                                <div class="card-body">
                                <div class="form-group row">
                                              
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                      
                                                    </div>
                                                </div>
                                     <div id="message"></div>
                                    <div class="table-responsive">
                                        <a href="add-student.php" class="btn btn-sm" style="background-color:rgb(235, 151, 42) !important;
                                        color: rgb(243, 245, 238) !important;"><i class="fa fa-fw fa-user-plus"></i> Add Student</a><br><br>
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">ID No.</th>
                                                    <th scope="col">Complete Name</th>
                                                    <th scope="col">Course</th>
                                                    <th scope="col">Section</th>
                                                    <th scope="col">Year</th>
                                                    <th scope="col">Contact</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Date Creation</th>
                                                    <th scope="col">Graduate Status</th>
                                                    <th scope="col">Account</th>
                                                    <th scope="col">QrCode</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php 
                                             $count=1; require_once 'phpqrcode/qrlib.php';
                                                $conn = new class_model();
                                                $student = $conn->fetchAll_student();
                                                $userStrand=$conn->user_account($user_id);
                                                $strandValue = $userStrand['STRAND'];
                                                $LRN=null;
                                               ?>
                                               <?php foreach ($student as $row) { ?>
                                                <?php if( $row['Graduate'] !== 'Graduated' ) {?>
                                                <tr>
                                                <td><?= $count++; ?></td>
                                                  <div hidden><?=  $LRN=$row['studentID_no']; ?></div>
                                                    <td><?= $row['studentID_no']; ?></td>
                                                    <td><?= $row['first_name'] .' '. $row['middle_name'].' '.$row['last_name']; ?></td>
                                                    <td><?= $row['course']; ?></td>
                                                    <td><?= $row['Section']; ?></td>
                                                    <td><?= $row['year_level']; ?></td>
                                                    <td><?= $row['mobile_number']; ?></td>
                                                    <td><?= $row['email_address']; ?></td>
                                                    <td><?= $row['date_created']; ?></td>
                                                    <td>
                                                     <?php 
                                                      if (strpos($row['Graduate'], 'Graduated') !== false) {
                                                        // Extracting the graduation year from the "Graduated" status
                                                        preg_match('/\d{4}/', $row['Graduate'], $matches);
                                                        $graduationYear = $matches[0];
                                                
                                                        // Constructing the year range
                                                        $yearRange = ($graduationYear) . '-' . ($graduationYear +1);?>
                                                        <?php echo '<span class="badge bg-success text-white">Graduated ' . $yearRange . '</span>';?>
                                                       <?php  }else if($row['Graduate'] === ''){
                                                         echo '<span class="badge bg-danger text-white">Not yet</span>';
                                                       }
                                                      ?>
                                                    </td>
                                                    <td>
                                                     <?php 
                                                      if($row['account_status'] === 'Active'){
                                                         echo '<span class="badge bg-success text-white">Active</span>';
                                                         }else if($row['account_status'] === 'Inactive'){
                                                         echo '<span class="badge bg-danger text-white">Inactive</span>';
                                                       }
                                                      ?>
                                                    </td>
                                                    <td>
                                                        <?php

                                                        if (isset($LRN) && !empty($LRN)) {
                                                         $qrCodePath = "images/$LRN.png"; // Adjusted path to save QR code image
                                                         QRcode::png($LRN, $qrCodePath, QR_ECLEVEL_L, 4); // Generate QR code
                                                         echo "<div  class='alert alert-custom-success'>QR Code is successfully loaded <img src='$qrCodePath' style='width:100px;' ></div>";
                                                        } else {
                                                            echo "<div class='alert alert-danger'>User ID is not set or is empty.</div>";
                                                        }
                                                        ?>
                                                        
                                                    </td>
                                                    <td class="align-right">
                                                        <a href="edit-student.php?student=<?= $row['student_id']; ?>&student-number=<?php echo $row['studentID_no']; ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                          <i class="fa fa-edit"></i>
                                                        </a> |  <input type="checkbox" class="select-checkbox" data-student-id="<?= $row['student_id']; ?>"> |<a href="view-stdgrade.php?student=<?= $row['student_id']; ?>&student-number=<?php echo $row['studentID_no']; ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                          <i class="fa fa-eye"></i>
                                                        </a>|
                                                        <a href="javascript:;" data-id="<?= $row['student_id']; ?>" class="text-secondary font-weight-bold text-xs delete" data-toggle="tooltip" data-original-title="Edit user">
                                                          <i class="fa fa-trash-alt"> </i>
                                                        </a>
                                                      </td>
                                                </tr>
                                                <?php }else{

                                                }?>
                                            <?php }?>
                                        </table>
                                        <button class="btn btn-primary" id="checkAllButton">Select All</button>  <button  class="btn btn-primary" id="updateYearLevel">Update</button>
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
    <script>
$(document).ready(function () {

    load_data();

     var count = 1;

     function load_data() {
         $(document).on('click', '.delete', function () {
                // ... (existing code) ...
         });
     }

        // Handle the update button click
     $('#updateYearLevel').on('click', function () {
         var selectedStudents = [];

            // Get selected student IDs
          $('.select-checkbox:checked').each(function () {
             selectedStudents.push($(this).data('student-id'));
         });

         if (selectedStudents.length === 0) {
             $('#message').html('<div class="alert alert-danger" role="alert">Please select at least on Drop DOWN Settings.</div>');
            return;
         }

            var newYearLevel = $('#Section').val();

            if (!newYearLevel) {
                $('#message').html('<div class="alert alert-danger" role="alert">Please take an action.</div>');
                return;
            }

            // Perform the update operation using AJAX
            $.ajax({
                url: "../init/controllers/Mass_section.php",
                method: "POST",
                data: {
                    student_ids: selectedStudents,
                    new_year_level: newYearLevel
                },
                success: function (response) {
                    $("#message").html(response);
                    setTimeout(function () {
                location.reload();
            }, 1000);
                },
                error: function (response) {
                    console.log("Failed");
                }
            });
        });
    });
</script>
    <script>
  $(document).ready(function () {
    // Add a click event listener to the "Check All" button
    $('#checkAllButton').on('click', function () {
      // Toggle the state of all checkboxes with the class 'select-checkbox'
      $('.select-checkbox').prop('checked', function(i, currentValue) {
        return !currentValue;
      });
    });
  });
</script>
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

                var student_id = $(this).attr("data-id");
                // console.log("================get course_id================");
                // console.log(course_id);
                if (confirm("Are you sure want to remove this data?")) {
                    $.ajax({
                        url: "../init/controllers/delete_student.php",
                        method: "POST",
                        data: {
                            student_id: student_id
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