<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <?php include"include/connect.php" ?>

  <?php
  if(isset($_POST['update'])){
    $msg="Unsuccessful" ;


    $themeid=$_POST['color'];



    $sql = "UPDATE company SET `theme` = '$themeid' WHERE `id` = 1";

    mysqli_query($con, $sql);

    $msg="Successful" ;

  }

  ?>
  <?php include"include/head.php" ?>

  <title>Settings - <?php echo $comp_name ?>  </title>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<?php $link="settings.php"; ;?>









<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
  <div class="content-wrapper">





     <div class="col-sm-12">
      <div class="card">
        <div class="card-header" style="padding-bottom: 0px;">
          <h4 class="card-title">Select Theme</h4>
        </div>
        <div class="card-block">
          <div class="card-body">
           <form action="" method="post">
             <div class="row">


              <div class="col-sm-3">
              </div>
              <div class="col-sm-4">
                <span>Select Theme</span>
                <select class="form-control select2" name="color"  style="text-transform: capitalize;" >

                  <?php

                  $rows =mysqli_query($con,"SELECT * FROM color  ORDER BY name" ) or die(mysqli_error($con));

                  while($row=mysqli_fetch_array($rows)){

                    $colid = $row['id']; 
                    $colname = $row['name']; 
                    ?>

                    <option value="<?php echo $colid ?>" <?php if($colid==$themeid) echo 'selected'?> ><?php echo $colname ?></option>

                  <?php } ?>

                </select>

              </div>
              

             <div class="col-sm-1">
               <span>&nbsp;</span>
               <button name="update" class="btn btn-primary" value="">Update</button>

             </div>

           </div>
         </form>

         <br><hr>

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