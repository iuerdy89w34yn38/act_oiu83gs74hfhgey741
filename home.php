<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

<?php include"include/connect.php" ?>

<?php include"include/head.php" ?>




<title>Dashboard - <?php echo $comp_name ?>  </title>




</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<?php $link="index.php"; ;?>


<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
<div class="content-wrapper">
<?php if($userrole=='admin') { ?>
<div class="row">
	<div class="col-lg-4">
		<div class="card  pull-up">
			<div class="card-header">
				<h4 class="card-title">Monthly Net Profit</h4>
				<div class="heading-elements">
					<a href="pls.php" target="blank"> <i class="la la-external-link"></i></a>
				</div>
			</div>
			<div class="card-block">
				<div class="card-body">

					<div class="row">

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

					
							$gtotal=0;
							$lmonth = date('Y-m-d', strtotime(' -30 day'));
							$allrows =mysqli_query($con,"SELECT * FROM acts WHERE typeid =2 AND id!=200029  ORDER BY name" ) or die(mysqli_error($con));
							while($allrow=mysqli_fetch_array($allrows)){
								$actid = $allrow['id'];
								$actname = $allrow['name'];
								
								$tcr=0;
								$tdr=0;
								$total=0;

								$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
								while($row=mysqli_fetch_array($rows)){
									$cr = $row['cr'];
									$tcr=$tcr+$cr;
								} 
								$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
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

							$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$cr = $row['cr'];
								$tcr=$tcr+$cr;
							} 
							$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
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

							$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid AND datec>'$lmonth' AND ref=0  ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$cr = $row['cr'];
								$tcr=$tcr+$cr;
							} 
							$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid AND datec>'$lmonth' AND ref=0  ORDER BY id desc" ) or die(mysqli_error($con));
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

							$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$cr = $row['cr'];
								$tcr=$tcr+$cr;
							} 
							$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
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

							$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$cr = $row['cr'];
								$tcr=$tcr+$cr;
							} 
							$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
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

							$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid AND datec>'$lmonth' AND ref=0 ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$cr = $row['cr'];
								$tcr=$tcr+$cr;
							} 
							$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid AND datec>'$lmonth' AND ref=0 ORDER BY id desc" ) or die(mysqli_error($con));
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


							$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$cr = $row['cr'];
								$tcr=$tcr+$cr;
							} 
							$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
							while($row=mysqli_fetch_array($rows)){
								$dr = $row['dr'];
								$tdr=$tdr+$dr;
							} 
							$balance=$tdr-$tcr;	
							$expenses=$expenses+$balance;

						}


						$gp=$netsales-$netcogs;
						$netprofit=$gp-$expenses;
						?>


						<div class="col-sm-12">
							
							<!-- 
							<center><h1>Net Profit:</h1></center>
							<hr>
							<center><h4> Sales: <?php echo $sales ?></h4></center>
							<center><h4> Sales Return: <?php echo $salesr ?></h4></center>
							<hr>
							<center><h4> Net Sales : <?php echo $netsales ?></h4></center>

							<center><h4> COGS Balance: <?php echo $netcogs ?></h4></center>
							<hr>
							<center><h4> Gross Profit: <?php echo $gp ?></h4></center>
							
							<center><h4> Expenses Balance: <?php echo $expenses ?></h4></center>
							<hr>
						-->

						<center><h2> Net Profit: Rs. <?php echo number_format($netprofit) ?>/-</h2></center>

					</div>



				</div>
			</div>
		</div>

	</div>

	<div class="card pull-up">
		<div class="card-content">
			<div class="card-body">
				<div class="media d-flex">
					<div class="media-body text-left">
						<?php // Overall - For all types of Account from Ledger by account type
						$vendpay=0;
						$allrows =mysqli_query($con,"SELECT id,name FROM vendors ORDER BY name" ) or die(mysqli_error($con));
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
							if($total>0){
							$vendpay=$vendpay+$total;
							

							?>
						<?php } } ?>

						<?php // Overall - For all types of Account from Ledger by account type
						
						$allrows =mysqli_query($con,"SELECT id,name FROM customers ORDER BY name" ) or die(mysqli_error($con));
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
							if($total>0){
							$vendpay=$vendpay+$total;
							

							?>
						<?php } } ?>


						<h4 class="text-muted">Accounts Receiveables
							<a href="recsale.php" target="blank"> <i class="la la-external-link warning"></i></a>
						</h4>



						<br>
						<h3>Rs.<?php echo number_format($vendpay) ?>/-</h3>
					</div>
					<div class="align-self-center">
						<i class="la la-industry warning font-large-2 float-right"></i>
					</div>
					
				</div>
			</div>
		</div>
	</div>


	<div class="card pull-up">
		<div class="card-content">
			<div class="card-body">
				<div class="media d-flex">
					<div class="media-body text-left">
					
					<?php // Overall - For all types of Account from Ledger by account type
					$vendpay=0;
					$allrows =mysqli_query($con,"SELECT id,name FROM vendors ORDER BY name" ) or die(mysqli_error($con));
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

						$total=$tcr-$tdr;
						if($total>0){
						$vendpay=$vendpay+$total;
						

						?>
					<?php } } ?>

					<?php // Overall - For all types of Account from Ledger by account type
				
					$allrows =mysqli_query($con,"SELECT id,name FROM customers ORDER BY name" ) or die(mysqli_error($con));
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

						$total=$tcr-$tdr;
						if($total>0){
						$vendpay=$vendpay+$total;
						

						?>
					<?php } } ?>


						<h4 class="text-muted">Accounts Payables
							<a href="paypur.php" target="blank"> <i class="la la-external-link warning"></i></a>

						</h4>
						<br>
						<h3>Rs.<?php echo number_format($vendpay) ?>/-</h3>
					</div>
					<div class="align-self-center">
						<i class="la la-industry warning font-large-2 float-right"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<?php $lmonth = date('Y-m-d', strtotime(' -30 day')); ?>

<div class="col-lg-4">

	<?php 

	$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=200019 AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
	$sales=0;
	while($row=mysqli_fetch_array($rows)){

		$cr = $row['cr'];
		$sales=$sales+$cr;
	} 

	$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=200029 AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
	$salesr=0;
	while($row=mysqli_fetch_array($rows)){

		$dr = $row['dr'];
		$salesr=$salesr+$dr;
	} 

	$netsales=$sales-$salesr;

	?>
	<div class="card pull-up">

		<div class="card-content">
			<div class="card-body">
				<div class="media d-flex">
					<div class="media-body text-left">
						<h6 class="text-muted">Monthly Net Sales 
							<a href="genled.php" target="blank"> <i class="la la-external-link success"></i></a>

						</h6> 
						<br>
						<h3>Rs.<?php echo number_format($netsales) ?>/-</h3>
					</div>
					<div class="align-self-center">
						<i class="la la-codepen success font-large-2 float-right"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php 

	$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=200018 AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
	$sales=0;
	while($row=mysqli_fetch_array($rows)){

		$dr = $row['dr'];
		$sales=$sales+$dr;
	} 

	$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=200028 AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
	$salesr=0;
	while($row=mysqli_fetch_array($rows)){

		$cr = $row['cr'];
		$salesr=$salesr+$cr;
	} 

	$netsales=$sales-$salesr;

	?>
	<div class="card pull-up">
		<div class="card-content">
			<div class="card-body">
				<div class="media d-flex">
					<div class="media-body text-left">
						<h6 class="text-muted">Monthly Net Purchases
							<a href="genled.php" target="blank"> <i class="la la-external-link warning"></i></a>

						</h6>
						<br>
						<h3>Rs.<?php echo number_format($netsales) ?>/-</h3>
					</div>
					<div class="align-self-center">
						<i class="la la-industry warning font-large-2 float-right"></i>
					</div>
				</div>
			</div>
		</div>
	</div>



	<?php 



	$rows =mysqli_query($con,"SELECT dr FROM journal WHERE typeid=4 AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
	$salesr=0;
	while($row=mysqli_fetch_array($rows)){

		$dr = $row['dr'];
		$salesr=$salesr+$dr;
	} 


	?>
	<div class="card pull-up">
		<div class="card-content">
			<div class="card-body">
				<div class="media d-flex">
					<div class="media-body text-left">
						<h6 class="text-muted">Monthly Expenses
							<a href="expr.php" target="blank"> <i class="la la-external-link danger"></i></a>

						</h6>
						<br>
						<h3>Rs.<?php echo number_format($salesr) ?>/-</h3>
					</div>
					<div class="align-self-center">
						<i class="la la-dollar danger font-large-2 float-right"></i>
					</div>
				</div>
			</div>
		</div>
	</div>





</div>



<div class="col-lg-4">
	<div class="card pull-up">
		<div class="card-content">
			<div class="card-body">
				<div class="media d-flex">
					<div class="media-body text-left" style="padding-right: 20px;">
						<h6 class="text-muted">Current Cash Status
							<a href="addcash.php" target="blank"> <i class="la la-external-link primary"></i></a>

						</h6>
						<br>


						<?php // Overall - For all types of Account from Ledger by account type
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
							$gtotal=$gtotal+$total;
							?>

							<h4><?php echo $actname ?>: 
								<span style="text-align: right;">Rs. <?php echo number_format($total);   ?>/- </span></h4>
								<hr>

						<?php } ?>
			

							<h3>Total : Rs. <?php echo number_format($gtotal) ?>/-</h3>


						</div>
						<div class="align-self-center">
							<i class="la la-money primary font-large-2 float-right"></i>
						</div>
					</div>
				</div>
			</div>
		</div>


		<?php // For Inventory
		$gtotal=0;

		$allrows =mysqli_query($con,"SELECT id,name FROM items ORDER BY name" ) or die(mysqli_error($con));
		while($allrow=mysqli_fetch_array($allrows)){
			$actid = $allrow['id'];
			$actname = $allrow['name'];

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
			$gtotal=$gtotal+$total;
			
			 }	

			 ?>
	




		<div class="card pull-up">
			<div class="card-content">
				<div class="card-body">
					<div class="media d-flex">
						<div class="media-body text-left">
							<h6 class="text-muted">Stock Inventory
								<a href="viewitems.php" target="blank"> <i class="la la-external-link "></i></a>

							</h6>
							<br>
							<h3>Total <?php echo number_format($gtotal) ?> Items</h3>
						</div>
						<div class="align-self-center">
							<i class="la la-cubes  font-large-2 float-right"></i>
						</div>
					</div>
				</div>
			</div>
		</div>






	</div>



</div>


<?php }else{?>
	<div class="row">



	<?php $lmonth = date('Y-m-d', strtotime(' -30 day')); ?>

	<div class="col-lg-6">

		<?php 

		$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=200019 AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
		$sales=0;
		while($row=mysqli_fetch_array($rows)){

			$cr = $row['cr'];
			$sales=$sales+$cr;
		} 

		$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=200029 AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
		$salesr=0;
		while($row=mysqli_fetch_array($rows)){

			$dr = $row['dr'];
			$salesr=$salesr+$dr;
		} 

		$netsales=$sales-$salesr;

		?>
		<div class="card pull-up">

			<div class="card-content">
				<div class="card-body">
					<div class="media d-flex">
						<div class="media-body text-left">
							<h6 class="text-muted">Monthly Net Sales 
								<a href="genled.php" target="blank"> <i class="la la-external-link success"></i></a>

							</h6> 
							<br>
							<h3>Rs.<?php echo number_format($netsales) ?>/-</h3>
						</div>
						<div class="align-self-center">
							<i class="la la-codepen success font-large-2 float-right"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php 

		$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=200018 AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
		$sales=0;
		while($row=mysqli_fetch_array($rows)){

			$dr = $row['dr'];
			$sales=$sales+$dr;
		} 

		$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=200028 AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
		$salesr=0;
		while($row=mysqli_fetch_array($rows)){

			$cr = $row['cr'];
			$salesr=$salesr+$cr;
		} 

		$netsales=$sales-$salesr;

		?>
		<div class="card pull-up">
			<div class="card-content">
				<div class="card-body">
					<div class="media d-flex">
						<div class="media-body text-left">
							<h6 class="text-muted">Monthly Net Purchases
								<a href="genled.php" target="blank"> <i class="la la-external-link warning"></i></a>

							</h6>
							<br>
							<h3>Rs.<?php echo number_format($netsales) ?>/-</h3>
						</div>
						<div class="align-self-center">
							<i class="la la-industry warning font-large-2 float-right"></i>
						</div>
					</div>
				</div>
			</div>
		</div>



		<?php 



		$rows =mysqli_query($con,"SELECT dr FROM journal WHERE typeid=4 AND datec>'$lmonth' ORDER BY id desc" ) or die(mysqli_error($con));
		$salesr=0;
		while($row=mysqli_fetch_array($rows)){

			$dr = $row['dr'];
			$salesr=$salesr+$dr;
		} 


		?>
		<div class="card pull-up">
			<div class="card-content">
				<div class="card-body">
					<div class="media d-flex">
						<div class="media-body text-left">
							<h6 class="text-muted">Monthly Expenses
								<a href="expr.php" target="blank"> <i class="la la-external-link danger"></i></a>

							</h6>
							<br>
							<h3>Rs.<?php echo number_format($salesr) ?>/-</h3>
						</div>
						<div class="align-self-center">
							<i class="la la-dollar danger font-large-2 float-right"></i>
						</div>
					</div>
				</div>
			</div>
		</div>





	</div>



	<div class="col-lg-6">
		<div class="card pull-up">
			<div class="card-content">
				<div class="card-body">
					<div class="media d-flex">
						<div class="media-body text-left" style="padding-right: 20px;">
							<h6 class="text-muted">Current Cash Status
								<a href="addcash.php" target="blank"> <i class="la la-external-link primary"></i></a>

							</h6>
							<br>


							<?php // Overall - For all types of Account from Ledger by account type
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
								$gtotal=$gtotal+$total;
								?>

								<h4><?php echo $actname ?>: 
									<span style="text-align: right;">Rs. <?php echo number_format($total);   ?>/- </span></h4>
									<hr>

							<?php } ?>
				

								<h3>Total : Rs. <?php echo number_format($gtotal) ?>/-</h3>


							</div>
							<div class="align-self-center">
								<i class="la la-money primary font-large-2 float-right"></i>
							</div>
						</div>
					</div>
				</div>
			</div>


			<?php // For Inventory
			$gtotal=0;

			$allrows =mysqli_query($con,"SELECT id,name FROM items ORDER BY name" ) or die(mysqli_error($con));
			while($allrow=mysqli_fetch_array($allrows)){
				$actid = $allrow['id'];
				$actname = $allrow['name'];

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
				$gtotal=$gtotal+$total;
				
				 }	?>
		




			<div class="card pull-up">
				<div class="card-content">
					<div class="card-body">
						<div class="media d-flex">
							<div class="media-body text-left">
								<h6 class="text-muted">Stock Inventory
									<a href="viewitems.php" target="blank"> <i class="la la-external-link "></i></a>

								</h6>
								<br>
								<h3>Total <?php echo number_format($gtotal) ?> Items</h3>
							</div>
							<div class="align-self-center">
								<i class="la la-cubes  font-large-2 float-right"></i>
							</div>
						</div>
					</div>
				</div>
			</div>








<?php } ?>

</div>
</div>



<?php include"include/footer.php" ?>

</body>
</html>
<?php include"include/backup.php" ?>


