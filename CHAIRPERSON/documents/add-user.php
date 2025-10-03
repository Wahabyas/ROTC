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
               <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                             <h2 class="pageheader-title"><i class="fa fa-fw fa-user-lock"></i> Add User </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">User</li>
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
                function createRandomIDnumber() {
 	$chars = "003232303232023232023456789";
 	srand((double)microtime()*1000000);
 	$i = 0;
 	$ran = '' ;
 	while ($i <= 7) {

 		$num = rand() % 33;

 		$tmp = substr($chars, $num, 1);

 		$ran = $ran . $tmp;

 		$i++;

 	}
 	return $ran;
 }
 $IDNumber ='CODE-'.createRandomIDnumber();?>
             
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card influencer-profile-data">
                                        <div class="card-body">
                                            <div class="" id="message"></div>
                                            <form id="validationform" name="user_form" data-parsley-validate="" novalidate="" method="POST">
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fa fa-user"></i> User Info</label>
                                                </div>
                                                <input data-parsley-type="alphanum" type="text" name="USERCODE" required="" value="<?=$IDNumber?>" placeholder="" class="form-control" hidden >
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Complete Name</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" name="complete_name" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Designation</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" name="desgination" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Email</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="email" name="email_address" required="" placeholder="" class="form-control">
                                                    </div>
                                                   
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Strand related</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">

                                                    <select data-parsley-type="alphanum" type="text" id="Strand" required="" placeholder="" class="form-control">
                                                
                                                <?php 
                                                $conn = new class_model();
                                                $course = $conn->fetchAll_course();
                                                 ?> 
                                                            <option value="">&larr;Select Strand &rarr;</option>      
                                                                <?php foreach ($course as $row) { ?>
                                                                <?php if($row['course_name'] !== 'TVL-ICT' && $row['course_name'] !== 'TVL-HE' && $row['course_name']!== 'TVL-Sports' && $row['course_name']!== 'AFA'){ ?>
                                                            <option value="<?= $row['course_name']; ?>"><?= $row['course_name']; ?></option>
                                                            <?php }else{
                                                                
                                                            } ?>
                                                        <?php } ?>
                                                        </select>  
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Role</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                    <select data-parsley-type="alphanum" type="text" id="Role" required="" placeholder="" class="form-control">
                                                      <option value="">&larr; Role &rarr;</option> 
                                                            <option value="EXAMINER">EXAMINER</option>
                                                            <option value="FACULTY">FACULTY</option>                                           
                                                     </select>                                        
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Phone No.</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" minlength="11" maxlength="11" name="phone_number" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fa fa-user-lock"></i> Account Info</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Username</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" name="username" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Password</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="password" name="password" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-group row text-right">
                                                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                                        <button class="btn btn-space btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
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
    $('#form').parsley();
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
   $('form[name="user_form"]').on('submit', function(e){
      e.preventDefault();

      var a = $(this).find('input[name="complete_name"]').val();
      var b = $(this).find('input[name="desgination"]').val();
      var c = $(this).find('input[name="email_address"]').val();
      var d = $(this).find('select[id="Strand"]').val();
      var e = $(this).find('input[name="phone_number"]').val();
      var f = $(this).find('input[name="username"]').val();
      var g = $(this).find('input[name="password"]').val();
      var h = $(this).find('select[id="Role"]').val();
      var i = $(this).find('input[name="USERCODE"]').val();

     if (a === ''||  b ==='' ||  c ===''||  d ==='' ||  e ==='' ||  f ==='' || g === '' || h === ''){
          $('#message').html('<div class="alert alert-danger"> Required All Fields!</div>');
          window.scrollTo(0, 0);
        }else{
        $.ajax({
            url: '../init/controllers/add_user.php',
            method: 'post',
            data: {
              complete_name: a,
              desgination: b,
              email_address: c,
              Strand: d,
              phone_number: e,
              username: f,
              password: g,
              Role: h,
              CODE:i
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