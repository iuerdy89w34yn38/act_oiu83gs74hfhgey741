<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>

  <title>Invoice - <?php echo $comp_name ?>  </title>
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

<?php $link="viewpinv.php"; ;?>



<?php if (!empty($_GET['id'])){
 $id=$_GET['id'] ; 
}?>


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

                <h4>Select Purchase Invoice ID:</h4>
                  <div class="input-group">
                    <select class="form-control select2" name="id">



                      <?php

                      $rows =mysqli_query($con,"SELECT invoiceno FROM journal WHERE invoicepic!='Null' AND dract=200018 " ) or die(mysqli_error($con));

                      while($row=mysqli_fetch_array($rows)){


                        $name = $row['invoiceno']; ?>

                        <option value="<?php echo $name ?>"><?php echo $name ?></option>

                      <?php } ?>

                    </select>
                  
                    <input type="submit" class="btn">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>

      <?php if (!empty($_GET['id'])){

       $id=$_GET['id'] ;

       $rows =mysqli_query($con,"SELECT invoicepic FROM journal  where invoiceno='$id' ORDER BY id limit 1" ) or die(mysqli_error($con));

       while($row=mysqli_fetch_array($rows)){

         $invoicepic = $row['invoicepic'];
    

        ?>



        <div class="col-sm-12">
          <div class="card">
            <div class="card-header" style="padding-bottom: 0px;">
              <h4 class="card-title">Invoice <?php echo $id ?></h4>
              <div class="heading-elements">
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
                <br><br>
                <div class="row">
                   <div class="col-md-12">

                    <img src="images/invoices/<?php echo $invoicepic ?>" class="img-fluid">

                   </div>
                </div>
               
              </div>
        </div>
      </div>
    </div>
  </div>

<?php }  } ?>


</div>
</div>


<?php include"include/footer.php" ?>

</body>
</html>