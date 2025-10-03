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
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                    <?php 
                    include '../init/model/config/connection2.php';
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
                     
                     

                   ?>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card influencer-profile-data">
                                        <div class="card-body">
                                            <div class="" id="message"></div>
                                            <div class="" id="message1"></div>
                                            <form id="validationform" name="student_form" data-parsley-validate="" novalidate="" method="POST">
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fa fa-user"></i> Student Info</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">LRN</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" id="LRNInput" name="LRN" value="<?= $LRN; ?>" required="" placeholder="" class="form-control">
                                                    </div> 
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">First Name</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" name="first_name" value="<?= $first_name; ?>" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                  <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Middle Name</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" name="middle_name" value="<?= $middle_name; ?>" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                   <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Last Name</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" name="last_name" value="<?= $last_name; ?>" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                               <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"> (Course)</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                       <select data-parsley-type="alphanum" type="text" value="<?= $courses; ?>" id="course" required="" placeholder="" class="form-control">
                                                        <?php 
                                                            $conn = new class_model();
                                                            $course = $conn->fetchAll_course();
                                                         ?>
                                                          <option value="<?= $courses; ?>" hidden><?= $courses; ?></option>
                                                            <?php foreach ($course as $row) { ?>
                                                             
                                                           <option value="<?= $row['course_name']; ?>"><?= $row['course_name']; ?></option>
                                                          
                                                       <?php } ?>
                                                       </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Platoon</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                       <select data-parsley-type="alphanum" type="text" name="Section" required="" placeholder="" class="form-control">
                                                        <?php 
                                                            $course = $conn->fetchAll_room();
                                                            ?>
                                                           <option value="<?= $section ?>"> <?= $section ?></option>
                                                            <?php foreach ($course as $row) { ?>
                                                           <option value="<?= $row['section']; ?>"><?= $row['section']; ?></option>
                                                       <?php } ?>
                                                       </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Year level</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <select data-parsley-type="alphanum" type="text"  value="<?= $year_level; ?>" id="year_level" required="" placeholder="" class="form-control">
                                                            <option value="<?= $year_level; ?>" hidden><?= $year_level; ?></option>
                                                           <option value="Grade 11 ( 1st Sem )">Grade 11 ( 1st Sem )</option>
                                                           <option value="Grade 11 ( 2nd Sem )">Grade 11 ( 2nd Sem )</option>
                                                           <option value="Grade 12 ( 1st Sem )">Grade 12 ( 1st Sem )</option>
                                                           <option value="Grade 12 ( 2nd Sem )">Grade 12 ( 2nd Sem )</option>
                                                       </select>
                                                    </div>
                                                </div>
                                                  <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Date of Birth</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="date" value="<?php echo $date_ofbirth; ?>" name="date_ofbirth" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Gender</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                       <select data-parsley-type="alphanum" type="text" value="<?= $gender; ?>" id="gender" required="" placeholder="" class="form-control">
                                                           <option value="<?= $gender; ?>" hidden><?= $gender; ?></option>
                                                           <option value="Male">Male</option>
                                                           <option value="Female">Female</option>
                                                       </select>
                                                    </div>
                                                </div>

                                               <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Complete Address</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                       <textarea rows="1" data-parsley-type="alphanum" type="text" name="complete_address" required="" placeholder="" class="form-control"><?= $complete_address; ?></textarea>
                                                    </div>
                                                </div>
                                                  <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Email Address</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="email" value="<?= $email_address; ?>" name="email_address" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                   <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Mobile Number</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" value="<?= $mobile_number;?>" name="mobile_number" minlength="11" maxlength="11" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fa fa-user-lock"></i> Account Info</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Username</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" value="<?= $username;?>" name="username" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Password</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="password" value="<?= $password; ?>" name="password" required="" placeholder="" class="form-control" >
                                                    </div>
                                                </div>
                                                 <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Status</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                       <select data-parsley-type="alphanum" type="text" value="<?= $account_status; ?>" id="account_status" required="" placeholder="" class="form-control">
                                                           <option value="<?= $account_status; ?>" hidden><?= $account_status; ?></option>
                                                           <option value="Active" style="background-color: green;color: #fff">Active</option>
                                                           <option value="Inactive" style="background-color: red;color: #fff">Inactive</option>
                                                       </select>
                                                    </div>
                                                </div>
                                              
                                                </div>
                                                <div class="form-group row text-right">
                                                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                                       <input name="student_id" value="<?= $student_id; ?>" type="hidden">
                                                        <button  class="btn btn-space btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php } ?>
                                        </div>
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
    document.getElementById('LRNInput').addEventListener('input', function(event) {
        // Remove non-numeric characters
        let inputValue = event.target.value.replace(/\D/g, '');

        // Add "LRN-" at the beginning if not already present
        if (!inputValue.startsWith('LRN-')) {
            inputValue = 'LRN-' + inputValue;
        }

        // Update the input value
        event.target.value = inputValue;
    });

    // Prevent the user from removing "LRN-" prefix using backspace or delete key
    document.getElementById('LRNInput').addEventListener('keydown', function(event) {
        if (event.key === 'Backspace' && event.target.selectionStart <= 4) {
            event.preventDefault();
        }

        if (event.key === 'Delete' && event.target.selectionStart < 4) {
            event.preventDefault();
        }
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
      $(document).ready(function() {
       $('form[name="student_form"]').on('submit', function(e){
          e.preventDefault();

          var a = $(this).find('input[name="first_name"]').val();
          var b = $(this).find('input[name="middle_name"]').val();
          var c = $(this).find('input[name="last_name"]').val();
          var d = $('#course option:selected').val();
          var e = $('#year_level option:selected').val();
          var f = $(this).find('input[name="date_ofbirth"]').val();
          var g = $('#gender option:selected').val();
          var h = $(this).find('textarea[name="complete_address"]').val();
          var i = $(this).find('input[name="email_address"]').val();
          var j = $(this).find('input[name="mobile_number"]').val(); 
          var k = $(this).find('input[name="username"]').val();
          var l = $(this).find('input[name="password"]').val();
          var n = $(this).find('input[name="LRN"]').val();
          var m = $('#account_status option:selected').val();
          var p = $(this).find('select[name="Section"]').val();
         
          const o = document.querySelector('input[name=student_id]').value;


         if (a === '' ||  b ==='' ||  c==='' ||  d ==='' ||  e ==='' ||  f ==='' || g ==='' ||  h ==='' ||  i ==='' ||  j ==='' ||  k==='' ||  l ===''|| o ==='' || n ==='' || p ==='' ){
              $('#message').html('<div class="alert alert-danger"> Required All Fields!</div>');
              window.scrollTo(0, 0);
            }else{
            $.ajax({
                url: '../init/controllers/edit_student.php',
                method: 'post',
                data: {
                  first_name: a,
                  middle_name: b,
                  last_name: c,
                  course: d,
                  year_level: e,
                  date_ofbirth: f,
                  gender: g,
                  complete_address: h,
                  email_address: i,
                  mobile_number: j,
                  username: k,
                  password: l,
                  account_status: m,
                  student_id: o,
                  LRN: n,
                  Section: p,
                
                },
                success: function(response) {
                  $("#message").html(response);
                    window.scrollTo(0, 0);
                    
                  },
                  error: function(response) {
                    console.log("Failed");
       
                  }
              });
           }
         });
      });
 </script>
</body>
 
</html>