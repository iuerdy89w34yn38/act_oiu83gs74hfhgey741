<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    
  <?php include"include/head.php" ?>

  <title>Transactions - 
  </title>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  
<?php $link="transaction.php"; ;?>

  
<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
  <div class="content-wrapper">

  	<div class="col-sm-12">
  	  <div class="card">
  	    <div class="card-header" style="padding-bottom: 0px;">
  	      <h4 class="card-title">Add New Transaction</h4>
  	    </div>
  	    <div class="card-block">
  	      <div class="card-body">
  	      	<div class="row">
	  	      	<div class="col-sm-3">
		  	      	<span>Date: (mm/dd/year) <?php echo date('m/d/Y');?></span>
		  	      	<input type="date" class="form-control" id="date" value="<?php echo date('Y-m-d');?>">

	  	      	</div>
	  	      	<div class="col-sm-4">
		  	      	<span>Description</span>
		  	          <input type="text" class="form-control" placeholder="">
	  	      	</div>
	  	      	<div class="col-sm-2">
		  	      	<span>Type</span>
		  	      	<select class="form-control">
		  	      		<option value="credit">Credit</option>
		  	      		<option value="debit">Debit</option>
		  	      		<option value="1">3</option>
		  	      	</select>
	  	      	</div>
	  	      	<div class="col-sm-2">
		  	      	<span>Amount</span>
		  	          <input type="number" class="form-control" id="basicInput">
	  	      	</div>
	  	      	<div class="col-sm-1">
		  	      	<span>&nbsp;</span>
		  	          <input type="submit" class="btn btn-primary " value="Add">
	  	      	</div>
	  	      	
  	      	</div>
  	      </div>
  	    </div>
  	  </div>
  	</div>

  </div>
</div>


<?php include"include/footer.php" ?>

</body>
</html>