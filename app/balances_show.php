<?php
//rnyeneuhhh
 include('../db/connect_db.php');
  session_start();
 if(!isset($_SESSION['user_id'])){
	header("location: ../index.php");
}
 $select = "SELECT * FROM providers ORDER BY p_id ASC";
 $query  = mysqli_query($db, $select);
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
	<link rel="stylesheet" href="../assets/plugins/datatables/datatables.min.css">
	<link rel="stylesheet" href="../assets/css/feathericon.min.css">
	<link rel="stylesheet" href="../assets/plugins/morris/morris.css">
	<link rel="stylesheet" href="../assets/css/style.css"> </head>

<body>
	<div class="main-wrapper">
		<div class="header">
			<div class="header-left">
				<a href="index.php" class="logo"> <!--<img src="../assets/img/hotel_logo.png" width="50" height="70" alt="logo">--> <span class="logoclass">e_PESA</span> </a>
				<a href="index.php" class="logo logo-small"> <span class="logoclass">e_PESA</span><!--<img src="../assets/img/hotel_logo.png" alt="Logo" width="30" height="30">--> </a>
			</div>
			<a href="javascript:void(0);" id="toggle_btn"> <i class="fe fe-text-align-left"></i> </a>
			<a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
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
						<li> <a href="index.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
						<li class="list-divider"></li>
						<li class="submenu"> <a href="#"><i class="fas fa-suitcase"></i> <span> Transactions </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="all-trans.php"> All Transactions </a></li>
								<li><a href="add-trans.php"> New Transaction </a></li>
								<li><a href="trans-logs.php"> Transaction log</a></li>
							</ul>
						</li>
						<li class="list-divider"></li>
<li class="submenu"> 
	<a href="#"><i class="fas fa-funnel-dollar"></i> <span> Balance top-up </span> <span class="menu-arrow"></span></a>
			<ul class="submenu_class" style="display: none;">
					<li><a class="active" href="balances_show.php"> Show Balances </a></li>
					
					
			</ul>
</li>
						
					</ul>
				</div>
			</div>
		</div>

		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<div class="mt-5">
								<h4 class="card-title float-left mt-2">Current Balance for each Provider</h4>
                                
                            </div>
						</div>
					</div>
				</div>
				
					<div class="col-sm-12">
						<div class="card">
						
							<div class="card-body">
<div class="table-responsive">
<table class="table table-nowrap mb-0">
<thead>
<tr>
<th>#</th>
<th>Provider Name</th>
<th>Float balance</th>
<th>Cash Balance</th>
<th>Action</th>
</tr>
</thead>
<tbody>
	
<?php
$count = 0;
while($row = mysqli_fetch_assoc($query)){
	$id = $row['p_id'];
$count++;												
?>
<tr>
<td><?php echo $count; ?></td>
<td align=""><?php echo $row['p_name']; ?></td>
<td align=""><?php echo $row['current_float']; ?></td>
<td align=""><?php echo $row['current_cash']; ?></td>
												
<td class="text-right">
<div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i></a>
<div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="balance_top_up.php<?php echo '?id='.$id; ?>"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a> 
</div>

</div>
</td>
</tr>
<?php
}
?>

</tbody>
</table>
</div>
</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	
	<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	<script src="../assets/js/jquery-3.5.1.min.js"></script>
	<script src="../assets/js/popper.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="../assets/plugins/datatables/datatables.min.js"></script>
	<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/plugins/raphael/raphael.min.js"></script>
	<script src="../assets/js/script.js"></script>
</body>

</html>