<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

	<?php include"include/connect.php" ?>

	<?php include"include/head.php" ?>

	


	<title>Profit Loss Statement - <?php echo $comp_name ?>  </title>



</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<?php $link="expr.php"; ;?>


<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-sm-2">
			</div>
			<div class="col-sm-8">
				<div class="card">
					<div class="card-header" style="padding-bottom: 0px;">
						<h4 class="card-title">Expense Report</h4>
						<div class="heading-elements">
						  <ul class="list-inline mb-0">
						    <li><a data-action="reload"><i class="la la-retweet"></i></a></li>
						    <li><a data-action="collapse"><i class="la la-minus"></i></a></li>
						    <li><a data-action="expand"><i class="la la-square-o"></i></a></li>
						    <li><a data-action="close"><i class="la la-close"></i></a></li>
						  </ul>
						</div>
					</div>
					<div class="card-content collpase show">
						<div class="card-body">

							<div class="row">

								<?php
							
								$expenses=0;
								$rows =mysqli_query($con,"SELECT * FROM acts WHERE typeid =4  ORDER BY name" ) or die(mysqli_error($con));

								while($row=mysqli_fetch_array($rows)){

									$id = $row['id'];
									$name = $row['name'];
									$balance = $row['balance'];
									$expenses=$expenses+$balance;
								


								?>



								<div class="col-md-2">
								</div>
								<div class="col-md-6">
								<h4><?php echo $name; ?></h4>
								</div>
								<div class="col-md-2">
								<h4><?php echo $balance; ?></h4>
								</div>
								<div class="col-md-2">
								</div>

						<?php 	} ?>

						<hr> 
						
						<div class="col-md-1">
						</div>
						<div class="col-md-7">
						<h2>Total Expenses</h2>
						</div>
						<div class="col-md-2">
						<h2>Rs. <?php echo number_format($balance); ?>/-</h2>
						</div>
						<div class="col-md-2">
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


