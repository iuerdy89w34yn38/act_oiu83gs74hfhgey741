<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

<?php include"include/connect.php" ?>

<?php include"include/head.php" ?>



<title>Balance Sheet - <?php echo $comp_name ?>  </title>

<style type="text/css">
	hr {
	    margin-top: 12px;
	    margin-bottom: 12px;
	    border: 0;
	    border-top: 1px solid rgba(0, 0, 0, 0.4);
	}
	h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
	    margin-bottom: 0;

	    font-weight: 400;
	    line-height: 20px;
	    color: #33343a;
	}

	@media print{@page {size: landscape;} body {transform: scale(1);}

</style>


</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<?php $link="balsheet.php"; ;?>


<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
<div class="content-wrapper">
<div class="row">
<div class="col-sm-1">
</div>
<div class="col-sm-10">
	<div class="card card-fullscreen">
		<div class="card-header" style="padding-bottom: 0px;">
              <h4 class="card-title">&nbsp;</h4>
		  <div class="heading-elements">
		    <ul class="list-inline mb-0">
		      <li><a data-action="reload"><i class="la la-retweet"></i></a></li>
		      <li><a data-action="collapse"><i class="la la-minus"></i></a></li>
		      <li><a data-action="expand"><i class="la la-square-o"></i></a></li>
		      <li><a data-action="close"><i class="la la-close"></i></a></li>
		    </ul>
		  </div>
		</div>
		<div class="card-content expand collapse show">
			<div class="card-body">

				<div class="row">
					<div class="col-md-12">
						<h2>
							<center>Balance Sheet - Date:</center>


						</h2>
						<hr>


					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<h4>
							<center>Assets</center>
						</h4>
					</div>
					<div class="col-md-2">
						<h4>
							<center>Rs:</center>
						</h4>
					</div>
					<div class="col-md-4">
						<h4>
							<center>Liabilities + Capital</center>
						</h4>
					</div>
					<div class="col-md-2">
						<h4>
							<center>Rs.</center>
						</h4>
					</div>
				</div>
				<div class="row">

					<div class="col-sm-4">

						<hr>

					</div>
					<div class="col-sm-2">

						<hr>

					</div>

					<div class="col-sm-4">

						<hr>

					</div>
					<div class="col-sm-2">

						<hr>

					</div>
				</div>
				<div class="row">

					<?php

					$bsat = 0;
					$bslt = 0;

					$bssales = 0;
					$bssalesr = 0;
					$bsnetsales = 0;
					$bscogs= 0;
					$bscogsr= 0;
					$bsnetcogs= 0;

					$bsgp= 0;


					$bscapital = 0;
					$netprofit = 0;
					$bscash = 0;
					$bscasst = 0;
					$bsfasst = 0;
					$bsexpenses = 0;
					$bsexp = 0;
					$bsdcap = 0;
					$bslib = 0;
					$bsvend = 0;
					$bsap = 0;
					$bsar = 0;

					?>

					<div class="col-md-6">
						<?php
						
							$gtotal=0;
							$allrows =mysqli_query($con,"SELECT id,name FROM acts WHERE purpose='cash'  ORDER BY name" ) or die(mysqli_error($con));
							while($allrow=mysqli_fetch_array($allrows)){
								$actid = $allrow['id'];
								$actname = $allrow['name'];
								
								$tcr=0;
								$tdr=0;
								$total=0;
								$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid " ) or die(mysqli_error($con));

								while($row=mysqli_fetch_array($rows)){
									$cr = $row['cr'];
									$tcr=$tcr+$cr;
								} 
								$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid " ) or die(mysqli_error($con));
								
								while($row=mysqli_fetch_array($rows)){
									$dr = $row['dr'];
									$tdr=$tdr+$dr;
								} 
								$total=$tdr-$tcr;
								$bscash=$bscash+$total;
								?>


							<div class="row">
								<div class="col-sm-8">
									<center><h6><?php echo $actname ?>:</h6></center>


								</div>
								<div class="col-sm-4">
									<center><h6><?php echo number_format($total,$floating)?></h6></center>

								</div>
							</div>
						<?php } ?>

						<?php // For Inventory
						$bsinvt=0;

						$allrows =mysqli_query($con,"SELECT id,name,price FROM items ORDER BY name" ) or die(mysqli_error($con));
						while($allrow=mysqli_fetch_array($allrows)){
							$actid = $allrow['id'];
							$actname = $allrow['name'];
							$price = $allrow['price'];

							$tcr=0;
							$tdr=0;
							$tpdr=0;
							$total=0;

							$rows =mysqli_query($con,"SELECT quantity FROM itemslog WHERE pid=$actid AND type='in' ORDER BY id desc" ) or die(mysqli_error($con));
							$sales=0;
							while($row=mysqli_fetch_array($rows)){
								$cr = $row['quantity'];
								$tcr=$tcr+$cr;
							} 
							$rows =mysqli_query($con,"SELECT quantity FROM itemslog WHERE pid=$actid AND type='out' ORDER BY id desc" ) or die(mysqli_error($con));
							$salesr=0;
							while($row=mysqli_fetch_array($rows)){
								$dr = $row['quantity'];
								$tdr=$tdr+$dr;
							} 
							$rows =mysqli_query($con,"SELECT quantity FROM itemslog WHERE pid=$actid AND type='preturn' ORDER BY id desc" ) or die(mysqli_error($con));
							$salesr=0;
							while($row=mysqli_fetch_array($rows)){
								$dr = $row['quantity'];
								$tpdr=$tpdr+$dr;
							} 
							$total=$tcr-$tdr-$tpdr;
							$totalval=$total*$price;	
							$bsinvt=$bsinvt+$totalval;

							
							
							 }	
							 
								$bscash=$bscash+$bsinvt;
							 ?>

						<div class="row">
							<div class="col-sm-8">
								<center><h6>Total Inventory:</h6></center>


							</div>
							<div class="col-sm-4">
								<center><h6 style="text-decoration:;"><?php echo number_format($bsinvt,$floating)?></h6></center>

							</div>
						</div>
						
						<div style="background: lightgrey;">
						<hr>
						<div class="row">
							<div class="col-sm-8">
								<strong> <center><h6 style="font-weight: 600">Current Assets:</h6></center></strong>
								

							</div>
							<div class="col-sm-4">
							<center><h6 style="font-weight: 600"><?php echo number_format($bscash,$floating)?></h6></center>
								

							</div>
						</div>
						<hr>
					</div>



			<?php

			$bsar=0;
            $allrows =mysqli_query($con,"SELECT id,name,address,phone FROM customers ORDER BY name" ) or die(mysqli_error($con));
            while($allrow=mysqli_fetch_array($allrows)){
             $actid = $allrow['id'];
             $actname = $allrow['name'];
             $address = $allrow['address'];
             $phone = $allrow['phone'];
             
             $tcr=0;
             $tdr=0;
             $total=0;
             $rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid " ) or die(mysqli_error($con));

             while($row=mysqli_fetch_array($rows)){
               $cr = $row['cr'];
               $tcr=$tcr+$cr;
             } 
             $rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid " ) or die(mysqli_error($con));
             
             while($row=mysqli_fetch_array($rows)){
               $dr = $row['dr'];
               $tdr=$tdr+$dr;
             } 

             $total=$tdr-$tcr;
             if($total>0){
             $bsar=$bsar+$total;
		         
		         } 
		     }
     
						
							?>
							<div class="row">
								<div class="col-sm-8">
									<center><h6>Customers:</h6></center>


								</div>
								<div class="col-sm-4">
									<center><h6><?php echo number_format($bsar,$floating)?></h6></center>

								</div>
							</div>


						<div style="background: lightgrey;">
						<hr>
						<div class="row">
							<div class="col-sm-8">
								<strong> <center><h6 style="font-weight: 600">Accounts Recievables:</h6></center></strong>
								

							</div>
							<div class="col-sm-4">
							<center><h6 style="font-weight: 600"><?php echo number_format($bsar,$floating)?></h6></center>
								

							</div>
						</div>
						<hr>
					</div>



						<?php

						$rows =mysqli_query($con,"SELECT * FROM acts WHERE typeid =6 ORDER BY name" ) or die(mysqli_error($con));

						while($row=mysqli_fetch_array($rows)){

							$bsname = $row['name'];
							$bsbalance = $row['balance'];
							$bsfasst=$bsfasst+$bsbalance;
							?>
							<div class="row">
								<div class="col-sm-8">
									<center><h6><?php echo $bsname ?>:</h6></center>


								</div>
								<div class="col-sm-4">
									<center><h6><?php echo number_format($bsbalance,$floating)?></h6></center>

								</div>
							</div>
						<?php } ?>

						<div style="background: lightgrey;">
						<hr>
						<div class="row">
							<div class="col-sm-8">
								<strong> <center><h6 style="font-weight: 600">Fixed Assets:</h6></center></strong>
								

							</div>
							<div class="col-sm-4">
							<center><h6 style="font-weight: 600"><?php echo number_format($bsfasst,$floating)?></h6></center>
								

							</div>
						</div>
						<hr>
					</div>



					</div>

<!------------------------------------------------------------------------------------------------------------------------->

					<div class="col-md-6">

							<?php

							$rows =mysqli_query($con,"SELECT * FROM acts WHERE typeid =3 ORDER BY name" ) or die(mysqli_error($con));

							while($row=mysqli_fetch_array($rows)){

								$bsname = $row['name'];
								$bsbalance = $row['balance'];
								$bslib=$bslib+$bsbalance;
							}
								?>
								<div class="row">
									<div class="col-sm-8">
										<center><h6>Loans:</h6></center>


									</div>
									<div class="col-sm-4">
										<center><h6><?php echo number_format($bslib,$floating)?></h6></center>

									</div>
								</div>


							<?php

							$rows =mysqli_query($con,"SELECT * FROM vendors WHERE balance>0 ORDER BY name" ) or die(mysqli_error($con));

							while($row=mysqli_fetch_array($rows)){


								$bsbalance = $row['balance'];
								$bsvend=$bsvend+$bsbalance;
							}
								?>
								<div class="row">
									<div class="col-sm-8">
										<center><h6>Vendors Payments:</h6></center>


									</div>
									<div class="col-sm-4">
										<center><h6><?php echo number_format($bsvend,$floating)?></h6></center>

									</div>
								</div>


							<div style="background: lightgrey;">
							<hr>
							<div class="row">
								<?php $bsap=$bslib+$bsvend ?>
								<div class="col-sm-8">
									<center><h6 style="font-weight: 600">Total Accounts Payables:</h6></center>


								</div>
								<div class="col-sm-4">

									<center><h6 style="font-weight: 600"><?php echo number_format($bsap,$floating)?></h6></center>

								</div>
						    </div>
						    <hr>
						</div>

							<?php


								$gtotal=0;
								$allrows =mysqli_query($con,"SELECT id,name FROM acts WHERE  typeid =1 ORDER BY name" ) or die(mysqli_error($con));
								while($allrow=mysqli_fetch_array($allrows)){
									$actid = $allrow['id'];
									$actname = $allrow['name'];
									
									$tcr=0;
									$tdr=0;
									$bsbalance=0;
									$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid " ) or die(mysqli_error($con));

									while($row=mysqli_fetch_array($rows)){
										$cr = $row['cr'];
										$tcr=$tcr+$cr;
									} 
									$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid " ) or die(mysqli_error($con));
									
									while($row=mysqli_fetch_array($rows)){
										$dr = $row['dr'];
										$tdr=$tdr+$dr;
									} 

									$bsbalance=$tcr-$tdr;
									$bscapital=$bscapital+$bsbalance;
									


								?>
								<div class="row">
									<div class="col-sm-8">
										<center><h6><?php echo $actname ?>:</h6></center>


									</div>
									<div class="col-sm-4">
										<center><h6><?php echo number_format($bsbalance,$floating)?></h6></center>

									</div>
								</div>
							<?php } ?>
							<div style="background: lightgrey;">
							<hr>
							<div class="row">
								<div class="col-sm-8">
									<center><h6 style="font-weight: 600">Total Invested Capital:</h6></center>


								</div>
								<div class="col-sm-4">

									<center><h6 style="font-weight: 600"><?php echo number_format($bscapital,$floating)?></h6></center>

								</div>
						    </div>
						    <hr>
						</div>

							<?php
							

								$gtotal=0;
								$allrows =mysqli_query($con,"SELECT id,name FROM acts WHERE  typeid =7 ORDER BY name" ) or die(mysqli_error($con));
								while($allrow=mysqli_fetch_array($allrows)){
									$actid = $allrow['id'];
									$actname = $allrow['name'];
									
									$tcr=0;
									$tdr=0;
									$bsbalance=0;
									$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid " ) or die(mysqli_error($con));

									while($row=mysqli_fetch_array($rows)){
										$cr = $row['cr'];
										$tcr=$tcr+$cr;
									} 
									$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid " ) or die(mysqli_error($con));
									
									while($row=mysqli_fetch_array($rows)){
										$dr = $row['dr'];
										$tdr=$tdr+$dr;
									} 

									$bsbalance=$tdr-$tcr;
									
								$bsdcap=$bsdcap+$bsbalance;
								?>
								<div class="row">
									<div class="col-sm-8">
										<center><h6><?php echo $bsname ?>:</h6></center>


									</div>
									<div class="col-sm-4">
										<center><h6><?php echo number_format($bsdcap,$floating)?></h6></center>

									</div>
								</div>
							<?php } ?>
							<div style="background: lightgrey;">
							<hr>
							<div class="row">
								<div class="col-sm-8">
									<center><h6 style="font-weight: 600">Personal Drawings:</h6></center>


								</div>
								<div class="col-sm-4">

									<center><h6 style="font-weight: 600">-<?php echo number_format($bsdcap,$floating)?></h6></center>

								</div>
						    </div>
						    <hr>
						</div>

						<?php
						$netprofit = 0;
						$balance = 0;
						$sales = 0;
						$salesr = 0;
						$salesd = 0;
						$netsales = 0;
						$cogs= 0;
						$cogsr= 0;
						$cogsd= 0;
						$netcogs= 0;
						$expenses= 0;
						$gp= 0;

							$allrows =mysqli_query($con,"SELECT * FROM acts WHERE typeid =2 AND id!=200029  ORDER BY name" ) or die(mysqli_error($con));
							while($allrow=mysqli_fetch_array($allrows)){
								$actid = $allrow['id'];
								$actname = $allrow['name'];
								
								$tcr=0;
								$tdr=0;
								$total=0;

								$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid   ORDER BY id desc" ) or die(mysqli_error($con));
								while($row=mysqli_fetch_array($rows)){
									$cr = $row['cr'];
									$tcr=$tcr+$cr;
								} 
								$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid   ORDER BY id desc" ) or die(mysqli_error($con));
								while($row=mysqli_fetch_array($rows)){
									$dr = $row['dr'];
									$tdr=$tdr+$dr;
								} 
								$balance=$tdr-$tcr;	
								$sales=$sales+$balance;
							}
						

						$allrows =mysqli_query($con,"SELECT * FROM acts WHERE id=200029  ORDER BY name" ) or die(mysqli_error($con));
						while($allrow=mysqli_fetch_array($allrows)){
							$actid = $allrow['id'];
							$actname = $allrow['name'];
							
							$tcr=0;
							$tdr=0;
							$total=0;

							$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid   ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$cr = $row['cr'];
								$tcr=$tcr+$cr;
							} 
							$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid   ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$dr = $row['dr'];
								$tdr=$tdr+$dr;
							} 
							$balance=$tdr-$tcr;	
							$salesr=$salesr+$balance;
						}

						$allrows =mysqli_query($con,"SELECT * FROM acts WHERE id=200039  ORDER BY name" ) or die(mysqli_error($con));
						while($allrow=mysqli_fetch_array($allrows)){
							$actid = $allrow['id'];
							$actname = $allrow['name'];
							
							$tcr=0;
							$tdr=0;
							$total=0;

							$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid   AND ref=0  ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$cr = $row['cr'];
								$tcr=$tcr+$cr;
							} 
							$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid   AND ref=0  ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$dr = $row['dr'];
								$tdr=$tdr+$dr;
							} 
							$balance=$tdr-$tcr;	
							$salesd=$salesd+$balance;
						}

					
						$netsales1 = $sales-$salesr-$salesd;
						$netsales = abs($netsales1);

					

						$allrows =mysqli_query($con,"SELECT * FROM acts WHERE typeid =10 AND id!=200028  ORDER BY name" ) or die(mysqli_error($con));
						while($allrow=mysqli_fetch_array($allrows)){
							$actid = $allrow['id'];
							$actname = $allrow['name'];
							
							$tcr=0;
							$tdr=0;
							$total=0;

							$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid   ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$cr = $row['cr'];
								$tcr=$tcr+$cr;
							} 
							$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid   ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$dr = $row['dr'];
								$tdr=$tdr+$dr;
							} 
							$balance=$tdr-$tcr;	
							$cogs=$cogs+$balance;
						}



						$allrows =mysqli_query($con,"SELECT * FROM acts WHERE id=200028  ORDER BY name" ) or die(mysqli_error($con));
						while($allrow=mysqli_fetch_array($allrows)){
							$actid = $allrow['id'];
							$actname = $allrow['name'];
							
							$tcr=0;
							$tdr=0;
							$total=0;

							$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid   ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$cr = $row['cr'];
								$tcr=$tcr+$cr;
							} 
							$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid   ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$dr = $row['dr'];
								$tdr=$tdr+$dr;
							} 
							$balance=$tcr-$tdr;	
							$cogsr=$cogsr+$balance;
						}


						$allrows =mysqli_query($con,"SELECT * FROM acts WHERE id=200038  ORDER BY name" ) or die(mysqli_error($con));
						while($allrow=mysqli_fetch_array($allrows)){
							$actid = $allrow['id'];
							$actname = $allrow['name'];
							
							$tcr=0;
							$tdr=0;
							$total=0;

							$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid   AND ref=0 ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$cr = $row['cr'];
								$tcr=$tcr+$cr;
							} 
							$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid   AND ref=0 ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$dr = $row['dr'];
								$tdr=$tdr+$dr;
							} 
							$balance=$tcr-$tdr;	
							$cogsd=$cogsd+$balance;
						}




						$netcogs = $cogs-$cogsr-$cogsd;


								
								$rows =mysqli_query($con,"SELECT id,name FROM acts WHERE typeid =4  ORDER BY name" ) or die(mysqli_error($con));
								while($row=mysqli_fetch_array($rows)){
									$actid = $row['id'];
									$actname = $row['name'];
							
							
							$tcr=0;
							$tdr=0;


							$rowsx =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid   ORDER BY id desc" ) or die(mysqli_error($con));
							while($rowx=mysqli_fetch_array($rowsx)){
								$cr = $rowx['cr'];
								$tcr=$tcr+$cr;
							} 
							$rowsx =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid   ORDER BY id desc" ) or die(mysqli_error($con));
							while($rowx=mysqli_fetch_array($rowsx)){
								$dr = $rowx['dr'];
								$tdr=$tdr+$dr;
							} 
							$balance=$tdr-$tcr;	
							$expenses=$expenses+$balance;

						}


						$gp=$netsales-$netcogs;
						$netprofit=$gp-$expenses;
						
						?>


							<div style="background: lightgrey;">
							<hr>
							<div class="row">

								<div class="col-sm-8">
									<center><h6 style="font-weight: 600">Net Income:</h6></center>


								</div>
								<div class="col-sm-4">

									<center><h6 style="font-weight: 600"><?php echo number_format($netprofit,$floating)?></h6></center>

								</div>
						    </div>
						    <hr>
						</div>



					</div>
					

				</div>
				<hr>
				<div class="row">
					<?php
					$bsat=$bscash+$bsfasst+$bsar;
					$bslt=$bscapital-$bsdcap+$bsap+$netprofit;
					 ?>


					<div class="col-sm-2">
					</div>
					<div class="col-sm-2">
						<center><h4  style="font-weight: 600">Total :</h4></center>
						

					</div>
					<div class="col-sm-2">
						<center><h4  style="font-weight: 600"><?php echo number_format($bsat,$floating)?></h4></center>


					</div>

					<div class="col-sm-2">
					</div>
					<div class="col-sm-2">
						<center><h4  style="font-weight: 600">Total :</h4></center>
						

					</div>
					<div class="col-sm-2">
						<center><h4  style="font-weight: 600"><?php echo number_format($bslt,$floating)?></h4></center>
						

					</div>



				</div>
			</div>
		</div>

	</div>
</div>

</div>






</div>
</div>



<?php include"include/footer.php" ?>

</body>
</html>