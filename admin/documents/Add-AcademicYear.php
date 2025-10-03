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
                    <h2 class="pageheader-title"><i class="fas fa-calendar mr-2"></i> DATE </h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Date</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <?php
          $conn = new class_model();
          
        
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
                                <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fas fa-calendar mr-2"></i>ADD DATE</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">DATE</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input data-parsley-type="alphanum" name="AcadYear" type="DATE" required=""
                                        placeholder="" class="form-control course_name">
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
    $(document).ready(function () {
        $('form[name="course_form"]').on('submit', function (e) {
            e.preventDefault();

            var a = $(this).find('input[name="AcadYear"]').val();
          
          
            if (a === '' ) {
                $('#message').html('<div class="alert alert-danger"> Please select a Trajectory!</div>');
            } else {
                $.ajax({
                    url: '../init/controllers/add_academicyear.php',
                    method: 'post',
                    data: {
                        acadyear: a
                      
                       
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
