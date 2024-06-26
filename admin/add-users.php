<?php
session_start();
include('include/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $contactno = $_POST['contactno'];
        $status = 1;

        // Check if email or contact number already exists
        $check_existing = mysqli_query($bd, "SELECT * FROM users WHERE userEmail='$email' OR contactNo='$contactno'");
        if (mysqli_num_rows($check_existing) > 0) {
            $err = "Email or Contact Number already exists!";
        } else {
            $query = mysqli_query($bd, "INSERT INTO users(fullName, userEmail, password, contactNo, status) VALUES('$fullname','$email','$password','$contactno','$status')");
            $msg = "Registration successful. Now user can login!";
        }
    }
}
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin| Add Users</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    </head>

    <body>
        <?php include('include/header.php'); ?>

        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <?php include('include/sidebar.php'); ?>
                    <div class="span9">
                        <div class="content">
                            <div class="module">
                                <div class="module-head">
                                    <h3>Add Users</h3>
                                </div>
                                <div class="module-body">
                                    <form class="form-horizontal row-fluid" method="post">
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Full Name</label>
                                            <div class="controls">
                                                <input type="text" placeholder="Enter Full Name" name="fullname" class="span8 tip" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Email</label>
                                            <div class="controls">
                                                <input type="email" placeholder="Enter Email" name="email" class="span8 tip" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Password</label>
                                            <div class="controls">
                                                <input type="password" placeholder="Enter Password" name="password" class="span8 tip" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Contact Number</label>
                                            <div class="controls">
                                                <input type="text" placeholder="Enter Contact Number" name="contactno" class="span8 tip" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" name="submit" class="btn">Add User</button>
                                            </div>
                                        </div>
                                    </form>
                                    <p style="color: green;"><?php if (isset($msg)) echo htmlentities($msg); ?></p>
                                    <p style="color: red;"><?php if (isset($err)) echo htmlentities($err); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.wrapper-->

        <?php include('include/footer.php'); ?>

        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/datatables/jquery.dataTables.js"></script>
        <script>
            $(document).ready(function() {
                $('.datatable-1').dataTable();
                $('.dataTables_paginate').addClass("btn-group datatable-pagination");
                $('.dataTables_paginate > a').wrapInner('<span />');
                $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
                $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
            });
        </script>
    </body>
