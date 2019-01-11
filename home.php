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
<?php

EXPORT_DATABASE('localhost','root','','accounting');
/* 
##### EXAMPLE #####
   EXPORT_DATABASE("localhost","user","pass","db_name" ); 
   
##### Notes #####
     * (optional) 5th parameter: to backup specific tables only,like: array("mytable1","mytable2",...)   
     * (optional) 6th parameter: backup filename (otherwise, it creates random name)
     * IMPORTANT NOTE ! Many people replaces strings in SQL file, which is not recommended. READ THIS:  http://itask.software/tools/wordpress-migrator
     * If you need, you can check "import.php" too
*/
// by https://github.com/tazotodua/useful-php-scripts //
function EXPORT_DATABASE($host,$user,$pass,$name,       $tables=false, $backup_name=false)
{ 
	set_time_limit(3000); $mysqli = new mysqli($host,$user,$pass,$name); $mysqli->select_db($name); $mysqli->query("SET NAMES 'utf8'");
	$queryTables = $mysqli->query('SHOW TABLES'); while($row = $queryTables->fetch_row()) { $target_tables[] = $row[0]; }	if($tables !== false) { $target_tables = array_intersect( $target_tables, $tables); } 
	$content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `".$name."`\r\n--\r\n\r\n\r\n";
	foreach($target_tables as $table){
		if (empty($table)){ continue; } 
		$result	= $mysqli->query('SELECT * FROM `'.$table.'`');  	$fields_amount=$result->field_count;  $rows_num=$mysqli->affected_rows; 	$res = $mysqli->query('SHOW CREATE TABLE '.$table);	$TableMLine=$res->fetch_row(); 
		$content .= "\n\n".$TableMLine[1].";\n\n";   $TableMLine[1]=str_ireplace('CREATE TABLE `','CREATE TABLE IF NOT EXISTS `',$TableMLine[1]);
		for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
			while($row = $result->fetch_row())	{ //when started (and every after 100 command cycle):
				if ($st_counter%100 == 0 || $st_counter == 0 )	{$content .= "\nINSERT INTO ".$table." VALUES";}
					$content .= "\n(";    for($j=0; $j<$fields_amount; $j++){ $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); if (isset($row[$j])){$content .= '"'.$row[$j].'"' ;}  else{$content .= '""';}	   if ($j<($fields_amount-1)){$content.= ',';}   }        $content .=")";
				//every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
				if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {$content .= ";";} else {$content .= ",";}	$st_counter=$st_counter+1;
			}
		} $content .="\n\n\n";
	}
	$content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
	$backup_name = $backup_name ? $backup_name : $name.date('d-m-Y').'.sql';
	//ob_get_clean(); header('Content-Type: application/octet-stream');  header("Content-Transfer-Encoding: Binary");  header('Content-Length: '. (function_exists('mb_strlen') ? mb_strlen($content, '8bit'): strlen($content)) );    header("Content-disposition: attachment; filename=\"".$backup_name."\""); 


		$fp = fopen('bks579/'.$backup_name, 'w');
		fwrite($fp, $content);
		fclose($fp);

	//fwrite($backup_name, $content);
	 exit;
}
?>