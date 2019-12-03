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

<?php $link="viewpay.php"; ;?>

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

                <h6>Enter ID:</h2>
                  <div class="input-group">
                    <input type="number" class="form-control" name="id" value="<?php if (!empty($id)) echo $id ; ?>"> <input type="submit" class="btn">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


      </form>

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

         if($dract=='200016' OR ($dract > 600000 && $dract < 800000) ){
            $typeid=$cract;
         }else{ $typeid=$dract; }

         $rowsx =mysqli_query($con,"SELECT name FROM acts  where id='$typeid' " ) or die(mysqli_error($con));
         while($rowx=mysqli_fetch_array($rowsx)){

         $typename = $rowx['name'];
         }

         if($dr==0){
          $amount=$cr;
        }
        else{ $amount = $dr;}


        $tamount = $amount;


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

                  <div class="col-sm-1">
                  </div>
                  <div class="col-sm-3">
                   <h4>Date: <strong> <?php  echo $datec?></strong></h4>

                 </div>

                 <div class="col-sm-3">
                   <h4>Invoice : <strong> <?php  echo $id?></strong></h4>

                 </div>
                 <div class="col-sm-3">
                   <h4>For : <strong> <?php echo $typename ?></strong></h4>

                 </div>
               </div>
               <br>
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
               <h5>Rs. <?php echo number_format($amount,$floating) ?>/-</h5>
             </div> 




           </div>
           <br>


           <hr>
           <br>
        <?php if(($dract==200019 OR $dract==200018 OR $dract==200028 OR $dract==200029) OR ($cract==200019 OR $cract==200018 OR $cract==200028 OR $cract==200029) ){ ?>
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
               <h4>  <?php echo number_format($itotal,$floating) ?> </h4>
             </div>
           </div>
           
         <?php } ?>



       <?php } ?>

     <?php 
        $rowsp =mysqli_query($con,"SELECT * FROM journal where (jid='$id') AND (actid=200038 OR actid=200039) LIMIT 1" ) or die(mysqli_error($con));
        $total=0;

        while($rowp=mysqli_fetch_array($rowsp)){

         $disdesp = $rowp['desp'];
         $discr = $rowp['cr'];
         $disdr = $rowp['dr'];

         if($discr==0){
            $disamount=$disdr;
         }else{ $disamount=$discr;}

         $tamount=$amount-$disamount;

         ?>

       <div class="row align-conter-center">

         <div class="col-sm-6">
         </div>
         <div class="col-sm-3">
          <hr>
          <br>

          <h3>Gross Total:</h3>

        </div>
         <div class="col-sm-3">
          <hr>
          <br>

          <h3> <strong>Rs. <?php echo number_format($amount,$floating) ?>/-</strong></h3>

        </div>
        <br>
        <br>
        <br>

      </div>
       <div class="row align-conter-center">

         <div class="col-sm-6">
         </div>
         <div class="col-sm-3">
          <hr>
          <br>

          <h3> <?php echo $disdesp ?>:</h3>

        </div>
         <div class="col-sm-3">
          <hr>
          <br>

          <h3> <strong>Rs. <?php echo number_format($disamount,$floating) ?>/-</strong></h3>

        </div>
        <br>
        <br>
        <br>

      </div>

    <?php } ?>

       <div class="row align-conter-center">

         <div class="col-sm-8">
         </div>
         <div class="col-sm-4">
          <hr>
          <br>

          <h3> Total: <strong>Rs. <?php echo number_format($tamount,$floating) ?>/-</strong></h3>

        </div>
        <br>
        <br>
        <br>

      </div>

      <div class="row">
        <div class="col-sm-5">
        </div>

        <div class="col-sm-2">

        <a href="print.php?id=<?php echo $id ?>" target="blank" class="btn btn-outline-primary block btn-lg" >
        <i class="la la-print"></i> Print    </a>
      </div>
    </div>


    </div>
  </div>
</div>
</div>
      <?php if($userrole=='admin'){ ?>

<form action="" method="GET">
<div class="row">
  <div class="col-md-4">
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
    <div class="form-group">

   


      <button type="button" class="btn btn-outline-danger block btn-lg" data-toggle="modal"
      data-target="#default">
      <i class="la la-trash"></i> Delete Invoice!
    </button>


    <!-- Modal -->
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title" id="myModalLabel1">Are You Sure!</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         

          <p>
            Deleting an Inovice will Delete all the records from the transaction regarding that Invoice ID.
           

          </p>
        

        </div>
        <div class="modal-footer">
          <p>
            Are you still want to Delelte this Invoice?
          </p>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">No</button>
    
          <button type="submit" class="btn btn-danger" name="delinv" value="<?php echo $id ?>">Yes!</button>

        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>


</form>

  <?php } ?>


<?php } } ?>
<style type="text/css">
.table td{
  text-align: left;
}
.table thead td{
  font-weight: 600;
}
</style>


<center><h2><?php if(!empty($msg))  echo $msg ;?></h2></center>

<div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-10">

    <div class="card">
      <div class="card-header" style="padding-bottom: 0px;">
        <h4 class="card-title">View Recent 20  Invoices</h4>
      </div>
      <div class="card-block">
        <div class="card-body">
         <form action="" method="get">
             <div class="row align-conter-center">



               <div class="col-sm-12">

                <table id="invtable" class="table table-bordered table-striped  dataex-select-multi ">
                  <thead>
                    <tr>
                      <td aria-sort="descending">Invoice</td>
                      <td>Type</td>
                      <td>Description</td>
                      <td>View/Edit</td>
                    </thead>
                    <tbody>

                      <?php

                      $rows =mysqli_query($con,"SELECT * FROM transaction  ORDER BY id desc LIMIT 20" ) or die(mysqli_error($con));

                      while($row=mysqli_fetch_array($rows)){

                        $id = $row['id'];
                        $desp = $row['desp'];

         $dract = $row['dract'];
         $cract = $row['cract'];

         if($dract=='200016' OR ($dract > 600000 && $dract < 800000) ){
            $typeid=$cract;
         }else{ $typeid=$dract; }


         $rowsx =mysqli_query($con,"SELECT name FROM acts  where id='$typeid' " ) or die(mysqli_error($con));
         while($rowx=mysqli_fetch_array($rowsx)){

         $typename = $rowx['name'];
         }
                        ?>

                        <tr>
                          <td><?php echo $id ?></td>
                          <td><?php echo $typename ?></td>
                          <td><?php echo $desp ?></td>
                          <td><button class="btn btn-primary  block-element" name="id" value="<?php echo $id ?>">View</button></td>

                        </tr>
                      <?php } ?>

                    </tbody>

                  </table>
                </div>


              </div>


            </form>

          </div>
        </div>
      </div>


    </div>
  </div>



</div>
</div>
  <center><h2><?php if(!empty($msg))  echo $msg ;?></h2></center>




<?php include"include/footer.php" ?>


</body>
</html>