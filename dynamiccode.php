<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

	<?php include"include/connect.php" ?>

	<?php include"include/head.php" ?>

	


	<title>DYnamic Code Test - <?php echo $comp_name ?>  </title>

	


</head>


<?php // For Single Account from Ledger

	$rows =mysqli_query($con,"SELECT * FROM acts WHERE id=200016  ORDER BY name" ) or die(mysqli_error($con));

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
<center> <h2><?php echo $actname ?> = <?php echo number_format($total) ?></h2>

	<hr>

	

<?php // For all types of Account from Ledger by account type

	$allrows =mysqli_query($con,"SELECT * FROM acts WHERE typeid=5  ORDER BY name" ) or die(mysqli_error($con));

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

?>
<center> <h2><?php echo $actname ?> = <?php echo number_format($total) ?></h2>

<?php } ?>
</html>
<!--


DELETE FROM journal where id = 2005003;
DELETE FROM ledger where jid = 2005003

-->
