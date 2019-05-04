<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    
  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>

  <title>Edit Account - <?php echo $comp_name ?>  </title>
  <style type="text/css">
    hr{
      margin-top: 0px;
      margin-bottom: 10px;
    }
  </style>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  
<?php $link="editacts.php"; ;?>

<?php if (!empty($_POST['id']))  $id=$_POST['id'] ;?>


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
     $bal=0;
     $slug=strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $name));
$data=mysqli_query($con,"INSERT INTO acts (name,typeid,type,slug,purpose,balance)VALUES ('$name','$typeid','$type','$slug','$purpose','$bal')")or die( mysqli_error($con) );
  $msg="Successful" ;
    
}
?>


<?php
if(isset($_POST['update'])){
    $msg="Unsuccessful" ;
    
     $name=$_POST['name'];
     $id=$_POST['update'];


    $sql = "UPDATE acts SET `name` = '$name' WHERE `id` =$id";
    
    mysqli_query($con, $sql);

	$msg="Successful" ;
    
}
?>

<?php
if(isset($_POST['del'])){
    

    $delid=$_POST['del'];



    $data=mysqli_query($con,"DELETE FROM `acts` WHERE id=$delid")or die(mysqli_error($con) );
    
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


  	<?php if (!empty($id)) { ?>
  	
  	<?php

  	$rows =mysqli_query($con,"SELECT * FROM acts WHERE id=$id" ) or die(mysqli_error($con));
  	          
  		while($row=mysqli_fetch_array($rows)){
  			
  			$name = $row['name']; 
  			$type = $row['type']; 
  		}
  		?>

  	  	<div class="col-sm-12">
  	  	  <div class="card">
  	  	    <div class="card-header" style="padding-bottom: 0px;">
  	  	      <h4 class="card-title">Edit  Account</h4>
  	  	    </div>
  	  	    <div class="card-block">


  	  	      <div class="card-body">
  	  	      	<form action="" method="post">
  	  	      	<div class="row">

  		  	      	<div class="col-sm-5">
  			  	      	<span>Name</span>
  			  	          <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
  		  	      	</div>
  		  	      	<div class="col-sm-3">
  			  	      	<span>Type</span>
  			  	      	<select style="text-transform: capitalize;" class="form-control" name="type" disabled>
  			  	      		
  			  	      		<option  value="<?php echo $type ?>"><?php echo $type ?></option>


  			  	      	</select>

  		  	      	</div>
  		  	      	<div class="col-sm-2">
  			  	      	<span>Balance </span>
  			  	          <input type="number" class="form-control" placeholder="0" disabled>
  		  	      	</div>
  		  	      	<div class="col-sm-1">
  			  	      	<span>&nbsp;</span>
  			  	      	<button name="update" class="btn btn-primary block-element" value="<?php echo $id ?>">Update</button>

  		  	      	</div>
  		  	      	
  	  	      	</div>
  	  	      </form>

  	  	      <br><hr>

  	  	      <center><h2><?php if(!empty($msg))  echo $msg ;?></h2></center>
  	  	      </div>
  	  	    </div>
  	  	  </div>
  	  	</div>

  	<?php } ?>	

  

  	  	<div class="col-sm-12">
  	  	  <div class="card">
               <section>
                  <div id="headingCollapse1" class="card-header text-center">
                   <a data-toggle="collapse" href="#collapse1" aria-expanded="false" aria-controls="collapse62"
                      class="card-title  collapsed"><i class="la la-plus"></i> Add Account</a>
                   </div>
                   <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="border no-border-top card-collapse collapse"
                     aria-expanded="false">
                     <div class="card-content">
                       <div class="card-body" style="background: white;">
                         
                                      <form action="" method="post">
                                      <div class="row">

                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-3">
                                          <span>Name</span>
                                            <input type="text" class="form-control" name="name" placeholder="Accout Name">
                                        </div>
                                         <div class="col-sm-3">
                                           <span>Type</span>
                                           <br>
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
                                          <br>
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
                                          <span>&nbsp;</span>
                                            <input type="submit" class="btn btn-primary" name="submit" value="Add">
                                        </div>
                                        
                                      </div>
                                    </form>
                     

                  </div>
               
               
            </section>
  	  	    <div class="card-header" style="padding-bottom: 0px;">
  	  	      <h4 class="card-title">View Existing Accounts</h4>
  	  	    </div>
  	  	    <div class="card-block">

  	  	      <div class="card-body">
  	  	      	<form action="" method="POST">
  	  	      	<div class="row align-conter-center">

  		  	      	<div class="col-sm-3">
  			  	      	<h2>Name</h2>
  		  	      	</div>
                  <div class="col-sm-2">
                    <h2>Type </h2>
                  </div>
                  <div class="col-sm-2">
                    <h2>Purpose </h2>
                  </div>
  		  	      	<div class="col-sm-2">
  			  	      	<h2>Balance </h2>
  		  	      	</div>
  		  	      	<div class="col-sm-3">
                    <h2>Update / Delete </h2>
  		  	      	</div>
  		  	      	
  	  	      	</div>
                <hr><br> 
  	  	      	<?php

  	  	      	$rows1s =mysqli_query($con,"SELECT * FROM acts  ORDER BY name" ) or die(mysqli_error($con));
  	  	      	          
  	  	      		while($rows1=mysqli_fetch_array($rows1s)){
  	  	      			
  	  	      			$id = $rows1['id'];
  	  	      			$name = $rows1['name']; 
                    $type = $rows1['type']; 
                    $purpose = $rows1['purpose']; 
                    $balance = $rows1['balance']; 
  	  	      			$nodel = $rows1['nodel']; 


                    $tcr=0;
                    $tdr=0;
                    $total=0;
                    $rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$id " ) or die(mysqli_error($con));

                    while($row=mysqli_fetch_array($rows)){
                      $cr = $row['cr'];
                      $tcr=$tcr+$cr;
                    } 
                    $rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$id " ) or die(mysqli_error($con));

                    while($row=mysqli_fetch_array($rows)){
                      $dr = $row['dr'];
                      $tdr=$tdr+$dr;
                    } 
                    $total1=$tdr-$tcr;
                    $total=abs($total1);
                    ?>
  	  	      		
  	  	      	<div class="row  align-items-center" align="">

  		  	      	<div class="col-sm-3">
  			  	      	<h5><?php echo $name ?></h5>
  		  	      	</div>
                  <div class="col-sm-2">
                    <h5 style="text-transform: capitalize;"><?php echo $type ?> </h5>
                  </div>
                  <div class="col-sm-2">
                    <h5 style="text-transform: capitalize;"><?php echo $purpose ?> </h5>
                  </div>
  		  	      	<div class="col-sm-2">
  			  	      	<h5 style="text-transform: capitalize;">

                    <?php if($id==200021 OR $id==200022) {
                      echo ' - ';
                    } else{ ?>
                      Rs. <?php echo number_format($total); } ?>/-</h5>
  		  	      	</div>
  		  	      	<div class="col-sm-1">
  			  	      	<button name="id" class="btn btn-primary" value="<?php echo $id ?>">Edit</button>

  		  	      	</div>
  		  	      	<div class="col-sm-1">
                    <?php if($nodel==0){ ?>
  			  	      	<button name="del" class="btn btn-danger" value="<?php echo $id ?>">Del</button>
                  <?php } ?>
  		  	      	</div>
  		  	      	
  	  	      	</div>
  	  	      	
  	  	      	<hr>
  	  	      <?php } ?>
  	  	      </form>

  	  	      <center><h2><?php if(!empty($msg))  echo $msg ;?></h2></center>
  	  	      </div>
  	  	    </div>
  	  	  </div>
  	  	</div>



    
  </div>
</div>
<?php include'include/footer.php'; ?>


</body>
</html>