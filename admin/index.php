<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        html,
        body {
            height: 100%;
            
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            flex-direction: column; /* Added */
        }

        .header-container {
            width: 100%; /* Added */
            display: flex; /* Added */
            justify-content: space-between; /* Added */
            align-items: center; /* Added */
            padding: 0 20px; /* Added */
            background-color: aliceblue;
            margin-top: -35px;
        }

        .user-dropdown {
            position: relative;
            /* margin-left: 20px; Removed */
        }

        .user-btn {
            background-color: transparent;
            border: none;
            color: black; /* Changed from #000 to black */
            font-size: 16px;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black; /* Changed from #000 to black */
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .user-dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header-container">
        <a href="/">
            <img src="assets/images/ROTC.png" alt="Logo" style="height: 80px;"> <!-- Adjusted image height -->
        </a>
        <h2 class="user-dropdown" style="border-bottom: 5px solid #d59f2a;"> Admin</h2>
        <div class="user-dropdown">
            <button class="user-btn">Users</button>
            <div class="dropdown-content">
            <a href="/ROTC/admin/index.php">Admin</a>
            <a href="/ROTC/Chairperson/index.php">Officer</a>
            <a href="/ROTC/index.php">Student</a>
            </div>
        </div>
    </div>
        
    <div class="splash-container">
        <div class="card">
            <div class="card-header text-center">
                <a href="index.php">
                    <img class="logo-img" src="assets/images/ROTC.png" alt="logo" height="200px">
                </a>
            </div>
            <div class="card-body">
                <form method="post" name="login_form">
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="username" alt="username" type="text" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" type="password" alt="password" placeholder="Password" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="remember" onclick="myFunction()"><span class="custom-control-label">Show Password</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-block" style="background-color:rgb(235, 151, 42) !important;color: rgb(243, 245, 238) !important;" value="Sign in" id="btn-login" name="btn-login">Sign in</button>
                    </div>
                    <div class="form-group" id="alert-msg">
                </form>
            </div>
        </div>
    </div>
    <!-- End Login Form Section -->

    <!-- Optional JavaScript -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script type="text/javascript">
        document.oncontextmenu = document.body.oncontextmenu = function() {
            return false;
        } //disable right click
        jQuery(function() {
            $('form[name="login_form"]').on('submit', function(e) {
                e.preventDefault();

                var u_username = $(this).find('input[alt="username"]').val();
                var p_password = $(this).find('input[alt="password"]').val();

                if (u_username === '' && p_password === '') {
                    $('#alert-msg').html('<div class="alert alert-danger"> Required Username and Password!</div>');
                } else {
                    $.ajax({
                            type: 'POST',
                            url: 'init/controllers/login_process.php',
                            data: {
                                username: u_username,
                                password: p_password
                            },
                            beforeSend: function() {
                                $('#alert-msg').html('');
                            }
                        })
                      .done(function(t) {
    if (t == 0) {
        $('#alert-msg').html('<div class="alert alert-danger">Incorrect username or password!</div>');
    } else if (t == 1) { // Only execute on success
        $("#btn-login").html('<img src="assets/images/loading.gif" /> &nbsp; Signing In ...');
        setTimeout(function() {
            window.location.href = "documents/index.php";
        }, 2000);
    }
});

                }
            });
        });
    </script>
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>
