<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

<?php include"include/connect.php" ?>

<?php include"include/head.php" ?>




<title>Expenses Report - <?php echo $comp_name ?>  </title>



</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<?php $link="expr.php"; ;?>
<style type="text/css">

table{
font-size: 16px;
}
.mh{
font-weight: 900;
font-size: 18px;
border-style: double;
}
.spc{

border: 0px solid !important;
}
</style>


<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
<div class="content-wrapper">



<?php if (!empty($_POST['dates'])) {
	$dates=$_POST['dates'] ;
	$datee=$_POST['datee'] ;


	?>

	<div class="row">
		<div class="col-sm-1">
		</div>
		<div class="col-sm-10">
			<div class="card">
				<div class="card-header" style="padding-bottom: 0px;">
					<h4 class="card-title">Expense Report from <?php echo $dates ?> to <?php echo $datee ?></h4>
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


							<div class="col-md-1">
							</div>
							<div class="col-md-10">
								<table class="table table-striped table-bordered">
									<?php
									$expenses = 0;
									$balance = 0;


									$rows1 =mysqli_query($con,"SELECT id,name FROM acts WHERE typeid =4  ORDER BY name" ) or die(mysqli_error($con));
									while($row1=mysqli_fetch_array($rows1)){
										$actid = $row1['id'];
										$actname = $row1['name'];


										$tcr=0;
										$tdr=0;


										$rows =mysqli_query($con,"SELECT cr FROM ledger WHERE actid=$actid AND datec>='$dates' AND datec<='$datee'  ORDER BY id desc" ) or die(mysqli_error($con));
										while($row=mysqli_fetch_array($rows)){
											$cr = $row['cr'];
											$tcr=$tcr+$cr;
										} 
										$rows =mysqli_query($con,"SELECT dr FROM ledger WHERE actid=$actid AND datec>='$dates' AND datec<='$datee'  ORDER BY id desc" ) or die(mysqli_error($con));
										while($row=mysqli_fetch_array($rows)){
											$dr = $row['dr'];
											$tdr=$tdr+$dr;
										} 
										$balance=$tdr-$tcr;	
										$expenses=$expenses+$balance;



									?>


									<tr>
										<td><?php echo $actname ?>:</td>
										<td><?php echo $balance ?></td>
									</tr>

								<?php } ?>

									<tr class="mh">
										<td>Total Expenses:</td>
										<td><?php echo $expenses ?></td>
									</tr>



								</table>
							</div>



						</div>
					</div>
				</div>

			</div>
		</div>

	</div>




<?php } ?>


<?php 
if (empty($_POST['dates'])) {
	$dates=date('Y-m-d');
	$datee=date('Y-m-d');
}
?>
<form action="" method="POST">
	<div class="row">
		<div class="col-sm-2">
		</div>
		<div class="col-sm-8">
			<div class="card">
				<div class="card-block">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col-md-5">
								<p>Starting Date:</p>
								<div class="input-group">
									<input type="date" class="form-control" name="dates" value="<?php echo $dates ?>"> 
								</div>
							</div>
							<div class="col-md-5">

								<p>Ending Date:</p>
								<div class="input-group">
									<input type="date" class="form-control" name="datee" value="<?php echo $datee ?>">
								</div>
							</div>
							<div class="col-md-2"> <input type="submit" class="btn">        </div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</form>








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


