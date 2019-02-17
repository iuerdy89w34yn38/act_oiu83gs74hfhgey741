  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">
  <head>

    <?php include"include/connect.php" ?>
    <?php include"include/head.php" ?>

    <title>Vendors Ledger - <?php echo $comp_name ?>  </title>
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

<?php $link="genledvend.php"; ;?>

<?php if (!empty($_POST['dates'])) {
 $dates=$_POST['dates'] ;
 $datee=$_POST['datee'] ;
 $act=$_POST['act'] ;
}
?>





<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
  <div class="content-wrapper">

    <?php if(!empty($dates)) { ?>

      <div class="col-sm-12">
        <div class="card">
          <div class="card-header" style="padding-bottom: 0px;">
            <h4 class="card-title">Ledger form <?php echo $dates ?> to <?php echo $datee ?></h4>

            <div class="heading-elements">
              <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="la la-minus"></i></a></li>
                <li><a data-action="expand"><i class="la la-square-o"></i></a></li>
                <li><a data-action="close"><i class="la la-close"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="card-content collpase show">
            <div class="card-body">
             <form action="tdetail.php" method="get">
              <?php
              $opbalance=Null;
              $rows =mysqli_query($con,"SELECT balance,cr,dr FROM ledger  where datec>='$dates' and datec<='$datee' AND (actid LIKE '$act' ) ORDER BY id desc limit 1" ) or die(mysqli_error($con));

              while($row=mysqli_fetch_array($rows)){
                $opbalance = $row['balance'];

              } 


              ?>
              <?php
              $opbalance=Null;
              $datey=date('Y-m-d' , strtotime($dates.'-1 days'));
              $rows =mysqli_query($con,"SELECT balance,cr,dr FROM ledger where actid LIKE '$act'  AND datec<'$dates' ORDER BY id desc limit 1" ) or die(mysqli_error($con));

              while($row=mysqli_fetch_array($rows)){

                $opbalance = $row['balance'];

              }
              $tbalance = $opbalance;
              ?>


              <div class="row align-conter-center">

                <div class="col-sm-8">
                </div>
                <div class="col-sm-4">
                 <h3>Opening Balance: <strong>Rs. <?php  if($opbalance===0) echo '0' ; else echo number_format($opbalance);
                 ?>/-</strong></h3>
                 <hr>
               </div>
             </div>

             <div class="row align-conter-center">

              <div class="col-sm-2">
               <h4>Invoice - Date</h4>
             </div>
             <div class="col-sm-6">
               <h4>Description</h4>
             </div>
             <div class="col-sm-1">
               <h4>Debit</h4>
             </div>
             <div class="col-sm-1">
               <h4>Credit</h2>
               </div>
               <div class="col-sm-2">
                 <h4>Balance</h2>
                 </div>

               </div>
               <?php
               $tdr=0;
               $tcr=0;

               $rows =mysqli_query($con,"SELECT * FROM ledger  where datec>='$dates' and datec<='$datee'  AND  (actid LIKE '$act' ) ORDER BY id" ) or die(mysqli_error($con));

               while($row=mysqli_fetch_array($rows)){

                 $id = $row['id'];
                 $jid = $row['jid'];
                 $desp = $row['desp'];
                 $dr=$row['dr'];
                 $cr=$row['cr']; 
                 $datec=$row['datec']; 
                 $tdr=$tdr+$dr;
                 $tcr=$tcr+$cr;

                 $time = strtotime($datec);
                 $mydate = date("m/d/Y", $time);

                 $tbalance = $tbalance + $dr;
                 $tbalance = $tbalance - $cr;
                 ?>

                 <hr>
                 <div class="row  align-items-center" align="">

                  <div class="col-sm-2">
                   <h5><?php echo $jid ?> - <?php echo $mydate ?></h5>
                 </div> 

                 <div class="col-sm-6">
                  <a href="viewpay.php?id=<?php echo $jid ?>" target="blank"><h6 style="color:#464855;text-decoration: underline;"><?php echo $desp ?></h6></a>
                </div> 

                <div class="col-sm-1">
                 <h5><?php echo number_format($dr) ?></h5>
               </div> 

               <div class="col-sm-1">
                 <h5><?php echo number_format($cr) ?></h5>
               </div>

               <div class="col-sm-2">
                 <h5><?php echo number_format($tbalance); ?></h5>
               </div> 


             </div>

           <?php } ?>
         </form>
         <div class="row align-conter-center">

          <div class="col-sm-8 text-right">
            <hr>
            <h4>Total</h4>
          </div>
          <div class="col-sm-1">
            <hr><strong><h5 style="font-weight: 600"><?php echo number_format($tdr) ?></h5></strong>

          </div>
          <div class="col-sm-1">
            <hr>
            <strong><h5 style="font-weight: 600"><?php echo number_format($tcr) ?></h5></strong>
          </div>

        </div>


        <div class="row align-conter-center">

         <div class="col-sm-8">
         </div>
         <div class="col-sm-4">
          <hr>
          <h3> Closing Balance: <strong>Rs. <?php if($tbalance===0) echo '0' ; else echo number_format($tbalance) ?>/-</strong></h3>
        </div>
      </div>


      <center><h2><?php if(!empty($msg))  echo $msg ;?></h2></center>
    </div>
  </div>
</div>
</div>


<?php } ?>

<?php 
if (empty($_POST['dates'])) {
 $dates=date('Y-m-d');
 $datee=date('Y-m-d');
}
?>
<form action="" method="POST">
  <div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-10">
      <div class="card">
        <div class="card-block">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-md-3">
                <p>Starting Date:</p>
                <div class="input-group">
                  <input type="date" class="form-control" name="dates" value="<?php echo $dates ?>"> 
                </div>
              </div>
              <div class="col-md-3">

                <p>Ending Date:</p>
                <div class="input-group">
                  <input type="date" class="form-control" name="datee" value="<?php echo $datee ?>">
                </div>
              </div>

              <div class="col-sm-4">
                <p>Select Vendors Account</p>
                <select class="form-control select2" name="act">
                 
                  <?php

                  $rows =mysqli_query($con,"SELECT * FROM vendors  ORDER BY name" ) or die(mysqli_error($con));

                  while($row=mysqli_fetch_array($rows)){

                    $slug = $row['id'];
                    $name = $row['name']; ?>

                    <option value="<?php echo $slug ?>" <?php if(!empty($act)) if($act==$slug) echo 'selected'; ?>><?php echo $name ?></option>

                  <?php } ?>
                  

                </select>

              </div>
              <div class="col-md-1"> <input type="submit" class="btn">        </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</form>



</div>
</div>


<?php include"include/footer.php" ?>

</body>
</html>