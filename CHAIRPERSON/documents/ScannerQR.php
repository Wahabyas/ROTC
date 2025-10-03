<?php include('main_header/header.php'); ?>
<?php include('left_sidebar/sidebar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Scanner</title>

<script src="../assets/adapter.min.js"></script>
<script src="../assets/vue.min.js"></script>
<script src="../assets/instascan.min.js"></script>
<script src="../assets/html5-qrcode.min.js"></script>

    <script src="assets/jquery.min.js"></script>
    <script src="assets/adapter.min.js"></script>
    <script src="assets/vue.min.js"></script>
    <script src="assets/instascan.min.js"></script>
    <script src="assets/jsQR.js"></script>
    <script src="assets/html5-qrcode.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsQR/1.3.1/jsQR.js"></script>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <style>/* Custom success styles */
.alert-custom-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

/* Custom success text color */
.alert-custom-success .alert-heading {
    color: #0c5460;
}
</style>
    <style>
     
        #scanner {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin: auto;
            overflow: hidden;
        }

      
        #preview {
            width: 100%;
            height: auto;
            display: block;
        }

        .overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 90%;
            height: 80%;
            background: rgba(255, 255, 255, 0.7);
            border: 2px dashed #007bff;
            transform: translate(-50%, -50%);
            border-radius: 10px;
            pointer-events: none;
        }

        .scan-line {
            position: absolute;
            width: 100%;
            height: 3px;
            background: #007bff;
            animation: scan 2s linear infinite;
            top: 0;
        }

        @keyframes scan {
            0% { top: 0; }
            50% { top: 100%; }
            100% { top: 0; }
        }

        .instruction {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%);
            color: #007bff;
            font-size: 1.5em;
            text-align: center;
            z-index: 10;
        }

        @media (max-width: 768px) {
            .instruction { font-size: 1.2em; }
        }
    </style>
</head>
<body>
<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="container">
                        <div class="row" >
                            <div class="col-md-6" >
                            <div class="" id="message" style="margin-top: 2%;"></div>
                                <div id="scanner">
                                    <video id="preview" width="100%"></video>
                                    <div class="overlay"></div>
                                    <div class="scan-line"></div>
                                    <?php   $activedate = $conn->fetchAll_Activedate(); 
                                    
                                    
                                    // Call the function ?>
                                    <div class="instruction">Point QR code here</div>
                                </div>
                            </div>
                            <div class="col-md-6">
    <label>SCAN QR CODE</label>
    <input type="text" id="qrText" readonly placeholder="Scan QR Code" class="form-control">
</div>
<div class="col-md-6">
    <label>Student Name</label>
    <input type="text" id="studentName" readonly placeholder="Student Name" class="form-control">
    <input type="text" id="IsD" hidden   class="form-control">
</div>

                                                  
                     </div>
                    </div>
    </div>
             

                    <script>

                 function startScanner() {
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    let isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);

    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            let selectedCamera = isMobile 
                ? cameras.find(camera => camera.name.toLowerCase().includes('back')) || cameras[0]
                : cameras[0];

            scanner.start(selectedCamera).catch(error => {
                console.error("Error starting scanner: ", error);
                alert("Error starting scanner: " + error.message);
            });
        } else {
            alert('No cameras found on your device.');
        }
    }).catch(function(error) {
        console.error("Error accessing the camera: ", error);
        alert("Cannot access the camera. Please check your device permissions and ensure you are using HTTPS.");
    });

    // Listener to handle scanned QR code content
    scanner.addListener('scan', function(content) {
        console.log("Scanned QR Code content:", content); // Log scanned content
        document.getElementById('qrText').value = content; 
        fetchStudentInfo(content); 
    });
}

// Function to fetch student information based on QR code content
function fetchStudentInfo(studentID) {
    $.ajax({
        url: '../init/controllers/fetch_student_info.php',
        method: 'POST',
        data: { student_id: studentID },
        dataType: 'json',
        success: function(response) {
            console.log("Fetched student info:", response); // Log fetched student info

            // Update input fields if data is returned
            if (response && response.name && response.ID) {
                document.getElementById('studentName').value = response.name;
                document.getElementById('IsD').value = response.ID ;

                var studentNameValue = $('#studentName').val();
    var isDValue = $('#IsD').val();

    // Log values to check if they are being captured
    console.log("Student Name Value:", studentNameValue);
    console.log("IsD Value:", isDValue);
    
    // Check for required fields
    if (studentNameValue === '' || isDValue === '') {
        $('#message').html('<div class="alert alert-danger">Please Scan QR code First!</div>');
        window.scrollTo(0, 0);
    } else {
        // Copy values to hidden fields for form submission
        $('#studentNameHidden').val(studentNameValue);
        $('#IsDHidden').val(isDValue);

        // Proceed with AJAX submission
        $.ajax({
            url: '../init/controllers/add_attendance.php',
            method: 'POST',
            data: {
                studentName1: studentNameValue,
                IsD: isDValue,
            },
            success: function(response) {
                $("#message").html(response);
                window.scrollTo(0, 0);
            },
            error: function() {
                console.log("Failed");
            }
        });
    }
            } else {
                alert("No student found with this ID.");
                document.getElementById('studentName').value = '';
                document.getElementById('IsD').value = '';
            }
        },
        error: function(error) {
            console.error("Error fetching student info: ", error);
            alert("Unable to fetch student information. Please try again.");
        }
    });
}

// Start scanner when page loads
window.addEventListener('load', startScanner);


                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="../assets/vendor/custom-js/jquery.multi-select.html"></script>
<script src="../assets/libs/js/main-js.js"></script>
<script src="../assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="../assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/vendor/datatables/js/data-table.js"></script>


<script>
    $(document).ready(function () {
        var firstName = $('#firstName').text();
        var lastName = $('#lastName').text();
        var initials = firstName.charAt(0) + lastName.charAt(0);
        $('#profileImage').text(initials);
    });
</script>
</body>
</html>
