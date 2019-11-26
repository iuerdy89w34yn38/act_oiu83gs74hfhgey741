<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>

  <title>Invoice - <?php echo $comp_name ?>  </title>
  <style type="text/css">
    body{
      font-size: 18px;
    }
 
</style>

</head>
<body class="printbody">

    <div class="card">
      <div class="card-body">

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


         $actid = 0;



         if($dr==0){
          $amount=$cr;
        }
        else $amount = $dr;

        $tamount = $amount;




        ?>


        <?php  } ?>

       <div style="margin-top:10px">
        
        <table style="text-align: ;" class="table table-bordered">
          <tr> <td colspan="4" style="text-align: center;"> Invoice <?php echo $comp_name ?> </td> </tr>
          <tr> <td colspan="4" >   <img style="max-width: 190px;float: left" class="img-fluid" src="images/logo.png"> </td> </tr>
          <tr>
          <td colspan="2"> Date :  <strong> <?php  echo $datec?></strong> </td>
          <td colspan="1"> For :  <strong> <?php  echo $typename?></strong> </td>
          <td colspan="1"> Inoive  : <strong> <?php  echo $id?></strong></td>
          </tr>

               <?php


               $rows2 =mysqli_query($con,"SELECT * FROM journal where jid='$id' AND ( type LIKE 'Vendors' OR type LIKE 'Customers' )  ORDER BY id limit 1" ) or die(mysqli_error($con));

               while($row2=mysqli_fetch_array($rows2)){

                  $red = 1;
                  $type1 = $row2['type'];
                 $actid = $row2['actid']; 
                   $type=strtolower($type1);

                 $rows3 =mysqli_query($con,"SELECT * FROM $type where id='$actid' " ) or die(mysqli_error($con));

                 while($row3=mysqli_fetch_array($rows3)){


                    $dname = $row3['name'];
                    $dcompany = $row3['company'];
                    $dcity = $row3['city'];
                   $dmobile = $row3['mobile']; 



                 }
               

                 ?>
                 <tr><td colspan="4">&nbsp;</td></tr>
          <tr>
             <td colspan="2"> ID: <?php echo $actid ?>  </td><td colspan="2"> Address: <?php echo $dcity ?> </td>
          </tr><tr>
                <td colspan="2"> Name: <?php echo $dname ?>  </td> <td colspan="2"> Phone: <?php echo $dmobile ?> </td>
          </tr>


               <?php } ?>
                 <tr><td colspan="4">&nbsp;</td></tr>

          <tr>
                <td colspan="3"> Description  </td><td> Amount   </td> 
          </tr>



          <tr>
                <td colspan="3">   <a href="viewv.php?jid=<?php echo $id ?>" target="blank"><h4><?php echo $desp ?></h4></a>
                </td><td> <h5>Rs. <?php echo number_format($amount) ?>/-</h5>   </td> 
          </tr>





        <?php if(($dract==200019 OR $dract==200018 OR $dract==200028 OR $dract==200029) OR ($cract==200019 OR $cract==200018 OR $cract==200028 OR $cract==200029) ){ ?>
                 <tr><td colspan="4">&nbsp;</td></tr>


          <tr>
                <td> Product  </td><td> Price   </td><td> Quantity  </td><td> Sub Total   </td> 
          </tr>

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

          <tr>
                <td>  <?php echo $pname ?>  </td><td>  <?php echo $pprice ?>  </td>
                <td>  <?php echo $pquantity ?> </td><td>  <?php echo number_format($itotal,$floating) ?> </td> 
          </tr>
 <?php } } ?>


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
        <tr><td colspan="4">&nbsp;</td></tr>
       <tr>
        <td colspan="2">
        </td>
        <td>
          <p>Gross Total:</p>
        </td>
        <td>
          <p> <strong>Rs. <?php echo number_format($amount,$floating) ?>/-</strong></p>
        </td>

      </tr>
       <tr>
          <td colspan="2"></td>
         <td>

          <p> <?php echo $disdesp ?>:</p>

        </td>
        <td>
          <p> <strong>Rs. <?php echo number_format($disamount,$floating) ?>/-</strong></p>
        </td>
      </tr>

    <?php } ?>


       <?php
       $tdr=0;
       $tcr=0;
       $tbalance=0;


       $rows =mysqli_query($con,"SELECT * FROM journal  where datec='$datec'  AND actid = '$actid'  AND jid<=$id ORDER BY id" ) or die(mysqli_error($con));

       while($row=mysqli_fetch_array($rows)){

         $dr=$row['dr'];
         $cr=$row['cr']; 

         $tdr=$tdr+$dr;
         $tcr=$tcr+$cr;

         $tbalance = $tbalance + $dr;
         $tbalance = $tbalance - $cr;

       }
         ?>
                 <tr><td colspan="4">&nbsp;</td></tr>

          <tr>  <td colspan="3" style="text-align: right;"> Total: </td> <td>Rs. <?php echo number_format($tamount,$floating) ?>/- </td> </tr>
          <tr>  <td colspan="3" style="text-align: right"> Closing Balance: </td> 
          <td> <strong>Rs. <?php if($tbalance===0) echo '0' ; else echo number_format($tbalance,$floating) ?>/-</strong></td> </tr>




        </table>






      </div>




        <div id="printOnly" style="position: fixed;    bottom: 0;">
        <div style="border:1px solid black;">

          <br>
          <br>
          <br>
          <br>
          <br>

        </div>
         
         <table class="table" style="border: 0px solid">
           <tr>
              <td>
                <center>
                  <h2>Prepared By:</h2>
                  <br>
                  <h2 style="font-family: none;">_________________</h2>
                  <br>
                </center>
              </td>
              <td>
                <center>
                  <h2>Approved By:</h2>
                  <br>
                  <h2 style="font-family: none;">_________________</h2>
                  <br>
                </center>
              </td>
              <td>
                <center>
                  <h2>Dealer Stamp:</h2>
                  <br>
                  <h2 style="font-family: none;">_________________</h2>
                  <br>
                </center>
                </td>
                <td>
                  <center>
                    <h2>Recieved By:</h2>
                    <br>
                    <h2 style="font-family: none;">_________________</h2>
                    <br>
                  </center>
                </td>
           </tr>
         </table>

         <div style="text-align: center;">
           <?php echo $comp_name ?> - <?php echo $comp_address ?> -<?php echo $comp_phone ?>  
         </div>
         <br>
         <br>
        </div>

  </div>
 </div>



<style type="text/css">

#printOnly {
   display : none;
}
.printbody{
  max-width: 80%;
  margin-left: 10%;
  margin-right: :10%;
}

@media print {
    #printOnly {
       display : block;
    }
    .printbody{
  max-width: 60%;
  margin-left: 3%;
  margin-right: :10%;
}

}

</style>



<?php }  ?>






<?php include"include/footer.php" ?>

</body>
</html>