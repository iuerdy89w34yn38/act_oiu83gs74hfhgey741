  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">
  <head>

    <?php include"include/connect.php" ?>
    <?php include"include/head.php" ?>

    <title>General Ledger - <?php echo $comp_name ?>  </title>
    <style type="text/css">
    hr {
      margin-top: 10px;
      margin-bottom: 10px;
      border: 0;
      border-top: 1px solid rgba(0, 0, 0, 0.3);
    }
  </style>
  
</head>
<body style="background: none;" class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" onload="window.print(); //window.close();">

<?php $link="genled.php"; ;?>

<?php if (!empty($_POST['dates'])) {
 $dates=$_POST['dates'] ;
 $datee=$_POST['datee'] ;
 $act=$_POST['act'] ;
}
?>

<style type="text/css">
  .table td{
    text-align: left;
  }
  .table thead{
    font-weight: 600;
  }
  .table tfoot{
    font-weight: 600;
  }
  .dataTables_wrapper table {

      width: 100% !important;

  }
</style>




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
              <br>
              <div class="row">
                <div class="col-sm-1 text-right">
                </div>
                <div class="col-sm-2 text-right">

                  <img src="images/logo.png" style="max-width: 100px;">

                </div>
                <div class="col-sm-4">
                  <h3>
                  <?php echo $comp_name ?>
                 </h3>
                </div>
                <div class="col-sm-4">

                  <h3>

                  <?php echo $comp_address ?>
                 - 

                  <?php echo $comp_phone ?>
                </h3>
                </div>

              </div>

              <br>
              <br>


              <?php
 

              if($act>400000 && $act<600000){
                $acts='vendors';
                $ref="'0' OR ref='1'";

              }else
              if($act>600000 && $act<800000){
                $acts='customers';
                $ref="'0' OR ref='1'";
                


              }else{
                $acts='acts';
                $ref=0;


              }


                $rows3 =mysqli_query($con,"SELECT * FROM $acts where id='$act' " ) or die(mysqli_error($con));

                while($row3=mysqli_fetch_array($rows3)){


                    $chkid = $row3['id'];
                   $chkname = $row3['name'];




                ?>

                 <div class="row text-left">

                  <div class="col-sm-1">

                  </div>
                  <div class="col-sm-2 text-right">
                   <h4>Account ID:</h4>
                 </div>
                 <div class="col-sm-2 text-left " >
                   <h4><?php echo $chkid ?>  </h4>
                 </div>
                  <div class="col-sm-2 text-right">
                   <h4> Name:</h4>
                 </div>
                 <div class="col-sm-3 text-left">
                   <h4> <?php echo $chkname ?> </h4>
                 </div>




               </div>



              <?php } ?>
                <br>

              <?php
              $opbalance=Null;
              $rows =mysqli_query($con,"SELECT balance,cr,dr FROM journal  where datec>='$dates' and datec<='$datee' AND ( ref=$ref ) and (actid LIKE '$act' ) ORDER BY id desc limit 1" ) or die(mysqli_error($con));

              while($row=mysqli_fetch_array($rows)){
                $opbalance = $row['balance'];

              } 


              ?>
              <?php
              $opbalance=Null;
              $datey=date('Y-m-d' , strtotime($dates.'-1 days'));
              $rows =mysqli_query($con,"SELECT balance,cr,dr FROM journal where actid LIKE '$act'  AND ( ref=$ref )  AND datec<'$dates' ORDER BY id desc limit 1" ) or die(mysqli_error($con));

              while($row=mysqli_fetch_array($rows)){

                $opbalance = $row['balance'];

              }
              $tbalance = $opbalance;
              ?>




             <table class="table table-bordered">
              <thead>
                <tr>
                <td colspan="5" style="text-align: right;">Opening Balance:</td>
                <td>Rs. <?php  if($opbalance===0) echo '0' ; else echo number_format($opbalance);               ?>/-</td>
              </tr>
             

                <tr>
                <td>Date</td>
                <td>Invoice</td>
                <td>Description</td>
                <td>Debit</td>
                <td>Credit</td>
                <td style="min-width: 150px">Balance</td>
              </tr>
              </thead> 

              <tbody>
                <?php
                $tdr=0;
                $tcr=0;

                $rows =mysqli_query($con,"SELECT * FROM journal  where datec>='$dates' and datec<='$datee'  AND ( ref=$ref ) and (actid LIKE '$act' ) ORDER BY id " ) or die(mysqli_error($con));

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
                    <tr>
                      <td><?php echo $mydate ?></td>
                      <td><?php echo $jid ?></td>
                      <td>  <a href="viewpay.php?id=<?php echo $jid ?>" target="blank"><?php echo $desp ?></a></td>
                      <td><?php echo number_format($dr) ?></td>
                      <td><?php echo number_format($cr) ?></td>
                      <td><?php echo number_format($tbalance); ?></td>
                    </tr>

                    <?php } ?>



              </tbody>
              <tfoot>
                <tr>
                <td></td>
                <td></td>
                <td style="text-align: right;">Total:</td>
                <td><?php echo number_format($tdr) ?></td>
                <td><?php echo number_format($tcr) ?></td>
                <td></td>
              </tr>
              <tr>

                <td colspan="5" style="text-align: right;">Closing Balance:</td>
                <td>Rs. <?php if($tbalance===0) echo '0' ; else echo number_format($tbalance) ?>/-</td>
              </tr>
              </tfoot>
             </table>

           



      <center><h2><?php if(!empty($msg))  echo $msg ;?></h2></center>
    </div>
  </div>
</div>
</div>

<?php } ?>

</div>
</div>


<?php include"include/footer.php" ?>

</body>
</html>