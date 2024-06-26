<?php
session_start();
include('include/config.php');

if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
}

date_default_timezone_set('Asia/Kolkata');
$currentTime = date('d-m-Y h:i:s A', time());

error_reporting(0);

if (isset($_POST['submit'])) {
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$contactno = $_POST['contactno'];
	$status = 1;
	$query = mysqli_query($bd, "insert into users(fullName, userEmail, password, contactNo, status) values('$fullname','$email','$password','$contactno','$status')");
	$msg = "Registration successful!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin | User Registration</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>


	<script language="javascript" type="text/javascript">
		var popUpWin = 0;

		function popUpWindow(URLStr, left, top, width, height) {
			if (popUpWin) {
				if (!popUpWin.closed) popUpWin.close();
			}
			popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
		}
	</script>

	<script>
		function userAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_availability.php",
				data: 'email=' + $("#email").val(),
				type: "POST",
				success: function(data) {
					$("#user-availability-status1").html(data);
					$("#loaderIcon").hide();
				},
				error: function() {}
			});
		}
	</script>
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
								<h3>User Registration</h3>
							</div>
							<div class="module-body table">
								<?php if (isset($msg)) { ?>
									<div class="alert alert-success">
										<?php echo htmlentities($msg); ?>
									</div>
								<?php } ?>
								<div class="panel-body">

									<form class="form-horizontal" method="post">
										<div class="form-group">
											<div class="col-sm-2">
												<label class="control-label" for="fullname">Full Name</label>
											</div>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="fullname" name="fullname" required="required" autofocus>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="email">Email</label>
											<div class="col-sm-10">
												<input type="email" class="form-control" id="email" name="email" onBlur="userAvailability()" required="required">
												<span id="user-availability-status1" style="font-size:12px;"></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="password">Password</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" id="password" name="password" required="required">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="contactno">Contact No</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="contactno" name="contactno" maxlength="10" required="required">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												<button class="btn btn-primary" type="submit" name="submit" id="submit"><i class="fa fa-user"></i> Register</button>
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
	</div>
	<?php include('include/footer.php'); ?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>