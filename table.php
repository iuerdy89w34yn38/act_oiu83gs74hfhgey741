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


<?php
if(isset($_POST['submitcap'])){
    $msg="Unsuccessful" ;
    
     $srcid=$_POST['src'];
     $rows =mysqli_query($con,"SELECT * FROM acts where id=$srcid ORDER BY name" ) or die(mysqli_error($con));
      while($row=mysqli_fetch_array($rows)){ 
        $srcname = $row['name'];
        $srcbalance = $row['balance'];
        $srctype = $row['type'];
        $srcdr = $row['dr'];
        $srccr = $row['cr'];
      }

     $destid=$_POST['dest'];
     $rows =mysqli_query($con,"SELECT * FROM acts where id=$destid ORDER BY name" ) or die(mysqli_error($con));
      while($row=mysqli_fetch_array($rows)){ 
        $destname = $row['name'];
        $destbalance = $row['balance'];
        $desttype = $row['type'];
        $destdr = $row['dr'];
        $destcr = $row['cr'];
      }

      $amount=$_POST['amount'];
      $op=0;
      $rows =mysqli_query($con,"SELECT balance FROM acts where purpose='cash' ORDER BY name" ) or die(mysqli_error($con));
       while($row=mysqli_fetch_array($rows)){ 
         $balance = $row['balance'];
         $op=$op+$balance;

       }

     $cl=$op-$amount;

     $srcbalance=$srcbalance-$amount;
     $destbalance=$destbalance+$amount;
     $newsrccr=$srccr+$amount;

     $datec=date('Y-m-d');
     $dateup=date('Y-m-d');
     $desp='Cash is Drawn from '.$srcname.' to '.$destname;
     
//Journal Entry
    $data=mysqli_query($con,"INSERT INTO journal (desp,dract,cract,cr,dractbal,cractbal,opbalance,clbalance,datec,dateup)VALUES ('$desp','$srcid','$destid','$amount','$srcbalance','$destbalance','$op','$cl','$datec','$dateup')")or die( mysqli_error($con) );


    $sqls = "UPDATE acts SET `balance` = '$srcbalance',`cr` = '$newsrccr' WHERE `id` = $srcid"  ;
    mysqli_query($con, $sqls)or die(mysqli_error($con));

    $sqls = "UPDATE acts SET `balance` = '$destbalance',`dr` = '$destbalance' WHERE `id` = $destid"  ;
    mysqli_query($con, $sqls)or die(mysqli_error($con));


//Ledger Entry
     $rows =mysqli_query($con,"SELECT id FROM journal ORDER BY id desc limit 1" ) or die(mysqli_error($con));
      while($row=mysqli_fetch_array($rows)){ 
        $jid = $row['id'];

      }

      $desp='Cash drawn from '.$srcname;
      
    $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,cr,datec,dateup)VALUES ('$jid','$srcid','$desp','$srctype','$amount','$datec','$dateup')")or die( mysqli_error($con) );

      $desp='Cash to '.$destname;
      
    $data=mysqli_query($con,"INSERT INTO ledger (jid,actid,desp,type,dr,datec,dateup)VALUES ('$jid','$destid','$desp','$desttype','$amount','$datec','$dateup')")or die( mysqli_error($con) );

	$msg="Successful" ;
    
}
?>



<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
  <div class="content-wrapper">





          <div class="col-sm-12">
            <div class="card">
              <div class="card-header" style="padding-bottom: 0px;">
                <h4 class="card-title">Withdraw Cash / Capital</h4>
              </div>
              <div class="card-block">
                <div class="card-body">
                  <form action="" method="post">
                  <div class="row">

                    <div class="col-sm-4">
                      <span>Select Drawing Capital Account</span>
                      <select class="form-control select2" name="dest">
                        <?php

                        $rows =mysqli_query($con,"SELECT * FROM acts where type='drawing capital'  ORDER BY name" ) or die(mysqli_error($con));
                                  
                          while($row=mysqli_fetch_array($rows)){
                            
                            $id = $row['id'];
                            $name = $row['name']; ?>

                        <option value="<?php echo $id ?>"><?php echo $name ?></option>

                        <?php } ?>

                      </select>
                    </div>
                    <div class="col-sm-3">
                      <span>Cash Account</span>
                      <select class="form-control select2" name="src">
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
                    <div class="col-sm-1">
                      <span>&nbsp;</span>
                        <input type="submit" class="btn btn-primary" name="submitcap" value="Add">
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
        <div class="card-header">
          <h2>Simple Styye Base Style</h2>
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
           
         
            
            <table class="table table-striped table-bordered base-style">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
                <tr>
                  <td>Garrett Winters</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>63</td>
                  <td>2011/07/25</td>
                  <td>$170,750</td>
                </tr>
                <tr>
                  <td>Ashton Cox</td>
                  <td>Junior Technical Author</td>
                  <td>San Francisco</td>
                  <td>66</td>
                  <td>2009/01/12</td>
                  <td>$86,000</td>
                </tr>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
                <tr>
                  <td>Garrett Winters</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>63</td>
                  <td>2011/07/25</td>
                  <td>$170,750</td>
                </tr>
                <tr>
                  <td>Ashton Cox</td>
                  <td>Junior Technical Author</td>
                  <td>San Francisco</td>
                  <td>66</td>
                  <td>2009/01/12</td>
                  <td>$86,000</td>
                </tr>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
                <tr>
                  <td>Garrett Winters</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>63</td>
                  <td>2011/07/25</td>
                  <td>$170,750</td>
                </tr>
                <tr>
                  <td>Ashton Cox</td>
                  <td>Junior Technical Author</td>
                  <td>San Francisco</td>
                  <td>66</td>
                  <td>2009/01/12</td>
                  <td>$86,000</td>
                </tr>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
                <tr>
                  <td>Garrett Winters</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>63</td>
                  <td>2011/07/25</td>
                  <td>$170,750</td>
                </tr>
                <tr>
                  <td>Ashton Cox</td>
                  <td>Junior Technical Author</td>
                  <td>San Francisco</td>
                  <td>66</td>
                  <td>2009/01/12</td>
                  <td>$86,000</td>
                </tr>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
                <tr>
                  <td>Garrett Winters</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>63</td>
                  <td>2011/07/25</td>
                  <td>$170,750</td>
                </tr>
                <tr>
                  <td>Ashton Cox</td>
                  <td>Junior Technical Author</td>
                  <td>San Francisco</td>
                  <td>66</td>
                  <td>2009/01/12</td>
                  <td>$86,000</td>
                </tr>
              </tbody>
            </table>


          </div>
        </div>
      </div>
    </div>



      


    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h2>Vendors Account Payables</h2>
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
           
         
            
            <table class="table table-striped table-bordered file-export">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
                <tr>
                  <td>Garrett Winters</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>63</td>
                  <td>2011/07/25</td>
                  <td>$170,750</td>
                </tr>
                <tr>
                  <td>Ashton Cox</td>
                  <td>Junior Technical Author</td>
                  <td>San Francisco</td>
                  <td>66</td>
                  <td>2009/01/12</td>
                  <td>$86,000</td>
                </tr>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
                <tr>
                  <td>Garrett Winters</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>63</td>
                  <td>2011/07/25</td>
                  <td>$170,750</td>
                </tr>
                <tr>
                  <td>Ashton Cox</td>
                  <td>Junior Technical Author</td>
                  <td>San Francisco</td>
                  <td>66</td>
                  <td>2009/01/12</td>
                  <td>$86,000</td>
                </tr>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
                <tr>
                  <td>Garrett Winters</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>63</td>
                  <td>2011/07/25</td>
                  <td>$170,750</td>
                </tr>
                <tr>
                  <td>Ashton Cox</td>
                  <td>Junior Technical Author</td>
                  <td>San Francisco</td>
                  <td>66</td>
                  <td>2009/01/12</td>
                  <td>$86,000</td>
                </tr>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
                <tr>
                  <td>Garrett Winters</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>63</td>
                  <td>2011/07/25</td>
                  <td>$170,750</td>
                </tr>
                <tr>
                  <td>Ashton Cox</td>
                  <td>Junior Technical Author</td>
                  <td>San Francisco</td>
                  <td>66</td>
                  <td>2009/01/12</td>
                  <td>$86,000</td>
                </tr>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
                <tr>
                  <td>Garrett Winters</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>63</td>
                  <td>2011/07/25</td>
                  <td>$170,750</td>
                </tr>
                <tr>
                  <td>Ashton Cox</td>
                  <td>Junior Technical Author</td>
                  <td>San Francisco</td>
                  <td>66</td>
                  <td>2009/01/12</td>
                  <td>$86,000</td>
                </tr>
              </tbody>
            </table>


          </div>
        </div>
      </div>
    </div>




    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h2>Vendors Account Payables</h2>
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
           
         
            
            <table class="table table-striped table-bordered dataex-select-multi ">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
                <tr>
                  <td>Garrett Winters</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>63</td>
                  <td>2011/07/25</td>
                  <td>$170,750</td>
                </tr>
                <tr>
                  <td>Ashton Cox</td>
                  <td>Junior Technical Author</td>
                  <td>San Francisco</td>
                  <td>66</td>
                  <td>2009/01/12</td>
                  <td>$86,000</td>
                </tr>
              </tbody>
            </table>


          </div>
        </div>
      </div>
    </div>





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

            <?php
            $tb=0;
             $rows =mysqli_query($con,"SELECT * FROM vendors where balance>0  ORDER BY name" ) or die(mysqli_error($con));
                      
              while($row=mysqli_fetch_array($rows)){
                
                $id = $row['id'];
                $name = $row['name'];
                $mobile = $row['mobile'];
                $company = $row['company'];
                $phone = $row['phone'];
                $address = $row['address'];
                $balance = $row['balance'];

              
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
</html>