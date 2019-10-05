<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    
  <?php include"include/connect.php" ?>
  <?php include"include/head.php" ?>

  <title>Notes <?php echo $comp_name ?>  </title>
  <style type="text/css">
    hr{
      margin-top: 0px;
      margin-bottom: 10px;
    }
  </style>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  
<?php $link="msgs.php"; ;?>

<?php if (!empty($_POST['id']))  $id=$_POST['id'] ;?>


<?php
if(isset($_POST['submit'])){
    $msg="Unsuccessful" ;
    
     $msgs=$_POST['msgs'];
     $datec=date('Y-m-d');

     $resolve=0;

$data=mysqli_query($con,"INSERT INTO msgs (msg,datec,resolve)VALUES ('$msgs','$datec','$resolve')")or die( mysqli_error($con) );
  $msg="Successful" ;
    
}
?>


<?php
if(isset($_POST['id'])){
    $msg="Unsuccessful" ;
    
     $id=$_POST['id'];


    $sql = "UPDATE msgs SET `resolve` = '1' WHERE `id` =$id";
    
    mysqli_query($con, $sql);

	$msg="Successful" ;
    
}
?>

<?php
if(isset($_POST['del'])){
    

    $delid=$_POST['del'];



    $data=mysqli_query($con,"DELETE FROM `msgs` WHERE id=$delid")or die(mysqli_error($con) );
    
    if ($data == 1) {
        $msg="Deleted Successfully!";
    } 
    
    else {
        $msg="Unsuccessful!";
    }


    }
?>


<style type="text/css">
  td{
    padding: 10px;
  }
</style>

<?php include"include/header.php" ?>
<?php include"include/sidebar.php" ?>
<div class="app-content content">
  <div class="content-wrapper">


  	  	<div class="col-sm-12">
  	  	  <div class="card">
  
  	  	    <div class="card-header" style="padding-bottom: 0px;">
  	  	      <h4 class="card-title">View Existing Messages</h4>
  	  	    </div>
  	  	    <div class="card-block">

  	  	      <div id="chat" class="card-body" style="height: 400px; overflow: scroll;">
  	  	      	<form action="" method="POST">


                  <table  class="table-bordered" style="text-align: center;padding: 20px;">

                    <thead>
                      
                      <tr>
                      <td>Date:</td>
                      <td style="width: 60%">Messages</td>
                      <td>Status</td>
                    </tr>
                    </thead> 

                    <tbody>
                      <?php
                     
                    $rows1s =mysqli_query($con,"SELECT * FROM msgs  ORDER BY id" ) or die(mysqli_error($con));
                              
                      while($rows1=mysqli_fetch_array($rows1s)){
                        
                        $id = $rows1['id'];
                        $msgs = $rows1['msg']; 
                        $date = $rows1['datec']; 
                        $resolve = $rows1['resolve']; 
                        
                        ?>
                          <tr>
                            <td><?php echo $date ?></td>
                            <td><?php echo $msgs ?></td>
                            <td>
                              <?php if($resolve==0){ ?>

                              <button name="id" class="btn btn-success" value="<?php echo $id ?>">Done</button>
                              
                              <button name="del" class="btn btn-danger" value="<?php echo $id ?>">Del</button>
                               
                               <?php }else { ?>
                                Resolved... 
                               <button name="del" class="btn" style="background: none" value="<?php echo $id ?>">x</button>

                                <?php } ; ?>
                            </td>

                          </tr>

                          <?php } ?>

                    </tbody>
                  </table>
  	  	      	


  	  	      </form>

  	  	      </div>
  	  	    </div>

             <div class="card-content">
                       <div class="card-body" style="background: white;">
                         
                                    <form action="" method="post">
                                      <div class="row">

                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-2">
                                          <span>Type Message:</span>

                                        </div>
                                        <div class="col-sm-7">
                                            <textarea type="text" class="form-control" name="msgs"> </textarea>
                                        </div>
                                       
                                        <div class="col-sm-2">
                                          <span>&nbsp;</span>
                                            <input type="submit" class="btn btn-primary" name="submit" value="Add">
                                        </div>
                                        
                                      </div>
                                    </form>
                     

                  </div>

              <center><h2><?php if(!empty($msg))  echo $msg ;?></h2></center>
               
               </div>
  	  	  </div>
  	  	</div>


    
  </div>
</div>

<?php include'include/footer.php'; ?>


<script type="text/javascript">

      $('#ex1').DataTable( {
          "order": [[ 1, "asc" ]]
      } );
      $.fn.dataTableExt.sErrMode = 'throw';

</script>
<script type="text/javascript">

  $(document).ready(function() {
    $('#chat').animate({
        scrollTop: $('#chat').get(0).scrollHeight
    }, 2000);
});

</script>

</body>
</html>