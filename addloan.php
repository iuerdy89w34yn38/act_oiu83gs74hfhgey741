<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>

  <title>Add / Pay Loan - <?php echo $comp_name ?>  </title>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<?php $link="addloan.php"; ;?>


<?php
if(isset($_POST['submitcap'])){
  $msg="Unsuccessful" ;

  $srcid=$_POST['src'];
  $destid=$_POST['dest'];
  $amount = $_POST['amount'];


  $datec=date('Y-m-d');
  $dateup=date('Y-m-d');



  if($destid==200016){

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


   $srcbalance=$srcbalance+$amount;
   $destbalance=$destbalance+$amount;




   $desp='Loan is Acquired from'.$srcname.' to '.$destname;

                             //transaction Entry
   $data=mysqli_query($con,"INSERT INTO transaction (desp,dract,cract,dr,datec,dateup)VALUES ('$desp','$srcid','$destid','$amount','$datec','$dateup')")or die( mysqli_error($con) );


   $sqls = "UPDATE acts SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
   mysqli_query($con, $sqls)or die(mysqli_error($con));

   $sqls = "UPDATE acts SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
   mysqli_query($con, $sqls)or die(mysqli_error($con));






                             //Ledger Entry
   $rows =mysqli_query($con,"SELECT id FROM transaction ORDER BY id desc limit 1" ) or die(mysqli_error($con));
   while($row=mysqli_fetch_array($rows)){ 
     $jid = $row['id'];

   }

   $desp='Loan is Acquired from '.$srcname;


   $data=mysqli_query($con,"INSERT INTO journal (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

   $desp='Cash is Coming in '.$destname;

   $data=mysqli_query($con,"INSERT INTO journal (jid,actid,desp,type,typeid,balance,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$desttypeid','$destbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

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

   $srcbalance=$srcbalance+$amount;
   $destbalance=$destbalance+$amount;



   $desp='Loan is Acquired from'.$srcname.' to '.$destname;

                         //transaction Entry
   $data=mysqli_query($con,"INSERT INTO transaction (desp,dract,cract,cr,dr,datec,dateup)VALUES ('$desp','$destid','$srcid','$amount','$amount','$datec','$dateup')")or die( mysqli_error($con) );


   $sqls = "UPDATE acts SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
   mysqli_query($con, $sqls)or die(mysqli_error($con));

   $sqls = "UPDATE acts SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
   mysqli_query($con, $sqls)or die(mysqli_error($con));






                         //Ledger Entry
   $rows =mysqli_query($con,"SELECT id FROM transaction ORDER BY id desc limit 1" ) or die(mysqli_error($con));
   while($row=mysqli_fetch_array($rows)){ 
     $jid = $row['id'];

   }

   $desp='Loan is Acquired from '.$srcname;


   $data=mysqli_query($con,"INSERT INTO journal (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

   $desp='Cash is Coming in '.$destname;

   $data=mysqli_query($con,"INSERT INTO journal (jid,actid,desp,type,typeid,balance,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$desttypeid','$destbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

 }

 $msg='Successful';
}



?>



<?php
if(isset($_POST['submitloan'])){
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
   $destbalance=$destbalance-$amount;




   $desp='Loan is Paid from'.$srcname.' to '.$destname;

                             //transaction Entry
   $data=mysqli_query($con,"INSERT INTO transaction (desp,dract,cract,cr,datec,dateup)VALUES ('$desp','$destid','$srcid','$amount','$datec','$dateup')")or die( mysqli_error($con) );


   $sqls = "UPDATE acts SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
   mysqli_query($con, $sqls)or die(mysqli_error($con));

   $sqls = "UPDATE acts SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
   mysqli_query($con, $sqls)or die(mysqli_error($con));






                             //Ledger Entry
   $rows =mysqli_query($con,"SELECT id FROM transaction ORDER BY id desc limit 1" ) or die(mysqli_error($con));
   while($row=mysqli_fetch_array($rows)){ 
     $jid = $row['id'];

   }

   $desp='Loan is Acquired from '.$srcname;


   $data=mysqli_query($con,"INSERT INTO journal (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

   $desp='Cash is Coming in '.$destname;

   $data=mysqli_query($con,"INSERT INTO journal (jid,actid,desp,type,typeid,balance,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$desttypeid','$destbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

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
   $destbalance=$destbalance-$amount;



   $desp='Loan is Acquired from'.$srcname.' to '.$destname;

                         //transaction Entry
   $data=mysqli_query($con,"INSERT INTO transaction (desp,dract,cract,cr,dr,datec,dateup)VALUES ('$desp','$destid','$srcid','$amount','$amount','$datec','$dateup')")or die( mysqli_error($con) );


   $sqls = "UPDATE acts SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
   mysqli_query($con, $sqls)or die(mysqli_error($con));

   $sqls = "UPDATE acts SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
   mysqli_query($con, $sqls)or die(mysqli_error($con));






                         //Ledger Entry
   $rows =mysqli_query($con,"SELECT id FROM transaction ORDER BY id desc limit 1" ) or die(mysqli_error($con));
   while($row=mysqli_fetch_array($rows)){ 
     $jid = $row['id'];

   }

   $desp='Loan is Paid from '.$srcname;


   $data=mysqli_query($con,"INSERT INTO journal (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

   $desp='Cash is Paid to '.$destname;

   $data=mysqli_query($con,"INSERT INTO journal (jid,actid,desp,type,typeid,balance,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$desttypeid','$destbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

 }

 $msg='Successful';

} 
 
?>



<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
  <div class="content-wrapper">


    <div class="col-sm-12">
      <div class="card">
        <div class="card-block">
          <div class="card-body">
           
            <h2>Current Cash Status</h2>
           
           <?php // Overall - For all types of Account from Ledger by account type
           $gtotal=0;
           $allrows =mysqli_query($con,"SELECT id,name FROM acts WHERE purpose='cash'  ORDER BY name" ) or die(mysqli_error($con));
           while($allrow=mysqli_fetch_array($allrows)){
            $actid = $allrow['id'];
            $actname = $allrow['name'];
            
            $tcr=0;
            $tdr=0;
            $total=0;
            $rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$actid " ) or die(mysqli_error($con));

            while($row=mysqli_fetch_array($rows)){
              $cr = $row['cr'];
              $tcr=$tcr+$cr;
            } 
            $rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$actid " ) or die(mysqli_error($con));
            
            while($row=mysqli_fetch_array($rows)){
              $dr = $row['dr'];
              $tdr=$tdr+$dr;
            } 
            $total=$tdr-$tcr;
            $gtotal=$gtotal+$total;
            ?>

       

           <div class="row align-items-center">
            <div class="col-md-3">
            </div>
            <div class="col-md-4">
                                
              <h3><?php echo $actname ?>:</h3>
            </div>
            <div class="col-md-2">
                                
              <h3>Rs. <?php echo number_format($total);   ?>/-</h3>
            </div>
            </div>


            <?php } ?>
    
    


          <hr>
          <div class="row align-items-center">
           <div class="col-md-3">
           </div>
           <div class="col-md-4">
                               
             <h3>Total :</h3>
           </div>
           <div class="col-md-2">
                               
             <h3>Rs. <?php echo number_format($gtotal) ?>/-</h3>
           </div>
           </div>

        </div>
      </div>
    </div>



    <div class="col-sm-12">
      <div class="card">
        <div class="card-block">
          <div class="card-body">


         <form action="" method="post">
          <h2>Add Loan</h2>
          <div class="row">

            <div class="col-sm-1">
            </div>
            <div class="col-sm-4">
              <span>Liability Account</span>
              <select class="form-control select2" name="src">
                <?php

                $rows =mysqli_query($con,"SELECT * FROM acts where typeid='3' AND id!='200022'  ORDER BY name" ) or die(mysqli_error($con));

                while($row=mysqli_fetch_array($rows)){

                  $id = $row['id'];
                  $name = $row['name']; ?>

                  <option value="<?php echo $id ?>"><?php echo $name ?></option>

                <?php } ?>

              </select>
            </div>
            <div class="col-sm-3">
              <span>Destination Account</span>
              <select class="form-control select2" name="dest">
                <?php

                $rows =mysqli_query($con,"SELECT * FROM acts where purpose='cash'  ORDER BY name" ) or die(mysqli_error($con));

                while($row=mysqli_fetch_array($rows)){

                  $id = $row['id'];
                  $name = $row['name']; ?>

                  <option value="<?php echo $id ?>"><?php echo $name ?></option>

                <?php } ?>

              </select>

            </div>
            <div class="col-sm-2">
              <span>Amount </span>
              <input type="number" name="amount" class="form-control" placeholder="0">
            </div>
            <div class="col-sm-1">
              <span>&nbsp;</span>
              <input type="submit" class="btn btn-primary" name="submitcap" value="Add">
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





  <div class="col-sm-12">
    <div class="card">
      <div class="card-block">
        <div class="card-body">

          <h2>Current Loan Payables</h2>
          <?php
          $tb=0;
          $rows =mysqli_query($con,"SELECT * FROM acts where typeid='3' AND balance>0 AND id!='200022'  ORDER BY name" ) or die(mysqli_error($con));

          while($row=mysqli_fetch_array($rows)){

            $id = $row['id'];
            $name = $row['name'];
            $balance = $row['balance'];
            $tb=$tb+$balance;

            ?>
            <div class="row align-items-center">
              <div class="col-md-3">
              </div>
              <div class="col-md-4">

                <h3><?php echo $name ?>:</h3>
              </div>
              <div class="col-md-2">

                <h3>Rs. <?php echo number_format($balance);   ?>/-</h3>
              </div>
            </div>

          <?php } ?>


          <div class="row align-items-center">
           <div class="col-md-3">
           </div>
           <div class="col-md-4">
            <hr>                 
            <h3>Total :</h3>
          </div>
          <div class="col-md-2">
           <hr>                  
           <h3>Rs. <?php echo number_format($tb) ?>/-</h3>
         </div>
       </div>
       <hr>

       <form action="" method="post">
        <h2>Pay Loan</h2>
        <div class="row">

          <div class="col-sm-1">
          </div>
          <div class="col-sm-4">
           <span>Liability Account</span>
           <select class="form-control select2" name="dest">
            <?php

            $rows =mysqli_query($con,"SELECT * FROM acts where typeid='3' AND id!='200022'  ORDER BY name" ) or die(mysqli_error($con));

            while($row=mysqli_fetch_array($rows)){

              $id = $row['id'];
              $name = $row['name']; ?>

              <option value="<?php echo $id ?>"><?php echo $name ?></option>

            <?php } ?>

          </select>
        </div>
        <div class="col-sm-3">
         <span>Source Account</span>
         <select class="form-control select2" name="src">
          <?php

          $rows =mysqli_query($con,"SELECT * FROM acts where purpose='cash'  ORDER BY name" ) or die(mysqli_error($con));

          while($row=mysqli_fetch_array($rows)){

            $id = $row['id'];
            $name = $row['name']; ?>

            <option value="<?php echo $id ?>"><?php echo $name ?></option>

          <?php } ?>

        </select>

      </div>
      <div class="col-sm-2">
       <span>Amount </span>
       <input type="number" name="amount" class="form-control" placeholder="0">
     </div>
     <div class="col-sm-1">
       <span>&nbsp;</span>
       <input type="submit" class="btn btn-primary" name="submitloan" value="Add">
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