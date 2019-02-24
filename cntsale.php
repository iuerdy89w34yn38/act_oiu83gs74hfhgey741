<!doctype html>
<html>
<head>
  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>

  <title>Counter Sale  - <?php echo $comp_name ?>  </title>


      <style type="text/css">
      .mycon {
        border: 1px solid #cacfe7;
        color: #3b4781;
        border-radius: 0.25rem;
        padding: 8px 10px;
      }
      .table th, .table td {
        padding: 5px 6px;
        text-align: center;
        vertical-align: middle;
      }
    </style>
  </head>
  <body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
  data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">


  <?php if(isset($_POST['send'])){


    $x= count($home = $_POST['qty1']);

    for ($i=0; $i < $x; $i++) {

      $pid = $_POST['item'][$i];
      $qty = $_POST['qty1'][$i];

      $rows =mysqli_query($con,"SELECT stock FROM items where id=$pid ORDER BY name" ) or die(mysqli_error($con));
      while($row=mysqli_fetch_array($rows)){ 
        $stock = $row['stock'];

      }
      if($qty>$stock){


        $msg = 'Quantity is greater than Stock';
        exit($msg);


      }



    }



    $subt = $_POST['sub_total'];
    $amount = preg_replace("/[^0-9^.]/", '', $subt); 

    $datec=date('Y-m-d');
    $dateup=date('Y-m-d');

    
    $discount = $_POST['discount'];


    $destid=200016;

    $srcid=200019;

    $rows =mysqli_query($con,"SELECT * FROM acts where id=$srcid ORDER BY name" ) or die(mysqli_error($con));
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

    $discid=200039;
    $rows =mysqli_query($con,"SELECT * FROM acts where id=$discid ORDER BY name" ) or die(mysqli_error($con));
    while($row=mysqli_fetch_array($rows)){ 
      $discname = $row['name'];
      $discbalance = $row['balance'];
      $disctype = $row['type'];
      $disctypeid = $row['typeid'];
    }


            //First Entry


    $srcbalance=$srcbalance+$amount-$discount;
    $destbalance=$destbalance+$amount;
    $aamount=$amount-$discount;
    $discbalance=$discbalance+$discount;




    $desp='Goods Sold to '.$destname.' through Counter Sale';

                          //Journal Entry
    $data=mysqli_query($con,"INSERT INTO journal (desp,dract,cract,dr,datec,dateup)VALUES ('$desp','$destid','$srcid','$amount','$datec','$dateup')")or die( mysqli_error($con) );


    $sqls = "UPDATE acts SET `balance` = '$srcbalance' WHERE `id` = $srcid"  ;
    mysqli_query($con, $sqls)or die(mysqli_error($con));

    $sqls = "UPDATE acts SET `balance` = '$destbalance' WHERE `id` = $destid"  ;
    mysqli_query($con, $sqls)or die(mysqli_error($con));

    $sqls = "UPDATE acts SET `balance` = '$discbalance' WHERE `id` = $discid"  ;
    mysqli_query($con, $sqls)or die(mysqli_error($con));







                          //Ledger Entry
    $rows =mysqli_query($con,"SELECT id FROM journal ORDER BY id desc limit 1" ) or die(mysqli_error($con));
    while($row=mysqli_fetch_array($rows)){ 
      $jid = $row['id'];

    }

    $desp='Goods Sold to '.$destname.' Counter Sale';


    $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$srctypeid','$srcbalance','$aamount','$datec','$dateup')")or die( mysqli_error($con) );

    

    if(!empty($discount)){

    $desp='Discount Given';

    $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,cr,datec,dateup)VALUES ('$jid','$discid','$desp','$disctype','$disctypeid','$discbalance','$discount','$datec','$dateup')")or die( mysqli_error($con) ); 
    }

    $desp='Counter Sale ';

    $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,typeid,balance,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$desttypeid','$destbalance','$amount','$datec','$dateup')")or die( mysqli_error($con) );




    $x= count($home = $_POST['qty1']);

    for ($i=0; $i < $x; $i++) {

      $pid = $_POST['item'][$i];
      $qty = $_POST['qty1'][$i];
      $price = $_POST['price1'][$i];



      $rows =mysqli_query($con,"SELECT name,stock FROM items where id=$pid" ) or die(mysqli_error($con));

      while($row=mysqli_fetch_array($rows)){

        $name = $row['name'];
        $stock = $row['stock'];
      }

      $stock=$stock-$qty;
      $type='out';
      $date=date('Y-m-d');



                      //Journal Entry
      $data=mysqli_query($con,"INSERT INTO itemslog (jid,pid,type,name,price,quantity,subtotal,datec)VALUES ('$jid','$pid','$type','$name','$price','$qty','$amount','$date')")or die( mysqli_error($con) );

      $sqls = "UPDATE items SET `stock` = '$stock' WHERE `id` = $pid"  ;
      mysqli_query($con, $sqls)or die(mysqli_error($con));


    }
    $msg = 'Successfull';




  }

  ?>

  <?php $link="cntsale.php"; ?>

  <?php include"include/header.php" ?>
  <?php include"include/sidebar.php" ?>

  <div class="app-content content">
   <div class="content-wrapper">

    <form name="cart" method="POST" action="">


      <div class="col-sm-12">
        <div class="card">
          <div class="card-header" style="padding-bottom: 0px;">
            <h4 class="card-title">Counter Sale Invoice</h4>
          </div>
          <div class="card-block">
            <div class="card-body">


                           
                           <style type="text/css">
                             table>thead>tr>th:nth-child(2){
                           display: none;
                             }
                             table>tbody>tr>td:nth-child(2){
                           display: none;
                             }
                             
                             table>tfoot>tr>td:nth-child(2){
                           display: none;
                             }

                           </style>


                            <table style="min-width: 700px;">
                              <thead>
                                <tr>
                                  <th style="min-width: 300px;">Product Name  </th>
                                  <th>Selling Price</th>
                                  <th>Quantity </th>
                                  <th>Price </th>
                                  <th>Total </th>
                                  <th>Add </th>
                                </tr>
                              </thead>
                              <tbody>
                               
                               <tr><td> <select class="form-control select2" name="item[]"> <?php $rows =mysqli_query($con,"SELECT * FROM items WHERE pause =0 ORDER BY name" ) or die(mysqli_error($con)); while($row=mysqli_fetch_array($rows)){ $id = $row['id']; $brand = $row['brand']; $name = $row['name']; ?> <option value="<?php echo $id ?>"><?php $rows1 =mysqli_query($con,"SELECT * FROM itemsb WHERE id=$brand ORDER BY name" ) or die(mysqli_error($con));while($row1=mysqli_fetch_array($rows1)){ $bname = $row1['name']; ?><?php echo $bname ?> <?php echo $name ?></option><?php } } ?></select> </td><td><input class="form-control" type="number" name="pprice[]" id="pprice" value=""></td><td><input class="form-control"  type="number" oninput="wrt('0')" name="qty1[]" ></td><td><input  class="form-control"  type="number" oninput="wrt('0')" name="price1[]" ></td><td><input class="form-control"  type="number" name="item_total1[]" id="c" disabled="" ></td><td>  <button class="add_form_field btn btn-primary" type="button"><i class="la la-plus"></i> </button>
              </td></tr>




                              </tbody>

                              <tfoot>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td style="text-align: right;">Grand Total:</td>
                                  <td><input class="form-control" type="text" name="sub_total" id="d" value="0" readonly=""  ></td>
                                
                              </tfoot>
                            </table>
                          
                          


                <div class="row">
                <div class="col-md-8">
                </div>
                <div class="col-md-3" id="disdiv">
                  <div class="">
                  <span>Discount</span>
                <input type="text" name="discount" class="form-control" value="0">
              </div>
              </div>

              </div>
              <hr>

              <center><button name="send"  class="btn btn-primary block-element">Sale</button></center>


              <center><h2>

                <?php if(!empty($msg)) { ?>

                  <br>
                  <hr>
                  <br>
                  <?php echo $msg ; } ?></h2></center>
                  <center><h2>

                    <?php if(!empty($msg1)) { ?>

                      <br>
                      <hr>
                      <br>
                      <?php echo $msg1 ; } ?></h2></center>
                    </div>
                  </div>
                </div>
              </div>

            </form>

        


    </div>



  </div>





</body>


<?php include 'include/footer.php'; ?>

</html>
