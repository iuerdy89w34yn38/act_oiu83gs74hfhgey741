<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    
  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>

  <title>Add Account - <?php echo $comp_name ?>  </title>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  
<?php $link="addvend.php"; ;?>


<?php
if(isset($_POST['submit'])){
    $msg="Unsuccessful" ;
    
     $name=$_POST['name'];
     $mobile=$_POST['mobile'];
     $company=$_POST['company'];
     $email=$_POST['email'];
     $phone=$_POST['phone'];
     $address=$_POST['address'];
     $city=$_POST['city'];
     $country=$_POST['country'];
     $date=date('Y-m-d');
     $typeid=200022;



    $data=mysqli_query($con,"INSERT INTO vendors (name,typeid,mobile,company,email,phone,address,city,country,dated)VALUES ('$name','$typeid','$mobile','$company','$email','$phone','$address','$city','$country','$date')")or die( mysqli_error($con) );
	$msg="Successful" ;
    
}
?>



<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
  <div class="content-wrapper">



  	  	<div class="col-sm-12">
  	  	  <div class="card">
  	  	    <div class="card-header" style="padding-bottom: 0px;">
  	  	      <h4 class="card-title">Add New Account</h4>
  	  	    </div>
  	  	    <div class="card-block">
  	  	      <div class="card-body">
  	  	      	<form action="" method="post">
  	  	      	<div class="row">

                  <div class="col-sm-4">
                    <span>Name</span>
                      <input type="text" class="form-control" name="name" placeholder="Vendor Name">
                  </div>
                  <div class="col-sm-4">
                    <span>Mobile</span>
                      <input type="text" class="form-control" name="mobile" placeholder="Vendor Mobile">
                  </div>
                  <div class="col-sm-4">
                    <span>Company</span>
                      <input type="text" class="form-control" name="company" placeholder="Vendor Company">
                  </div>
                  <div class="col-sm-4">
                    <span>Email</span>
                      <input type="email" class="form-control" name="email" placeholder="Vendor Email">
                  </div>
                  <div class="col-sm-4">
                    <span>Phone</span>
                      <input type="text" class="form-control" name="phone" placeholder="Company Phone">
                  </div>
  		  	      	<div class="col-sm-6">
  			  	      	<span>Street Address</span>
  			  	          <input type="text" class="form-control" name="address" placeholder="Address">
  		  	      	</div>
                  <div class="col-sm-3">
                    <span>City</span>
                    <select class="form-control select2" name="city">
                      <option value="*"> None </option>
                      <?php

                      $rows =mysqli_query($con,"SELECT * FROM cities ORDER BY city" ) or die(mysqli_error($con));
                                
                        while($row=mysqli_fetch_array($rows)){
                          
                          $name = $row['city']; ?>

                      <option value="<?php echo $name ?>"><?php echo $name ?></option>

                      <?php } ?>

                    </select>

                  </div>
  		  	      	<div class="col-sm-3">
  			  	      	<span>Country</span>
  			  	      	<select class="form-control select2" name="country">
  			  	      		<?php

  			  	      		$rows =mysqli_query($con,"SELECT * FROM countries ORDER BY country" ) or die(mysqli_error($con));
  			  	      		          
  			  	      			while($row=mysqli_fetch_array($rows)){
  			  	      				
  			  	      				$name = $row['country']; ?>

  			  	      		<option value="<?php echo $name ?>" <?php if($name=='Pakistan') echo 'selected' ?>><?php echo $name ?></option>

  			  	      		<?php } ?>

  			  	      	</select>

  		  	      	</div>

                  <div class="col-sm-5">
                  </div>
  		  	      	<div class="col-sm-1">
  			  	      	<span>&nbsp;</span>
  			  	          <input type="submit" class="btn btn-primary" name="submit" value="Add Vendor">
  		  	      	</div>
  		  	      	
  	  	      	</div>
  	  	      </form>
              

  	  	      <center><h2><?php if(!empty($msg)) { ?>

                <br>
                <hr>
                <br>
              <?php echo $msg ; } ?></h2></center>
  	  	      </div>
  	  	    </div>
  	  	  </div>
  	  	</div>



    
  </div>
</div>


<?php include"include/footer.php" ?>

</body>
</html>