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

<?php $link="daybook.php"; ;?>

<?php if (empty($_GET['date']))  $date=date('Y-m-d') ;?>
<?php if (!empty($_GET['date']))  $date=$_GET['date'] ;?>





<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
  <div class="content-wrapper">


<form action="" method="GET">
<div class="row">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
  <div class="card">
    <div class="card-block">
      <div class="card-body">

        <div class="input-group">
          <input type="date" class="form-control" name="date" value="<?php echo $date ?>"> <input type="submit" class="btn">
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</form>


<div class="col-sm-12">
  <div class="card">
    <div class="card-header" style="padding-bottom: 0px;">
      <h4 class="card-title">Daybook for <?php echo $date ?></h4><div class="heading-elements">
            <ul class="list-inline mb-0">
              <li><a data-action="reload"><i class="la la-retweet"></i></a></li>
              <li><a data-action="collapse"><i class="la la-minus"></i></a></li>
              <li><a data-action="expand"><i class="la la-square-o"></i></a></li>
              <li><a data-action="close"><i class="la la-close"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="card-content collpase show">
      <div class="card-body">
        
        <?php
        $opbalance=Null;
        $rows =mysqli_query($con,"SELECT balance,cr,dr FROM ledger where actid = 200016 AND datec<'$date' ORDER BY id desc limit 1" ) or die(mysqli_error($con));

        while($row=mysqli_fetch_array($rows)){

          $opbalance = $row['balance'];
         
}
          ?>
         <div class="row align-conter-center">

          <div class="col-sm-8">
          </div>
          <div class="col-sm-4">
           <h3>Opening Balance: <strong>Rs. <?php  if($opbalance===0) echo '0'; else echo number_format($opbalance)
            ?>/-</strong></h3>
           <hr>
         </div>
       </div>
       
         <div class="row align-conter-center">

          <div class="col-sm-1">
           <h4>ID</h4>
         </div>
          <div class="col-sm-7">
           <h4>Description</h4>
         </div>
          <div class="col-sm-2">
           <h4>Debit</h4>
         </div>
          <div class="col-sm-2">
           <h4>Credit</h2>
         </div>

       </div>
       <?php
       $tdr=0;
       $tcr=0;

       $rows =mysqli_query($con,"SELECT * FROM journal  where datec='$date' ORDER BY id " ) or die(mysqli_error($con));

       while($row=mysqli_fetch_array($rows)){

         $id = $row['id'];
         $dract=$row['dract'];
         $cract=$row['cract']; 
         $dr=$row['dr']; 
         $cr=$row['cr']; 
         $desp=$row['desp']; 

         if($dract=='200016' OR $cract=='200016'){

         $tdr=$tdr+$dr;
         $tcr=$tcr+$cr;
         ?>

         <hr>
         <div class="row  align-items-center" align="">

          <div class="col-sm-1">
           <h5><?php echo $id ?></h5>
         </div> 
         
          <div class="col-sm-7">

            <a href="viewpay.php?id=<?php echo $id ?>" target="blank"><h5><?php echo $desp ?></h5></a>
         </div> 
         
          <div class="col-sm-2">
           <h5><?php echo number_format($dr) ?></h5>
         </div> 
         
          <div class="col-sm-2">
           <h5><?php echo number_format($cr) ?></h5>
         </div> 


       </div>

     <?php }
     else{ ?>

      <?php
      $rowsl =mysqli_query($con,"SELECT * FROM ledger  where jid='$id' ORDER BY id " ) or die(mysqli_error($con));

      while($rowl=mysqli_fetch_array($rowsl)){

        $lid = $rowl['id'];

        $dr=$rowl['dr']; 
        $cr=$rowl['cr']; 
        $desp=$rowl['desp']; 
        $tdr=$tdr+$dr;
        $tcr=$tcr+$cr;
        ?>

        <hr>
        <div class="row  align-items-center" align="">

         <div class="col-sm-1">
          <h5><?php echo $lid ;?></h5>
        </div> 
        
         <div class="col-sm-7">

           <a href="viewpay.php?id=<?php echo $id ?>" target="blank"><h5><?php echo $desp ?></h5></a>
        </div> 
        
         <div class="col-sm-2">
          <h5><?php echo number_format($dr) ?></h5>
        </div> 
        
         <div class="col-sm-2">
          <h5><?php echo number_format($cr) ?></h5>
        </div> 


      </div>



      <?php } } } ?>

     <div class="row align-conter-center">

      <div class="col-sm-8 text-right">
        <hr>
       <h4>Total</h4>
     </div>
      <div class="col-sm-2">
        <hr>
       <h4><?php echo number_format($tdr) ?></h4>
     </div>
      <div class="col-sm-2">
        <hr>
       <h4><?php echo number_format($tcr) ?></h2>
     </div>

   </div>

           <?php

           $rows =mysqli_query($con,"SELECT balance FROM ledger where actid = 200016 AND datec='$date' ORDER BY id desc limit 1" ) or die(mysqli_error($con));

           while($row=mysqli_fetch_array($rows)){

             $clbalance = $row['balance'];
   }
             ?>
            <div class="row align-conter-center">

             <div class="col-sm-8">
             </div>
             <div class="col-sm-4">
              <hr>
              <h3> Closing Balance: <strong>Rs. <?php if(!empty($clbalance))  echo number_format($clbalance) ?>/-</strong></h3>
              
            </div>
          </div>


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