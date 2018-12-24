<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Plant a tree  - admin </title>
	<meta name="description" content="Grandin is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Grandin Admin, Grandinadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework"/>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	
	<!-- Data table CSS -->
	 <link href="<?php echo BASE_URL ;?>assets/as_assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/> 
	<link href="<?php echo BASE_URL ;?>assets/as_assets//vendors/bower_components/datatables.net-responsive/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/>
	<!-- Data table CSS -->
	
	<!-- Toast CSS -->
	<link href="<?php echo BASE_URL ;?>assets/as_assets/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
	<!-- bootstrap-select CSS -->
	<link href="<?php echo BASE_URL ;?>assets/as_assets/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>	
		
	<!-- switchery CSS -->
	<link href="<?php echo BASE_URL ;?>assets/as_assets/vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css"/>
	
	<!-- vector map CSS -->
	<link href="<?php echo BASE_URL ;?>assets/as_assets/vendors/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" type="text/css"/>
	<!-- Morris Charts CSS -->
    <link href="<?php echo BASE_URL ;?>assets/as_assets/vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo BASE_URL ;?>assets/css/slider.css" rel="stylesheet" type="text/css"/> 
	<!-- Custom CSS -->
	<link href="<?php echo BASE_URL ;?>assets/as_assets/dist/css/style.css" rel="stylesheet" type="text/css">
	 <script src="<?php echo BASE_URL ;?>assets/as_assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo BASE_URL ;?>assets/as_assets/dist/js/jquery.validate.min.js "></script>
    <script src="<?php echo BASE_URL ;?>assets/js/slider.js "></script>
	<style>
	.error
	{
		color:red;
		font:16px;
		margin-left: 10px;
	}
	.main-slider-container {
			  position: relative;
			  margin: 0 auto
			}

			.slider-container {
			  position: absolute;
			  overflow: hidden;
			  border: 1px solid #000;
			}

			ul {
			  position: relative;
			  margin: 0;
			  padding: 0;
			}

			li {
			  list-style-type: none;
			  position: relative;
			  float: left;
			}

			.disable-link { pointer-events: none; }

			.prev {
			  left: -60px;
			  background: url(images/prev.png);
			}

			.next {
			  right: -60px;
			  background: url(images/next.png);
			}

			.disable-link.prev { background: none; }

			.disable-link.next { background: none; }

			.crousel-navigation {
			  position: absolute;
			  top: 110px;
			  width: 50px;
			  height: 50px;
			}

			/*  Some other style to butify content */

			.slider-container h3,
			.slider-container p {
			  margin-left: 20px;
			  margin-right: 20px;
			}

			.slider-container p {
			  width: 200px;
			  display: inline-block;
			  vertical-align: top;
			}

			.slider-container .crousel-image-outer {
			  margin-right: 20px;
			  display: inline-block;
			  width: 200px;
			}
   </style>
</head>