

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

 		
     }

 ?>



<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
<meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
<meta name="author" content="PIXINVENT">

<link rel="apple-touch-icon" href="images/ico/apple-icon-120.png">
<link rel="shortcut icon" type="image/x-icon" href="images/ico/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
<link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
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
	    background: #0D83DD;
	    color: white;
	}
.navigation > li.open {
	    background: #146fb4;
	}
.main-menu.menu-dark {
	    background: #0D83DD;

	}
	.main-menu.menu-dark .navigation > li > a {
	    padding: 5px 18px 5px 20px;
	}
	.main-menu.menu-dark .navigation .navigation-header {
	    color: #ffffff;
	    padding: 8px 20px 8px 20px;
	}
	.main-menu.menu-dark .navigation > li .active > a{
		background: #146fb4;
		
	}
	.main-menu.menu-dark .navigation > li ul .active > a{
		color: white;
	}
	.main-menu.menu-dark .navigation > li.open > a{
		background: #0D83DD;
	}
	.main-menu.menu-dark .navigation li a {
	    background: #0D83DD		;
	}
	.main-menu.menu-dark .navigation > li.active > a {
	    background: #146fb4;
	}
	.main-menu.menu-dark .navigation li a {
	    color: #fff;

	}
	.navbar-semi-dark .navbar-header {
	    background: #0665ae;
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
	    border-color: #146fb4 !important;
	    background-color: #0d83dd !important;
	    color: #FFFFFF;
	}



	body.vertical-layout.vertical-menu-modern.menu-expanded .content, body.vertical-layout.vertical-menu-modern.menu-expanded .footer {
	    margin-left: 230px;
	}
	body.vertical-layout.vertical-menu-modern.menu-expanded .main-menu {
	    width: 230px;
	}
	body.vertical-layout.vertical-menu-modern.menu-expanded .navbar .navbar-header {
	    float: left;
	    width: 230px;
	}





	body .content .content-wrapper{
	    background: #0b5da0;
	}
	html body .content.app-content {
	    background: #0b5da0;
	}


	
</style>