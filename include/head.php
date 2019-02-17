

<?php 
session_start();
if(!isset($_SESSION['name'])){
	header("location:index.php");
}
// Store Session Data
 $username= $_SESSION['name'];  // Initializing Session with value of PHP Variable
 
 
 ?>

 <?php include"include/connect.php";?>


 <?php

 date_default_timezone_set("Asia/Karachi");
 setlocale(LC_MONETARY,"ur-PK");


 $rows =mysqli_query($con,"SELECT * FROM company" ) or die(mysqli_error($con));
           
 	while($row=mysqli_fetch_array($rows)){
 		
 		$comp_name = $row['comp_name'];
 		$comp_owner = $row['comp_owner'];
 		$comp_phone = $row['comp_phone'];
 		$comp_email = $row['comp_email'];
 		$comp_address = $row['comp_address'];
 		$comp_logo = $row['comp_logo'];
 		$themeid = $row['theme'];


 		
     }



 $rows =mysqli_query($con,"SELECT * FROM color where id=$themeid" ) or die(mysqli_error($con));
           
 	while($row=mysqli_fetch_array($rows)){
 		
 		$color1 = $row['color1'];
 		$color2 = $row['color2'];
 		$color3 = $row['color3'];


 		
     }

 ?>



<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">


<link rel="shortcut icon" type="image/x-icon" href="images/ico/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
<link href="css/la/css/line-awesome.min.css"
<link href="css/la/css/line-awesome-font-awesome.min.css"
rel="stylesheet">
<!-- BEGIN VENDOR CSS-->
<link rel="stylesheet" type="text/css" href="css/vendors.css">
<link rel="stylesheet" type="text/css" href="vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="vendors/css/forms/selects/select2.min.css">
<link rel="stylesheet" type="text/css" href="vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="vendors/css/forms/icheck/custom.css">

<link rel="stylesheet" type="text/css" href="css/plugins/forms/checkboxes-radios.css">

<link rel="stylesheet" type="text/css" href="css/plugins/animate/animate.css">

<!-- END VENDOR CSS-->
<!-- BEGIN MODERN CSS-->
<link rel="stylesheet" type="text/css" href="css/app.css">
<!-- END MODERN CSS-->
<!-- BEGIN Page Level CSS-->
<link rel="stylesheet" type="text/css" href="css/core/menu/menu-types/vertical-menu-modern.css">
<link rel="stylesheet" type="text/css" href="css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="vendors/css/charts/jquery-jvectormap-2.0.3.css">
<link rel="stylesheet" type="text/css" href="vendors/css/charts/morris.css">
<link rel="stylesheet" type="text/css" href="css/core/colors/palette-gradient.css">



<!-- END Page Level CSS-->





<style type="text/css">
.navigation > li {
	    background: <?php echo $color1  ?>;
	    color: white;
	}
.navigation > li.open {
	    background:  <?php echo $color2  ?>;
	}
.main-menu.menu-dark {
	    background:  <?php echo $color1  ?>;

	}
	.main-menu.menu-dark .navigation > li > a {
	    padding: 5px 18px 5px 20px;
	}
	.main-menu.menu-dark .navigation .navigation-header {
	    color: #ffffff;
	    padding: 8px 20px 8px 20px;
	}
	.main-menu.menu-dark .navigation > li .active > a{
		background:  <?php echo $color2  ?>;
		
	}
	.main-menu.menu-dark .navigation > li.open > a {
	    color: #bfbfbf;

	    border-right: 4px solid   <?php echo $color2  ?>;
	}
	.main-menu.menu-dark .navigation > li ul .active > a{
		color: white;
	}
	.main-menu.menu-dark .navigation > li.open > a{
		background:  <?php echo $color1  ?>;
	}
	.main-menu.menu-dark .navigation li a {
	    background:  <?php echo $color1  ?>		;
	}
	.main-menu.menu-dark .navigation > li.active > a {
	    background:  <?php echo $color2  ?>;
	}
	.main-menu.menu-dark .navigation li a {
	    color: #fff;

	}
	.navbar-semi-dark .navbar-header {
	    background:  <?php if($themeid==4) echo '#000'; else  echo $color3 ;  ?>;
	}
	.header-navbar .navbar-header .navbar-brand .brand-logo {
	    width: 100px;
	}

	.card-header .heading-elements {
	    background-color: inherit;
	    position: absolute;
	    top: 6px;
	    right: 20px;
	}

	.btn-primary {
	    border-color:   <?php echo $color2  ?> !important;
	    background-color:   <?php echo $color1  ?> !important;
	    color: #FFFFFF;
	}
	.btn-primary:hover{
	    border-color:   <?php echo $color2  ?> !important;
	    background-color:   <?php echo $color2  ?> !important;
	    color: #FFFFFF;
	}


	
	.select2-container {

	    min-width: 100% !important; 
	}



	.select2-container--default .select2-results__options .select2-results__option[aria-selected=true] {
	    background-color:  <?php echo $color2  ?>  !important;
	    color: #FFFFFF !important;
	}

	.table-striped tbody tr.odd.selected, .table-striped tbody tr.even.selected {
	    background-color: <?php echo $color2  ?>;
	    color: #fff;
	}

	.page-item.active .page-link {
	    background-color:  <?php echo $color1  ?>;
	    border-color:  <?php echo $color2  ?>;
	}
	.table td {
	    padding: 0.5rem 1rem;
	    text-align: center;
	}

	select.form-control:not([size]):not([multiple]) {
	    height: 35px;
	}

	html body a {
	    color:   <?php echo $color2  ?>;
	}
	html body a:hover{
	    color:   <?php echo $color1  ?>;
	    text-decoration: underline;
	}


	}
	body.vertical-layout.vertical-menu-modern.menu-expanded .main-menu {
	    min-width: 230px;
	}
	body.vertical-layout.vertical-menu-modern.menu-expanded .navbar .navbar-header {
	    float: left;
	    min-width: 230px;
	}





	body .content .content-wrapper{
	    background:  <?php echo $color3  ?>;
	}
	html body {
	    background:  <?php echo $color3  ?>;
	}
	html body .content.app-content {
	    background:  <?php echo $color3  ?>;
	}


	
</style>