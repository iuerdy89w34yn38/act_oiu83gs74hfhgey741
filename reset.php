<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    
  <?php include"include/head.php" ?>

  <title>Reset Successful
  </title>
  
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

	// Name of the file
	$filename = 'resetquery.sql';



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
	 echo "Reset Successful";
	?>



</h1></center>

  	
  </div>
</div>

<?php include"include/footer.php" ?>

</body>
</html>