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

<?php $link="viewinv.php"; ;?>

<?php
if(isset($_GET['delinv'])){
  $msg="Unsuccessful" ;
  
  $inv=$_GET['delinv'];





  $data=mysqli_query($con,"DELETE FROM transaction where id = $inv")or die( mysqli_error($con) );
  $data=mysqli_query($con,"DELETE FROM journal where jid = $inv")or die( mysqli_error($con) );
  $data=mysqli_query($con,"DELETE FROM itemslog where jid = $inv")or die( mysqli_error($con) );

  $msg=" Deleted Invoice" ;
  
}
?>






      <?php if (!empty($_GET['id'])){

       $id=$_GET['id'] ;

       $rows =mysqli_query($con,"SELECT * FROM transaction  where id='$id' ORDER BY id limit 1" ) or die(mysqli_error($con));

       while($row=mysqli_fetch_array($rows)){

         $desp = $row['desp'];
         $datec = $row['datec'];
         $dr = $row['dr'];
         $cr = $row['cr'];

         $dract = $row['dract'];
         $cract = $row['cract'];



         if($dr==0){
          $amount=$cr;
        }
        else $amount = $dr;

        ?>



        <div class="col-sm-12">
          <div class="card">
            <div class="card-header" style="padding-bottom: 0px;">
              <h4 class="card-title">Invoice <?php echo $comp_name ?></h4>
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

                <div class="row align-conter-center">

                  <div class="col-sm-1">
                  </div>
                  <div class="col-sm-2">
                    <img class="img-fluid" src="images/logo.png">
                  </div>
                </div>

                <br>
                <br>
                <br>
                <div class="row align-conter-center">

                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-3">
                   <h4>Date: <strong> <?php  echo $datec?></strong></h4>

                 </div>

                 <div class="col-sm-3">
                   <h4>Invoice : <strong> <?php  echo $id?></strong></h4>

                 </div>
               </div>
               <br>

               <?php


               $rows2 =mysqli_query($con,"SELECT * FROM journal where jid='$id' AND ( type LIKE 'Vendors' OR type LIKE 'Customers' )  ORDER BY id limit 1" ) or die(mysqli_error($con));

               while($row2=mysqli_fetch_array($rows2)){

                  $red = 1;
                  $type = $row2['type'];
                 $actid = $row2['actid']; 

                 $rows3 =mysqli_query($con,"SELECT * FROM $type where id='$actid' " ) or die(mysqli_error($con));

                 while($row3=mysqli_fetch_array($rows3)){


                    $dname = $row3['name'];
                    $dcompany = $row3['company'];
                    $dcity = $row3['city'];
                   $dmobile = $row3['mobile']; 


                 }

                 ?>

                  <div class="row text-center">

                   <div class="col-sm-1">

                   </div>
                   <div class="col-sm-2">
                    <h4><?php echo $type ?> :</h4>
                  </div>
                  <div class="col-sm-8">
                    <h4><?php echo $dname ?> - <?php echo $dcompany ?> - <?php echo $dcity ?> - <?php echo $dmobile ?> </h4>
                  </div>



                </div>


                <br>
                

               <?php } ?>

               <?php if(empty($red)){ ?>
               <div class="row align-conter-center">

                <div class="col-sm-1">

                </div>
                <div class="col-sm-8">
                 <h4>Description</h4>
               </div>
               <div class="col-sm-2">
                 <h4>Amount</h4>
               </div>



             </div>
             <br>
             <br>

             <hr>
             <br>
             <div class="row  align-items-center" align="">

              <div class="col-sm-1">

              </div> 

              <div class="col-sm-8  ">

                <a href="viewv.php?jid=<?php echo $id ?>" target="blank"><h4><?php echo $desp ?></h4></a>
              </div> 
              <br>
              <br>

              <div class="col-sm-2">
               <h5>Rs. <?php echo number_format($amount) ?>/-</h5>
             </div> 




           </div>
           <br>

         <?php } ?>


           <hr>
           <br>
           <?php if(($dract>200000 AND $dract<400000) OR ($cract>200000 AND $cract<400000) ){ ?>

             <div class="row align-conter-center">

               <div class="col-sm-1">
               </div>
               <div class="col-sm-4">
                 <h2> Product </h2>
               </div>
               <div class="col-sm-2">
                 <h2> Price </h2>
               </div>
               <div class="col-sm-2">
                <h2> Quantity </h2>
              </div>
              <div class="col-sm-2">
                <h2> Sub Total </h2>
              </div>
            </div>
            <hr>
            <br>
            <?php 
            $rowsp =mysqli_query($con,"SELECT * FROM itemslog  where jid='$id' " ) or die(mysqli_error($con));
            $total=0;

            while($rowp=mysqli_fetch_array($rowsp)){

             $pname = $rowp['name'];
             $pquantity = $rowp['quantity'];
             $pprice = $rowp['price'];
             $st = $rowp['subtotal'];

             $itotal=$pprice*$pquantity;
             $total=$total+$itotal;

             ?>
             <div class="row align-conter-center">

               <div class="col-sm-1">
               </div>
               <div class="col-sm-4">
                <h4> <?php echo $pname ?> </h4>
              </div>
              <div class="col-sm-2">
               <h4>  <?php echo $pprice ?> </h4>
             </div>
             <div class="col-sm-2">
               <h4>  <?php echo $pquantity ?> </h4>
             </div>
             <div class="col-sm-2">
               <h4>  <?php echo number_format($itotal) ?> </h4>
             </div>
           </div>
           
         <?php } ?>



       <?php } ?>

       <div class="row align-conter-center">

         <div class="col-sm-8">
         </div>
         <div class="col-sm-4">
          <hr>
          <br>

          <h3> Total: <strong>Rs. <?php echo number_format($amount) ?>/-</strong></h3>

        </div>


        <h1></h1>
        <br>
        <br>
        <br>

      </div>
        <div style="margin-top: 400px;">




          <hr>


          <h2>&nbsp; &nbsp; Customer Details:</h2>

          <br>
          <br>
          <br>
          <br>
          <br>

<?php } } ?>






<?php include"include/footer.php" ?>

</body>
</html>