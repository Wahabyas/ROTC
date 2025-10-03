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
                             <h2 class="pageheader-title"><i class="fas fa-flag"></i>  Edit Announcement </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Announcement</li>
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
                    $GET_announcementid = intval($_GET['student']);
                    $announcement_number = $_GET['student-number'];
                    $sql = "SELECT * FROM `announcement` WHERE `Announcement_id`= ? AND Announcement_to = ?";
                    $stmt = $conn->prepare($sql); 
                    $stmt->bind_param("is", $GET_announcementid,$announcement_number);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {

                     $tos = $row['Announcement_to'];
                     $title = $row['Announcement_title'];
                     $desc = $row['Announcement_desc'];
                     $from = $row['Announcement_from'];
                     $id = $row['Announcement_id'];
                     
                     $stmt->close();
                     $conn->close();

                   ?>
                <?php $conn = new class_model();
                $to = $conn-> fetchAll_room();
                ?>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card influencer-profile-data">
                                        <div class="card-body">
                                            <div class="" id="message"></div>
                                            <form id="validationform" name="student_form" data-parsley-validate="" novalidate="" method="POST">
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fas fa-flag"></i> Announcement details</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">To :</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <select data-parsley-type="alphanum" type="text" name="to1" value="<?=$tos?>" required="" placeholder="<?= $tos?>" class="form-control">
                                                           <option value="ALL">  ALL </option>
                                                           <option value="EMPLOYEES">  EMPLOYEES </option>
                                                           <option value="Administrator">  ADMINISTRATOR </option>
                                                           <option value="CHAIRPERSON">  CHAIRPERSON </option>
                                                           <option value="EXAMINER">  EXAMINER </option>
                                                           <option value="FACULTY">  FACULTY </option>
                                                           <option value="Student">  STUDENT </option>
                                                           <option value="">---Followings are Section---</option>
                                                           <?php foreach($to as $rus) { ?>
                                                           <option value="<?= $rus['section'] ?>"><?= $rus['section'] ?></option>
                                                                <?php } ?>
                                                       </select>
                                                    </div>
                                             </div>
                                             <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Announcement Title</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input data-parsley-type="alphanum" name="title1" type="text" required="" value="<?=$title?>"
                                        placeholder="<?=$title?>" class="form-control course_name">
                                </div> 
                            </div>
                            <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Announcement</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                       <textarea rows="1" data-parsley-type="alphanum" type="text" name="Announcement1" value="<?=$desc?>" required="" placeholder="<?=$desc?>" class="form-control"><?=$desc?></textarea>
                                                    </div>
                                                </div>
                                                   <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">From</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" name="From1" value="<?= $from ?>" required="" placeholder="<?=$from ?>" class="form-control" readonly>
                                                    </div>
                                                </div>
                                              
                                                <div class="form-group row text-right">
                                                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                                       <input name="student_id" value="<?= $id ?>" type="hidden">
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

          var a = $(this).find('select[name="to1"]').val();
          var b = $(this).find('input[name="title1"]').val();
          var c = $(this).find('textarea[name="Announcement1"]').val();
          var d = $(this).find('input[name="From1"]').val();
          const o = document.querySelector('input[name=student_id]').value;


         if (a === '' ||  b === '' ||  c ==='' ||  d ==='' ){
              $('#message').html('<div class="alert alert-danger"> Required All Fields!</div>');
              window.scrollTo(0, 0);
            }else{
            $.ajax({
                url: '../init/controllers/edit_announcement.php',
                method: 'post',
                data: {
                    to1: a,
                    title1: b,
                    Announcement1: c,
                    From1: d,
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