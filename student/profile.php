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
                <style>
        /* Custom styles for Grade Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    
        
        @media print {
            body * {
                visibility: hidden;
                flex: glow 1;
            flex: basis 200;
            }
            #gradeTable, #gradeTable * {
                visibility: visible;
            flex: glow 1;
            flex: basis 200;
            }

            #gradeTable {
                position: absolute;
                left: 0;
                top: 0;
                flex: glow 1;
            flex: basis 200;
            }
        }
    </style>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                             <h2 class="pageheader-title"><i class="fa fa-fw fa-user"></i> Profile </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                    $active='Active';
                        $student_id = $_SESSION['student_id'];
                        $conn = new class_model();
                        $user = $conn->student_profile($student_id);
                        $userid = $user['studentID_no'];
                    
                        $coursed = $user['course'];
                        $section = $user['Section'];
                        $club = $conn->fetchAll_clubmember('club_memeber','club_name','position');
                        $grades =$conn->fetchALL_Grade($userid);
                  
                       
                    
                    ?>
                    <div class="row">

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card influencer-profile-data">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="text-center">
                                                        <div id="profileImage_2"></div>
                                                     <!--    <img src="../assets/images/256-128.webp" alt="User Avatar" class="rounded-circle user-avatar-xxl"> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-12">
                                                        <div class="user-avatar-info">
                                                            <div class="m-b-20">
                                                                <div class="user-avatar-name">
                                                                    <h2 class="mb-1"><span id="firstName"><?= ucfirst($user['first_name']).' </span>'.ucfirst($user['middle_name']).'<span id="lastName"> '.ucfirst($user['last_name']); ?></span></h2>
                                                                </div><br>
                                                            </div>
                                                        
                                                            <div class="user-avatar-address">
                                                                <p class="border-bottom pb-3">
                                                                    <span class="d-xl-inline-block d-block mb-2"><i class="fa fa-map-marker-alt mr-2 text-primary "></i><?= ucfirst($user['complete_address']); ?></span>
                                                                    <span class="mb-2 ml-xl-4 d-xl-inline-block d-block"><i class="fa fa-link mr-2 text-primary"></i>
Joined date: <?= date("M d, Y",strtotime($user['date_created'])); ?> </span>
                                                                    <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"><i class="fa fa-transgender mr-2 text-primary"></i> <!-- Female icon --><?= ucfirst($user['gender']); ?> </span>
                                                                     <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"><i class="fa fa-id-card mr-2 text-primary"></i> <?= ucfirst($userid); ?> </span>
                                                                     <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"> <i class="fa fa-book mr-2 text-primary"></i><?= ucfirst($coursed); ?> </span>
                                                                     <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"> <i class="fa fa-fw fa-home"></i> <?= ucfirst($section); ?> </span>
                                                       <?php foreach ($club as $member) {?>
                                                        <?php if($member['club_memeber'] === $user['first_name'].' '.$user['middle_name'].' '.$user['last_name']) {?>
                                                                            <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"> <i class="fas fa-fw fa-users" style="margin-right: 10px;"></i><?= ucfirst($member['position']); ?> of <?= ucfirst($member['club_name']); ?> 
                                                                            </span>
                                                                            <?php }else{
                                                                                
                                                                            } ?>
                                                                            <?php } ?>
                                                                  <!--   <span class=" mb-2 d-xl-inline-block d-block ml-xl-4">29 Year Old </span> -->
                                                                </p>
                                                                <p class="border-bottom pb-3">
                                                                    <span class="d-xl-inline-block d-block mb-2"><i class="fa fa-certificate mr-2 text-primary "></i><?= ucfirst($user['course']); ?></span>
                                                                    <span class="mb-2 ml-xl-4 d-xl-inline-block d-block"> <i class="fa fa-calendar mr-2 text-primary"></i> <?= ucfirst($user['year_level']); ?> </span>
                                                                </p>
                                                                <div class="mt-3">
                                                                    <a href="<?= ucfirst($user['email_address']); ?>" class="badge badge-light mr-1"><i class="fa fa-fw fa-envelope"></i> <?= ucfirst($user['email_address']); ?></a> <a href="#" class="badge badge-light mr-1"><i class="fa fa-fw fa-phone"></i> <?= ucfirst($user['mobile_number']); ?></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border-top user-social-box">
                                                <form id="validationform" data-parsley-validate="" novalidate="" method="POST">
                                                    <div class="form-group row">
                                                        <label class="col-12 col-sm-3 col-form-label text-sm-right"><i class="fa fa-user"></i> Account Info</label>
                                                    </div>
                                                    <div class="" id="message"></div>
                                                  

                                                    <div class="form-group row">
                                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Username</label>
                                                        <div class="col-12 col-sm-8 col-lg-6">
                                                            <input data-parsley-type="alphanum" type="text" name="username" value="<?= $user['username']; ?>" required="" placeholder="" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Password</label>
                                                        <div class="col-12 col-sm-8 col-lg-6">
                                                            <input data-parsley-type="alphanum" type="password" name="password" value="<?= $user['password']; ?>" required="" placeholder="" class="form-control">
                                                          <label  class="col-12 col-sm-3 col-form-label text-sm-right">Show Password</label>
                                                            <input  class="yas" type="checkbox" id="remember" onclick="myFunction()">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row text-right">
                                                        <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                                              <input name="student_id" value="<?= $user['student_id']; ?>" class="form-control" hidden>
                                                            <button type="button" class="btn btn-space btn-primary" id="btn-change">Save Changes</button>
                                                            <button class="btn btn-space btn-secondary">Cancel</button>
                                                        </div>
                                                        
                                                    </div>
                                                    <?php 
require_once 'C:/XAMPP/htdocs/ROTC/CHAIRPERSON/documents/phpqrcode/qrlib.php';

// Ensure $userid is defined and has a value
if (isset($userid) && !empty($userid)) {
    // Set the path for the QR code
    $qrCodePath = "C:/XAMPP/htdocs/ROTC/CHAIRPERSON/documents/images/".$userid.".png"; 

    // Generate the QR code and save it to the specified path
    QRcode::png($userid, $qrCodePath, QR_ECLEVEL_L, 4); 
    

    // Check if the file was created
    if (file_exists($qrCodePath)) {
        // Convert the path to a web-accessible URL
        if (isset($userid) && !empty($userid)) {
            ob_start(); // Start output buffering
        
            // Generate the QR code directly to the output
            QRcode::png($userid, null, QR_ECLEVEL_L, 4); 
        
            // Get the image data from the output buffer
            $imageData = ob_get_contents(); // Capture the output
        
            // Clean the output buffer
            ob_end_clean(); 
        
            // Encode the image data as base64
            $base64Image = base64_encode($imageData);
            
            // Create a data URI for the image
            $qrCodeUrlx = "data:image/png;base64," . $base64Image;
        
            // Display the QR code in the HTML
            echo "<div class='alert alert-custom-success text-center' style='text-align: center;'>
                <p>Your QR Code is:</p>
                <img id='printableImage' src='$qrCodeUrlx' style='width:200px; height:200px;'>
              </div>";
        } else {
            echo "<div class='alert alert-danger'>User ID is not set or is empty.</div>";
        }
       
    } else {
        echo "<div class='alert alert-danger'>Please Inform The developer.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>User ID is not set or is empty.</div>";
}
?>
<button id="printButton" onclick="printImage()">Print Image</button>

                                                </form>
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
    <script>
    function printImage() {
        const printContent = document.getElementById('printableImage').outerHTML;
        const printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Print QR Code</title>
                <style>
                    body {
                        text-align: center;
                        margin: 0;
                        padding: 20px;
                    }
                    img {
                        width: 200px;
                        height: 200px;
                    }
                </style>
            </head>
            <body>
                ${printContent}
            </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }
</script>
    <script>
        // JavaScript to handle the print functionality
        // JavaScript to handle the print functionality for the second table
    document.getElementById('printBtn').addEventListener('click', function() {
        var printContent = document.getElementById('gradeTable').outerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    });

     // JavaScript to handle the print functionality for the second table
     document.getElementById('printBtn1').addEventListener('click', function() {
        var printContent = document.getElementById('gradeTable1').outerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    });
    // JavaScript to handle the print functionality for the second table
    document.getElementById('printBtn2').addEventListener('click', function() {
        var printContent = document.getElementById('gradeTable2').outerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    });
     // JavaScript to handle the print functionality for the second table
     document.getElementById('printBtn3').addEventListener('click', function() {
        var printContent = document.getElementById('gradeTable3').outerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    });
    </script>
      <script>
    function myFunction() {
        var x = document.querySelector('input[name="password"]');
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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
    <script type="text/javascript">
        $(document).ready(function(){
          var firstName = $('#firstName').text();
          var lastName = $('#lastName').text();
          var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
          var profileImage_2 = $('#profileImage_2').text(intials);
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
          document.addEventListener('DOMContentLoaded', () => {
              let btn = document.querySelector('#btn-change');
              btn.addEventListener('click', () => {

    
                  const password = document.querySelector('input[name=password]').value;
                  console.log(password);
                  const student_id = document.querySelector('input[name=student_id]').value;
                   console.log(student_id);

                  var data = new FormData(this.form);
                  data.append('password', password);
                  data.append('student_id', student_id);


              if (password === ''){
                      $('#message').html('<div class="alert alert-danger"> Required All Fields!</div>');
                    }else{
                       $.ajax({
                        url: '../init/controllers/change_password.php',
                          type: "POST",
                          data: data,
                          processData: false,
                          contentType: false,
                          async: false,
                          cache: false,
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
      <script>
$(document).ready(function(){
 
 function load_unseen_notification_1(view = '')
 {
  $.ajax({
   url:"../init/controllers/fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
     $('.dropdown-menu_1').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count_1').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification_1();

 $(document).on('click', '.dropdown-toggle1', function(){
  $('.count_1').html('');
  load_unseen_notification_1('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification_1(); 
 }, 4000);
 
});
</script>

<script>
$(document).ready(function(){
 
 function load_unseen_notification_2(view = '')
 {
  $.ajax({
   url:"../init/controllers/fetchprob.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
     $('.dropdown-menu_2').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count_2').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification_2();

 $(document).on('click', '.dropdown-toggle2', function(){
  $('.count_2').html('');
  load_unseen_notification_2('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification_2(); 
 }, 5000);
 
});
</script>
</body>
</html>