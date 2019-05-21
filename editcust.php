<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>

  <title>Edit Customers - <?php echo $comp_name ?>  </title>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<?php $link="editcust.php"; ;?>

<?php if (!empty($_GET['id']))  $id=$_GET['id'] ;?>


<?php
if(isset($_POST['submit'])){
  $msg="Unsuccessful" ;
  
  $name=$_POST['name'];
  $mobile=$_POST['mobile'];
  $company=$_POST['company'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $address=$_POST['address'];
  $city=$_POST['city'];
  $country=$_POST['country'];
  $date=date('Y-m-d');
  $typeid=200021;




  $data=mysqli_query($con,"INSERT INTO customers (name,typeid,mobile,company,email,phone,address,city,country,dated)VALUES ('$name','$typeid','$mobile','$company','$email','$phone','$address','$city','$country','$date')")or die( mysqli_error($con) );
  $msg="Successful" ;
  
}
?>



<?php
if(isset($_POST['update'])){
  $msg="Unsuccessful" ;


  $id=$_POST['update'];
  $name=$_POST['name'];
  $mobile=$_POST['mobile'];
  $company=$_POST['company'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $address=$_POST['address'];
  $city=$_POST['city'];
  $country=$_POST['country'];


  $sql = "UPDATE customers SET `name` = '$name',`mobile` = '$mobile',`company` = '$company',`email` = '$email',`phone` = '$phone',`address` = '$address',`city` = '$city',`country` = '$country' WHERE `id` =$id";

  mysqli_query($con, $sql);

  $msg="Successful" ;

}
?>

<?php
if(isset($_GET['del'])){


  $delid=$_GET['del'];



  $data=mysqli_query($con,"DELETE FROM `customers` WHERE id=$delid")or die(mysqli_error($con) );

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

     $rows =mysqli_query($con,"SELECT * FROM customers WHERE id=$id" ) or die(mysqli_error($con));

     while($row=mysqli_fetch_array($rows)){

       $name = $row['name'];
       $mobile=$row['mobile'];
       $company=$row['company'];
       $email=$row['email'];
       $phone=$row['phone'];
       $address=$row['address'];
       $city=$row['city'];
       $country=$row['country']; 
       $balance=$row['balance']; 
     }
     ?>

     <div class="col-sm-12">
      <div class="card">
        <div class="card-header" style="padding-bottom: 0px;">
          <h4 class="card-title">Edit  Vendor</h4>
        </div>
        <div class="card-block">
          <div class="card-body">
           <form action="" method="post">
             <div class="row">


              <div class="col-sm-4">
                <span>Name</span>
                <input type="text" class="form-control" name="name" value="<?php echo $name ?>" >
              </div>
              <div class="col-sm-4">
                <span>Mobile</span>
                <input type="text" class="form-control" name="mobile" value="<?php echo $mobile ?>">
              </div>
              <div class="col-sm-4">
                <span>Company</span>
                <input type="text" class="form-control" name="company" value="<?php echo $company ?>" >
              </div>
              <div class="col-sm-4">
                <span>Email</span>
                <input type="email" class="form-control" name="email"  value="<?php echo $email ?>">
              </div>
              <div class="col-sm-4">
                <span>Phone</span>
                <input type="text" class="form-control" name="phone"  value="<?php echo $phone ?>">
              </div>
              <div class="col-sm-6">
                <span>Street Address</span>
                <input type="text" class="form-control" name="address" value="<?php echo $address ?>" >
              </div>
              <div class="col-sm-3">
                <span>City</span>
                <select class="form-control select2" name="city">
                  <option value="*"> None </option>
                  <?php

                  $rows =mysqli_query($con,"SELECT * FROM cities  ORDER BY city" ) or die(mysqli_error($con));

                  while($row=mysqli_fetch_array($rows)){

                    $nname = $row['city']; ?>

                    <option value="<?php echo $nname ?>" <?php if($nname==$city) echo 'selected'?> ><?php echo $nname ?></option>

                  <?php } ?>

                </select>

              </div>
              <div class="col-sm-3">
                <span>Country</span>
                <select class="form-control select2" name="country">
                  <?php

                  $rows =mysqli_query($con,"SELECT * FROM countries  ORDER BY country" ) or die(mysqli_error($con));

                  while($row=mysqli_fetch_array($rows)){

                    $name = $row['country']; ?>

                    <option value="<?php echo $name ?>" <?php if($name==$country) echo 'selected' ?>><?php echo $name ?></option>

                  <?php } ?>

                </select>

              </div>
              <div class="col-sm-2">
               <span>Balance </span>
               <input type="number" class="form-control" placeholder="0" disabled>
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


   <section>
    <div id="headingCollapse1" class="card-header text-center">
     <a data-toggle="collapse" href="#collapse1" aria-expanded="false" aria-controls="collapse62"
     class="card-title  collapsed"><i class="la la-plus"></i> Add Account</a>
   </div>
   <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="border no-border-top card-collapse collapse"
   aria-expanded="false">
   <div class="card-content">
     <div class="card-body" style="background: white;">
       
      
      <form action="" method="post">
        <div class="row">

          <div class="col-sm-4">
            <span>Name</span>
            <input type="text" class="form-control" name="name" placeholder="Customer Name">
          </div>
          <div class="col-sm-4">
            <span>Mobile</span>
            <input type="text" class="form-control" name="mobile" placeholder="Customer Mobile">
          </div>
          <div class="col-sm-4">
            <span>Company</span>
            <input type="text" class="form-control" name="company" placeholder="Customer Company">
          </div>
          <div class="col-sm-4">
            <span>Email</span>
            <input type="email" class="form-control" name="email" placeholder="Customer Email">
          </div>
          <div class="col-sm-4">
            <span>Phone</span>
            <input type="text" class="form-control" name="phone" placeholder="Company Phone">
          </div>
          <div class="col-sm-6">
            <span>Street Address</span>
            <input type="text" class="form-control" name="address" placeholder="Address">
          </div>
          <div class="col-sm-3">
            <span>City</span>
            <select class="form-control select2" name="city">
              <option value="*"> None </option>
              <?php

              $rows =mysqli_query($con,"SELECT * FROM cities  ORDER BY city" ) or die(mysqli_error($con));
              
              while($row=mysqli_fetch_array($rows)){
                
                $name = $row['city']; ?>

                <option value="<?php echo $name ?>"><?php echo $name ?></option>

              <?php } ?>

            </select>

          </div>
          <div class="col-sm-3">
            <span>Country</span>
            <select class="form-control select2" name="country">
              <?php

              $rows =mysqli_query($con,"SELECT * FROM countries  ORDER BY country" ) or die(mysqli_error($con));
              
              while($row=mysqli_fetch_array($rows)){
                
                $name = $row['country']; ?>

                <option value="<?php echo $name ?>" <?php if($name=='Pakistan') echo 'selected' ?>><?php echo $name ?></option>

              <?php } ?>

            </select>

          </div>

          <div class="col-sm-5">
          </div>
          <div class="col-sm-1">
            <span>&nbsp;</span>
            <input type="submit" class="btn btn-primary" name="submit" value="Add Customer">
          </div>
          
        </div>
      </form>
      
      

    </div>
    
    
  </section>
  
  <div class="card-header" style="padding-bottom: 0px;">
    <h4 class="card-title">View Existing Customers</h4>
  </div>
  <div class="card-block">
    <div class="card-body">
     <form action="" method="get">


      <table id="ex1" class="table table-bordered table-striped  dataex-select-multi">

        <thead>
          
          <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Mobile</td>
          <td>Company</td>
          <td>City</td>
          <td>Balance</td>
          <td>Update</td>
        </tr>
        </thead> 

        <tbody>
          <?php
         $rows1 =mysqli_query($con,"SELECT * FROM customers  ORDER BY name" ) or die(mysqli_error($con));

         while($row1=mysqli_fetch_array($rows1)){

           $id = $row1['id'];
           $name = $row1['name'];
           $mobile=$row1['mobile'];
           $company=$row1['company'];
           $city=$row1['city']; 
           $balance=$row1['balance']; 


           $tcr=0;
           $tdr=0;
           $total=0;
           $rows =mysqli_query($con,"SELECT cr FROM journal WHERE actid=$id " ) or die(mysqli_error($con));

           while($row=mysqli_fetch_array($rows)){
             $cr = $row['cr'];
             $tcr=$tcr+$cr;
           } 
           $rows =mysqli_query($con,"SELECT dr FROM journal WHERE actid=$id " ) or die(mysqli_error($con));

           while($row=mysqli_fetch_array($rows)){
             $dr = $row['dr'];
             $tdr=$tdr+$dr;
           } 
           $total1=$tdr-$tcr;
           $total=$total1;

            ?>
              <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $name ?></td>
                <td><?php echo $mobile ?> </td>
                <td><?php echo $company ?> </td>
                <td><?php echo $city ?> </td>
                <td><?php echo $total ?> </td>
                <td>
                  <button name="id" class="btn btn-primary" value="<?php echo $id ?>">Edit</button>

                  <button name="del" class="btn btn-danger" value="<?php echo $id ?>">Del</button>

                </td>

              </tr>

              <?php } ?>

        </tbody>
      </table>
      
      
 </form>

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