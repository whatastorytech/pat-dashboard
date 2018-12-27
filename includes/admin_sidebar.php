<?php 
$status = 're_resend';
$sql ="SELECT * FROM tree_updates  LEFT JOIN garden ON  tree_updates.garden_id = garden.garden_id LEFT JOIN location ON  garden.location_id = location.location_id  LEFT JOIN gardner ON  tree_updates.garden_id = gardner.garden_id  where tree_updates.update_status = : status ORDER BY tree_updates.plant_id desc";
$update_query=$dbh->prepare($sql);
$update_query->bindParam(':status',$status,PDO::PARAM_STR);
$update_query->execute();
$updates=$update_query->fetchAll(PDO::FETCH_OBJ);
?>
<body>
	<!-- <!-- Preloader -->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div> 
	<!-- /Preloader -->
    <div class="wrapper box-layout theme-6-active pimary-color-pink">
    		<!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="dashboard.php">
							<img class="brand-img" src="<?php echo BASE_URL;?>img/logo@3x.png" alt="brand"/>
							<span class="brand-text">PTA</span>
						</a>
					</div>
				</div>	
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
				<a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
				<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
				<form id="search_form" role="search" class="top-nav-search collapse pull-left">
					<div class="input-group">
						<input type="text" name="example-input1-group2" class="form-control" placeholder="Search">
						<span class="input-group-btn">
						<button type="button" class="btn  btn-default"  data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
						</span>
					</div>
				</form>
			</div>
			<div id="mobile_only_nav" class="mobile-only-nav pull-right">
				<ul class="nav navbar-right top-nav pull-right">
					<li>
						<a id="open_right_sidebar" href="#"><i class="zmdi zmdi-settings top-nav-icon"></i></a>
					</li>
					<li class="dropdown app-drp">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-apps top-nav-icon"></i></a>
						<ul class="dropdown-menu app-dropdown" data-dropdown-in="slideInRight" data-dropdown-out="flipOutX">
							<li>
								<div class="app-nicescroll-bar">
									<ul class="app-icon-wrap pa-10">
										
									</ul>
								</div>	
							</li>
							<li>
								<div class="app-box-bottom-wrap">
									<hr class="light-grey-hr ma-0"/>
									<a class="block text-center read-all" href="javascript:void(0)"> more </a>
								</div>
							</li>
						</ul>
					</li>
					<li class="dropdown full-width-drp">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-more-vert top-nav-icon"></i></a>
						<ul class="dropdown-menu mega-menu pa-0" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
							<li class="product-nicescroll-bar row">
								<ul class="pa-20">
									<li class="col-md-3 col-xs-6 col-menu-list">
										<a href="javascript:void(0);"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
										<hr class="light-grey-hr ma-0"/>
										<ul>
				
										</ul>
									</li>
									<li class="col-md-3 col-xs-6 col-menu-list">
										<a href="javascript:void(0);">
											<div class="pull-left">
												<i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">E-Commerce</span>
											</div>	
											<div class="pull-right"><span class="label label-success">7</span>
											</div>
											<div class="clearfix"></div>
										</a>
										<hr class="light-grey-hr ma-0"/>
										<ul>
											
										</ul>
									</li>
									
								</ul>
							</li>	
						</ul>
					</li>
					<li class="dropdown alert-drp">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-notifications top-nav-icon"></i><span class="top-nav-icon-badge">5</span></a>
						<ul  class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
							<li>
								<div class="notification-box-head-wrap">
									<span class="notification-box-head pull-left inline-block">notifications</span>
									<a class="txt-danger pull-right clear-notifications inline-block" href="javascript:void(0)"> clear all </a>
									<div class="clearfix"></div>
									<hr class="light-grey-hr ma-0"/>
								</div>
							</li>
							<li>
								<div class="streamline message-nicescroll-bar">
									<div class="sl-item">
										<a href="javascript:void(0)">
											<div class="icon bg-green">
												<i class="zmdi zmdi-flag"></i>
											</div>
											<div class="sl-content">
												<span class="inline-block capitalize-font  pull-left truncate head-notifications">
											</div>
										</a>	
									</div>
									<hr class="light-grey-hr ma-0"/>									
									</div>
								</div>
							</li>
							<li>
								<div class="notification-box-bottom-wrap">
									<hr class="light-grey-hr ma-0"/>
									<a class="block text-center read-all" href="javascript:void(0)"> read all </a>
									<div class="clearfix"></div>
								</div>
							</li>
						</ul>
					</li>
					<li class="dropdown auth-drp">
						<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?php echo BASE_URL;?>img/user1.png" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
						<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
							<li>
								<a href="profile.html"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
							</li>
							<li class="divider"></li>							
							<li class="divider"></li>							<li>
								<a href="#"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
							</li>
						</ul>
					</li>
				</ul>
			</div>	
		</nav>
		<!-- /Top Menu Items -->
		
		<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				
					<!-- User Profile -->
					<li>
						<div class="user-profile text-center">
							<!-- <img src="admin_assets/img/user1.png" alt="user_auth" class="user-auth-img img-circle"/> -->
							<div class="dropdown mt-5">
							<a href="#" class="dropdown-toggle pr-0 bg-transparent" data-toggle="dropdown">ryan georgian <span class="caret"></span></a>
							<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
								<li class="divider"></li>
								<li class="divider"></li>
								<li>
									<a href="logout.php"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
								</li>
							</ul>
							</div>
						</div>
					</li>
					<!-- /User Profile -->
				<li class="navigation-header">
					<span>Main</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<li>
					<a href="users.php"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">Users</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a href="trees.php"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">Trees</span></div><div class="clearfix"></div></a>
				</li>
				
				<li>
					<a href="gardners.php"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">Gardner's</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a href="gardens.php"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">Garden's</span></div><div class="clearfix"></div></a>
				</li>
				<!-- <li>
					<a href="plantations.php"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">Plantation's</span></div><div class="clearfix"></div></a>
				</li> -->
				<li>
					<a href="locations.php"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">Location's</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a href="trees_category.php"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">Trees Category's</span></div><div class="clearfix"></div></a>
				</li>
			</ul>
		</div>
		<!-- /Left Sidebar Menu -->
		
		<!-- Right Sidebar Menu -->
		<div class="fixed-sidebar-right">
			<ul class="right-sidebar">
				
			</ul>
		</div>
		<!-- /Right Sidebar Menu -->