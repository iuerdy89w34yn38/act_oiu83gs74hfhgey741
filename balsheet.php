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

						$rows =mysqli_query($con,"SELECT * FROM acts WHERE purpose ='cash' ORDER BY name" ) or die(mysqli_error($con));

						while($row=mysqli_fetch_array($rows)){

							$bsname = $row['name'];
							$bsbalance = $row['balance'];
							$bscash=$bscash+$bsbalance;
							?>
							<div class="row">
								<div class="col-sm-8">
									<center><h6><?php echo $bsname ?>:</h6></center>


								</div>
								<div class="col-sm-4">
									<center><h6><?php echo number_format($bsbalance)?></h6></center>

								</div>
							</div>
						<?php } ?>
						
						<div style="background: lightgrey;">
						<hr>
						<div class="row">
							<div class="col-sm-8">
								<strong> <center><h6 style="font-weight: 600">Current Assets:</h6></center></strong>
								

							</div>
							<div class="col-sm-4">
							<center><h6 style="font-weight: 600"><?php echo number_format($bscash)?></h6></center>
								

							</div>
						</div>
						<hr>
					</div>

						<?php

						$rows =mysqli_query($con,"SELECT * FROM customers WHERE balance>0 ORDER BY name" ) or die(mysqli_error($con));

						while($row=mysqli_fetch_array($rows)){

							$bsname = $row['name'];
							$bsbalance = $row['balance'];
							$bsar=$bsar+$bsbalance;
						}
							?>
							<div class="row">
								<div class="col-sm-8">
									<center><h6>Customers:</h6></center>


								</div>
								<div class="col-sm-4">
									<center><h6><?php echo number_format($bsar)?></h6></center>

								</div>
							</div>


						<div style="background: lightgrey;">
						<hr>
						<div class="row">
							<div class="col-sm-8">
								<strong> <center><h6 style="font-weight: 600">Accounts Recievables:</h6></center></strong>
								

							</div>
							<div class="col-sm-4">
							<center><h6 style="font-weight: 600"><?php echo number_format($bsar)?></h6></center>
								

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
									<center><h6><?php echo number_format($bsbalance)?></h6></center>

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
							<center><h6 style="font-weight: 600"><?php echo number_format($bsfasst)?></h6></center>
								

							</div>
						</div>
						<hr>
					</div>



					</div>

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
										<center><h6><?php echo number_format($bslib)?></h6></center>

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
										<center><h6><?php echo number_format($bsvend)?></h6></center>

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

									<center><h6 style="font-weight: 600"><?php echo number_format($bsap)?></h6></center>

								</div>
						    </div>
						    <hr>
						</div>

							<?php

							$rows =mysqli_query($con,"SELECT * FROM acts WHERE typeid =1 ORDER BY name" ) or die(mysqli_error($con));

							while($row=mysqli_fetch_array($rows)){

								$bsname = $row['name'];
								$bsbalance = $row['balance'];
								$bscapital=$bscapital+$bsbalance;
								?>
								<div class="row">
									<div class="col-sm-8">
										<center><h6><?php echo $bsname ?>:</h6></center>


									</div>
									<div class="col-sm-4">
										<center><h6><?php echo number_format($bsbalance)?></h6></center>

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

									<center><h6 style="font-weight: 600"><?php echo number_format($bscapital)?></h6></center>

								</div>
						    </div>
						    <hr>
						</div>

							<?php

							$rows =mysqli_query($con,"SELECT * FROM acts WHERE typeid =7 ORDER BY name" ) or die(mysqli_error($con));

							while($row=mysqli_fetch_array($rows)){

								$bsname = $row['name'];
								$bsbalance = $row['balance'];
								$bsdcap=$bsdcap+$bsbalance;
								?>
								<div class="row">
									<div class="col-sm-8">
										<center><h6><?php echo $bsname ?>:</h6></center>


									</div>
									<div class="col-sm-4">
										<center><h6><?php echo number_format($bsdcap)?></h6></center>

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

									<center><h6 style="font-weight: 600">-<?php echo number_format($bsdcap)?></h6></center>

								</div>
						    </div>
						    <hr>
						</div>

							

						<?php


						$bssales = 0;
						$bssalesr = 0;
						$bsnetsales = 0;
						$bscogs= 0;
						$bscogsr= 0;
						$bsnetcogs= 0;
						
						$rows =mysqli_query($con,"SELECT * FROM acts WHERE typeid =2 AND id!=200029  ORDER BY name" ) or die(mysqli_error($con));

						while($row=mysqli_fetch_array($rows)){



							$bsbalance = $row['balance'];
							$bssales=$bssales+$bsbalance;
						}
						$rows =mysqli_query($con,"SELECT * FROM acts WHERE id=200029  ORDER BY name" ) or die(mysqli_error($con));

						while($row=mysqli_fetch_array($rows)){


							$bssalesr = $row['balance'];
						}

						$bsnetsales = $bssales-$bssalesr;

						$rows =mysqli_query($con,"SELECT * FROM acts WHERE typeid =10 AND id!=200028  ORDER BY name" ) or die(mysqli_error($con));

						while($row=mysqli_fetch_array($rows)){


							$bsbalance = $row['balance'];
							$bscogs=$bscogs+$bsbalance;
						} 

						$rows =mysqli_query($con,"SELECT * FROM acts WHERE id=200028  ORDER BY name" ) or die(mysqli_error($con));

						while($row=mysqli_fetch_array($rows)){


							$bscogsr = $row['balance'];
						} 

						$bsnetcogs = $bscogs-$bscogsr;


						$rows =mysqli_query($con,"SELECT * FROM acts WHERE typeid =4  ORDER BY name" ) or die(mysqli_error($con));

						while($row=mysqli_fetch_array($rows)){


							$bsbalance = $row['balance'];
							$bsexpenses=$bsexpenses+$bsbalance;
						} 

						$bsgp=$bsnetsales-$bsnetcogs;
						$bsnetprofit=$bsgp-$bsexpenses;

						?>

							<div style="background: lightgrey;">
							<hr>
							<div class="row">

								<div class="col-sm-8">
									<center><h6 style="font-weight: 600">Net Income:</h6></center>


								</div>
								<div class="col-sm-4">

									<center><h6 style="font-weight: 600"><?php echo number_format($bsnetprofit)?></h6></center>

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
					$bslt=$bscapital-$bsdcap+$bsap+$bsnetprofit;
					 ?>


					<div class="col-sm-2">
					</div>
					<div class="col-sm-2">
						<center><h4  style="font-weight: 600">Total :</h4></center>
						

					</div>
					<div class="col-sm-2">
						<center><h4  style="font-weight: 600"><?php echo number_format($bsat)?></h4></center>


					</div>

					<div class="col-sm-2">
					</div>
					<div class="col-sm-2">
						<center><h4  style="font-weight: 600">Total :</h4></center>
						

					</div>
					<div class="col-sm-2">
						<center><h4  style="font-weight: 600"><?php echo number_format($bslt)?></h4></center>
						

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