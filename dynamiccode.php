<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

	<?php include"include/connect.php" ?>

	<?php include"include/head.php" ?>

	<title>DYnamic Code Test - <?php echo $comp_name ?>  </title>

	
</head>

<body>
	<br>
	<center><strong>Overall - For Single Account from Ledger </strong></center>
	<br>

<?php // Overall - For Single Account from Ledger 

	$rows =mysqli_query($con,"SELECT id,name FROM acts WHERE id=200016  ORDER BY name" ) or die(mysqli_error($con));

	while($row=mysqli_fetch_array($rows)){

		$actid = $row['id'];
		$actname = $row['name'];
	}

	$tcr=0;
	$tdr=0;
	$total=0;

	$rows =mysqli_query($con,"SELECT cr FROM ledger WHERE actid=$actid " ) or die(mysqli_error($con));


	while($row=mysqli_fetch_array($rows)){

		$cr = $row['cr'];
		$tcr=$tcr+$cr;
	} 

	$rows =mysqli_query($con,"SELECT dr FROM ledger WHERE actid=$actid " ) or die(mysqli_error($con));
	

	while($row=mysqli_fetch_array($rows)){

		$dr = $row['dr'];
		$tdr=$tdr+$dr;
	} 

	$total=$tdr-$tcr;

?>
<center> <h2><?php echo $actname ?> = <?php echo number_format($total) ?></h2></center>

	<hr>

	
	<br>
	<center><strong>Overall - For all types of Account from Ledger by account type </strong></center>
	<br>


<?php // Overall - For all types of Account from Ledger by account type

	$gtotal=0;

	$allrows =mysqli_query($con,"SELECT id,name FROM acts WHERE typeid=5  ORDER BY name" ) or die(mysqli_error($con));

	while($allrow=mysqli_fetch_array($allrows)){

		$actid = $allrow['id'];
		$actname = $allrow['name'];
	

	$tcr=0;
	$tdr=0;
	$total=0;

	$rows =mysqli_query($con,"SELECT cr FROM ledger WHERE actid=$actid " ) or die(mysqli_error($con));


	while($row=mysqli_fetch_array($rows)){

		$cr = $row['cr'];
		$tcr=$tcr+$cr;
	} 

	$rows =mysqli_query($con,"SELECT dr FROM ledger WHERE actid=$actid " ) or die(mysqli_error($con));
	

	while($row=mysqli_fetch_array($rows)){

		$dr = $row['dr'];
		$tdr=$tdr+$dr;
	} 

	$total=$tdr-$tcr;
	$gtotal=$gtotal+$total;

?>
<center> <h2><?php echo $actname ?> = <?php echo number_format($total) ?></h2></center>

<?php } ?>

<center> <h2>Grand Total = <?php echo number_format($gtotal) ?></h2></center>

	<hr>

		<br>
		<center><strong>Overall - For All Customers / Vendors Accounts from Ledger </strong></center>
		<br>

	<?php // Overall - For Customers / Vendors Account from Ledger 

	$gtotal=0;

		$allrows =mysqli_query($con,"SELECT * FROM customers  ORDER BY name" ) or die(mysqli_error($con));

		while($allrow=mysqli_fetch_array($allrows)){

			$actid = $allrow['id'];
			$actname = $allrow['name'];
		

		$tcr=0;
		$tdr=0;
		$total=0;

		$rows =mysqli_query($con,"SELECT cr FROM ledger WHERE actid=$actid " ) or die(mysqli_error($con));


		while($row=mysqli_fetch_array($rows)){

			$cr = $row['cr'];
			$tcr=$tcr+$cr;
		} 

		$rows =mysqli_query($con,"SELECT dr FROM ledger WHERE actid=$actid " ) or die(mysqli_error($con));
		

		while($row=mysqli_fetch_array($rows)){

			$dr = $row['dr'];
			$tdr=$tdr+$dr;
		} 

		$total=$tdr-$tcr;	
	$gtotal=$gtotal+$total;

	?>

	<center> <h2><?php echo $actname ?> = <?php echo number_format($total) ?></h2></center>

		
	<?php }	?>
		<center> <h2>Grand Total = <?php echo number_format($gtotal) ?></h2></center>


		<hr>

		<br>
		<center><strong>Overall - For All Customers / Vendors Accounts from Ledger </strong></center>
		<br>

	<?php // Overall - For Customers / Vendors Account from Ledger 

	$gtotal=0;

		$allrows =mysqli_query($con,"SELECT * FROM vendors  ORDER BY name" ) or die(mysqli_error($con));

		while($allrow=mysqli_fetch_array($allrows)){

			$actid = $allrow['id'];
			$actname = $allrow['name'];
		

		$tcr=0;
		$tdr=0;
		$total=0;

		$rows =mysqli_query($con,"SELECT cr FROM ledger WHERE actid=$actid " ) or die(mysqli_error($con));


		while($row=mysqli_fetch_array($rows)){

			$cr = $row['cr'];
			$tcr=$tcr+$cr;
		} 

		$rows =mysqli_query($con,"SELECT dr FROM ledger WHERE actid=$actid " ) or die(mysqli_error($con));
		

		while($row=mysqli_fetch_array($rows)){

			$dr = $row['dr'];
			$tdr=$tdr+$dr;
		} 

		$total=$tdr-$tcr;	
	$gtotal=$gtotal+$total;

	?>

	<center> <h2><?php echo $actname ?> = <?php echo number_format($total) ?></h2></center>

		
	<?php }	?>
		<center> <h2>Grand Total = <?php echo number_format($gtotal) ?></h2></center>


		<hr>





</body>
</html>
<!--


DELETE FROM journal where id = 2005003;
DELETE FROM ledger where jid = 2005003

-->
