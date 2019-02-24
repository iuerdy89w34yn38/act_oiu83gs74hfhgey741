<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <?php include"include/connect.php";
      
  session_start();

  if(isset($_SESSION['name'])){
  header("location:home.php");
  }
  ?> 

  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="css/vendors.css">
  <link rel="stylesheet" type="text/css" href="vendors/css/forms/selects/select2.min.css">

  <title>Login </title>
  
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
 

<div class="app-content content">
<div class="content-wrapper">
<br><br>

<section class="flexbox-container">
  <div class="col-12 d-flex align-items-center justify-content-center">
    <div class="col-md-4 col-10 box-shadow-2 p-0">
      <div class="card border-grey border-lighten-3 m-0">
        <div class="card-header border-0">
          <div class="card-title text-center">
            <div class="p-1">
              <img src="images/logo.png" alt="logo" style="max-width: 200px;">
            </div>
          </div>
          <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
            <span>Please Login to Proceed</span>
          </h6>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form class="form-horizontal form-simple" action="" method="post" novalidate>
              <fieldset class="form-group position-relative has-icon-left mb-0">
                <input type="text" name="un" class="form-control form-control-lg input-lg" id="un" placeholder="Enter "
                required>

              </fieldset>
              <br>

              <div class="form-group row">
                <div class="col-md-6 col-12 text-center text-md-left">
                  <fieldset>
                    <input type="checkbox" id="remember-me" class="chk-remember">
                    <label for="remember-me"> Remember Me</label>
                  </fieldset>
                </div>
                <br>
                
                <?php
                echo $user_ip=$_SERVER['REMOTE_ADDR'];
                $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
                echo $country = $geo["geoplugin_countryName"];
                echo $city = $geo["geoplugin_city"];
                ?>
                <br>
              <button type="submit" name="login" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
            </form>

     
             <?php
                            
                if (isset($_POST['login'])) {
                            if (empty($_POST['un']) ) {
                            echo "Username or Password is empty";
                            }
                            else
                            {
                            $username=$_POST['un'];
                            $username = stripslashes($username);
                            $query = mysqli_query($con,"SELECT * from users where username='$username'")or die(mysqli_error($con));
                            $rows = mysqli_num_rows($query);
                            if ($rows == 1) {

                              $rowxs =mysqli_query($con,"SELECT * from users where username='$username'" ) or die(mysqli_error($con));
                                        
                                while($rowx=mysqli_fetch_array($rowxs)){
                                  
                                  $userrole = $rowx['role'];
                                  }


                            $_SESSION['name']=$username; // Initializing Session
                            $_SESSION['role']=$userrole; // Initializing Session
                            header("location:home.php"); // Redirecting To Other Page
                            } else {
                            echo "Username or Password is invalid";
                            }
                            }
                            }
                
            ?>
                




          </div>
        </div>

      </div>
    </div>
  </div>
</section>

    
  </div>
</div>

<?php include"include/footer.php" ?>

</body>
</html>