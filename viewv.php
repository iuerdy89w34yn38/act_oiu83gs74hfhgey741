<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>

  <title>Daybook - <?php echo $comp_name ?>  </title>
  <style type="text/css">
    hr {
        margin-top: 10px;
        margin-bottom: 10px;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, 0.3);
    }
  </style>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<?php $link="viewv.php"; ;?>



<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
  <div class="content-wrapper">



<?php if (!empty($_GET['jid'])){
  $jid=$_GET['jid'] ; 
  ?>

<div class="col-sm-12">
  <div class="card">
    <div class="card-header" style="padding-bottom: 0px;">
      <h4 class="card-title">Voucher Detail</h4>
    </div>
    <div class="card-block">
      <div class="card-body">


       
         <div class="row align-conter-center">

          <div class="col-sm-2">
           <h4>Account</h4>
         </div>
          <div class="col-sm-5">
           <h4>Description</h4>
         </div>
          <div class="col-sm-2">
           <h4>Type</h4>
         </div>
          <div class="col-sm-2">
           <h4>Debit</h4>
         </div>
          <div class="col-sm-1">
           <h4>Credit</h2>
         </div>

       </div>
       <?php


       $rows =mysqli_query($con,"SELECT * FROM ledger  where jid='$jid' ORDER BY id " ) or die(mysqli_error($con));

       while($row=mysqli_fetch_array($rows)){

         $id = $row['id'];
         $actid = $row['actid'];
         $desp = $row['desp'];
         $type = $row['type'];
         $dr=$row['dr'];
         $cr=$row['cr'];

         ?>

         <hr>
         <div class="row  align-items-center" align="">

          <div class="col-sm-2">
           <h5><?php echo $actid ?></h5>
         </div> 
         
          <div class="col-sm-5">
           <a href="viewv.php?jid=<?php echo $id ?>"><h5><?php echo $desp ?></h5></a>
         </div> 
          <div class="col-sm-2">
            <p style="text-transform: capitalize;"><?php echo $type ?> </p>
         </div> 
         
          <div class="col-sm-2">
           <h5><?php echo $dr ?></h5>
         </div> 
         
          <div class="col-sm-1">
           <h5><?php echo $cr ?></h5>
         </div> 


       </div>

     <?php }  
   }
   ?>
  



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