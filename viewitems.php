<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>


  <title>Edit Customers - <?php echo $comp_name ?>  </title>
  
  <style type="text/css">
    hr{
      margin-top: 0px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<?php $link="viewitems.php"; ;?>

<?php if (!empty($_POST['id']))  $id=$_POST['id'] ;?>

<?php
if(isset($_POST['update'])){
  $msg="Unsuccessful" ;


  $id=$_POST['update'];
  $name=$_POST['name'];
  $brand=$_POST['brand'];
  $wgt=$_POST['wgt'];
  $desp=$_POST['desp'];
 

  if(isset($_POST['pause'])){
    $pause='1';
  }
  else{
    $pause='0';
  }



  $sql = "UPDATE items SET `name` = '$name',`brand` = '$brand',`weight` = '$wgt',`desp` = '$desp',`pause` = '$pause' WHERE `id` =$id";

  mysqli_query($con, $sql);

  $msg="Successful" ;

}
?>

<?php
if(isset($_POST['del'])){


  $delid=$_POST['del'];



  $data=mysqli_query($con,"DELETE FROM `items` WHERE id=$delid")or die(mysqli_error($con) );

  if ($data == 1) {
    $msg="Deleted Successfully!";
  } 

  else {
    $msg="Unsuccessful!";
  }


}
?>






<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
  <div class="content-wrapper">


  	<?php if (!empty($id)) { ?>

     <?php

     $rows =mysqli_query($con,"SELECT * FROM items WHERE id=$id" ) or die(mysqli_error($con));

     while($row=mysqli_fetch_array($rows)){


       $name = $row['name'];
       $brand=$row['brand'];
       $desp=$row['desp'];
       $wgt=$row['weight'];
       $pause=$row['pause'];

     }
     ?>

     <div class="col-sm-12">
      <div class="card">
        <div class="card-header" style="padding-bottom: 0px;">
          <h4 class="card-title">Edit  Product Details</h4>
        </div>
        <div class="card-block">
          <div class="card-body">
           <form action="" method="post">
             <div class="row skin skin-square skin-square-blue">


              <div class="col-sm-4">
                <span>Name</span>
                <input type="text" class="form-control" name="name" value="<?php echo $name ?>" >
              </div>
              
              <div class="col-sm-4">
                <span>Brand</span><br>
                <select class="form-control select2" name="brand">

                  <?php

                  $rows =mysqli_query($con,"SELECT * FROM itemsb Where id!=1 ORDER BY name" ) or die(mysqli_error($con));

                  while($row=mysqli_fetch_array($rows)){

                    $iid = $row['id']; 
                    $iname = $row['name']; ?>

                    <option value="<?php echo $iid ?>" <?php if($iid==$brand) echo 'selected'?> ><?php echo $iname ?></option>

                  <?php } ?>

                </select>

              </div>
              <div class="col-sm-4">
                <span>Weight</span>
                <input type="text" class="form-control" name="wgt" value="<?php echo $wgt ?>">
              </div>
              <div class="col-sm-1">
              </div>
              <div class="col-sm-6">
                <span>Description</span>
                <input type="text" class="form-control" name="desp" value="<?php echo $desp ?>">
              </div>



             <div class="col-sm-2">
              <br>
              <div class="input-group">
              <h4>Pause &nbsp; </h4>
              <input type="checkbox"  id="input-11" name="pause" <?php if($pause=='1') echo 'checked'; ?>>
            </div>
             </div>
             <div class="col-sm-1">
               <span>&nbsp;</span>
               <button name="update" class="btn btn-primary" value="<?php echo $id ?>">Update</button>

             </div>

           </div>
         </form>

         <br><hr>

         <center><h2><?php if(!empty($msg))  echo $msg ;?></h2></center>
       </div>
     </div>
   </div>
 </div>

<?php } ?>	



<div class="col-sm-12">
  <div class="card">
    <div class="card-header" style="padding-bottom: 0px;">
      <h4 class="card-title">View Products</h4>
    </div>
    <div class="card-block">
      <div class="card-body">
       <form action="" method="post">
         <div class="row align-conter-center">

          <div class="col-sm-2">
           <h4>Name</h4>
         </div>
          <div class="col-sm-2">
           <h4>Brand</h4>
         </div>
          <div class="col-sm-3">
           <h4>Description</h4>
         </div>
          <div class="col-sm-1">
           <h6>Weight</h6>
         </div>
         <div class="col-sm-1">
           <h4>Stock </h4>
         </div>
         <div class="col-sm-1">
           <h4>Active</h4>
         </div>
         <div class="col-sm-1">
           <span>Update</span>

         </div>
         <div class="col-sm-1">
           <span>Delete</span>

         </div>

       </div>
       <br>
       <hr><br>
       <?php

       $rows =mysqli_query($con,"SELECT * FROM items Where id!=1 ORDER BY name" ) or die(mysqli_error($con));

       while($row=mysqli_fetch_array($rows)){

         $id = $row['id'];
         $name = $row['name'];
         $brand=$row['brand'];
         $desp=$row['desp'];
         $wgt=$row['weight']; 
         $stock=$row['stock']; 
         $pause=$row['pause']; 

         ?>
         <div class="row  align-items-center" align="">

          <div class="col-sm-2">
           <h5><?php echo $name ?></h5>
         </div> 
         
          <div class="col-sm-2">
           <?php

           $rowsl =mysqli_query($con,"SELECT * FROM itemsb Where id=$brand ORDER BY name" ) or die(mysqli_error($con));

           while($rowl=mysqli_fetch_array($rowsl)){

             $brandname = $rowl['name'];?>
              <h5><?php echo $brandname ?></h5>
             <?php }
             ?>
           
         </div> 
         
          <div class="col-sm-3">
           <h5><?php echo $desp ?></h5>
         </div> 
         
          <div class="col-sm-1">
           <h5><?php echo $wgt ?></h5>
         </div> 

          <div class="col-sm-1">
           <h5><?php echo $stock ?></h5>
         </div> 

         <div class="col-sm-1">
           <h5 ><?php if($pause==0) echo 'Yes'; else echo 'No' ;?> </h5>
         </div>
         <div class="col-sm-1">

           <button name="id" class="btn btn-primary" value="<?php echo $id ?>"><i class="la la-pencil"></i></button>

         </div>
         <div class="col-sm-1">


           <button name="del" class="btn btn-danger" value="<?php echo $id ?>"><i class="la la-trash"></i></button>
         </div>

       </div>
       <hr>

     <?php } ?>
   </form>

   <center><h2><?php if(!empty($msg))  echo $msg ;?></h2></center>
 </div>
</div>
</div>
</div>



<?php if (!empty($_POST['pid'])) {
 $pid=$_POST['pid'] ;

?>

<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-8">
  <div class="card">
    <div class="card-header" style="padding-bottom: 0px;">
      <h4 class="card-title">View Products</h4>
    </div>
    <div class="card-block">
      <div class="card-body">
         <div class="row align-conter-center">

          <div class="col-sm-2">
           <h4>Date</h4>
         </div>
          <div class="col-sm-2">
           <h4>Invoice</h4>
         </div>
          <div class="col-sm-4">
           <h4>Name</h4>
         </div>
          <div class="col-sm-2">
           <h4>Quantity</h4>
         </div>
          <div class="col-sm-2">
           <h6>Price</h6>
         </div>


       </div>
       <br>
       <h3>Sold</h3>
       <hr><br>
       <?php

       $rows =mysqli_query($con,"SELECT * FROM itemslog Where pid=$pid AND type='out' ORDER BY jid desc" ) or die(mysqli_error($con));

       while($row=mysqli_fetch_array($rows)){

         $jid = $row['jid'];
         $name = $row['name'];
         $date=$row['datec'];
         $qty=$row['quantity']; 
         $price=$row['price']; 

         ?>
         <div class="row  align-items-center" align="">

          <div class="col-sm-2">
           <h5><?php echo $date ?></h5>
         </div> 
          
         
          <div class="col-sm-2">
           <h5><a href="viewpay.php?id=<?php echo $jid ?>" target="blank"><?php echo $jid ?></a></h5>
         </div> 
         
          <div class="col-sm-4">
           <h5><?php echo $name ?></h5>
         </div>
         
          <div class="col-sm-2">
           <h5><?php echo $qty ?></h5>
         </div> 

          <div class="col-sm-2">
           <h5>Rs. <?php echo number_format($price) ?>/-</h5>
         </div> 




       </div>
       <hr>

     <?php } ?>
 <br>
       <h3>Purchased</h3>
       <hr><br>
       <?php

       $rows =mysqli_query($con,"SELECT * FROM itemslog Where pid=$pid AND type='in' ORDER BY jid desc" ) or die(mysqli_error($con));

       while($row=mysqli_fetch_array($rows)){

         $jid = $row['jid'];
         $name = $row['name'];
         $date=$row['datec'];
         $qty=$row['quantity']; 
         $price=$row['price']; 

         ?>
         <div class="row  align-items-center" align="">

          <div class="col-sm-2">
           <h5><?php echo $date ?></h5>
         </div> 
          
         
          <div class="col-sm-2">
           <h5><a href="viewpay.php?id=<?php echo $jid ?>" target="blank"><?php echo $jid ?></a></h5>
         </div> 
         
          <div class="col-sm-4">
           <h5><?php echo $name ?></h5>
         </div>
         
          <div class="col-sm-2">
           <h5><?php echo $qty ?></h5>
         </div> 

          <div class="col-sm-2">
           <h5>Rs. <?php echo number_format($price) ?>/-</h5>
         </div> 




       </div>
       <hr>

     <?php } ?>


 </div>
</div>
</div>
</div>
</div>

<?php } ?>

<form action="" method="POST">
<div class="row">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
  <div class="card">
    <div class="card-block">
      <div class="card-body">
        <h6>Select Product to view Recent Purchased Price </h6> 
        <div class="input-group">
          <select class="select select2 form-control" name="pid">
            <?php

            $rowsl =mysqli_query($con,"SELECT * FROM items WHERE id!=1 ORDER BY name" ) or die(mysqli_error($con));

            while($rowl=mysqli_fetch_array($rowsl)){

              $npid = $rowl['id'];
              $pname = $rowl['name'];?>
              <option value="<?php echo $npid ?>" <?php if(!empty($pid)) 
              { if($pid==$npid) echo "selected"; } ?>><?php echo $pname ?></option>

              <?php }
              ?>

          </select>


           <input type="submit" class="btn">
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