<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    
  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>

  <title>Add Account - <?php echo $comp_name ?>  </title>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  
<?php $link="addacts.php"; ;?>


<?php
if(isset($_POST['submit'])){
    $msg="Unsuccessful" ;
    
     $name=$_POST['name'];
     $typeid=$_POST['type'];

     $rows =mysqli_query($con,"SELECT * FROM act_t WHERE id=$typeid  " ) or die(mysqli_error($con));
               
       while($row=mysqli_fetch_array($rows)){
         
         $type = $row['name'];
       }

     $purpose=$_POST['purpose'];
     $bal=$_POST['bal'];
     $slug=strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $name));
$data=mysqli_query($con,"INSERT INTO acts (name,typeid,type,slug,purpose,balance)VALUES ('$name','$typeid','$type','$slug','$purpose','$bal')")or die( mysqli_error($con) );
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
                <div class="heading-elements">
                  <a data-toggle="modal"   data-target="#pulse">
                    <i class="la blue la-question-circle"></i>
                  </a>
                </div>
              <!-- Button trigger modal -->
             
              <!-- Modal -->
              <div class="modal animated pulse text-left" id="pulse" tabindex="-1" role="dialog"
              aria-labelledby="myModalLabel38" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel38">Basic Modal</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h5>Check First Paragraph</h5>
                      <p>Oat cake ice cream candy chocolate cake chocolate
                        cake cotton candy dragée apple pie. Brownie carrot
                        cake candy canes bonbon fruitcake topping halvah.
                        Cake sweet roll cake cheesecake cookie chocolate
                        cake liquorice. Apple pie sugar plum powder donut
                        soufflé.
                      </p>
                      <p>Sweet roll biscuit donut cake gingerbread. Chocolate
                        cupcake chocolate bar ice cream. Danish candy
                        cake.
                      </p>
                      <hr>
                      <h5>Some More Text</h5>
                      <p>Cupcake sugar plum dessert tart powder chocolate
                        fruitcake jelly. Tootsie roll bonbon toffee danish.
                        Biscuit sweet cake gummies danish. Tootsie roll
                        cotton candy tiramisu lollipop candy cookie biscuit
                        pie.
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-outline-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>

              
  	  	    </div>
  	  	    <div class="card-block">
  	  	      <div class="card-body">

  	  	      	<form action="" method="post">
  	  	      	<div class="row">

  		  	      	<div class="col-sm-4">
  			  	      	<span>Name</span>
  			  	          <input type="text" class="form-control" name="name" placeholder="Accout Name">
  		  	      	</div>
                  <div class="col-sm-2">
                    <span>Type</span>
                    <select class="form-control select2" name="type">
                      <?php

                      $rows =mysqli_query($con,"SELECT * FROM act_t  ORDER BY name" ) or die(mysqli_error($con));
                                
                        while($row=mysqli_fetch_array($rows)){
                          
                          $id = $row['id'];
                          $name = $row['name']; ?>

                      <option value="<?php echo $id ?>"><?php echo $name ?></option>

                      <?php } ?>

                    </select>

                  </div>
  		  	      	<div class="col-sm-3">
  			  	      	<span>Purpose</span>
  			  	      	<select class="form-control select2" name="purpose">
                      <option value="other">Other</option>
                      <option value="cash">Manage Cash</option>
                      <option value="capital">Manage Capital</option>
                      <option value="expenses">Manage Expenses</option>
                      <option value="inventory">Manage Inventory</option>
                      <option value="income">Manage Income</option>
                      <option value="assets">Manage Assets</option>
  			  	      		<option value="liabilities">Manage Liabilities</option>
  			  	      	</select>

  		  	      	</div>
  		  	      	<div class="col-sm-1">
  			  	      	<span>Balance </span>
  			  	          <input type="number" name="bal" class="form-control" value="0" >
  		  	      	</div>
  		  	      	<div class="col-sm-1">
  			  	      	<span>&nbsp;</span>
  			  	          <input type="submit" class="btn btn-primary" name="submit" value="Add">
  		  	      	</div>
  		  	      	
  	  	      	</div>
  	  	      </form>

  	  	      <center><h2><?php if(!empty($msg))  echo $msg ;?></h2></center>
  	  	      </div>
  	  	    </div>
  	  	  </div>
  	  	</div>



    
  </div>
</div>


<?php include"include/footer.php" ?>

</body>
</html>