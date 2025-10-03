
<?php
 

  include('../init/model/class_model.php');
       session_start();
    if(!(trim($_SESSION['user_id']))){
        header('location:../index.php');
    }

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/vendor/fontawesome-free/css/all.min.css">
<!--     <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/datatables/css/buttons.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/datatables/css/select.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>ROTC Attendance System</title>
    <style>
        ul.navbar-nav li a{
            color: rgb(207, 214, 200) !important;
        }
        ul.navbar-nav li a i{
            color: rgb(207, 214, 200) !important;
        }
        .navbar-brand{
            color: rgb(255, 55, 0) !important;
        }
        /*Profile image */


        #profileImage {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background:maroon;
        font-size: 16px;
        color: #fff;
        text-align: center;
        line-height: 41px;
        margin: 0px 0;
        }
    </style>
    </style>
</head>
<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="index.php"><p style="color:black;font-size: 100%;size: 3em;border-bottom: 5px solid #ed790c;font-family: 'Arial', sans-serif;
font-family: 'Arial', sans-serif;
">Officer</p></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fas fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                         <li class="nav-item dropdown">
                        
                            <div class="dropdown-menu dropdown-menu-right dropdown dropdown-menu_1" aria-labelledby="navbarDropdownMenuLink1" style="width: 400px">
                            </div>
                        </li>&nbsp;&nbsp;
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="index.php" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <div id="profileImage"></div><!-- <img src="../assets/images/256-128.webp" alt="" class="user-avatar-md rounded-circle"> --></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info" style="background-color: #666">
                                    <h5 class="mb-0 text-white nav-user-name">
                                    <?php
                                        $user_id = $_SESSION['user_id'];
                                        $conn = new class_model();
                                        $user = $conn->user_account($user_id);
                                        echo '<center><h4 class = "text-warning"><b>Welcome Chairperson! </b>,<span id="lastName">'.ucfirst($user['complete_name']).'</span></h4></center>';
                                    ?>
                                    </h5>            
                                </div>
                                <a class="dropdown-item" href="logout/logout.php"style="background-color: #666"><i class="fas fa-sign-out-alt" style="margin-right: 7px;"></i> Logout</a>
                                <a class="dropdown-item" href="profile.php" style="background-color: #666"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="import-student.php" style="background-color: #666;"><i class="fas fa-plus"></i> <span style="margin-left:7px;">Import</span></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>