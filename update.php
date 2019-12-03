<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    
  <?php include"include/head.php" ?>

  <title>Software Update  </title>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  

  
<?php $link="lol.php"; ;?>
  
<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>

<div class="app-content content">
  <div class="content-wrapper">

<center><h1 style="color: white;">
	
	<?php

	if(isset($_POST['doupdate'])){
  	$msg="Unsuccessful" ;

	// Name of the file
	$filename = 'update.sql';



	// Temporary variable, used to store current query
	$templine = '';
	// Read in entire file
	$lines = file($filename);
	// Loop through each line
	foreach ($lines as $line)
	{
	// Skip it if it's a comment
	if (substr($line, 0, 2) == '--' || $line == '')
	    continue;

	// Add this line to the current segment
	$templine .= $line;
	// If it has a semicolon at the end, it's the end of the query
	if (substr(trim($line), -1, 1) == ';')
	{
	    // Perform the query
	    mysqli_query($con,$templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
	    // Reset temp variable to empty
	    $templine = '';
	}
	}
	$rows =mysqli_query($con,"SELECT * FROM software where id=1 " ) or die(mysqli_error($con));
    while($row=mysqli_fetch_array($rows)){ 
      $ver = $row['ver'];
      $api = $row['api'];
      $upver = $row['upver'];
  	}
    $sqls = "UPDATE software SET `ver` = '$upver' WHERE `id` = 1"  ;
    mysqli_query($con, $sqls)or die(mysqli_error($con));

	 echo "Update Successful"; 
	}

	?>

</h1>

<?php

    $rows =mysqli_query($con,"SELECT * FROM software where id=1 " ) or die(mysqli_error($con));
    while($row=mysqli_fetch_array($rows)){ 
      $ver = $row['ver'];
      $api = $row['api'];
      $upver = $row['upver'];
      if ($upver>$ver) { ?>
      	<form action="" method="post">
      		<h2> Current Version: <?php echo $ver ?> - Updated Version: <?php echo $upver ?> </h2>
      		<button type="submit" name="doupdate" class="btn btn-success">Update</button>
      	</form>
      	     <?php } else {
      	     	echo "Updated Version: ".$ver;
      	     }
    }

    ?>

  	</center>
  </div>
</div>

<?php include"include/footer.php" ?>

</body>
</html>