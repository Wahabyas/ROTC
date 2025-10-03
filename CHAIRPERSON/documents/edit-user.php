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
                             <h2 class="pageheader-title"><i class="fa fa-fw fa-eye"></i> View Teaching Load </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">View</li>
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
                    $GET_uid = intval($_GET['user']);
                    $student_number = $_GET['full-name'];
                    $sql = "SELECT * FROM `tbl_usermanagement` WHERE `user_id`= ? AND complete_name = ?";
                    $stmt = $conn->prepare($sql); 
                    $stmt->bind_param("is", $GET_uid, $student_number);
                    $stmt->execute();
                    $conz = new class_model();
                    $getAllcourse =$conz->fetchAll_course();
                    $Allsection = $conz->fetchAll_room();
                    $result = $stmt->get_result();
                    $day = $conz->fetchALL_sched($student_number);
                    if ($row = $result->fetch_assoc()) {
                   ?>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" >
                                    <div class="card influencer-profile-data">
                                        <div class="card-body" >
                                            <div class="" id="message"></div>
                                            <form id="validationform" name="user_form" data-parsley-validate="" novalidate="" method="POST" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fa fa-user"></i> User Info</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Complete Name</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" value="<?= $row['complete_name']; ?>" name="complete_name2" required="" placeholder="" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Designation</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" value="<?= $row['desgination']; ?>" name="desgination2" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">ROLE</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <select data-parsley-type="alphanum" type="text" name="Role2" required="" placeholder="" class="form-control" readonly>
                                                        <option value="<?=$row['role']?>"> <?=$row['role']?> </option>    
                                                           
                                                       </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Strand</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <select data-parsley-type="alphanum" type="text" value="<?= $row['STRAND']; ?>" name="STRAND2" required="" placeholder="" class="form-control">
                                                            <option value="<?= $row['STRAND']; ?>"><?= $row['STRAND']; ?></option>    
                                                        <?php foreach ($getAllcourse as $rowj) { ?>
                                                            <?php if($rowj['course_name'] !== 'TVL-ICT' && $rowj['course_name'] !== 'TVL-HE' && $rowj['course_name']!== 'TVL-Sports'  && $rowj['course_name']!== 'AFA'){ ?>
                                                           <option value="<?= $rowj['course_name']; ?>"><?= $rowj['course_name']; ?></option>
                                                           <?php }else{
                                                                
                                                            } ?>
                                                       <?php } ?> 
                                                       </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Section</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <select data-parsley-type="alphanum" type="text" value="<?= $row['STRAND']; ?>" name="Sectionz" required="" placeholder="" class="form-control">
                                                            <option value="<?= $row['Section']; ?>"><?= $row['Section']; ?></option>    
                                                        <?php foreach ($Allsection as $rows) { ?>
                                                           <option value="<?= $rows['section']; ?>"><?= $rows['section']; ?></option>
                                                       <?php } ?> 
                                                       <option value="">Null</option>
                                                       </select>
                                                    </div>
                                                </div>
                                             <div class="form-group row"> 
                                                <label  class="col-12 col-sm-3 col-form-label text-sm-right">Email</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="email" value="<?= $row['email_address']; ?>" name="email_address2" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Phone No.</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" value="<?= $row['phone_number']; ?>" minlength="11" maxlength="11" name="phone_number2" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fa fa-user-lock"></i> Account Info</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Username</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" value="<?= $row['username']; ?>" name="username2" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Password</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" value="<?= $row['password']; ?>" type="text" name="password2" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                 <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Status</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                       <select data-parsley-type="alphanum" type="text" value="<?= $row['status']; ?>" id="status2" required="" placeholder="" class="form-control">
                                                           <option value="<?= $row['status']; ?>" hidden><?= $row['status']; ?></option>
                                                           <option value="Active" style="background-color: green;color: #fff">Active</option>
                                                           <option value="Inactive" style="background-color: red;color: #fff">Inactive</option>
                                                       </select>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-group row text-right">
                                                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                                        <input name="user_id2" value="<?= $row['user_id']; ?>" type="hidden">
                                                        <button class="btn btn-space btn-primary" id="edit-user">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                 <?php } ?>
                            </div>
                            <div class="card">
                                <h5 class="card-header">Teaching Load Information</h5>
                                <div class="card-body">
                                     <div id="message"></div>
                                     <div class="form-group row">
                                    <div class="table-responsive">
                                    
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Teacher's name</th>
                                                    <th scope="col">Subject</th>
                                                    <th scope="col">Units</th>
                                                    <th scope="col">Schedule</th>
                                                    <th scope="col">Semester</th>
                                                    <th scope="col">Section</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($day  as $row){ ?>
                                                <tr>
                                              
                                                    <td><?= $row['Day']; ?></td>
                                                    <td><?= $row['Subject']; ?></td>
                                                    <td><?= $row['Units']; ?></td>
                                                    <td><?= $row['Hours']; ?></td>
                                                    <td><?= $row['Sem']; ?></td>
                                                    <td><?= $row['Section']; ?></td>
                                                    <td class="align-right">
                                                         <input type="checkbox" class="select-checkbox" data-student-id="<?= $row['sched_id']; ?>">
                                                        </td>
                                                   <?php } ?>
                                               </tr>
                                        </table>
                                    </div>
                                </div>
                                <button class="btn btn-primary" id="checkAllButton">Select All</button>  <button class="btn btn-danger" id="deleteSelectedButton">Delete Selected</button>
                            </div>
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
    // Add a click event listener to the "Check All" button
  

    // Add a click event listener to the "Delete Selected" button
    $('#deleteSelectedButton').on('click', function () {
        var selectedStudents = [];

        // Get selected student IDs
        $('.select-checkbox:checked').each(function () {
            selectedStudents.push($(this).data('student-id'));
        });

        if (selectedStudents.length === 0) {
            $('#message').html('<div class="alert alert-danger" role="alert">Please select at least one Teaching load to delete.</div>');
            return;
        }

        if (confirm("Are you sure you want to delete the selected Teaching Loads?")) {
            // Perform the delete operation using AJAX
            $.ajax({
                url: "../init/controllers/Mass_delete.php", // Update the URL to your delete script
                method: "POST",
                data: {
                    student_ids: selectedStudents
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
        }
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
                    setTimeout(function () {
                location.reload();
            }, 1000);
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
        document.addEventListener('DOMContentLoaded', function () {
            let btn = document.querySelector('#edit-user');
            btn.addEventListener('click', function () {
                setTimeout(function () {
                location.reload();
            }, 1000);
               

                const complete_name = document.querySelector('input[name=complete_name2]').value;
                const desgination = document.querySelector('input[name=desgination2]').value;
                const Role = document.querySelector('select[name=Role2]').value;
                const STRAND = document.querySelector('select[name=STRAND2]').value;
                const Sectionz = document.querySelector('select[name=Sectionz]').value;
                const email_address = document.querySelector('input[name=email_address2]').value;
                const phone_number = document.querySelector('input[name=phone_number2]').value;
                const username = document.querySelector('input[name=username2]').value;
                const password = document.querySelector('input[name=password2]').value;
                const sttatus = $('#status2 option:selected').val();
                const user_id = document.querySelector('input[name=user_id2]').value;

                var form = document.querySelector('#validationform');
                var data = new FormData(form);

                data.append('complete_name', complete_name);
                data.append('desgination', desgination);       
                data.append('STRAND', STRAND);
                data.append('Sectionz',Sectionz);
                data.append('Role', Role);
                data.append('email_address', email_address);
                data.append('phone_number', phone_number);
                data.append('username', username);
                data.append('password', password);
                data.append('sttatus', sttatus);
                data.append('user_id', user_id);

                if (complete_name === '' || desgination === '' ||  email_address === '' || phone_number === '' || username === '' || password === '' || STRAND === '' || sttatus==='' ) {
                    $('#message').html('<div class="alert alert-danger">Required All Fields!</div>');
                } else {
                    $.ajax({
                        url: '../init/controllers/edit_user.php',
                        type: "POST",
                        data: data,
                        processData: false,
                        contentType: false,
                        async: false,
                        cache: false,
                        success: function(response) {
                  $("#message").html(response);
                  setTimeout(function () {
                location.reload();
            }, 1000); },
                        error: function (response) {
                            console.log("Failed");
                        }
                    });
                }

            });
        });
    </script>
</body>
 
</html>