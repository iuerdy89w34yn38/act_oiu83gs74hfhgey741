<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    
  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>

  <title>Add Account - <?php echo $comp_name ?>  </title>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  
<?php $link="additems.php"; ;?>


<?php
if(isset($_POST['submitp'])){
    $msg="Unsuccessful" ;
    
     $name=$_POST['name'];
     $desp=$_POST['desp'];
     $brand=$_POST['brand'];
     $wgt=$_POST['wgt'];




    $data=mysqli_query($con,"INSERT INTO items (name,desp,brand,weight)VALUES ('$name','$desp','$brand','$wgt')")or die( mysqli_error($con) );
  $msg="Successful" ;
    
}
?>

<?php
if(isset($_POST['submitc'])){
    $msg1="Unsuccessful" ;
    
     $name=$_POST['name'];





    $data=mysqli_query($con,"INSERT INTO itemsb (name)VALUES ('$name')")or die( mysqli_error($con) );
	$msg1="Successful" ;
    
}
?>



<?php
if(isset($_POST['update'])){
  $msg1="Unsuccessful" ;


  $id=$_POST['update'];
  $name=$_POST['name'.$id];


  $sql = "UPDATE itemsb SET `name` = '$name' WHERE `id` =$id";

  mysqli_query($con, $sql);

  $msg1="Successful" ;

}
?>

<?php
if(isset($_POST['del'])){


  $delid=$_POST['del'];



  $data=mysqli_query($con,"DELETE FROM `itemsb` WHERE id=$delid")or die(mysqli_error($con) );
  $data1=mysqli_query($con,"UPDATE items SET `brand` = '1' WHERE `brand` =$delid")or die(mysqli_error($con) );

  if ($data == 1) {
    $msg="Deleted Successfully!";
  } 

  else {
    $msg="Unsuccessful!";
  }


}
?>





<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
  <div class="content-wrapper">



        <div class="col-sm-12">
          <div class="card">
            <div class="card-header" style="padding-bottom: 0px;">
              <h4 class="card-title">Add New Product</h4>
            </div>
            <div class="card-block">
              <div class="card-body">
                <form action="" method="post">
                <div class="row">

                  <div class="col-sm-4">
                    <span>Name</span>
                      <input type="text" class="form-control" name="name" placeholder="Name">
                  </div>
                

                  <div class="col-sm-4">
                    <span>Brand</span>
                    <select class="form-control select2" name="brand">
                      <?php

                      $rows =mysqli_query($con,"SELECT * FROM itemsb where id!=1  ORDER BY name" ) or die(mysqli_error($con));
                                
                        while($row=mysqli_fetch_array($rows)){
                          
                          $id = $row['id']; 
                          $name = $row['name']; ?>

                      <option value="<?php echo $id ?>"><?php echo $name ?></option>

                      <?php } ?>

                    </select>

                  </div>


                  <div class="col-sm-4">
                    <span>Weight (g)</span>
                      <input type="text" class="form-control" name="wgt" placeholder="Description">
                  </div>


                  <div class="col-sm-1">
                  </div>
                  <div class="col-sm-9">
                    <span>Description</span>
                      <input type="text" class="form-control" name="desp" placeholder="Description">
                  </div>

                  


                 
                  <div class="col-sm-1">
                    <span>&nbsp;</span>
                      <input type="submit" class="btn btn-primary" name="submitp" value="Add">
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



<div class="row">
        <div class="col-sm-3">
        </div>
  	  	<div class="col-sm-6">
  	  	  <div class="card">
  	  	    <div class="card-header" style="padding-bottom: 0px;">
  	  	      <h4 class="card-title">Add New Brand</h4>
  	  	    </div>
  	  	    <div class="card-block">
  	  	      <div class="card-body">
                <form action="" method="post">
                <div class="row">

                  <div class="col-sm-1">
                  </div>
                  <div class="col-sm-10">
                    <span>Name</span>
                    <div class="input-group">
                      <input type="text" class="form-control" name="name" placeholder="Name">
               
                      <input type="submit" class="btn btn-primary" name="submitc" value="Add">
                    </div>
                  </div>
                  
                </div>
              </form>
              <br>
  	  	      	<form action="" method="post">
                  <?php

                  $rows =mysqli_query($con,"SELECT * FROM itemsb WHERE id!=1   ORDER BY name" ) or die(mysqli_error($con));
                            
                    while($row=mysqli_fetch_array($rows)){
                      
                      $id = $row['id']; 
                      $name = $row['name']; ?>
  	  	      	<div class="row">

                  <div class="col-sm-1">
                  </div>
                  <div class="col-sm-10">

                    <div class="input-group">

                      <input type="text" class="form-control" name="name<?php echo $id ?>" value="<?php echo $name ?>">
               
                      <button class="btn btn-warning" value="<?php echo $id ?>" name="update" > Save </button>
  			  	          <button class="btn btn-danger" value="<?php echo $id ?>" name="del">Del </button>
                    </div>
  		  	      	</div>
  		  	      	
  	  	      	</div>
              <?php } ?>
  	  	      </form>
              

  	  	      <center><h2><?php if(!empty($msg1)) { ?>
                
                <br>
                <hr>
                <br>
              <?php echo $msg1 ; } ?></h2></center>
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