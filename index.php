<?php
 include('db/connect_db.php');
session_start();


?>




<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>e_PESA Management System</title>
	<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/plugins/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="assets/css/feathericon.min.css">
	<link rel="stylesheet" href="assets/plugins/morris/morris.css">
	<link rel="stylesheet" href="assets/css/style.css">
	 <!--Sweetalert Plugin --->
  <script src="assets/js/sweetalert.js"></script>
</head>

<body>
	<div class="main-wrapper login-body">
		<div class="login-wrapper">
			<div class="container">
				<div class="loginbox">
					<div class="login-left"> <span class="logoclass text-primary">e_PESA MS</span> </div>
					<div class="login-right">
						<div class="login-right-wrap">
							<h1>Login</h1>
							<p class="account-subtitle">To gain Access to the System</p>
							<form action="login.php" method="post" autocomplete="off">
							<div class="form-group">
						<?php
                        if(@$_GET['Empty']==true)
                        {
                    ?>
                         <div class="alert alert-danger text-center" role="alert">
 <?php echo $_GET['Empty']; ?>
</div>                                
                    <?php
					header('refresh:2;index.php');
                        }
                    ?>


                    <?php 
                        if(@$_GET['Invalid']==true)
                        {
                    ?>
 <div class="alert alert-danger" role="alert">
 <?php echo $_GET['Invalid']; ?>
</div>                                
                    <?php
					header('refresh:2;index.php');
                        }
                    ?>
							</div>
								<div class="form-group">
									<input class="form-control" type="text" placeholder="Username" name="username"> </div>
								<div class="form-group">
									<input class="form-control" type="password" placeholder="Password" name="password" > </div>
								<div class="form-group">
									<button class="btn btn-primary btn-block" type="submit" name="btn_login">Login</button>
								</div>

							</form>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/js/script.js"></script>
</body>

</html>