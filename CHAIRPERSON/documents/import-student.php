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
                     <h2 class="pageheader-title"><i class="fa fa-fw fa-user-graduate"></i>  Import Student (Excel)</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Import</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card influencer-profile-data">
                    <div class="card-body">
                        <div class="" id="message"></div>
                        <form id="validationform" name="student_form" data-parsley-validate="" novalidate="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fa fa-user"></i>Import student</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Excel file</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="file" id="LRNInput" name="excel" required="" class="form-control" pl>
                                    <small>Note* Excel Format should be <small style="font-size: 1.2em;font-style:italic;color:red;"> LRN, FIRST NAME, MIDDLE NAME, LASTNAME, STRAND, DOB, GENDER, COMPLETE ADDRESS, EMAIL ADDRESS, MOBILE NUMBER, USERNAME OF ACCOUNT, PASSWORD. (12 column)</small> There should be no header</small><br>
                                    <small>Note* There Should be no Special character in <small style="font-size: 1.2em;font-style:italic;color:red;">USERNAME</small> and <small style="font-size: 1.2em;font-style:italic;color:red;">PASSWORD</small> Such as <small style="font-size: 1.2em;font-style:italic;color:red;">Emoji</small> </small>
                                </div>
                            </div>
                            <div class="form-group row text-right">
                                <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                    <button type="submit" class="btn btn-space btn-primary" name="import">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

$conn = new mysqli('localhost', 'root', '', 'mshs-protal');
if(isset($_POST["import"])){
    $fileName = $_FILES["excel"]["name"];
    $fileExtension = explode('.', $fileName);
    $fileExtension = strtolower(end($fileExtension));
    $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

    $targetDirectory = "uploads/" . $newFileName;
    move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

    require 'excelReader/excel_reader2.php';
    require 'excelReader/SpreadsheetReader.php';
    require 'excelReader/SpreadsheetReader_XLSX.php';
    require 'excelReader/SpreadsheetReader_CSV.php';
    require 'excelReader/SpreadsheetReader_XLS.php';
    require 'excelReader/SpreadsheetReader_ODS.php';
    $currentDateTime = date("Y-m-d H:i:s");

    $reader = new SpreadsheetReader($targetDirectory);
    foreach($reader as $key => $row){
        if (empty(array_filter($row))) {
            continue; // Skip empty rows
        }
        $ID_Number = $row[0];
        $First_name = $row[1];
        $middle_name = $row[2];
        $Last_name = $row[3];
        $course = $row[4];
        $Year_level = 'Grade 11 ( 1st Sem )';
        $date = $row[5];
        $gender = $row[6];
        $Complete_address = $row[7];
        $email_address = $row[8];
        $Mobile_no = $row[9];
        $username = $row[10];
        $password = $row[11];
        $account_status = 'Active';
        mysqli_query($conn, "INSERT INTO tbl_student VALUES('', '".$ID_Number."', '".$First_name."', '".$middle_name."', '".$Last_name."', '".$course."', '', '".$Year_level."', '".$date."', '".$gender."', '".$Complete_address."', '".$email_address."', '".$Mobile_no."', '".$username."', '".$password."', '".$account_status."', '', '".$currentDateTime."', '')");
    }
    
    echo
    "
    <script>
    alert('Succesfully Imported');
    document.location.href = '';
    </script>
    ";
}
?>
<!-- ============================================================== -->
<!-- end main wrapper -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="../assets/vendor/parsley/parsley.js"></script>
<script src="../assets/libs/js/main-js.js"></script>
<script>
$('#validationform').parsley();
</script>
<script type="text/javascript">
$(document).ready(function(){
  var firstName = $('#firstName').text();
  var lastName = $('#lastName').text();
  var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
  var profileImage = $('#profileImage').text(intials);
});
</script>
</body>
</html>
