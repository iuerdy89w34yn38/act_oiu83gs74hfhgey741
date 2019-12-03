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
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

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

              <br>
              <br>


              <?php



                $rows3 =mysqli_query($con,"SELECT * FROM acts where id='$act' " ) or die(mysqli_error($con));

                while($row3=mysqli_fetch_array($rows3)){


                   $chkid = $row3['id'];
                   $chkname = $row3['name'];




                ?>

                 <div class="row text-left">

                  <div class="col-sm-2">

                  </div>
                  <div class="col-sm-2">
                   <h4>Account ID:</h4>
                 </div>
                 <div class="col-sm-2">
                   <h4><?php echo $chkid ?>  </h4>
                 </div>
                  <div class="col-sm-2">
                   <h4> Name:</h4>
                 </div>
                 <div class="col-sm-3">
                   <h4> <?php echo $chkname ?> </h4>
                 </div>




               </div>

                <br>

              <?php } ?>
                <br>
                <br>



              <?php
              $opbalance=Null;
              $rows =mysqli_query($con,"SELECT balance,cr,dr FROM journal  where datec>='$dates' and datec<='$datee' AND ref=0 and (actid LIKE '$act' ) ORDER BY id desc limit 1" ) or die(mysqli_error($con));

              while($row=mysqli_fetch_array($rows)){
                $opbalance = $row['balance'];

              } 


              ?>
              <?php
              $opbalance=Null;
              $datey=date('Y-m-d' , strtotime($dates.'-1 days'));
              $rows =mysqli_query($con,"SELECT balance,cr,dr FROM journal where actid LIKE '$act'  AND ref=0  AND datec<'$dates' ORDER BY id desc limit 1" ) or die(mysqli_error($con));

              while($row=mysqli_fetch_array($rows)){

                $opbalance = $row['balance'];

              }
              $tbalance = $opbalance;
              ?>




             <table class="table table-bordered table-striped  dataex-select-multi">
              <thead>
                <tr>
                <td colspan="5" style="text-align: right;">Opening Balance:</td>
                <td>Rs. <?php  if($opbalance===0) echo '0' ; else echo number_format($opbalance,$floating);               ?>/-</td>
              </tr>
             

                <tr>
                <td>Date</td>
                <td>Type</td>
                <td>Invoice</td>
                <td>Description</td>
                <td>Debit</td>
                <td>Credit</td>
                <td>Balance</td>
              </tr>
              </thead> 

              <tbody>
                <?php
                $tdr=0;
                $tcr=0;

                $rows =mysqli_query($con,"SELECT * FROM journal  where datec>='$dates' and datec<='$datee'  AND ref=0 and (actid LIKE '$act' ) ORDER BY id desc" ) or die(mysqli_error($con));

                while($row=mysqli_fetch_array($rows)){

                  $id = $row['id'];
                  $jid = $row['jid'];
                  $desp = $row['desp'];
                  $dr=$row['dr'];
                  $cr=$row['cr']; 
                  $datec=$row['datec']; 
                  $typeid=$row['typeid']; 
                  $tdr=$tdr+$dr;
                  $tcr=$tcr+$cr;



         $rowsx =mysqli_query($con,"SELECT name FROM act_t  where id='$typeid' " ) or die(mysqli_error($con));
         while($rowx=mysqli_fetch_array($rowsx)){

         $typename = $rowx['name'];
         }

                  $time = strtotime($datec);
                  $mydate = date("m/d/Y", $time);

                  $tbalance = $tbalance + $dr;
                  $tbalance = $tbalance - $cr;
                  ?>
                    <tr>
                      <td><?php echo $mydate ?></td>
                      <td><?php echo $typename ?></td>
                      <td><?php echo $jid ?></td>
                      <td>  <a href="viewpay.php?id=<?php echo $jid ?>" target="blank"><?php echo $desp ?></a></td>
                      <td><?php echo number_format($dr,$floating) ?></td>
                      <td><?php echo number_format($cr,$floating) ?></td>
                      <td><?php echo number_format($tbalance,$floating); ?></td>
                    </tr>


                    <?php } ?>

              </tbody>
              <tfoot>
                <tr>
                <td></td>
                <td></td>
                <td style="text-align: right;">Total:</td>
                <td><?php echo number_format($tdr,$floating) ?></td>
                <td><?php echo number_format($tcr,$floating) ?></td>
                <td></td>
              </tr>
              <tr>

                <td colspan="5" style="text-align: right;">Closing Balance:</td>
                <td>Rs. <?php if($tbalance===0) echo '0' ; else echo number_format($tbalance,$floating) ?>/-</td>
              </tr>
              </tfoot>
             </table>





<form action="printledger.php" method="POST" target="blank">
  <div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-10">
      <div class="card">
        <div class="card-block">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-md-3" style="display: none;">
                <p>Starting Date:</p>
                <div class="input-group">
                  <input type="date" class="form-control" name="dates" value="<?php echo $dates ?>"> 
                </div>
              </div>
              <div class="col-md-3" style="display: none;">

                <p>Ending Date:</p>
                <div class="input-group">
                  <input type="date" class="form-control" name="datee" value="<?php echo $datee ?>">
                </div>
              </div>

              <div class="col-sm-3" style="display: none;">
                <p>Select Account</p>
                <select class="form-control select2" name="act">
                  <option value="%"> All </option>
                  <?php

                  $rows =mysqli_query($con,"SELECT * FROM acts where id!=200021 AND id!=200022  ORDER BY name" ) or die(mysqli_error($con));

                  while($row=mysqli_fetch_array($rows)){

                    $slug = $row['id'];
                    $name = $row['name']; ?>

                    <option value="<?php echo $slug ?>" <?php if(!empty($act)) if($act==$slug) echo 'selected'; ?>><?php echo $name ?></option>

                  <?php } ?>
              

                </select>

              </div>

              <div class="col-md-5">     </div>
              <div class="col-md-1"> <button type="submit" class="btn btn-primary" > <i class="la la-print"></i> Print </button>    </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</form>



           



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

              <div class="col-sm-3">
                <p>Select Account</p>
                <select class="form-control select2" name="act">
                  <option value="%"> All </option>
                  <?php

                  $rows =mysqli_query($con,"SELECT * FROM acts where id!=200021 AND id!=200022  ORDER BY name" ) or die(mysqli_error($con));

                  while($row=mysqli_fetch_array($rows)){

                    $slug = $row['id'];
                    $name = $row['name']; ?>

                    <option value="<?php echo $slug ?>" <?php if(!empty($act)) if($act==$slug) echo 'selected'; ?>><?php echo $name ?></option>

                  <?php } ?>
              

                </select>

              </div>

              <div class="col-md-1">     </div>
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