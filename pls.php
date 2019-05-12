<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

<?php include"include/connect.php" ?>

<?php include"include/head.php" ?>




<title>Profit Loss Statement - <?php echo $comp_name ?>  </title>



</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<?php $link="pls.php"; ;?>
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
					<h4 class="card-title">Profit Loss / Income Statement</h4>
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
							$tax= 0;
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

									$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid AND datec>='$dates' AND datec<='$datee'  ORDER BY id desc" ) or die(mysqli_error($con));
									while($row=mysqli_fetch_array($rows)){
										$cr = $row['cr'];
										$tcr=$tcr+$cr;
									} 
									$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid AND datec>='$dates' AND datec<='$datee'  ORDER BY id desc" ) or die(mysqli_error($con));
									while($row=mysqli_fetch_array($rows)){
										$dr = $row['dr'];
										$tdr=$tdr+$dr;
									} 
									$balance=$tcr-$tdr;	
									$sales=$sales+$balance;
								}
							

							$allrows =mysqli_query($con,"SELECT * FROM acts WHERE id=200029  ORDER BY name" ) or die(mysqli_error($con));
							while($allrow=mysqli_fetch_array($allrows)){
								$actid = $allrow['id'];
								$actname = $allrow['name'];
								
								$tcr=0;
								$tdr=0;
								$total=0;

								$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid AND datec>='$dates' AND datec<='$datee'  ORDER BY id desc" ) or die(mysqli_error($con));
								while($row=mysqli_fetch_array($rows)){
									$cr = $row['cr'];
									$tcr=$tcr+$cr;
								} 
								$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid AND datec>='$dates' AND datec<='$datee'  ORDER BY id desc" ) or die(mysqli_error($con));
								while($row=mysqli_fetch_array($rows)){
									$dr = $row['dr'];
									$tdr=$tdr+$dr;
								} 
								$balance=$tcr-$tdr;	
								$salesr=$salesr+$balance;
							}

							$allrows =mysqli_query($con,"SELECT * FROM acts WHERE id=200039  ORDER BY name" ) or die(mysqli_error($con));
							while($allrow=mysqli_fetch_array($allrows)){
								$actid = $allrow['id'];
								$actname = $allrow['name'];
								
								$tcr=0;
								$tdr=0;
								$total=0;

								$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid AND datec>='$dates' AND datec<='$datee' AND ref=0  ORDER BY id desc" ) or die(mysqli_error($con));
								while($row=mysqli_fetch_array($rows)){
									$cr = $row['cr'];
									$tcr=$tcr+$cr;
								} 
								$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid AND datec>='$dates' AND datec<='$datee' AND ref=0  ORDER BY id desc" ) or die(mysqli_error($con));
								while($row=mysqli_fetch_array($rows)){
									$dr = $row['dr'];
									$tdr=$tdr+$dr;
								} 
								$balance=$tcr-$tdr;	
								$salesd=$salesd+$balance;
							}

							
							$netsales = $sales-$salesr-$salesd;

							

							$allrows =mysqli_query($con,"SELECT * FROM acts WHERE typeid =10 AND id!=200028  ORDER BY name" ) or die(mysqli_error($con));
							while($allrow=mysqli_fetch_array($allrows)){
								$actid = $allrow['id'];
								$actname = $allrow['name'];
								
								$tcr=0;
								$tdr=0;
								$total=0;

								$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid AND datec>='$dates' AND datec<='$datee'  ORDER BY id desc" ) or die(mysqli_error($con));
								while($row=mysqli_fetch_array($rows)){
									$cr = $row['cr'];
									$tcr=$tcr+$cr;
								} 
								$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid AND datec>='$dates' AND datec<='$datee'  ORDER BY id desc" ) or die(mysqli_error($con));
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
								$balance=0;

								$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid AND datec>='$dates' AND datec<='$datee'  ORDER BY id desc" ) or die(mysqli_error($con));
								while($row=mysqli_fetch_array($rows)){
									$cr = $row['cr'];
									$tcr=$tcr+$cr;
								} 
								$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid AND datec>='$dates' AND datec<='$datee'  ORDER BY id desc" ) or die(mysqli_error($con));
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
								$balance=0;

								$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid AND datec>='$dates' AND datec<='$datee' AND ref=0  ORDER BY id desc" ) or die(mysqli_error($con));
								while($row=mysqli_fetch_array($rows)){
									$cr = $row['cr'];
									$tcr=$tcr+$cr;
								} 
								$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid AND datec>='$dates' AND datec<='$datee' AND ref=0  ORDER BY id desc" ) or die(mysqli_error($con));
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


								$rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid AND datec>='$dates' AND datec<='$datee'  ORDER BY id desc" ) or die(mysqli_error($con));
								while($row=mysqli_fetch_array($rows)){
									$cr = $row['cr'];
									$tcr=$tcr+$cr;
								} 
								$rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid AND datec>='$dates' AND datec<='$datee'  ORDER BY id desc" ) or die(mysqli_error($con));
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


							<div class="col-md-1">
							</div>
							<div class="col-md-10">
								<table class="table table-striped table-bordered">

									<tr>
										<td>Total Sales:</td>
										<td><?php echo $sales ?></td>
									</tr>

									<tr>
										<td>Sales Returns:</td>
										<td><?php echo $salesr ?></td>
									</tr>

									<tr>
										<td>Sales Discount:</td>
										<td><?php echo $salesd ?></td>
									</tr>

									<tr class="mh">
										<td>Net Sales:</td>
										<td><?php echo number_format($netsales) ?></td>
									</tr>

									<tr class="spc">
										<td class="spc">&nbsp;</td>
										<td class="spc">&nbsp;</td>
									</tr>

									<tr>
										<td>Total Purchases:</td>
										<td><?php echo $cogs ?></td>
									</tr>
									<tr>
										<td>Purchases Return:</td>
										<td><?php echo $cogsr ?></td>
									</tr>
									<tr>
										<td>Purchases Discount:</td>
										<td><?php echo $cogsd ?></td>
									</tr>
									<tr class="mh">
										<td>Net Purchases:</td>
										<td><?php echo number_format($netcogs) ?></td>
									</tr>

									<tr class="spc">
										<td class="spc">&nbsp;</td>
										<td class="spc">&nbsp;</td>
									</tr>

									
									<tr class="mh">
										<td>Expenses:</td>
										<td><?php echo $expenses ?></td>
									</tr>
									

									
									<tr class="mh">
										<td>Tax Deduction:</td>
										<td><?php echo $tax ?></td>
									</tr>



									<tr class="mh">
										<td>Net Profit / Loss:</td>
										<td><?php echo number_format($netprofit) ?></td>
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


