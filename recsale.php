  <!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    
  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>

  <title>Recieve Credit Sale - <?php echo $comp_name ?>  </title>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  
<?php $link="recsale.php"; ;?>



  <?php if(isset($_POST['send'])){


    $chequeno = $_POST['chequeno'];


    $act = $_POST['act'];
    $pay = $_POST['pay'];

    $subt = $_POST['amount'];
    $amount = preg_replace("/[^0-9^.]/", '', $subt); 

    $datec=date('Y-m-d');
    $dateup=date('Y-m-d');


      $destid=$pay;
      if($destid==200016){//cash in hand

          $srcid=$act;

          $rows =mysqli_query($con,"SELECT * FROM customers where id=$srcid ORDER BY name" ) or die(mysqli_error($con));
          while($row=mysqli_fetch_array($rows)){ 
            $srcname = $row['name'];
            $srcbalance = $row['balance'];
            $srctype = $row['type'];
            $srctypeid = $row['typeid'];
          }

          $rows =mysqli_query($con,"SELECT * FROM acts where id=$destid ORDER BY name" ) or die(mysqli_error($con));
          while($row=mysqli_fetch_array($rows)){ 
            $destname = $row['name'];
            $destbalance = $row['balance'];
            $desttype = $row['type'];
            $desttypeid = $row['typeid'];

          }

            //First Entry
    

         $srcbalance=$srcbalance-$amount;
         $destbalance=$destbalance+$amount;




         $desp='Recieve Payment Against Sales Invoice From '.$srcname.' To '.$destname;

                          //Journal Entry
         $data=mysqli_query($con,"INSERT INTO journal (desp,dract,cract,dr,datec,dateup)VALUES ('$desp','$destid','$srcid','$amount','$datec','$dateup')")or die( mysqli_error($con) );


         $sqls = "UPDATE customers SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
         mysqli_query($con, $sqls)or die(mysqli_error($con));

         $sqls = "UPDATE acts SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
         mysqli_query($con, $sqls)or die(mysqli_error($con));






                          //Ledger Entry
         $rows =mysqli_query($con,"SELECT id FROM journal ORDER BY id desc limit 1" ) or die(mysqli_error($con));
         while($row=mysqli_fetch_array($rows)){ 
          $jid = $row['id'];

        }

         $desp='Recieve Payment Against Sales Invoice From '.$srcname.' To '.$destname;


        $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

        $desp='Cash to '.$destname;

        $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$desttypeid','$destbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

      }
      else if($destid==200032){ //Cheque 

        $srcid=$act;
          $rows =mysqli_query($con,"SELECT * FROM customers where id=$srcid ORDER BY name" ) or die(mysqli_error($con));
          while($row=mysqli_fetch_array($rows)){ 
            $srcname = $row['name'];
            $srcbalance = $row['balance'];
            $srctype = $row['type'];
            $srctypeid = $row['typeid'];
          }

          $rows =mysqli_query($con,"SELECT * FROM acts where id=$destid ORDER BY name" ) or die(mysqli_error($con));
          while($row=mysqli_fetch_array($rows)){ 
            $destname = $row['name'];
            $destbalance = $row['balance'];
            $desttype = $row['type'];
            $desttypeid = $row['typeid'];

          }

            //First Entry
      

         $srcbalance=$srcbalance-$chequeamt;
         $destbalance=$destbalance+$amount;





         $desp='Recieve Payment Against Sales Invoice From '.$srcname.' To '.$destname.' No. '.$chequeno;

                          //Journal Entry
         $data=mysqli_query($con,"INSERT INTO journal (desp,dract,cract,cr,datec,dateup,chequeno)VALUES ('$desp','$destid','$srcid','$amount','$datec','$dateup','$chequeno')")or die( mysqli_error($con) );


         $sqls = "UPDATE customers SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
         mysqli_query($con, $sqls)or die(mysqli_error($con));

         $sqls = "UPDATE acts SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
         mysqli_query($con, $sqls)or die(mysqli_error($con));








                          //Ledger Entry
         $rows =mysqli_query($con,"SELECT id FROM journal ORDER BY id desc limit 1" ) or die(mysqli_error($con));
         while($row=mysqli_fetch_array($rows)){ 
          $jid = $row['id'];

        }


         $desp='Recieve Payment Against Sales Invoice From '.$srcname.' To '.$destname.' No. '.$chequeno;


        $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

    $desp='Cash to '.$destname;;

        $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$desttypeid','$destbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

      }
      else{

        $srcid=$act;
      $rows =mysqli_query($con,"SELECT * FROM customers where id=$srcid ORDER BY name" ) or die(mysqli_error($con));
      while($row=mysqli_fetch_array($rows)){ 
        $srcname = $row['name'];
        $srcbalance = $row['balance'];
        $srctype = $row['type'];
        $srctypeid = $row['typeid'];
      }

      $destid=$pay;
      $rows =mysqli_query($con,"SELECT * FROM acts where id=$destid ORDER BY name" ) or die(mysqli_error($con));
      while($row=mysqli_fetch_array($rows)){ 
        $destname = $row['name'];
        $destbalance = $row['balance'];
        $desttype = $row['type'];
        $desttypeid = $row['typeid'];

      }

        //First Entry
    
      $srcbalance=$srcbalance-$amount;
      $destbalance=$destbalance+$amount;




         $desp='Recieve Payment Against Sales Invoice From '.$srcname.' To '.$destname;

                      //Journal Entry
     $data=mysqli_query($con,"INSERT INTO journal (desp,dract,cract,cr,dr,datec,dateup)VALUES ('$desp','$destid','$srcid','$amount','$amount','$datec','$dateup')")or die( mysqli_error($con) );


     $sqls = "UPDATE acts SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
     mysqli_query($con, $sqls)or die(mysqli_error($con));

     $sqls = "UPDATE customers SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
     mysqli_query($con, $sqls)or die(mysqli_error($con));






                      //Ledger Entry
     $rows =mysqli_query($con,"SELECT id FROM journal ORDER BY id desc limit 1" ) or die(mysqli_error($con));
     while($row=mysqli_fetch_array($rows)){ 
      $jid = $row['id'];

    }

         $desp='Recieve Payment Against Sales Invoice From '.$srcname.' To '.$destname;


    $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

    $desp='Cash to '.$destname;;

    $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$desttypeid','$destbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

    }


}

?>

<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
  <div class="content-wrapper">





          <div class="col-sm-12">
            <div class="card">
              <div class="card-header" style="padding-bottom: 0px;">
                <h4 class="card-title">Recieve Credit Sale</h4>
              </div>
              <div class="card-block">
                <div class="card-body">
                  <form action="" method="post">
                  <div class="row">

                    <div class="col-sm-4">
                      <span>Select Account</span>
                      <select class="form-control select2" name="act">
                        <?php

                         $rows =mysqli_query($con,"SELECT * FROM customers where balance!=0  ORDER BY name" ) or die(mysqli_error($con));
                                  
                          while($row=mysqli_fetch_array($rows)){
                            
                            $id = $row['id'];
                            $name = $row['name'];
                            ?>

                        <option value="<?php echo $id ?>"><?php echo $name ?></option>

                        <?php } ?>

                      </select>
                    </div>
                    <div class="col-sm-3">
                      <span>Payment Account</span>
                      <select class="form-control select2"  id="multiOptions"  name="pay">
                        <?php

                        $rows =mysqli_query($con,"SELECT * FROM acts where purpose='cash'  ORDER BY name" ) or die(mysqli_error($con));
                                  
                          while($row=mysqli_fetch_array($rows)){
                            
                            $id = $row['id'];
                            $name = $row['name']; ?>

                        <option value="<?php echo $id ?>"><?php echo $name ?></option>

                        <?php } ?>

                      </select>

                    </div>
                    <div class="col-sm-2">
                      <span>Amount </span>
                        <input type="number" name="amount" class="form-control" placeholder="0">
                    </div>
                   

                      <div class="col-sm-2" id="chequediv">
                        <center><span>Cheque No :</span></center>
                        <input type="text" name="chequeno" class="form-control">

                    </div>
                    <div class="col-sm-1">
                      <span>&nbsp;</span>
                        <input type="submit" class="btn btn-primary" name="send" value="Add">
                    </div>
                    
                  </div>

                </form>
                            <center><h2><?php if(!empty($msg)) { ?>
                              
                              <br>
                              <hr>
                              <br>
                            <?php echo $msg ; } ?></h2></center>
                </div>
              </div>
            </div>
          </div>






    <div class="col-sm-12">
      <div class="card">
        <div class="card-block">
          <div class="card-body">
           
            <h2>Vendors Account Recieveables</h2>
            <div class="row align-items-center">
             <div class="col-md-1">
             </div>
             <div class="col-md-2">
               <h3>Vendor</h3>
             </div>

             <div class="col-md-6">
                                 
               <h3>Details</h3>
             </div>
             <div class="col-md-2">
                                 
               <h2>Balance</h3>
             </div>
             </div>
             <br>
             <hr>

            <?php
            $tb=0;
             $rows =mysqli_query($con,"SELECT * FROM customers where balance!=0  ORDER BY name" ) or die(mysqli_error($con));
                      
              while($row=mysqli_fetch_array($rows)){
                
                $id = $row['id'];
                $name = $row['name'];
                $mobile = $row['mobile'];
                $company = $row['company'];
                $phone = $row['phone'];
                $address = $row['address'];
                $balance = $row['balance'];
                $tb = $tb+$balance;

              
              ?>
              <br>

           <div class="row align-items-center">
            <div class="col-md-1">
            </div>
            <div class="col-md-2">
              <h5><?php echo $name ?></h5>
            </div>

            <div class="col-md-6">
                                
              <h5><?php echo $address.' - '.$phone ?>:</h5>
            </div>
            <div class="col-md-2">
                                
              <h5>Rs. <?php echo number_format($balance);   ?>/-</h5>
            </div>
            </div>

          <?php } ?>

          <hr>
          <div class="row align-items-center">
           <div class="col-md-3">
           </div>
           <div class="col-md-4">
                               
             <h3>Total :</h3>
           </div>
           <div class="col-md-2">
                               
             <h3>Rs. <?php echo number_format($tb) ?>/-</h3>
           </div>
           </div>

        </div>
      </div>
    </div>




    
  </div>
</div>



<?php include"include/footer.php" ?>

</body>
<script type="text/javascript">
  
  $(document).ready(function () {

  $('#chequediv').hide();

  $("#multiOptions").change(function () {
      if ($(this).val() == "200032" ) {
         $('#chequediv').show();
         
      }
      else { 
          $('#chequediv').hide();
           }
  });
  });

</script>

</html>