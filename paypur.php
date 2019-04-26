  <!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    
  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>

  <title>Pay Credit Purchase - <?php echo $comp_name ?>  </title>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  
<?php $link="paypur.php"; ;?>



  <?php if(isset($_POST['payvend'])){


    $chequeno = $_POST['chequeno'];

    $act = $_POST['act'];
    $pay = $_POST['pay'];

    $subt = $_POST['amount'];
    $amount = preg_replace("/[^0-9^.]/", '', $subt);
    $discount = $_POST['discount'];


    $discid=200038;
    $rows =mysqli_query($con,"SELECT * FROM acts where id=$discid ORDER BY name" ) or die(mysqli_error($con));
    while($row=mysqli_fetch_array($rows)){ 
      $discname = $row['name'];
      $discbalance = $row['balance'];
      $disctype = $row['type'];
      $disctypeid = $row['typeid'];
    }
 

    $datec=date('Y-m-d');
    $dateup=date('Y-m-d');


      $srcid=$pay;
      if($srcid==200016){ //Cash in Hand

          $rows =mysqli_query($con,"SELECT * FROM acts where id=$srcid ORDER BY name" ) or die(mysqli_error($con));
          while($row=mysqli_fetch_array($rows)){ 
            $srcname = $row['name'];
            $srcbalance = $row['balance'];
            $srctype = $row['type'];
            $srctypeid = $row['typeid'];
          }

          $destid=$act;
          $rows =mysqli_query($con,"SELECT * FROM vendors where id=$destid ORDER BY name" ) or die(mysqli_error($con));
          while($row=mysqli_fetch_array($rows)){ 
            $destname = $row['name'];
            $destbalance = $row['balance'];
            $desttype = $row['type'];
            $desttypeid = $row['typeid'];

          }

            //First Entry
    

         $srcbalance=$srcbalance-$amount+$discount;
         $destbalance=$destbalance-$amount;
         $aamount=$amount-$discount;
         $discbalance=$discbalance+$discount;




         $desp='Made Payment Against Purchase Invoice from '.$destname;

                          //Journal Entry
         $data=mysqli_query($con,"INSERT INTO journal (desp,dract,cract,cr,datec,dateup)VALUES ('$desp','$destid','$srcid','$amount','$datec','$dateup')")or die( mysqli_error($con) );


         $sqls = "UPDATE acts SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
         mysqli_query($con, $sqls)or die(mysqli_error($con));

         $sqls = "UPDATE vendors SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
         mysqli_query($con, $sqls)or die(mysqli_error($con));

         $sqls = "UPDATE acts SET `balance` = '$discbalance' WHERE `id` = $discid"  ;
         mysqli_query($con, $sqls)or die(mysqli_error($con));






                          //Ledger Entry
         $rows =mysqli_query($con,"SELECT id FROM journal ORDER BY id desc limit 1" ) or die(mysqli_error($con));
         while($row=mysqli_fetch_array($rows)){ 
          $jid = $row['id'];

        }

        $desp='Payment Made from '.$srcname;


        $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$aamount','$datec','$dateup')")or die( mysqli_error($con) );


        if(!empty($discount)){

        $desp='Early Payment Discount Recieved';

        $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$discid','$desp','$disctype','$disctypeid','$discbalance','$discount','$datec','$dateup')")or die( mysqli_error($con) ); 
        }


        $desp='Payment Made to '.$destname;

        $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$desttypeid','$destbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

      }
        else if($srcid==200032){ //Cheque 

          
            $rows =mysqli_query($con,"SELECT * FROM acts where id=$srcid ORDER BY name" ) or die(mysqli_error($con));
            while($row=mysqli_fetch_array($rows)){ 
              $srcname = $row['name'];
              $srcbalance = $row['balance'];
              $srctype = $row['type'];
              $srctypeid = $row['typeid'];
            }
            $destid=$act;
            $rows =mysqli_query($con,"SELECT * FROM vendors where id=$destid ORDER BY name" ) or die(mysqli_error($con));
            while($row=mysqli_fetch_array($rows)){ 
              $destname = $row['name'];
              $destbalance = $row['balance'];
              $desttype = $row['type'];
              $desttypeid = $row['typeid'];

            }

              //First Entry
        

           $srcbalance=$srcbalance-$amount;
           $destbalance=$destbalance-$amount;





     $desp='Made Payment Against Purchase Invoice from '.$destname.' through Open Cheque No. '.$chequeno;

                            //Journal Entry
           $data=mysqli_query($con,"INSERT INTO journal (desp,dract,cract,cr,datec,dateup,chequeno)VALUES ('$desp','$destid','$srcid','$amount','$datec','$dateup','$chequeno')")or die( mysqli_error($con) );


           $sqls = "UPDATE acts SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
           mysqli_query($con, $sqls)or die(mysqli_error($con));

           $sqls = "UPDATE vendors SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
           mysqli_query($con, $sqls)or die(mysqli_error($con));


            //Ledger Entry
           $rows =mysqli_query($con,"SELECT id FROM journal ORDER BY id desc limit 1" ) or die(mysqli_error($con));
           while($row=mysqli_fetch_array($rows)){ 
            $jid = $row['id'];

          }


     $desp='Made Payment Against Purchase Invoice from '.$destname.' through Open Cheque No. '.$chequeno;


          $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

    $desp='Payment Made to '.$destname;;

          $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$desttypeid','$destbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

        }
      else{


      $rows =mysqli_query($con,"SELECT * FROM acts where id=$srcid ORDER BY name" ) or die(mysqli_error($con));
      while($row=mysqli_fetch_array($rows)){ 
        $srcname = $row['name'];
        $srcbalance = $row['balance'];
        $srctype = $row['type'];
        $srctypeid = $row['typeid'];
      }

      $destid=$act;
      $rows =mysqli_query($con,"SELECT * FROM vendors where id=$destid ORDER BY name" ) or die(mysqli_error($con));
      while($row=mysqli_fetch_array($rows)){ 
        $destname = $row['name'];
        $destbalance = $row['balance'];
        $desttype = $row['type'];
        $desttypeid = $row['typeid'];

      }

        //First Entry
  

  $srcbalance=$srcbalance-$amount+$discount;
  $destbalance=$destbalance-$amount;
  $aamount=$amount-$discount;
  $discbalance=$discbalance+$discount;




     $desp='Made Payment Against Purchase Invoice from '.$destname;

                      //Journal Entry
     $data=mysqli_query($con,"INSERT INTO journal (desp,dract,cract,cr,dr,datec,dateup)VALUES ('$desp','$destid','$srcid','$amount','$amount','$datec','$dateup')")or die( mysqli_error($con) );


     $sqls = "UPDATE acts SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
     mysqli_query($con, $sqls)or die(mysqli_error($con));

     $sqls = "UPDATE vendors SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
     mysqli_query($con, $sqls)or die(mysqli_error($con));

     $sqls = "UPDATE acts SET `balance` = '$discbalance' WHERE `id` = $discid"  ;
     mysqli_query($con, $sqls)or die(mysqli_error($con));







                      //Ledger Entry
     $rows =mysqli_query($con,"SELECT id FROM journal ORDER BY id desc limit 1" ) or die(mysqli_error($con));
     while($row=mysqli_fetch_array($rows)){ 
      $jid = $row['id'];

    }

    $desp='Payment Made from '.$srcname;


    $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$aamount','$datec','$dateup')")or die( mysqli_error($con) );

    if(!empty($discount)){

    $desp='Early Payment Discount Recieved';

    $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$discid','$desp','$disctype','$disctypeid','$discbalance','$discount','$datec','$dateup')")or die( mysqli_error($con) ); 
    }


    $desp='Payment Made to '.$destname;


    $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$desttypeid','$destbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

    }


}

?>

  <?php if(isset($_POST['paycus'])){


    $chequeno = $_POST['chequeno'];

    $act = $_POST['act'];
    $pay = $_POST['pay'];

    $subt = $_POST['amount'];
    $amount = preg_replace("/[^0-9^.]/", '', $subt);
    $discount = $_POST['discount'];


    $discid=200039;
    $rows =mysqli_query($con,"SELECT * FROM acts where id=$discid ORDER BY name" ) or die(mysqli_error($con));
    while($row=mysqli_fetch_array($rows)){ 
      $discname = $row['name'];
      $discbalance = $row['balance'];
      $disctype = $row['type'];
      $disctypeid = $row['typeid'];
    }
 

    $datec=date('Y-m-d');
    $dateup=date('Y-m-d');


      $srcid=$pay;
      if($srcid==200016){ //Cash in Hand

          $rows =mysqli_query($con,"SELECT * FROM acts where id=$srcid ORDER BY name" ) or die(mysqli_error($con));
          while($row=mysqli_fetch_array($rows)){ 
            $srcname = $row['name'];
            $srcbalance = $row['balance'];
            $srctype = $row['type'];
            $srctypeid = $row['typeid'];
          }

          $destid=$act;
          $rows =mysqli_query($con,"SELECT * FROM customers where id=$destid ORDER BY name" ) or die(mysqli_error($con));
          while($row=mysqli_fetch_array($rows)){ 
            $destname = $row['name'];
            $destbalance = $row['balance'];
            $desttype = $row['type'];
            $desttypeid = $row['typeid'];

          }

            //First Entry
    

         $srcbalance=$srcbalance-$amount+$discount;
         $destbalance=$destbalance-$amount;
         $aamount=$amount-$discount;
         $discbalance=$discbalance+$discount;




         $desp='Made Payment Against Credit Balance of '.$destname;

                          //Journal Entry
         $data=mysqli_query($con,"INSERT INTO journal (desp,dract,cract,cr,datec,dateup)VALUES ('$desp','$destid','$srcid','$amount','$datec','$dateup')")or die( mysqli_error($con) );


         $sqls = "UPDATE acts SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
         mysqli_query($con, $sqls)or die(mysqli_error($con));

         $sqls = "UPDATE customers SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
         mysqli_query($con, $sqls)or die(mysqli_error($con));

         $sqls = "UPDATE acts SET `balance` = '$discbalance' WHERE `id` = $discid"  ;
         mysqli_query($con, $sqls)or die(mysqli_error($con));






                          //Ledger Entry
         $rows =mysqli_query($con,"SELECT id FROM journal ORDER BY id desc limit 1" ) or die(mysqli_error($con));
         while($row=mysqli_fetch_array($rows)){ 
          $jid = $row['id'];

        }

        $desp='Payment Made from '.$srcname;


        $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$aamount','$datec','$dateup')")or die( mysqli_error($con) );


        if(!empty($discount)){

        $desp=' Discount Recieved';

        $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$discid','$desp','$disctype','$disctypeid','$discbalance','$discount','$datec','$dateup')")or die( mysqli_error($con) ); 
        }


        $desp='Made Payment Against Credit Balance of  '.$destname;

        $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$desttypeid','$destbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

      }
        else if($srcid==200032){ //Cheque 

          
            $rows =mysqli_query($con,"SELECT * FROM acts where id=$srcid ORDER BY name" ) or die(mysqli_error($con));
            while($row=mysqli_fetch_array($rows)){ 
              $srcname = $row['name'];
              $srcbalance = $row['balance'];
              $srctype = $row['type'];
              $srctypeid = $row['typeid'];
            }
            $destid=$act;
            $rows =mysqli_query($con,"SELECT * FROM customers where id=$destid ORDER BY name" ) or die(mysqli_error($con));
            while($row=mysqli_fetch_array($rows)){ 
              $destname = $row['name'];
              $destbalance = $row['balance'];
              $desttype = $row['type'];
              $desttypeid = $row['typeid'];

            }

              //First Entry
        

           $srcbalance=$srcbalance-$amount;
           $destbalance=$destbalance-$amount;





     $desp='Made Payment Against Credit Balance of '.$destname.' through Open Cheque No. '.$chequeno;

                            //Journal Entry
           $data=mysqli_query($con,"INSERT INTO journal (desp,dract,cract,cr,datec,dateup,chequeno)VALUES ('$desp','$destid','$srcid','$amount','$datec','$dateup','$chequeno')")or die( mysqli_error($con) );


           $sqls = "UPDATE acts SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
           mysqli_query($con, $sqls)or die(mysqli_error($con));

           $sqls = "UPDATE customers SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
           mysqli_query($con, $sqls)or die(mysqli_error($con));


            //Ledger Entry
           $rows =mysqli_query($con,"SELECT id FROM journal ORDER BY id desc limit 1" ) or die(mysqli_error($con));
           while($row=mysqli_fetch_array($rows)){ 
            $jid = $row['id'];

          }


     $desp='Made Payment Against Credit Balance of  '.$destname.' through Open Cheque No. '.$chequeno;


          $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

    $desp='Payment Made to '.$destname;;

          $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$desttypeid','$destbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );

        }
      else{


      $rows =mysqli_query($con,"SELECT * FROM acts where id=$srcid ORDER BY name" ) or die(mysqli_error($con));
      while($row=mysqli_fetch_array($rows)){ 
        $srcname = $row['name'];
        $srcbalance = $row['balance'];
        $srctype = $row['type'];
        $srctypeid = $row['typeid'];
      }

      $destid=$act;
      $rows =mysqli_query($con,"SELECT * FROM customers where id=$destid ORDER BY name" ) or die(mysqli_error($con));
      while($row=mysqli_fetch_array($rows)){ 
        $destname = $row['name'];
        $destbalance = $row['balance'];
        $desttype = $row['type'];
        $desttypeid = $row['typeid'];

      }

        //First Entry
  

  $srcbalance=$srcbalance-$amount+$discount;
  $destbalance=$destbalance-$amount;
  $aamount=$amount-$discount;
  $discbalance=$discbalance+$discount;




     $desp='Made Payment Against Credit Balance of '.$destname;

                      //Journal Entry
     $data=mysqli_query($con,"INSERT INTO journal (desp,dract,cract,cr,dr,datec,dateup)VALUES ('$desp','$destid','$srcid','$amount','$amount','$datec','$dateup')")or die( mysqli_error($con) );


     $sqls = "UPDATE acts SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
     mysqli_query($con, $sqls)or die(mysqli_error($con));

     $sqls = "UPDATE customers SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
     mysqli_query($con, $sqls)or die(mysqli_error($con));

     $sqls = "UPDATE acts SET `balance` = '$discbalance' WHERE `id` = $discid"  ;
     mysqli_query($con, $sqls)or die(mysqli_error($con));







                      //Ledger Entry
     $rows =mysqli_query($con,"SELECT id FROM journal ORDER BY id desc limit 1" ) or die(mysqli_error($con));
     while($row=mysqli_fetch_array($rows)){ 
      $jid = $row['id'];

    }

    $desp='Payment Made from '.$srcname;


    $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$aamount','$datec','$dateup')")or die( mysqli_error($con) );

    if(!empty($discount)){

    $desp='Discount Recieved';

    $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$discid','$desp','$disctype','$disctypeid','$discbalance','$discount','$datec','$dateup')")or die( mysqli_error($con) ); 
    }


    $desp='Made Payment Against Credit Balance of  '.$destname;


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
        <div class="card-block">
          <div class="card-body">
           
            <h2>Vendors Account Payables</h2>
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
             <?php // Overall - For all types of Account from Ledger by account type
             $vendpay=0;
             $allrows =mysqli_query($con,"SELECT id,name FROM vendors ORDER BY name" ) or die(mysqli_error($con));
             while($allrow=mysqli_fetch_array($allrows)){
              $actid = $allrow['id'];
              $actname = $allrow['name'];
              
              $tcr=0;
              $tdr=0;
              $total=0;
              $rows =mysqli_query($con,"SELECT cr FROM ledger WHERE actid=$actid " ) or die(mysqli_error($con));

              while($row=mysqli_fetch_array($rows)){
                $cr = $row['cr'];
                $tcr=$tcr+$cr;
              } 
              $rows =mysqli_query($con,"SELECT dr FROM ledger WHERE actid=$actid " ) or die(mysqli_error($con));
              
              while($row=mysqli_fetch_array($rows)){
                $dr = $row['dr'];
                $tdr=$tdr+$dr;
              } 

              $total=$tcr-$tdr;
              if($total>0){
              $vendpay=$vendpay+$total;
             

              ?>
       
       <br>
           <div class="row align-items-center">
            <div class="col-md-1">
            </div>
            <div class="col-md-2">
              <h5><?php echo $actname ?></h5>
            </div>

            <div class="col-md-6">
                                
              <h5><?php //echo $address.' - '.$phone ?>:</h5>
            </div>
            <div class="col-md-2">
                                
              <h5>Rs. <?php echo number_format($total);   ?>/-</h5>
            </div>
            </div>

          <?php  } } ?>

          <hr>
          <div class="row align-items-center">
           <div class="col-md-3">
           </div>
           <div class="col-md-4">
                               
             <h3>Total :</h3>
           </div>
           <div class="col-md-2">
                               
             <h3>Rs. <?php echo number_format($vendpay  ) ?>/-</h3>
           </div>
           </div>
           <br>
             <form action="" method="post">
             <div class="row">

               <div class="col-sm-4">
                 <span>Select Vendor Account</span>
                 <select class="form-control select2" name="act">
                   <?php

                    $rows =mysqli_query($con,"SELECT * FROM vendors where balance!=0  ORDER BY name" ) or die(mysqli_error($con));
                             
                     while($row=mysqli_fetch_array($rows)){
                       
                       $id = $row['id'];
                       $name = $row['name'];
                       ?>

                   <option value="<?php echo $id ?>"><?php echo $name ?></option>

                   <?php } ?>

                 </select>
               </div>
               <div class="col-sm-3">
                 <span>Cash Account</span>
                 <select class="form-control select2" id="multiOptions" name="pay">
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
                 <div class="col-sm-2" id="disdiv">
                   <center><span>Discount :</span></center>  
                    <input type="number" name="discount" class="form-control" value="0">

               </div>
               <div class="col-sm-1">
                 <span>&nbsp;</span>
                   <input type="submit" class="btn btn-primary" name="payvend" value="Add">
               </div>
               
             </div>
           </form>

        </div>
      </div>
    </div>







    <div class="col-sm-12">
      <div class="card">
        <div class="card-block">
          <div class="card-body">
           
            <h2>Customers Account Payables</h2>
            <div class="row align-items-center">
             <div class="col-md-1">
             </div>
             <div class="col-md-2">
               <h3>Customer</h3>
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
             <?php // Overall - For all types of Account from Ledger by account type
             $vendpay=0;
             $allrows =mysqli_query($con,"SELECT id,name FROM customers ORDER BY name" ) or die(mysqli_error($con));
             while($allrow=mysqli_fetch_array($allrows)){
              $actid = $allrow['id'];
              $actname = $allrow['name'];
              
              $tcr=0;
              $tdr=0;
              $total=0;
              $rows =mysqli_query($con,"SELECT cr FROM ledger WHERE actid=$actid " ) or die(mysqli_error($con));

              while($row=mysqli_fetch_array($rows)){
                $cr = $row['cr'];
                $tcr=$tcr+$cr;
              } 
              $rows =mysqli_query($con,"SELECT dr FROM ledger WHERE actid=$actid " ) or die(mysqli_error($con));
              
              while($row=mysqli_fetch_array($rows)){
                $dr = $row['dr'];
                $tdr=$tdr+$dr;
              } 

              $total=$tcr-$tdr;
              if($total>0){
              $vendpay=$vendpay+$total;
             

              ?>
          


              <br>

           <div class="row align-items-center">
            <div class="col-md-1">
            </div>
            <div class="col-md-2">
              <h5><?php echo $actname ?></h5>
            </div>

            <div class="col-md-6">
                                
              <h5><?php //echo $address.' - '.$phone ?>:</h5>
            </div>
            <div class="col-md-2">
                                
              <h5>Rs. <?php echo number_format($total);   ?>/-</h5>
            </div>
            </div>

          <?php  } } ?>

          <hr>
          <div class="row align-items-center">
           <div class="col-md-3">
           </div>
           <div class="col-md-4">
                               
             <h3>Total :</h3>
           </div>
           <div class="col-md-2">
                               
             <h3>Rs. <?php echo number_format($vendpay  ) ?>/-</h3>
           </div>
           </div>
           <br>
             <form action="" method="post">
             <div class="row">

               <div class="col-sm-4">
                 <span>Select Customer Account</span>
                 <select class="form-control select2" name="act">
                   <?php

                    $vendpay=0;
                    $allrows =mysqli_query($con,"SELECT id,name FROM customers ORDER BY name" ) or die(mysqli_error($con));
                    while($allrow=mysqli_fetch_array($allrows)){
                     $actid = $allrow['id'];
                     $actname = $allrow['name'];
                     
                     $tcr=0;
                     $tdr=0;
                     $total=0;
                     $rows =mysqli_query($con,"SELECT cr FROM ledger WHERE actid=$actid " ) or die(mysqli_error($con));

                     while($row=mysqli_fetch_array($rows)){
                       $cr = $row['cr'];
                       $tcr=$tcr+$cr;
                     } 
                     $rows =mysqli_query($con,"SELECT dr FROM ledger WHERE actid=$actid " ) or die(mysqli_error($con));
                     
                     while($row=mysqli_fetch_array($rows)){
                       $dr = $row['dr'];
                       $tdr=$tdr+$dr;
                     } 

                     $total=$tcr-$tdr;
                     if($total>0){
                     $vendpay=$vendpay+$total;
                    
                       ?>

                   <option value="<?php echo $actid ?>"><?php echo $actname ?></option>

                   <?php } } ?>

                 </select>
               </div>
               <div class="col-sm-3">
                 <span>Cash Account</span>
                 <select class="form-control select2" id="multiOptions2" name="pay">
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

                 <div class="col-sm-2" id="chequediv2">
                   <center><span>Cheque No :</span></center>
                   <input type="text" name="chequeno" class="form-control">

               </div>
                 <div class="col-sm-2" id="disdiv2">
                   <center><span>Discount :</span></center>  
                    <input type="number" name="discount" class="form-control" value="0">

               </div>
               <div class="col-sm-1">
                 <span>&nbsp;</span>
                   <input type="submit" class="btn btn-primary" name="paycus" value="Add">
               </div>
               
             </div>
           </form>

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
         $('#disdiv').hide();
         
      }
      else { 
          $('#chequediv').hide();
          $('#disdiv').show();
           }
  });
  });

</script>



<script type="text/javascript">
  
  $(document).ready(function () {

  $('#chequediv2').hide();

  $("#multiOptions2").change(function () {
      if ($(this).val() == "200032" ) {
         $('#chequediv2').show();
         $('#disdiv2').hide();
         
      }
      else { 
          $('#chequediv2').hide();
          $('#disdiv2').show();
           }
  });
  });

</script>


</html>