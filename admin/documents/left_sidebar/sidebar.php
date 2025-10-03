<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
    <style>
        #dash:active,
        #dash:visited {
            background-color: black;
        }

        #dash:hover {
            background-color: black;
            border-radius: 20px !important;
        }

       
    </style>
</head>

<body>
    <div class="nav-left-sidebar sidebar-dark" style="background-color:#2c3e50;padding-bottom:5%;">
       
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="index.php">Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            <a href="index.php"><img class="logo-img" src="../assets/images/ROTC.png" width="200px" alt="logo"></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="index.php" id="dash" style="background-color:black;border-radius: 20px;"><i class="fa fa-fw fa-tachometer-alt"></i>Dashboard <span class="badge badge-success">6</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="evaluation.php" id="dash"><i class="fas fa-calendar mr-2"></i>Add Date <span class="badge badge-success">6</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="course.php" id="dash"><i class="fa fa-fw fa-certificate"></i>Course <span class="badge badge-success">6</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="student.php" id="dash"><i class="fa fa-fw fa-user-graduate"></i>Student <span class="badge badge-success">6</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="room.php"><i class="fa fa-fw fa-home"></i>Platon <span class="badge badge-success">6</span></a>
                        </li>
                        
                        <li class="nav-item ">
                            <a class="nav-link" href="users.php" id="dash"><i class="fa fa-fw fa-user-lock"></i>Officer <span class="badge badge-success">6</span></a>
                        </li>
                        <li class="nav-item" id="dash">
                            <a class="nav-link"id="dash" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8"><i class="fas fa-fw fa-chart-pie"></i>Statistics</a>
                            <div id="submenu-8" class="collapse submenu" style="background-color: black;">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="course-report.php" id="dash">Student by Strand</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="status-report.php" id="dash">Request Status</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <br>
                    </ul>
                </div>
            </nav>
        
    </div>
</body>

</html>
