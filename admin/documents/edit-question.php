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
                             <h2 class="pageheader-title"><i class="fas fa-question mr-2"></i>  Edit Question Evalutaion </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Question Evalutaion</li>
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
                    $Question_id = intval($_GET['student']);
                    $Question = $_GET['student-number'];
                    $sql = "SELECT * FROM `questions` WHERE `question_ID`= ? AND Question = ?";
                    $stmt = $conn->prepare($sql); 
                    $stmt->bind_param("is", $Question_id,$Question);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {

                   
                     $stmt->close();
                     $conn->close();

                   ?>
                
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card influencer-profile-data">
                                        <div class="card-body">
                                            <div class="" id="message"></div>
                                            <form id="validationform" name="student_form" data-parsley-validate="" novalidate="" method="POST">
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fas fa-question"></i> Question Evalutaion details</label>
                                                </div>
                                            
                                             <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Question</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <textarea data-parsley-type="alphanum" name="Question1" type="text" required="" value="<?=$row['Question']?>"
                                        placeholder="<?=$row['Question']?>" class="form-control course_name"><?=$row['Question']?></textarea>
                                </div> 
                            </div>
                           
                        
                                                   
                                               
                                                <div class="form-group row text-right">
                                                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                                       <input name="student_id" value="<?=$row['question_ID']?>" type="hidden">
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

          var a = $(this).find('textarea[name="Question1"]').val();
         
          const o = document.querySelector('input[name=student_id]').value;


         if (a === '' ){
              $('#message').html('<div class="alert alert-danger"> Required All Fields!</div>');
              window.scrollTo(0, 0);
            }else{
            $.ajax({
                url: '../init/controllers/edit_question.php',
                method: 'post',
                data: {
                    question: a,
                  
                    student_id: o

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