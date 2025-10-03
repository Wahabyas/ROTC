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
                        $currentYear = date('Y');

                        $previousYear = $currentYear - 1;
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
                     
                     

                   ?>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" >
                                  
                        <?php 
                                                $conn = new class_model();
                                                $user_id = $_SESSION['user_id'];
                                                $student = $conn->fetchAll_student();
                                                $userz = $conn->fetchAll_user();
                                                $userStrand = $conn->user_account($user_id);
                                               ?>
                                        <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                
                                <?php foreach($userz as $wow) {?>
                                    <?php if($wow['Section'] === $row['section']) { ?>
                                <h5 class="card-header">Their Adviser is <?=$wow['complete_name'] ?> </h5>
                                <?php }else{

                                } ?>
                                <?php } ?>
                                <div class="card-body">
                                         <div style="width: 20%;display:flex;margin-bottom:20px;">
                                               <select  style="padding-left: -20px;" id="new_year_level" required="" placeholder=" " class="form-control">
                                                 <option value="" >Graduation Update</option>
                                                   <option  style="background-color: red;color: #fff" value="">Not yet</option>
                                                   <option style="background-color: green;color: #fff" value="Graduated <?=$previousYear?>-<?=$currentYear?>">Graduate <?=$previousYear?>-<?=$currentYear?></option>
                        
                                               </select>
                                        </div>
                                     <div id="message"></div>
                                     <div class="form-group row">
                                    <div class="table-responsive">
                                    
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
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
                                                      ?> |
                                                       <input type="checkbox" class="select-checkbox" data-student-id="<?= $rowr['student_id']; ?>">
                                                    </td>

                                                  </tr>
                                                  <?php }else{

} ?>
                                                  <?php }else{

                                                  } ?>
                                            <?php }?>
                                        </table>
                                        <span> <button  class="btn btn-primary" id="updateYearLevel">Update</button>  <button class="btn btn-primary" id="checkAllButton">Select All</button></span>
                                        <?php } ?>
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
           
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/parsley/parsley.js"></script>
    
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
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
             $('#message').html('<div class="alert alert-danger" role="alert">Please select at least one student.</div>');
            return;
         }

            var newYearLevel = $('#new_year_level').val();

            if (!newYearLevel) {
                $('#message').html('<div class="alert alert-danger" role="alert">Please select Graduate.</div>');
                return;
            }

            // Perform the update operation using AJAX
            $.ajax({
                url: "../init/controllers/update_student.php",
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
     <script type="text/javascript">
        $(document).ready(function(){
          var firstName = $('#firstName').text();
          var lastName = $('#lastName').text();
          var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
          var profileImage = $('#profileImage').text(intials);
        });
    </script>
    <script>
    $('#form').parsley();
    </script>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>
    <script>
    $('form[name="student_form"]').on('submit', function(e) {
    e.preventDefault();

    var a = $(this).find('input[name="section"]').val();
    var b = $(this).find('input[name="section_code"]').val();
    var c = $(this).find('input[name="room_name"]').val();
    const d = document.querySelector('input[name=room_id]').value;

    $.ajax({
        url: '../init/controllers/edit_room.php',
        method: 'post',
        data: {
            section: a,
            section_code: b,
            room_name: c,
            room_id: d
        },
        success: function(response) {
            $("#message").html(response);
            window.scrollTo(0, 0);
        },
        error: function(response) {
            console.log("Failed");
        }
    });
});

         
      
 </script>
</body>
 
</html>