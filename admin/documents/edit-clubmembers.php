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
                             <h2 class="pageheader-title"><i class="fa fa-fw fa-book"></i>  Edit club Member</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">club Member</li>
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
                    $GET_clubid = intval($_GET['student']);
                    $club_number = $_GET['student-number'];
                    $sql = "SELECT * FROM `clubmembers` WHERE `club_memberid`= ? AND club_memeber = ?";
                    $stmt = $conn->prepare($sql); 
                    $stmt->bind_param("is", $GET_clubid, $club_number);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $conn = new class_model();
                    $club = $conn->fetchAll_club(); 
                    while ($row = $result->fetch_assoc()) {
                     $club_id = $row['club_memberid'];
                     $club_name = $row['club_name'];
                     $club_member = $row['club_memeber'];
                     $club_code = $row['position'];
                     $club_strand = $row['Clubadviser']; 
                   ?>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card influencer-profile-data">
                                        <div class="card-body">
                                            <div class="" id="message"></div>
                                            <div class="" id="message1"></div>
                                            <form id="validationform" name="student_form" data-parsley-validate="" novalidate="" method="POST">
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fa fa-book"></i> Club Member Info</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Club Member Name</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                    <input data-parsley-type="alphanum" type="text" name="club_memeber" value="<?= $row['club_memeber']; ?>" required="" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Club name</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <select data-parsley-type="alphanum" type="" name="Club_name" required="" placeholder="" class="form-control">
                                                        <option value="<?=$club_name?>"><?=$club_name?></option>
                                                        <?php foreach ($club as $rows) { ?>
                                                            <option value="<?=$rows['club_name']?>"><?=$rows['club_name']?></option>
                                                            
                                                            <?php } ?>
                                                            </select>
                                                           
                                                    </div>
                                                </div>
                                                  <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Position </label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" name="position" value="<?= $row['position']; ?>" required="" placeholder="" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                   <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">club adviser</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <input data-parsley-type="alphanum" type="text" name="Clubadviser" value="<?= $row['Clubadviser']; ?>" required="" placeholder="" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                  <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Status</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                       <select data-parsley-type="alphanum" type="text" value="" name="AAccount_status" required="" placeholder="<?= $row['Status']; ?>" class="form-control">
                                                       <option value="<?= $row['Status']; ?>" ><?= $row['Status']; ?></option>
                                                           <option value="Active" style="background-color: green;color: #fff">Active</option>
                                                           <option value="Inactive" style="background-color: red;color: #fff">Inactive</option>
                                                       </select>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-group row text-right">
                                                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                                       <input name="club_memberid" value="<?= $row['club_memberid']; ?>" type="hidden">
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
    $('form[name="student_form"]').on('submit', function(e) {
    e.preventDefault();

    var a = $(this).find('input[name="club_memeber"]').val();
    var b = $(this).find('select[name="Club_name"]').val();
    var c = $(this).find('input[name="position"]').val();
    var d = $(this).find('input[name="Clubadviser"]').val();
    var z = $(this).find('select[name="AAccount_status"]').val();
    const g = document.querySelector('input[name=club_memberid]').value;

    $.ajax({
        url: '../init/controllers/edit_clubmembers.php',
        method: 'post',
        data: {
            club_memeber: a,
            position: c,
            Clubadviser: d,
            club_name: b,
            club_id: g,
            AAccount_status: z,
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