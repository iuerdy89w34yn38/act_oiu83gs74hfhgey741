  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">
  <head>

    <?php include"include/connect.php" ?>
    <?php include"include/head.php" ?>

    <title>Trial Balance - <?php echo $comp_name ?>  </title>
    <style type="text/css">
    hr {
      margin-top: 10px;
      margin-bottom: 10px;
      border: 0;
      border-top: 1px solid rgba(0, 0, 0, 0.3);
    }
    table{
      font-family: "Quicksand", Georgia, "Times New Roman", Times, serif;
      font-weight: 400;
    }
    th{
      text-align: center;
      vertical-align: middle !important;

    }
    tbody>tr:hover{
      background: #d8d9da;
    }
    tbody>tr:nth-of-type(odd):hover {
        background-color: #c6c7c7 !important;
    }
  </style>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<?php $link="trialbal.php"; ;?>

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
            <h4 class="card-title">Trial Balance  form <?php echo $dates ?> to <?php echo $datee ?></h4>

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
              $tbalance = $opbalance;
              $btdbalance =0;
              $btcbalance =0;
              $ctdbalance =0;
              $ctcbalance =0;
              $etdbalance =0;
              $etcbalance =0;

              $rowsty =mysqli_query($con,"SELECT * FROM act_t  where id LIKE '$act' ORDER BY tbshow" ) or die(mysqli_error($con));

              while($rowty=mysqli_fetch_array($rowsty)){

                $acttype=$rowty['name'];
                $acttypeid=$rowty['id'];

              ?>

              
              <table class="table table-striped table-bordered ">
                <thead>
                  <tr>
                    <th colspan="8" ><?php echo $acttype ?></th>

                  </tr>
                  <tr>
                    <th rowspan="2" >Description</th>
                    <th rowspan="2">Account ID</th>
                    <th colspan="2">Begining</th>
                    <th colspan="2">Current</th>
                    <th colspan="2">Closing</th>

                  </tr>
                  <tr>

                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Debit</th>
                    <th>Credit</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $btdr=0;
                  $btcr=0;
                  $ctdr=0;
                  $ctcr=0;
                  $etdr=0;
                  $etcr=0;

                  $nbtdbalance =0;
                  $nbtcbalance =0;
                  $nctdbalance =0;
                  $nctcbalance =0;
                  $netdbalance =0;
                  $netcbalance =0;

                  $rowst =mysqli_query($con,"SELECT * FROM acts  where typeid LIKE '$acttypeid' ORDER BY id" ) or die(mysqli_error($con));

                  while($rowt=mysqli_fetch_array($rowst)){

                    $actname=$rowt['name'];
                    $actid=$rowt['id'];
                    $btdr=0;
                    $btcr=0;
                    $ctdr=0;
                    $ctcr=0;
                    $etdr=0;
                    $etcr=0;
                  
                  if($actid==200022){

                    $rows =mysqli_query($con,"SELECT * FROM journal  where datec<'$dates'  AND ref=0 and typeid LIKE '$actid' ORDER BY id" ) or die(mysqli_error($con));

                    while($row=mysqli_fetch_array($rows)){

                      $bdr=$row['dr'];
                      $bcr=$row['cr']; 
                      $btdr=$btdr+$bdr;
                      $btcr=$btcr+$bcr;

                      $nbtdbalance = $nbtdbalance + $btdr;
                      $nbtcbalance = $nbtcbalance + $btcr;

                    }

                    $btdbalance = $btdbalance + $btdr;
                    $btcbalance = $btcbalance + $btcr;

                    $rows =mysqli_query($con,"SELECT * FROM journal  where datec<='$datee' and datec>'$dates' AND ref=0 and typeid LIKE '$actid' ORDER BY id" ) or die(mysqli_error($con));

                    while($row=mysqli_fetch_array($rows)){

                      $cdr=$row['dr'];
                      $ccr=$row['cr']; 
                      $ctdr=$ctdr+$cdr;
                      $ctcr=$ctcr+$ccr;

                     
                     $nctdbalance = $nctdbalance + $cdr;
                     $nctcbalance = $nctcbalance + $ccr;
                    }
                    $ctdbalance = $ctdbalance + $ctdr;
                    $ctcbalance = $ctcbalance + $ctcr;
                    
                    $rows =mysqli_query($con,"SELECT * FROM journal  where datec<='$datee' AND ref=0 and  typeid LIKE '$actid' ORDER BY id" ) or die(mysqli_error($con));

                    while($row=mysqli_fetch_array($rows)){

                      $edr=$row['dr'];
                      $ecr=$row['cr']; 
                      $etdr=$etdr+$edr;
                      $etcr=$etcr+$ecr;

                    $netdbalance = $netdbalance + $edr;
                    $netcbalance = $netcbalance + $ecr;
 
                    }
                    $etdbalance = $etdbalance + $etdr;
                    $etcbalance = $etcbalance + $etcr;


                    $ctdr = $etdr - $btdr;
                    $ctcr = $etcr - $btcr;

                    $nctdbalance = $netdbalance - $nbtdbalance;
                    $nctcbalance = $netcbalance - $nbtcbalance;

                    $ctdbalance = $etdbalance - $btdbalance;
                    $ctcbalance = $etcbalance - $btcbalance;


                  }
                  else if($actid==200021){

                    $rows =mysqli_query($con,"SELECT * FROM journal  where datec<'$dates'  AND ref=0 and typeid LIKE '$actid' ORDER BY id" ) or die(mysqli_error($con));

                    while($row=mysqli_fetch_array($rows)){

                      $bdr=$row['dr'];
                      $bcr=$row['cr']; 
                      $btdr=$btdr+$bdr;
                      $btcr=$btcr+$bcr;

                      $nbtdbalance = $nbtdbalance + $bdr;
                      $nbtcbalance = $nbtcbalance + $bcr;
                    }


                    $btdbalance = $btdbalance + $btdr;
                    $btcbalance = $btcbalance + $btcr;

          


                    $rows =mysqli_query($con,"SELECT * FROM journal  where datec<='$datee'  AND ref=0 and  typeid LIKE '$actid' ORDER BY id" ) or die(mysqli_error($con));

                    while($row=mysqli_fetch_array($rows)){

                      $edr=$row['dr'];
                      $ecr=$row['cr']; 
                      $etdr=$etdr+$edr;
                      $etcr=$etcr+$ecr;

                     
                     $netdbalance = $netdbalance + $edr;
                     $netcbalance = $netcbalance + $ecr;

                    }
                    $etdbalance = $etdbalance + $etdr;
                    $etcbalance = $etcbalance + $etcr;


                    $ctdr = $etdr - $btdr;
                    $ctcr = $etcr - $btcr;

                    $nctdbalance = $netdbalance - $nbtdbalance;
                    $nctcbalance = $netcbalance - $nbtcbalance;

                    $ctdbalance = $etdbalance - $btdbalance;
                    $ctcbalance = $etcbalance - $btcbalance;

                }else{

                  $rows =mysqli_query($con,"SELECT * FROM journal  where datec<'$dates'  AND ref=0 and actid LIKE '$actid' ORDER BY id" ) or die(mysqli_error($con));

                  while($row=mysqli_fetch_array($rows)){

                    $bdr=$row['dr'];
                    $bcr=$row['cr']; 
                    $btdr=$btdr+$bdr;
                    $btcr=$btcr+$bcr;

                    $nbtdbalance = $nbtdbalance + $bdr;
                    $nbtcbalance = $nbtcbalance + $bcr;
                  }

                  $btdbalance = $btdbalance + $btdr;
                  $btcbalance = $btcbalance + $btcr;

      


                  $rows =mysqli_query($con,"SELECT * FROM journal  where datec<='$datee'  AND ref=0  and actid LIKE '$actid' ORDER BY id" ) or die(mysqli_error($con));

                  while($row=mysqli_fetch_array($rows)){

                    $edr=$row['dr'];
                    $ecr=$row['cr']; 
                    $etdr=$etdr+$edr;
                    $etcr=$etcr+$ecr;

                   
                   $netdbalance = $netdbalance + $edr;
                   $netcbalance = $netcbalance + $ecr;

                  }
                  $etdbalance = $etdbalance + $etdr;
                  $etcbalance = $etcbalance + $etcr;

                  $ctdr = $etdr - $btdr;
                  $ctcr = $etcr - $btcr;

                  $nctdbalance = $netdbalance - $nbtdbalance;
                  $nctcbalance = $netcbalance - $nbtcbalance;

                  $ctdbalance = $etdbalance - $btdbalance;
                  $ctcbalance = $etcbalance - $btcbalance;

                }
                    ?>
                  <tr>
                    
                    <td><?php echo $actname ?></td>
                    <td><?php echo $actid ?></td>
                    <td><?php echo number_format($btdr) ?></td>
                    <td><?php echo number_format($btcr) ?></td>
                    <td><?php echo number_format($ctdr) ?></td>
                    <td><?php echo number_format($ctcr) ?></td>
                    <td><?php echo number_format($etdr) ?></td>
                    <td><?php echo number_format($etcr) ?></td>
                  </tr>



                <?php } ?>

                </tbody>
                <tfoot>
                  
                  <th colspan="2" style="text-align: right;">Accounts Total: </th>
                  <th><?php echo number_format( $btdbalance )?></th>
                  <th><?php echo number_format( $btcbalance ) ?></th>
                  <th><?php echo number_format( $ctdbalance )?></th>
                  <th><?php echo number_format( $ctcbalance )?></th>
                  <th><?php echo number_format( $etdbalance )?></th>
                  <th><?php echo number_format( $etcbalance )?></th>
                </tfoot>
               <tfoot>
                  
                  <th colspan="2" align="right">Total</th>
                  <th><?php echo number_format( $nbtdbalance )?></th>
                  <th><?php echo number_format( $nbtcbalance ) ?></th>
                  <th><?php echo number_format( $nctdbalance )?></th>
                  <th><?php echo number_format( $nctcbalance )?></th>
                  <th><?php echo number_format( $netdbalance )?></th>
                  <th><?php echo number_format( $netcbalance )?></th>
                </tfoot>
              </table>
              <br>
            <?php } ?>
            </form>
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
                <p>Select Account</p>
                <select class="form-control select2" name="act">
                  <option value="%"> All </option>
                  <?php

                  $rows =mysqli_query($con,"SELECT * FROM act_t  ORDER BY name" ) or die(mysqli_error($con));

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