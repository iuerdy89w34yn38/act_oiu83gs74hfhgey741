<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    
  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>

  <title>Add Fixed Assets  - <?php echo $comp_name ?>  </title>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  
<?php $link="addast.php"; ;?>


<?php
if(isset($_POST['submit'])){
    $msg="Unsuccessful" ;

    $srcid=$_POST['src'];
    $destid=$_POST['dest'];
    $amount = $_POST['amount'];


    $datec=date('Y-m-d');
    $dateup=date('Y-m-d');



    if($srcid==200016){

     $rows =mysqli_query($con,"SELECT * FROM acts where id=$srcid ORDER BY name" ) or die(mysqli_error($con));
     while($row=mysqli_fetch_array($rows)){ 
       $srcname = $row['name'];
       $srcbalance = $row['balance'];
       $srctype = $row['type'];
       $srctypeid = $row['typeid'];
     }

     $destid=$destid;
     $rows =mysqli_query($con,"SELECT * FROM acts where id=$destid ORDER BY name" ) or die(mysqli_error($con));
     while($row=mysqli_fetch_array($rows)){ 
       $destname = $row['name'];
       $destbalance = $row['balance'];
       $desttype = $row['type'];
       $desttypeid = $row['typeid'];

     }

                 //First Entry


     $srcbalance=$srcbalance-$amount;
     $destbalance=$destbalance+$amount;



     $desp=$_POST['desp'];

                               //Journal Entry
     $data=mysqli_query($con,"INSERT INTO journal (desp,dract,cract,cr,datec,dateup)VALUES ('$desp','$srcid','$destid','$amount','$datec','$dateup')")or die( mysqli_error($con) );


     $sqls = "UPDATE acts SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
     mysqli_query($con, $sqls)or die(mysqli_error($con));

     $sqls = "UPDATE acts SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
     mysqli_query($con, $sqls)or die(mysqli_error($con));






                               //Ledger Entry
     $rows =mysqli_query($con,"SELECT id FROM journal ORDER BY id desc limit 1" ) or die(mysqli_error($con));
     while($row=mysqli_fetch_array($rows)){ 
       $jid = $row['id'];

     }

     $desp='Cash from '.$srcname;


     $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

     $desp='Pay for '.$destname;

     $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$desttypeid','$destbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

   }
   else{
     $rows =mysqli_query($con,"SELECT * FROM acts where id=$srcid ORDER BY name" ) or die(mysqli_error($con));
     while($row=mysqli_fetch_array($rows)){ 
       $srcname = $row['name'];
       $srcbalance = $row['balance'];
       $srctype = $row['type'];
       $srctypeid = $row['typeid'];
     }

     $destid=$destid;
     $rows =mysqli_query($con,"SELECT * FROM acts where id=$destid ORDER BY name" ) or die(mysqli_error($con));
     while($row=mysqli_fetch_array($rows)){ 
       $destname = $row['name'];
       $destbalance = $row['balance'];
       $desttype = $row['type'];
       $desttypeid = $row['typeid'];

     }

             //First Entry

     $srcbalance=$srcbalance-$amount;
     $destbalance=$destbalance+$amount;



     $desp=$_POST['desp'];

                           //Journal Entry
     $data=mysqli_query($con,"INSERT INTO journal (desp,dract,cract,cr,dr,datec,dateup)VALUES ('$desp','$srcid','$destid','$amount','$amount','$datec','$dateup')")or die( mysqli_error($con) );


     $sqls = "UPDATE acts SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
     mysqli_query($con, $sqls)or die(mysqli_error($con));

     $sqls = "UPDATE acts SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
     mysqli_query($con, $sqls)or die(mysqli_error($con));






                           //Ledger Entry
     $rows =mysqli_query($con,"SELECT id FROM journal ORDER BY id desc limit 1" ) or die(mysqli_error($con));
     while($row=mysqli_fetch_array($rows)){ 
       $jid = $row['id'];

     }

     $desp='Cash from '.$srcname;


     $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

     $desp='Pay for '.$destname;

     $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$desttypeid','$destbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

   }

 $msg = 'Successful';
  }
     

?>



<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
  <div class="content-wrapper">



  	  	<div class="col-sm-12">
  	  	  <div class="card">
  	  	    <div class="card-header" style="padding-bottom: 0px;">
  	  	      <h4 class="card-title">Add Long Term Assets</h4>
  	  	    </div>
  	  	    <div class="card-block">
  	  	      <div class="card-body">
  	  	      	<form action="" method="post">
  	  	      	<div class="row">

                  <div class="col-sm-1">
                  
                   </div>
                  <div class="col-sm-3">
                    <center><span>Date:</span></center>
                      <input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d') ?>">
                  </div>

                  <div class="col-sm-3">
                    <center><span>Select Account:</span></center>
                    <select class="form-control select2" name="dest">

                      <?php

                      $rows =mysqli_query($con,"SELECT * FROM acts WHERE typeid ='6'  ORDER BY name" ) or die(mysqli_error($con));
                                
                        while($row=mysqli_fetch_array($rows)){
                          
                          $id = $row['id'];
                          $name = $row['name']; ?>

                      <option value="<?php echo $id ?>"><?php echo $name ?></option>

                      <?php } ?>

                    </select>

                  </div>
                  <div class="col-sm-3">
                    <center><span>Payment Methods:</span></center>
                    <select class="form-control select2" name="src">

                      <?php

                      $rows =mysqli_query($con,"SELECT * FROM acts WHERE purpose ='cash'  ORDER BY name" ) or die(mysqli_error($con));
                                
                        while($row=mysqli_fetch_array($rows)){
                          
                          $id = $row['id'];
                          $name = $row['name']; ?>

                      <option value="<?php echo $id ?>"><?php echo $name ?></option>

                      <?php } ?>

                    </select>

                  </div>
                  <div class="col-sm-2">
                  </div>

                  <div class="col-sm-9">
                    <span>Description:</span>
                      <input type="text" class="form-control" name="desp" placeholder="Description">
                  </div>

                  <div class="col-sm-2">
                    <span>Amount Rs: </span>
                      <input type="number" class="form-control" name="amount" placeholder="0">
                  </div>
                 

                  <div class="col-sm-5">
                  </div>
  		  	      	<div class="col-sm-1">
  			  	      	<span>&nbsp;</span>
  			  	          <input type="submit" class="btn btn-primary" name="submit" value="Add Expense">
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