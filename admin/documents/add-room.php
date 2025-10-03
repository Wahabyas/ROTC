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
                             <h2 class="pageheader-title"><i class="fa fa-fw fa-home"></i>  Add Platoon </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Platoon</li>
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
                $SECNumber ='SEC-'.createRandomIDnumber();
                ?>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card influencer-profile-data">
                                        <div class="card-body">
                                            <div class="" id="message"></div>
                                            <form id="validationform" name="student_form" data-parsley-validate="" novalidate="" method="POST">
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fa fa-home"></i> Room Info</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Platoon </label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" name="Section_name" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                <input data-parsley-type="alphanum" value="<?= $SECNumber ?>" type="text" name="Section_code" required="" placeholder="" class="form-control" hidden>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Platoon name</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" name="Room_name" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row text-right">
                                                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                                        <button  class="btn btn-space btn-primary">Submit</button>
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
       $('form[name="student_form"]').on('submit', function(e){
          e.preventDefault();

          var a = $(this).find('input[name="Section_name"]').val(); 
          var b = $(this).find('input[name="Section_code"]').val(); 
          var c = $(this).find('input[name="Room_name"]').val();     
         


         if (a === ''){
              $('#message').html('<div class="alert alert-danger"> Required All Fields!</div>');
              window.scrollTo(0, 0);
            }else{
            $.ajax({
                url: '../init/controllers/add_room.php',
                method: 'post',
                data: {
                    Section_name: a,  
                    Section_code: b,
                    Room_name: c,
                },
                success: function(response) {
                  $("#message").html(response);
                   setTimeout(function () {
                location.reload();
            }, 1000); },
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