<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

	<?php include"include/connect.php" ?>

	<?php include"include/head.php" ?>

	


	<title>Dashboard - <?php echo $comp_name ?>  </title>

	<?php
	 
	$dataPoints = array(
		array("x"=> 10, "y"=> 41),
		array("x"=> 20, "y"=> 35, "indexLabel"=> "Lowest"),
	);
		
	?>

</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<?php $link="index.php"; ;?>


<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-sm-4">
				<div class="card">
					<div class="card-header" style="padding-bottom: 0px;">
						<h4 class="card-title">Net Profit</h4>
					</div>
					<div class="card-block">
						<div class="card-body">

							<div class="row">

								<?php
								$netprofit = 0;
								$balance = 0;
								$sales = 0;
								$salesr = 0;
								$netsales = 0;
								$cogs= 0;
								$cogsr= 0;
								$netcogs= 0;
								$expenses= 0;
								$gp= 0;

								$rows =mysqli_query($con,"SELECT * FROM acts WHERE typeid =2 AND id!=200029  ORDER BY name" ) or die(mysqli_error($con));

								while($row=mysqli_fetch_array($rows)){

									$id = $row['id'];
									$name = $row['name'];
									$balance = $row['balance'];
									$sales=$sales+$balance;
								}
								$rows =mysqli_query($con,"SELECT * FROM acts WHERE id=200029  ORDER BY name" ) or die(mysqli_error($con));

								while($row=mysqli_fetch_array($rows)){

									$id = $row['id'];
									$name = $row['name'];
									$salesr = $row['balance'];
								}

								$netsales = $sales-$salesr;

								$rows =mysqli_query($con,"SELECT * FROM acts WHERE typeid =10 AND id!=200028  ORDER BY name" ) or die(mysqli_error($con));

								while($row=mysqli_fetch_array($rows)){

									$id = $row['id'];
									$name = $row['name'];
									$balance = $row['balance'];
									$cogs=$cogs+$balance;
								} 

								$rows =mysqli_query($con,"SELECT * FROM acts WHERE id=200028  ORDER BY name" ) or die(mysqli_error($con));

								while($row=mysqli_fetch_array($rows)){

									$id = $row['id'];
									$name = $row['name'];
									$cogsr = $row['balance'];
								} 

								$netcogs = $cogs-$cogsr;


								$rows =mysqli_query($con,"SELECT * FROM acts WHERE typeid =4  ORDER BY name" ) or die(mysqli_error($con));

								while($row=mysqli_fetch_array($rows)){

									$id = $row['id'];
									$name = $row['name'];
									$balance = $row['balance'];
									$expenses=$expenses+$balance;
								} 

								$gp=$netsales-$netcogs;
								$netprofit=$gp-$expenses;

								?>

								<div class="col-sm-12">
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
									<center><h2> Net Profit: <?php echo $netprofit ?></h2></center>

								</div>



							</div>
						</div>
					</div>

				</div>
			</div>

		</div>

		









	</div>
</div>

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Simple Column Chart with Index Labels"
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",   
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

<?php include"include/footer.php" ?>

</body>
</html>
<?php include"include/backup.php" ?>


