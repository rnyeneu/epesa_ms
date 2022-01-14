<?php
//rnyeneu

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
		
	
	
		
    if(isset($_POST['submit'])){
	
		
        $trans_id = $_POST['trans_id'];
        $ttype = $_POST['ttype'];
        $tprovider = $_POST['tprovider'];
        $trans_date = $_POST['trans_date'];
        $amount = $_POST['amount'];
		
		
		
				
			
			

        //check if the transaction ID already exist
        if(isset($_POST['trans_id'])){
            $select = "SELECT transaction_id FROM transactions WHERE transaction_id='$trans_id'";
            $qr = mysqli_query($db, $select);
            if(mysqli_num_rows($qr) > 0 ){
				echo'<script type="text/javascript">
                     alert("Uhhh!, nothing was recorded, transaction ID exists");
                    </script>';
            }
			//Withdraw validation
			elseif($ttype == "Withdraw" && $cash_airtel_money < $amount && $tprovider == $mtandao1){
				echo'<script type="text/javascript">
                     alert("Uhhh!, you dont have enough Airtel Money cash balance!");
                    </script>';
			}elseif($ttype == "Withdraw" && $cash_halopesa < $amount && $tprovider == $mtandao2){
				
				echo'<script type="text/javascript">
                     alert("Uhhh!, you dont have enough Halopesa cash balance!");
                    </script>';
			}elseif($ttype == "Withdraw" && $cash_m_pesa < $amount && $tprovider == $mtandao3){
				
				echo'<script type="text/javascript">
                     alert("Uhhh!, you dont have enough M-Pesa cash balance!");
                    </script>';
			}elseif($ttype == "Withdraw" && $cash_tigopesa < $amount && $tprovider == $mtandao4){
				
				echo'<script type="text/javascript">
                     alert("Uhhh!, you dont have enough Tigopesa cash balance!");
                    </script>';
			}
			//Deposit Validation
			elseif($ttype == "Deposit" && $float_airtel_money < $amount && $tprovider == $mtandao1){
				echo'<script type="text/javascript">
                     alert("Uhhh!, you dont have enough Float in your Aitel Money account!");
                    </script>';
			}elseif($ttype == "Deposit" && $float_halopesa < $amount && $tprovider == $mtandao2){
				echo'<script type="text/javascript">
                     alert("Uhhh!, you dont have enough Float in your Halopesa account!");
                    </script>';
			}elseif($ttype == "Deposit" && $float_m_pesa < $amount && $tprovider == $mtandao3){
				echo'<script type="text/javascript">
                     alert("Uhhh!, you dont have enough Float in your M-Pesa account!");
                    </script>';
			}elseif($ttype == "Deposit" && $float_tigopesa < $amount && $tprovider == $mtandao4){
				echo'<script type="text/javascript">
                     alert("Uhhh!, you dont have enough Float in your Tigopesa account!");
                    </script>';
			}
			
			else{
				
				//withdrawing codes
			if($ttype == "Withdraw" && $tprovider == $mtandao1){
					
			$new_blc_af = $float_airtel_money + $amount;
			$new_blc_ac = $cash_airtel_money - $amount;
		
			$a = "UPDATE providers SET current_float = '$new_blc_af', current_cash = '$new_blc_ac' 
			WHERE p_name = '$mtandao1' ";
			$aa = mysqli_query($db, $a);
			}
			
			elseif($ttype == "Withdraw" && $tprovider == $mtandao2){
				
				$new_blc_hf = $float_halopesa + $amount;
				$new_blc_hc = $cash_halopesa - $amount;
		
			$b = "UPDATE providers SET current_float = '$new_blc_hf', current_cash = '$new_blc_hc' 
			WHERE p_name = '$mtandao2' ";
			$bb = mysqli_query($db, $b);
			}
			
			elseif($ttype == "Withdraw" && $tprovider == $mtandao3){
				
				$new_blc_mf = $float_m_pesa + $amount;
				$new_blc_mc = $cash_m_pesa - $amount;
		
			$c = "UPDATE providers SET current_float = '$new_blc_mf', current_cash = '$new_blc_mc' 
			WHERE p_name = '$mtandao3' ";
			$cc = mysqli_query($db, $c);
			}
			
			elseif($ttype == "Withdraw" && $tprovider == $mtandao4){
				
				$new_blc_tf = $float_tigopesa + $amount;
				$new_blc_tc = $cash_tigopesa - $amount;
		
			$d = "UPDATE providers SET current_float = '$new_blc_tf', current_cash = '$new_blc_tc' 
			WHERE p_name = '$mtandao4' ";
			$dd = mysqli_query($db, $d);
			}
			
			//Depositing codes
			
			elseif($ttype == "Deposit" && $tprovider == $mtandao1){
				
				$new_blc_af_d = $float_airtel_money - $amount;
				$new_blc_ac_d = $cash_airtel_money + $amount;
		
			$ad = "UPDATE providers SET current_float = '$new_blc_af_d', current_cash = '$new_blc_ac_d' 
			WHERE p_name = '$mtandao1' ";
			$aad = mysqli_query($db, $ad);
			}
			
			elseif($ttype == "Deposit" && $tprovider == $mtandao2){
				
				$new_blc_hf_d = $float_halopesa - $amount;
				$new_blc_hc_d = $cash_halopesa + $amount;
		
			$bd = "UPDATE providers SET current_float = '$new_blc_hf_d', current_cash = '$new_blc_hc_d' 
			WHERE p_name = '$mtandao2' ";
			$bbd = mysqli_query($db, $bd);
			}
			
			elseif($ttype == "Deposit" && $tprovider == $mtandao3){
				
				$new_blc_mf_d = $float_m_pesa - $amount;
				$new_blc_mc_d = $cash_m_pesa + $amount;
		
			$cd = "UPDATE providers SET current_float = '$new_blc_mf_d', current_cash = '$new_blc_mc_d' 
			WHERE p_name = '$mtandao3' ";
			$ccd = mysqli_query($db, $cd);
			}
			
			elseif($ttype == "Deposit" && $tprovider == $mtandao4){
				
				$new_blc_tf_d = $float_tigopesa - $amount;
				$new_blc_tc_d = $cash_tigopesa + $amount;
		
			$dd = "UPDATE providers SET current_float = '$new_blc_tf_d', current_cash = '$new_blc_tc_d' 
			WHERE p_name = '$mtandao4' ";
			$ddd = mysqli_query($db, $dd);
			}
			

                //insert query here
                $insert = "INSERT INTO transactions(id,transaction_id,trans_type,trans_provider,trans_date,amount) VALUES('', '$trans_id','$ttype','$tprovider','$trans_date','$amount')";
				$qry = mysqli_query($db, $insert) or die(mysqli_error);
				//$last_id = mysqli_insert_id($db);

			
                //if execution $insert
                if($qry){
					if($ttype == "Withdraw" && $tprovider == $mtandao1){
			$insert_logs = "INSERT INTO transactions_log (trans_type,trans_provider,amount,float_balance,cash_balance) VALUES ('$ttype','$tprovider','$amount','$new_blc_af','$new_blc_ac')";
			$query_logs_a1 = mysqli_query($db, $insert_logs);
					}
					
					elseif($ttype == "Withdraw" && $tprovider == $mtandao2){
			$insert_logs_1 = "INSERT INTO transactions_log (trans_type,trans_provider,amount,float_balance,cash_balance) VALUES ('$ttype','$tprovider','$amount','$new_blc_hf','$new_blc_hc')";
			$query_logs_a2 = mysqli_query($db, $insert_logs_1);
					}
					
					elseif($ttype == "Withdraw" && $tprovider == $mtandao3){
			$insert_logs_2 = "INSERT INTO transactions_log (trans_type,trans_provider,amount,float_balance,cash_balance) VALUES ('$ttype','$tprovider','$amount','$new_blc_mf','$new_blc_mc')";
			$query_logs_a3 = mysqli_query($db, $insert_logs_2);
					}
					
					elseif($ttype == "Withdraw" && $tprovider == $mtandao4){
			$insert_logs_3 = "INSERT INTO transactions_log (trans_type,trans_provider,amount,float_balance,cash_balance) VALUES ('$ttype','$tprovider','$amount','$new_blc_tf','$new_blc_tc')";
			$query_logs_a4 = mysqli_query($db, $insert_logs_3);
					}
					
					elseif($ttype == "Deposit" && $tprovider == $mtandao1){
			$insert_logs_4 = "INSERT INTO transactions_log (trans_type,trans_provider,amount,float_balance,cash_balance) VALUES ('$ttype','$tprovider','$amount','$new_blc_af_d','$new_blc_ac_d')";
			$query_logs_b1 = mysqli_query($db, $insert_logs_4);
					}
					
					elseif($ttype == "Deposit" && $tprovider == $mtandao2){
			$insert_logs_5 = "INSERT INTO transactions_log (trans_type,trans_provider,amount,float_balance,cash_balance) VALUES ('$ttype','$tprovider','$amount','$new_blc_hf_d','$new_blc_hc_d')";
			$query_logs_b2 = mysqli_query($db, $insert_logs_5);
					}
					
					elseif($ttype == "Deposit" && $tprovider == $mtandao3){
			$insert_logs_6 = "INSERT INTO transactions_log (trans_type,trans_provider,amount,float_balance,cash_balance) VALUES ('$ttype','$tprovider','$amount','$new_blc_mf_d','$new_blc_mc_d')";
			$query_logs_b3 = mysqli_query($db, $insert_logs_6);
					}
					
					elseif($ttype == "Deposit" && $tprovider == $mtandao4){
			$insert_logs_7 = "INSERT INTO transactions_log (trans_type,trans_provider,amount,float_balance,cash_balance) VALUES ('$ttype','$tprovider','$amount','$new_blc_tf_d','$new_blc_tc_d')";
			$query_logs_b4 = mysqli_query($db, $insert_logs_7);
					}
					
                    echo '<script type="text/javascript">
              alert("New transaction added successfully");
              </script>';
                
				
            }
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
				<a href="index.html" class="logo"> <!-- <img src="../assets/img/hotel_logo.png" width="50" height="70" alt="logo"> --> <span class="logoclass">e_PESA</span> </a>
				<a href="index.html" class="logo logo-small"> <span class="logoclass">e_PESA</span><!--<img src="assets/img/hotel_logo.png" alt="Logo" width="30" height="30">--> </a>
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
								<li><a class="active" href="add-trans.php"> New Transaction </a></li>
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
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title mt-5">Add New Transaction</h3> </div>
							
	
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<form method="post" action="" autocomplete="off">
							<div class="row formtype">
								<div class="col-md-4">
									<div class="form-group">
										<label>Transaction ID</label>
										<input  class="form-control" type="text" required="" name="trans_id"> </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Type</label>
										<select class="form-control" id="sel1"  required="" name="ttype">
											<option value="">Transaction type</option>
											<option value="Deposit">Deposit</option>
											<option value="Withdraw">Withdraw</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Provider</label>
										<select class="form-control" id="sel2"  required="" name="tprovider">
											<option value="">Select a provider</option>
											
											<?php
                                $slct = "SELECT * FROM providers";
								
                                $q = mysqli_query($db, $slct);
                                while($row = mysqli_fetch_assoc($q)){
                                    $p_name = $row['p_name'];
									
									
                                ?>
                                
                                    <option value="<?php echo $row['p_name']; ?>"><?php echo $row['p_name']; ?></option>
                                <?php
                                }
                                ?>

      
                                <option value="Airtel Super-Agent">Airtel Super-Agent</option>
                                <option value="Halopesa Super-Agent">Halopesa Super-Agent</option>
                                <option value="M-Pesa Super-Agent">M-Pesa Super-Agent</option>
                                <option value="Tigopesa Super-Agent">Tigopesa Super-Agent</option>


											
										</select>
									</div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Date</label>
										<div class="cal-icon">
											<input type="text" class="form-control datetimepicker" required="" name="trans_date"> </div>
									</div>
								</div>
								
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Amount</label>
										<input type="number" class="form-control" id="usr" required="" name="amount"> </div>
								</div>
							
							</div>
							<button type="submit" name="submit" class="btn btn-primary buttonedit1">Add Transaction</button>
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