<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>


  <title>View Inventory - <?php echo $comp_name ?>  </title>
  
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
    <div class="card-header">
      <h2>View Products</h2>
      <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
      <div class="heading-elements">
        <ul class="list-inline mb-0">
          <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
          <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
          <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
          <li><a data-action="close"><i class="ft-x"></i></a></li>
        </ul>
      </div>
    </div>
    <div class="card-block">
      <div class="card-body">
       
     
       <form action="" method="post">
        
        <table class="table table-striped table-bordered dataex-select-multi ">
          <thead>
            <tr>
              <th>Name</th>
              <th>Brand</th>
              <th>Product Description</th>
              <th>Weight</th>
              <th>Stock</th>
              <th>Price</th>
              <th>Active</th>
              <th>Edit</th>
              <th>Del</th>
            </tr>
          </thead>
          <tbody>  
            <?php

                    $rows1 =mysqli_query($con,"SELECT * FROM items  ORDER BY name" ) or die(mysqli_error($con));

                    while($row1=mysqli_fetch_array($rows1)){

                      $id = $row1['id'];
                      $name = $row1['name'];
                      $brand=$row1['brand'];
                      $desp=$row1['desp'];
                      $wgt=$row1['weight']; 

                      $price=$row1['price']; 
                      $pause=$row1['pause']; 


                      $tcr=0;
                      $tdr=0;
                      $tpdr=0;
                      $total=0;
                      $gtotal=0;

                      $rows =mysqli_query($con,"SELECT quantity FROM itemslog WHERE pid=$id AND type='in' ORDER BY id desc" ) or die(mysqli_error($con));
                      $sales=0;
                      while($row=mysqli_fetch_array($rows)){
                        $cr = $row['quantity'];
                        $tcr=$tcr+$cr;
                      } 
                      $rows =mysqli_query($con,"SELECT quantity FROM itemslog WHERE pid=$id AND type='out' ORDER BY id desc" ) or die(mysqli_error($con));
                      $salesr=0;
                      while($row=mysqli_fetch_array($rows)){
                        $dr = $row['quantity'];
                        $tdr=$tdr+$dr;
                      } 
                      $rows =mysqli_query($con,"SELECT quantity FROM itemslog WHERE pid=$id AND type='preturn' ORDER BY id desc" ) or die(mysqli_error($con));
                      $salesr=0;
                      while($row=mysqli_fetch_array($rows)){
                        $dr = $row['quantity'];
                        $tpdr=$tpdr+$dr;
                      } 
                      $total=$tcr-$tdr-$tpdr; 
                      $gtotal=$gtotal+$total;

                      ?>
            <tr>

                  
                      <td><?php echo $name ?></td>
                      
                       <td><?php

                        $rowsl =mysqli_query($con,"SELECT * FROM itemsb Where id=$brand ORDER BY name" ) or die(mysqli_error($con));

                        while($rowl=mysqli_fetch_array($rowsl)){

                          $brandname = $rowl['name'];?>
                          <?php echo $brandname ?>
                          <?php }
                          ?>
                        
                      </td>
                      
                       <td><?php echo $desp ?></td>
                      
                       <td><?php echo $wgt ?> </td> 

                       <td><?php echo $gtotal ?></td> 
                       <td><?php echo $price ?></td> 

                      <td><?php if($pause==0) echo 'Yes'; else echo 'No' ;?> </td>
                      
                      <td>
                     

                        <button name="id" class="btn btn-primary" value="<?php echo $id ?>"><i class="la la-pencil"></i></button>


                      </td>    
                      <td>
                       

                    
                        <button name="del" class="btn btn-danger" value="<?php echo $id ?>"><i class="la la-trash"></i></button>
             

                      </td>

            </tr>
           

                  <?php } ?>
               
          </tbody>
        </table>
 </form>

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
          <table class="table table-striped table-bordered dataex-select-multi ">
            <thead>
              <tr>
                <th>Date</th>

                <th>Invoice</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>SubTotal</th>
                <th>Invt.</th>
              </tr>
            </thead>
            <tbody>  
              <?php

                      $rows =mysqli_query($con,"SELECT * FROM itemslog WHERE pid=$pid ORDER BY name" ) or die(mysqli_error($con));

                      while($row=mysqli_fetch_array($rows)){

                        $id = $row['id'];
                        $jid = $row['jid'];
                        $price=$row['price']; 
                        $quantity=$row['quantity']; 
                        $subtotal=$row['subtotal']; 
                        $datec=$row['datec']; 
                        $type=$row['type']; 


                        ?>
              <tr>

                         <td><?php echo $datec ?></td> 
                  
                        
                         <td>  <h5><a href="viewpay.php?id=<?php echo $jid ?>" target="blank"><?php echo $jid ?></a></h5>  </td>
                                              

                         <td><?php echo $price ?></td> 
                         <td><?php echo $quantity ?></td> 
                         <td><?php echo $subtotal ?></td> 
                         <td style="text-transform: capitalize;"><?php echo $type ?></td> 

                       


              </tr>
             

                    <?php } ?>
                 
            </tbody>
          </table>
         </div>
       
       </div>
       </div>
</div>
</div>
</div>

<?php } ?>

<form action="" method="POST">
<div class="row">
<div class="col-sm-3">
</div>
<div class="col-sm-5">
  <div class="card">
    <div class="card-block">
      <div class="card-body">
        <h6>Select Product to view Recent Purchased Price </h6> 
        <div class="row">

        <div class="col-md-8">
          <select class="select select2 form-control" name="pid">
            <?php

            $rowsl =mysqli_query($con,"SELECT * FROM items ORDER BY name" ) or die(mysqli_error($con));

            while($rowl=mysqli_fetch_array($rowsl)){

              $npid = $rowl['id'];
              $pname = $rowl['name'];?>
              <option value="<?php echo $npid ?>" <?php if(!empty($pid)) 
              { if($pid==$npid) echo "selected"; } ?>><?php echo $pname ?></option>

              <?php }
              ?>

          </select>
        </div>
        <div class="col-md-4">

           <input type="submit" class="btn">
        </div>
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