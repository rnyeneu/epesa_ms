<?php
  include('../db/connect_db.php');
   session_start();
 if(!isset($_SESSION['user_id'])){
	header("location: ../index.php");
}
	
		$mtandao1 = "Airtel Money"; 
		$mtandao2 = "Halopesa";
		$mtandao3 = "M-Pesa";
		$mtandao4 = "Tigopesa";
	
	//AIRTEL MONEY select statement
		$select_airtel = "SELECT * FROM providers WHERE p_name = '$mtandao1' ";
        $query_airtel = mysqli_query($db, $select_airtel);
		$row_airtel_money = mysqli_fetch_assoc($query_airtel);
		$float_airtel_money = $row_airtel_money['current_float'];
		$cash_airtel_money = $row_airtel_money['current_cash'];
		
	//HALOPESA select statement
		$select_halo = "SELECT * FROM providers WHERE p_name = '$mtandao2' ";
        $query_halo = mysqli_query($db, $select_halo);
		$row_halopesa = mysqli_fetch_assoc($query_halo);
		$float_halopesa = $row_halopesa['current_float'];
		$cash_halopesa = $row_halopesa['current_cash'];
	
	//M-PESA select statement
		$select_m_pesa = "SELECT * FROM providers WHERE p_name = '$mtandao3' ";
        $query_m_pesa = mysqli_query($db, $select_m_pesa);
		$row_m_pesa = mysqli_fetch_assoc($query_m_pesa);
		$float_m_pesa = $row_m_pesa['current_float'];
		$cash_m_pesa = $row_m_pesa['current_cash'];
	
	//TIGOPSEA select statement
		$select_tigopesa = "SELECT * FROM providers WHERE p_name = '$mtandao4' ";
        $query_tigopesa = mysqli_query($db, $select_tigopesa);
		$row_tigopesa = mysqli_fetch_assoc($query_tigopesa);
		$float_tigopesa = $row_tigopesa['current_float'];
		$cash_tigopesa = $row_tigopesa['current_cash'];
		
		?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>e_PESA Management System</title>

<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">

<link rel="stylesheet" href="../assets/css/feathericon.min.css">
<link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
<link rel="stylesheet" href="../assets/plugins/morris/morris.css">

<link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<div class="main-wrapper">

<div class="header">

<div class="header-left">
<a href="index.html" class="logo">
<!-- <img src="../assets/img/hotel_logo.png" width="50" height="70" alt="logo"> -->
<span class="logoclass">e_PESA</span>
</a>
<a href="index.html" class="logo logo-small">
<span class="logoclass">e_PESA</span><!--<img src="assets/img/hotel_logo.png" alt="Logo" width="30" height="30">-->
</a>
</div>

<a href="javascript:void(0);" id="toggle_btn">
<i class="fe fe-text-align-left"></i>
</a>

<a class="mobile_btn" id="mobile_btn">
<i class="fas fa-bars"></i>
</a>
<ul class="nav user-menu">
				
				<li class="nav-item dropdown has-arrow">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <span class="user-img"><img class="rounded-circle" src="../assets/img/profiles/user.png" width="31" alt="Soeng Souy"></span> </a>
					<div class="dropdown-menu">
						<div class="user-header">
							
							<div class="user-text">
								<h6><?php echo $_SESSION['fullname']; ?></h6>
								
							</div>
						</div>  
						<a  onclick="return confirm('Are You Sure want to Sign Out ?')" class="dropdown-item" href="../logout.php?logout">Logout</a> 
						</div>
				</li>
			</ul>




</div>


<div class="sidebar" id="sidebar">
<div class="sidebar-inner slimscroll">
<div id="sidebar-menu" class="sidebar-menu">
<ul>
<li>
<a href="index.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
</li>
<li class="list-divider"></li>
<li class="submenu"> 
	<a href="#"><i class="fas fa-suitcase"></i> <span> Transactions </span> <span class="menu-arrow"></span></a>
			<ul class="submenu_class" style="display: none;">
					<li><a href="all-trans.php"> All Transactions </a></li>
					<li><a href="add-trans.php"> New Transaction </a></li>
					<li><a href="trans-logs.php"> Transaction Log </a></li>
			</ul>
</li>
<li class="list-divider"></li>
<li class="submenu"> 
	<a href="#"><i class="fas fa-funnel-dollar"></i> <span> Balance top-up </span> <span class="menu-arrow"></span></a>
			<ul class="submenu_class" style="display: none;">
					<li><a href="balances_show.php"> Show Balances </a></li>
					
					
			</ul>
</li>

</ul>
</div>
</div>
</div>


<div class="page-wrapper">
<div class="content container-fluid">
<div class="page-header">

</div>
<div class="row">
<div class="col-sm-12">
<section class="pricing py-5">
<div class="container">
<div class="row  mt-5">

<div class="col-lg-3">
<div class="card mb-5 mb-lg-0">
<div class="card-body">
<h5 class="card-title text-muted text-uppercase text-center">Airtel Money</h5>
<h6 class="card-price text-center mt-3"><span class="period"></span>
</h6>
<hr>
<ul class="fa-ul">
<li><span class="fa-li"><i class="fas fa-weight"></i></span>Float balance</li>
<li class="text-primary font-weight-bold"><span class="fa-li"><i ></i></span><?php echo "Tsh ".number_format($float_airtel_money)."/="; ?>
</li>
<li><span class="fa-li"><i class="fas fa-weight"></i></span>Cash balance</li>
<li class="text-primary font-weight-bold"><span class="fa-li"><i ></i></span><?php echo "Tsh ".number_format($cash_airtel_money)."/="; ?>
</li>
<li><span class="fa-li"><i></i></span>
</li>
</ul>
<hr>
<ul class="fa-ul">
<li class="text-danger font-weight-bold"><?php echo "Total Tsh ".number_format($cash_airtel_money+$float_airtel_money)."/="; ?>
</li>
</u>

</div>
</div>
</div>

<div class="col-lg-3">
<div class="card mb-5 mb-lg-0">
<div class="card-body">
<h5 class="card-title text-muted text-uppercase text-center">Halopesa</h5>
<h6 class="card-price text-center mt-3"><span class="period"></span>
</h6>
<hr>
<ul class="fa-ul">
<li><span class="fa-li"><i class="fas fa-weight"></i></span>Float balance</li>
<li class="text-primary font-weight-bold"><span class="fa-li"><i ></i></span><?php echo "Tsh ".number_format($float_halopesa)."/="; ?>
</li>
<li><span class="fa-li"><i class="fas fa-weight"></i></span>Cash balance</li>
<li class="text-primary font-weight-bold"><span class="fa-li"><i ></i></span><?php echo "Tsh ".number_format($cash_halopesa)."/="; ?>
</li>
<li><span class="fa-li"><i></i></span>
</li>
</ul>
<hr>
<ul class="fa-ul">
<li class="text-warning font-weight-bold"><?php echo "Total Tsh ".number_format($cash_halopesa+$float_halopesa)."/="; ?>
</li>
</u>
</div>
</div>
</div>

<div class="col-lg-3">
<div class="card">
<div class="card-body">
<h5 class="card-title text-muted text-uppercase text-center">M-Pesa</h5>
<h6 class="card-price text-center mt-3"><span class="period"></span>
</h6>
<hr>
<ul class="fa-ul">
<li><span class="fa-li"><i class="fas fa-weight"></i></span>Float balance</li>
<li class="text-primary font-weight-bold"><span class="fa-li"><i ></i></span><?php echo "Tsh ".number_format($float_m_pesa)."/="; ?>
</li>
<li><span class="fa-li"><i class="fas fa-weight"></i></span>Cash balance</li>
<li class="text-primary font-weight-bold"><span class="fa-li"><i ></i></span><?php echo "Tsh ".number_format($cash_m_pesa)."/="; ?>
</li>
<li><span class="fa-li"><i></i></span>
</li>
</ul>
<hr>
<ul class="fa-ul">
<li class="text-danger font-weight-bold"><?php echo "Total Tsh ".number_format($cash_m_pesa+$float_m_pesa)."/="; ?>
</li>
</u>
</div>
</div>
</div>
<div class="col-lg-3">
<div class="card mb-5 mb-lg-0">
<div class="card-body">
<h5 class="card-title text-muted text-uppercase text-center">Tigopesa</h5>
<h6 class="card-price text-center mt-3"><span class="period"></span>
</h6>
<hr>
<ul class="fa-ul">
<li><span class="fa-li"><i class="fas fa-weight"></i></span>Float balance</li>
<li class="text-primary font-weight-bold"><span class="fa-li"><i ></i></span><?php echo "Tsh ".number_format($float_tigopesa)."/="; ?>
</li>
<li><span class="fa-li"><i class="fas fa-weight"></i></span>Cash balance</li>
<li class="text-primary font-weight-bold"><span class="fa-li"><i ></i></span><?php echo "Tsh ".number_format($cash_tigopesa)."/="; ?>
</li>
<li><span class="fa-li"><i></i></span>
</li>
</ul>
<hr>
<ul class="fa-ul">
<li class="text-primary font-weight-bold"><?php echo "Total Tsh ".number_format($cash_tigopesa+$float_tigopesa)."/="; ?>
</li>
</u>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
</div>
</div>

</div>


<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/plugins/raphael/raphael.min.js"></script>


<script src="../assets/js/script.js"></script>
</body>
</html>