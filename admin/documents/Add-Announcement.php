<?php include('main_header/header.php'); ?>
<!-- ============================================================== -->
<!-- end navbar -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- left sidebar -->
<!-- ============================================================== -->
<?php include('left_sidebar/sidebar.php'); ?>
<!-- ============================================================== -->
<!-- end left sidebar -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- wrapper -->
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title"><i class="fas fa-flag"></i> Announcement </h2>
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
        <?php
          $user_id = $_SESSION['user_id'];
          $conn = new class_model();
          $to = $conn-> fetchAll_room();
          $user = $conn->user_account($user_id);
          $username = $user['complete_name'];
        ?>
        <!-- ============================================================== -->
        <!-- end pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card influencer-profile-data">
                    <div class="card-body">
                        <div class="" id="message"></div>
                        <form id="validationform" name="course_form" data-parsley-validate="" novalidate=""
                            method="POST">
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fas fa-flag"></i> Announcement Info</label>
                            </div>
                            <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">To :</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <select data-parsley-type="alphanum" type="text" name="to" required="" placeholder="" class="form-control">
                                                           <option value="ALL">  ALL </option>
        
                                                           <option value="Administrator">  ADMINISTRATOR </option>
                                                           <option value="CHAIRPERSON">  officer </option>
                                                          
                                                           <option value="">  ------Platoon----- </option>
                                                           <?php foreach($to as $rus) { ?>
                                                           <option value="<?= $rus['section'] ?>"><?= $rus['section'] ?></option>
                                                                <?php } ?>
                                                       </select>
                                                    </div>
                                             </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Announcement Title</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input data-parsley-type="alphanum" name="title" type="text" required=""
                                        placeholder="" class="form-control course_name">
                                </div> 
                            </div>
                            <input type="text" name="from" value="Admin, <?=$username?>" hidden>
                            <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Announcement</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                       <textarea rows="1" data-parsley-type="alphanum" type="text" name="Announcement" required="" placeholder="" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0" style="margin-left: 67%;">
                                    <button class="btn btn-space btn-primary add-course">Submit</button>
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
<!-- ============================================================== -->
<!-- end main wrapper -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="../assets/vendor/parsley/parsley.js"></script>
<script src="../assets/libs/js/main-js.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var firstName = $('#firstName').text();
        var lastName = $('#lastName').text();
        var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
        var profileImage = $('#profileImage').text(intials);
    });
</script>
<script>
    $('#validationform').parsley();
</script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
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
    $(document).ready(function () {
        $('form[name="course_form"]').on('submit', function (e) {
            e.preventDefault();

            var a = $(this).find('select[name="to"]').val();
            var b = $(this).find('input[name="title"]').val();
            var c = $(this).find('textarea[name="Announcement"]').val();
            var d = $(this).find('input[name="from"]').val();
            if (a === '' || b === '' || c === '' || d === '') {
                $('#message').html('<div class="alert alert-danger"> Please select a Trajectory!</div>');
            } else {
                $.ajax({
                    url: '../init/controllers/Add_announcement.php',
                    method: 'post',
                    data: {
                        to: a,  
                        title: b,
                        Announcement: c, 
                        from: d
                    },
                    success: function (response) {
                        $("#message").html(response);
                    },
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
