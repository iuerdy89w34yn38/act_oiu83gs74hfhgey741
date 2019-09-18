<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <?php include"include/connect.php" ?>


  <?php include"include/head.php" ?>

    <?php
  if(isset($_POST['update'])){
    $msg="Successful..." ;


    $themeid=$_POST['color'];



    $sql = "UPDATE users SET `theme` = '$themeid' WHERE `username` = '$username'";

    mysqli_query($con, $sql);

    ?>

     <meta http-equiv="refresh" content="0;URL='home.php'">

<?php

  }

  ?>



    <?php
for ($n=1; $n < 10; $n++) { 
  
  if(isset($_POST['updateuser'.$n])){
    $msg="Unsuccessful..." ;


    $updatepassword=$_POST['updatepassword'];
    $updateusername=$_POST['updateusername'];



    $sql = "UPDATE users SET `password` = '$updatepassword' WHERE `username` = '$updateusername'";

    mysqli_query($con, $sql);

    $msg="Successful..." ;
   

  }

}
  ?>


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
<?php if ($userrole=='admin') {
  ?>

          <h4 class="card-title">Manage Users</h4>
    <?php
                  $n=1;
                  $rows =mysqli_query($con,"SELECT * FROM users  ORDER BY role" ) or die(mysqli_error($con));

                  while($row=mysqli_fetch_array($rows)){

                    $updateusername = $row['username']; 
                    $updateuserrole = $row['role']; 
                    $updatepassword = $row['password']; 
                    ?>

           <form action="" method="post">
          

             <div class="row">


              <div class="col-sm-3" style="text-transform: uppercase;">
                <?php echo $updateuserrole ?> :
              </div>
              <div class="col-sm-3">
                <input type="text" readonly="" class="form-control" name="updateusername" value="<?php echo $updateusername ?>">

              </div>

              <div class="col-sm-3">
                <input type="text" class="form-control" name="updatepassword" value="<?php echo $updatepassword ?>">

              </div>
              

             <div class="col-sm-1">

               <button name="updateuser<?php echo $n ?>" class="btn btn-primary" value="">Update</button>

             </div>

           </div>
         </form>

         <br><hr>

<?php $n++; } } ?>

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