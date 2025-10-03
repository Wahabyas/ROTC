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
                                                       <?php 
                                                            $conn = new class_model();
                                                            $course = $conn->fetchAll_course();
                                                            $countcourse = $conn->countAllCourses();
                                                            $CountallStudent = $conn->countAllStudents();
                                                            $studentCountTvlSports = $conn->countStudentsByCourse('TVL-Sports');
                                                            $studentCountTvlHE = $conn->countStudentsByCourse('TVL-HE');
                                                            $studentCountSTEM = $conn->countStudentsByCourse('STEM');
                                                            $studentCountTvlICT = $conn->countStudentsByCourse('TVL-ICT');
                                                            $studentCountABM = $conn->countStudentsByCourse('ABM');
                                                            $studentCountHUMSS = $conn->countStudentsByCourse('HUMSS');
                                                            $studentCountGAS = $conn->countStudentsByCourse('GAS');
                                                            $studentCountAFA = $conn->countStudentsByCourse('AFA');
                                                         ?>
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
                                                            
                                                            <th>Strand</th>
                                                            <th>Number of Student</th>
                                                         </tr>
                                                     </thead>
                                                    <tbody>
                                                    <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Strand</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                       <select data-parsley-type="alphanum" type="text" id="course" required="" placeholder="" class="form-control">
                                                         <option value="">SELECT STRAND</option>
                                                       <?php foreach ($course as $row) { ?>
                                                      <option value="<?= $row['course_name'] ?>"><?= $row['course_name'] ?></option>
                                                      <?php } ?>                                            
                                                       </select>
                                                    </div>
                                                </div>
                                                        <tr>
                                                           <td>TVL-Sports</td>
                                                           <td><?= $studentCountTvlSports?></td>
                                                        </tr>
                                                        <tr>
                                                           <td>TVL-HE</td>
                                                           <td><?= $studentCountTvlHE?></td>
                                                        </tr>
                                                        <tr>
                                                           <td>STEM</td>
                                                           <td><?= $studentCountSTEM?></td>
                                                        </tr>
                                                        <tr>
                                                           <td>TVL-ICT</td>
                                                           <td><?= $studentCountTvlICT?></td>
                                                        </tr>
                                                        <tr>
                                                           <td>ABM</td>
                                                           <td><?= $studentCountABM?></td>
                                                        </tr>
                                                        <tr>
                                                           <td>HUMSS</td>
                                                           <td><?=  $studentCountHUMSS?></td>
                                                        </tr>
                                                       
                                                        <tr>
                                                           <td>AFA</td>
                                                           <td><?= $studentCountAFA?></td>
                                                        </tr>
                                                        <tr>
                                                           <td>TOTAL NUMBER OF STUDENT</td>
                                                           <td><?= $CountallStudent ?></td>
                                          
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
                                                    <h4>Number of Student</h4><br>
                                                 </div>
                                                 <div id="piechart" style="width: 500px; height: 500px;"></div>
                                              </div> <div id="piechart1" style="width: 500px; height: 500px;"></div>
                                             
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
    <script type="text/javascript" src="../assets/js/loader.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          var firstName = $('#firstName').text();
          var lastName = $('#lastName').text();
          var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
          var profileImage = $('#profileImage').text(intials);
        });
    </script>
<script type="text/javascript">
   google.charts.load('current', { 'packages': ['corechart'] });
   google.charts.setOnLoadCallback(drawChart);

   function drawChart() {
      var data = google.visualization.arrayToDataTable([
         ['Course', 'Request'],
         ['TVL-Sports', <?= $studentCountTvlSports ?>],
         ['STEM', <?= $studentCountSTEM ?>],
         ['TVL-ICT', <?= $studentCountTvlICT ?>],
         ['ABM', <?= $studentCountABM ?>],
         ['HUMSS', <?= $studentCountHUMSS ?>],
     
         ['AFA', <?= $studentCountAFA ?>],
      ]);

      var options = {
         title: 'Number of Students by Course',
         // You can customize other options as needed
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
   }
</script>


