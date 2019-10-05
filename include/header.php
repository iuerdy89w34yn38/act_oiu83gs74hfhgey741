<!-- fixed-top-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item mr-auto">
            <a class="navbar-brand" href="index.php">
              <img class="brand-logo" alt="logo" src="images/logo.png">
            </a>
          </li>
          <li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon font-medium-3 white ft-toggle-right" data-ticon="ft-toggle-right"></i></a></li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"></a></li>
         

          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">
                  <span class="user-name text-bold-700" style="text-transform: uppercase;"><?php echo $username ?></span>
                </span>
                <span class="avatar avatar-online">

                  <img src="images/pro.png" alt="avatar"><i></i></span>
                  <?php  $rows =mysqli_query($con,"SELECT * FROM msgs where resolve = 0" ) or die(mysqli_error($con)); 
                      $notescount=mysqli_num_rows($rows); ?>

                  <?php if($notescount>0) { ?> <span class="topbadge"><?php echo $notescount ?></span> <?php } ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="ft-user"></i> Edit Profile</a>
                <a class="dropdown-item" href="notes.php"><i class="ft-list"></i> Notes
                  <?php if($notescount>0) { ?> <span class="mybadge"><?php echo $notescount ?></span> <?php } ?>

                 </a>
                
                <a class="dropdown-item" href="reset.php"><i class="ft-check-square"></i> Reset</a>
                <a class="dropdown-item" href="settings.php"><i class="ft-settings"></i> Settings</a>
                <div class="dropdown-divider"></div><a class="dropdown-item" href="logout.php"><i class="ft-power"></i> Logout</a>
              </div>
            </li>
            
          </ul>
        </div>
      </div>
    </div>
  </nav>