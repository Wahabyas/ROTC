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

        <style>
        canvas {
            max-width: 600px;
            margin: 20px auto;
            display: block;
        }
    </style>
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                             <h2 class="pageheader-title"><i class="fa fa-fw fa-chart-bar"></i> Reports </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Reports</li>
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
                            <div class="card">
                                <h5 class="card-header">Request Status Reports</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                                           <div class="card">
                                              <div class="card-body">
                                                 <div class="chart-title">
                                                    <h4>Request Status</h4>
                                                 </div>
                                                 <table class="table table-bordered mytable">
                                                     <thead>
                                                         <tr>
                                                            <th>Status</th>
                                                            <th>Number of Request</th>
                                                         </tr>
                                                     </thead>
                                                    <tbody>
                                                       <tr>
                                                       <?php 
                                    $conn = new class_model();
                                    $cstudent = $conn->count_numberoftotalpending();
                                    $countforstd=null;
                                    $countforRcv=null;
                                    $countforpaid=null;
                                                       ?>
                                                        <?php foreach ($cstudent as $row): $countforstd=$row['count_pending'] ?>
                                                          <td>Pending</td>
                                                          <td><?= $row['count_pending']; ?></td>
                                                          <?php endforeach;?>
                                                       </tr>
                                                       <tr>
                                                       <?php 
                                    $conn = new class_model();
                                    $cstudent = $conn->count_numberoftotalpaid();
                               ?><?php foreach ($cstudent as $row): $countforpaid=$row['count_paid'] ?>
                                                          <td>Paid</td>
                                                          <td><?=$row['count_paid'] ?></td>
                                                          <?php endforeach;?>
                                                       </tr>
                                                       <tr>
                                                       <?php 
                                    $conn = new class_model();
                                    $cstudent = $conn->count_numberoftotalreceived();
                               ?>
                                <?php foreach ($cstudent as $row): $countforRcv=$row['count_received']?>
                                                          <td>Recieved</td>
                                                          <td><?= $row['count_received']; ?></td>
                                                          <?php endforeach;?>
                                                       </tr>
                                                       <tr>
                                                       <?php 
                                    $conn = new class_model();
                                    $cstudent = $conn->count_numberoftotalrequest();
                               ?>   <?php foreach ($cstudent as $row): ?>
                                                          <td><strong>Total Activities</strong></td>
                                                          <td><?= $row['count_request']; ?></td>
                                                          <?php endforeach;?>
                                                       </tr>
                                                    </tbody>
                                                 </table>
                                              </div>
                                           </div>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                                           <div class="card">
                                              <div class="card-body">
                                                 <div class="chart-title">
                                                    <h4>Statistics by Request Status</h4><br>
                                                 </div>
                                                 <canvas id="bargraph"></canvas>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end responsive table -->
                        <!-- ============================================================== -->
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
    <script src="../assets/vendor/custom-js/jquery.multi-select.html"></script>
    <script src="../assets/libs/js/main-js.js"></script>
    <script src="../assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="../assets/vendor/datatables/js/data-table.js"></script>
    <script src="../assets/js/chart.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          var firstName = $('#firstName').text();
          var lastName = $('#lastName').text();
          var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
          var profileImage = $('#profileImage').text(intials);
        });
    </script>
     <canvas id="bargraph"></canvas>
 <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Data
            var countForStd = <?=$countforstd?>;
            var countForPaid = <?=$countforpaid?>;
            var countForRcv = <?=$countforRcv?>;

            // Bar Chart
            var barChartData = {
                labels: ["Pending", "Paid", "Received"],
                datasets: [{
                    label: 'Number of Requests',
                    backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(75, 192, 192)'],
                    data: [countForStd, countForPaid, countForRcv],
                }]
            };

            // Chart Configuration
            var ctx = document.getElementById('bargraph').getContext('2d');
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true,
                        },
                        y: {
                            beginAtZero: true,
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'middle',
                        },
                    }
                }
            });
        });
    </script>

</body>
 
</html>