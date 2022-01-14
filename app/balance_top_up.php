<?php
  include('../db/connect_db.php');
   session_start();
	$get_id = $_GET['id'];
 if(!isset($_SESSION['user_id'])){
	header("location: ../index.php");
}
	

	
		//rnyeneu pn ooo
    if(isset($_POST['submit'])){
	
		
        
        $ttype = $_POST['ttype'];
        //$tprovider = $_POST['tprovider'];
        $amount = $_POST['amount'];
		
		
        
            $select = "SELECT * FROM providers WHERE p_id='$get_id'";
            $qr = mysqli_query($db, $select);
            $row_ = mysqli_fetch_assoc($qr);
			$float_ = $row_['current_float'];
			$cash_ = $row_['current_cash'];
			$pname = $row_['p_name'];
          
			//Withdraw validation
			if($ttype == "Withdraw" && $cash_ < $amount ){
				echo'<script type="text/javascript">
                     alert("Uhhh!, you dont have enough Money cash balance!");
                    </script>';
			}

			//Deposit Validation
			elseif($ttype == "Deposit" && $float_ < $amount ){
				echo'<script type="text/javascript">
                     alert("Uhhh!, you dont have enough Float in your account!");
                    </script>';
			}
			
			else{
				
				//withdrawing codes
			if($ttype == "Withdraw" ){
					
			$new_f_blc_w = $float_ - $amount;
			$new_c_blc_w = $cash_ + $amount;
		
			$a = "UPDATE providers SET current_float = '$new_f_blc_w', current_cash = '$new_c_blc_w' 
			WHERE p_id = '$get_id' ";
			$aa = mysqli_query($db, $a);
			}

			//Depositing codes
			if($ttype == "Deposit" ){
					
			$new_f_blc_d = $float_ + $amount;
			$new_c_blc_d = $cash_ - $amount;
		
			$e = "UPDATE providers SET current_float = '$new_f_blc_d', current_cash = '$new_c_blc_d' 
			WHERE p_id = '$get_id' ";
			$ee = mysqli_query($db, $e);
			}
			
			
			//Depositing codes for New amount
			
			elseif($ttype == "New Float"){
		
			$b = "UPDATE providers SET current_float = '$new_f_blc_d' WHERE p_id = '$get_id' ";
			$bb = mysqli_query($db, $b);
			}
			
			elseif($ttype == "New Cash"){
		
			$c = "UPDATE providers SET current_cash = '$new_c_blc_w' WHERE p_id = '$get_id' ";
			$cc = mysqli_query($db, $c);
			}
			
			
                //insert query here
                $insert = "INSERT INTO transactions (id, transaction_id,trans_type,trans_provider, trans_date,amount, time_added) VALUES('',Null,'$ttype',
                '$pname',null,'$amount','')";
				$qry = mysqli_query($db, $insert);

			
                //if execution $insert
                if($qry){

					if($ttype == "Withdraw"){
			$insert_logs = "INSERT INTO transactions_log (trans_type,trans_provider,amount,float_balance,cash_balance) VALUES ('$ttype','$pname',
			'$amount','$new_f_blc_w','$new_c_blc_w')";
			$query_logs_a1 = mysqli_query($db, $insert_logs);
					}
					
					
					elseif($ttype == "Deposit" ){
			$insert_logs_4 = "INSERT INTO transactions_log (trans_type,trans_provider,amount,float_balance,cash_balance) VALUES ('$ttype','$pname',
			'$amount','$new_f_blc_d','$new_c_blc_d')";
			$query_logs_b2 = mysqli_query($db, $insert_logs_4);
					}
				
				elseif($ttype == "New Float" ){
			$insert_logs_5 = "INSERT INTO transactions_log (trans_type,trans_provider,amount,float_balance,cash_balance) VALUES ('$ttype','$pname',
			'$amount','$new_f_blc_d','$cash_')";
			$query_logs_b3 = mysqli_query($db, $insert_logs_5);
					}

					elseif($ttype == "New Cash"){
			$insert_logs_6 = "INSERT INTO transactions_log (trans_type,trans_provider,amount,float_balance,cash_balance) VALUES ('$ttype','$pname',
			'$amount','$float_','$new_c_blc_w')";
			$query_logs_b4 = mysqli_query($db, $insert_logs_6);
					}
						
			
					
                    echo '<script type="text/javascript">
              alert("New transaction added successfully");
              </script>';
                
				
            }
				}
        
    
		
	}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>e_PESA Management System</title>
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="../assets/css/feathericon.min.css">
	<link rel="stylesheet" href="../assets/plugins/morris/morris.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="../assets/css/style.css"> </head>

<body>
	<div class="main-wrapper">
		<div class="header">
			<div class="header-left">
				<a href="index.php" class="logo"> <!-- <img src="../assets/img/hotel_logo.png" width="50" height="70" alt="logo"> --> <span class="logoclass">e_PESA</span> </a>
				<a href="index.php" class="logo logo-small"> <span class="logoclass">e_PESA</span><!--<img src="assets/img/hotel_logo.png" alt="Logo" width="30" height="30">--> </a>
			</div>
			<a href="javascript:void(0);" id="toggle_btn"> <i class="fe fe-text-align-left"></i> </a>
			<a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
			
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
								<li><a href="trans-logs.php"> Transaction Log </a></li>
							</ul>
						</li>
						<li class="list-divider"></li>
<li class="submenu"> 
	<a href="#"><i class="fas fa-funnel-dollar"></i> <span> Balance top-up </span> <span class="menu-arrow"></span></a>
			<ul class="submenu_class" style="display: none;">
					<li><a  href="balances_show.php"> Show Balances </a></li>
					
					
			</ul>
						
						
					</ul>
				</div>
			</div>
		</div>

		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h6 class="page-title mt-5 text-primary">Accounts top-up (<i>Withdraw = Cash top-up</i>) & (<i>Deposit = Float top-up</i>)</h6> </div>
							
	
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<form  method="post" action="" autocomplete="off">
							<div class="row formtype">
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Type</label>
										<select class="form-control" id="sel1"  required="" name="ttype">
											<option value="">Transaction type</option>
											<option value="New Float">Add New FLoat</option>
											<option value="New Cash">Add New Cash</option>
										</select>
									</div>
								</div>
								
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Amount</label>
										<input type="text" class="form-control" id="usr" required="" name="amount"> </div>
								</div>
								
							
							
							</div>
							<button type="reset" name="submit" class="btn btn-primary buttonedit1">Process</button>
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<script src="../assets/js/jquery-3.5.1.min.js"></script>
	<script src="../assets/js/popper.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/moment.min.js"></script>
	<script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
	<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/plugins/raphael/raphael.min.js"></script>
	<script src="../assets/js/script.js"></script>
	<script>
	$(function() {
		$('#datetimepicker3').datetimepicker({
			format: 'LT'
		});
	});
	</script>
</body>

</html>