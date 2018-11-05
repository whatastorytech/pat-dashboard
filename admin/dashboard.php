<?php
/*********************************************************************
*	File	:	Dashboard.php
*	Created	:	By  What a Story
*	Prupose	:	To Display Statistics  information  about Project
**********************************************************************/
// include required files

include('../includes/config.php');
include('../includes/connect.php');
include('../includes/functions.php');


if(!isset($_SESSION['login']))
{ 
header('location:index.php');
}


include('../includes/admin_header.php');
include('../includes/admin_sidebar.php');
?>
        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid pt-25">
				<!-- Row -->
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0 bg-gradient">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<a href="users.php"><div class="sm-data-box">
										<div class="container-fluid">
											<div class="row">
										        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="txt-light block counter"><span class="counter-anim">123</span></span>
													<span class="weight-500 uppercase-font block font-13 txt-light">users</span>
												</div></a>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
													<i class="icon-people  data-right-rep-icon txt-light"></i>
												</div>
											</div>	
										</div>
									</div>
								</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0 bg-gradient1">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box">
										<div class="container-fluid">
											<a href="trees.php"><div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="txt-light block counter"><span class="counter-anim">2100</span></span>
													<span class="weight-500 uppercase-font block txt-light">Trees Planted</span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
													<i class="icon-envelope-letter data-right-rep-icon txt-light"></i>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0 bg-gradient2">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box">
										<div class="container-fluid">
											<a href="locations.php"><div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 txt-light data-wrap-left">
													<span class="block counter"><span class="counter-anim">10</span></span>
													<span class="weight-500 uppercase-font block">locations</span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 txt-light data-wrap-right">
													<i class=" icon-book-open data-right-rep-icon"></i>
												</div>
											</div></a>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0 bg-gradient3">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box">
										<div class="container-fluid">
											<a href="gardners.php"><div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="txt-light block counter"><span class="counter-anim">46</span>%</span>
													<span class="weight-500 uppercase-font block txt-light">gardners</span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">
													<div id="sparkline_4" class="sp-small-chart" ></div>
												</div>
											</div>	</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->
				<!-- Row -->
				<div class="row">
	             <div class="col-md-6">
					
					<div class="col-lg-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Name of Trees & No. of Trees Planted Chart</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div id="morris_bar_chart" class="morris-chart"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Total Amount Generated  chart</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div id="morris_donut_chart" class="morris-chart donut-chart"></div>
								</div>
							</div>
					</div>
					</div>
					<div class="col-lg-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">line Chart</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<canvas id="chart_1" height="100"></canvas>	
								</div>
							</div>
						</div>
					</div>

					
				</div>	

				<div class="row">
					<div class="col-lg-6">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Tree Updated for This months</h6>
								</div>
								<div class="pull-right">
									<a href="#" class="pull-left inline-block full-screen mr-15">
										<i class="zmdi zmdi-fullscreen"></i>
									</a>
									<div class="pull-left inline-block dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
										<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>Update</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>Edit</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>Remove</a></li>
										</ul>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="table-wrap">
										<div class="table-responsive">
										  <table class="table table-hover mb-0">
											<thead>
											  <tr>
												<th>Plantation</th>
												<th>Update date</th>
												<th>Gardner</th>
												<th>Action</th>
												</tr>
											</thead>
											<tbody>
											  <tr>
												<td>CMVM Digitisation of paper records</td>
												<td>1st june 2018</td>
												<td>Arun Shauri</td>
												<td><a href="javascript:void(0)" class="pull-left btn btn-primary btn-xs mr-15">verify</a></td>										
											  </tr>
											  <tr>
												<td>CMVM Digitisation of paper records</td>
												<td>1st june 2018</td>
												<td>Arun Shauri</td>
												<td><a href="javascript:void(0)" class="pull-left btn btn-primary btn-xs mr-15">verify</a></td>										
											  </tr>
											  <tr>
												<td>CMVM Digitisation of paper records</td>
												<td>1st june 2018</td>
												<td>Arun Shauri</td>
												<td><a href="javascript:void(0)" class="pull-left btn btn-primary btn-xs mr-15">verify</a></td>										
											  </tr>
											  <tr>
												<td>CMVM Digitisation of paper records</td>
												<td>1st june 2018</td>
												<td>Arun Shauri</td>
												<td><a href="javascript:void(0)" class="pull-left btn btn-primary btn-xs mr-15">verify</a></td>									
											  </tr>
											</tbody>
										  </table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Due Amount this month</h6>
								</div>
								<div class="pull-right">
									<a href="#" class="pull-left inline-block full-screen mr-15">
										<i class="zmdi zmdi-fullscreen"></i>
									</a>
									<div class="pull-left inline-block dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
										<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>Update</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>Edit</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>Remove</a></li>
										</ul>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="table-wrap">
										<div class="table-responsive">
										  <table class="table table-hover mb-0">
											<thead>
											  <tr>
											
														<th>Name</th>
														<th>Email</th>
														<th>Phone</th>
														<th>Registered on </th>
												</tr>
											</thead>
											<tbody>
											  <tr>
												<td>Demo Dsouja</td>
												<td>demo@gmail.com</td>
												<td>0321654789</td>	
												<td>1st june 2018</td>										
											  </tr>
											   <tr>
												<td>Demo Dsouja</td>
												<td>demo@gmail.com</td>
												<td>0321654789</td>	
												<td>1st june 2018</td>										
											  </tr>
											   <tr>
												<td>Demo Dsouja</td>
												<td>demo@gmail.com</td>
												<td>0321654789</td>	
												<td>1st june 2018</td>										
											  </tr>
											  <tr>
												<td>Demo Dsouja</td>
												<td>demo@gmail.com</td>
												<td>0321654789</td>	
												<td>1st june 2018</td>										
											  </tr>
											</tbody>
										  </table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
					
                      
				</div>
				
					<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<!-- 	<div class="panel panel-default card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Total Employees</h6>
								</div>
								<div class="pull-right">
									<a href="#" class="pull-left inline-block refresh mr-15">
										<i class="zmdi zmdi-replay"></i>
									</a>
									<div class="pull-left inline-block dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
										<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>Edit</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>Delete</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>New</a></li>
										</ul>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							
							<!-- <div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div id="e_chart_1" class="" style="height:242px;"></div>
									<div class="label-chatrs mt-15">
										<div class="mb-5">
											<span class="clabels inline-block bg-blue mr-5"></span>
											<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Actions pending</span>
										</div>
										<div class="mb-5">
											<span class="clabels inline-block bg-pink mr-5"></span>
											<span class="clabels-text font-12 inline-block txt-dark capitalize-font">decision pending</span>
										</div>
										<div class="">
											<span class="clabels inline-block bg-light-blue mr-5"></span>
											<span class="clabels-text font-12 inline-block txt-dark capitalize-font">chage request pending</span>
										</div>										
									</div>
								</div>
							</div> -->
						</div> 
					</div>
					
					<!-- <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Open Positions</h6>
								</div>
								<div class="pull-right">
									<a href="#" class="pull-left inline-block refresh">
										<i class="zmdi zmdi-replay"></i>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div id="e_chart_4" class="" style="height:330px;"></div>	
								</div>	
							</div>
						</div>
					</div> -->
					
				</div>
				<!-- /Row -->
				
				<!-- Row -->
				<div class="row">
					<!-- <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Key Metrics</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div  class="panel-body">
									<span class="font-12 head-font txt-dark">Employee Turnover<span class="pull-right">85%</span></span>
									<div class="progress mt-10 mb-30">
										<div class="progress-bar progress-bar-info" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%" role="progressbar"> <span class="sr-only">85% Complete (success)</span> </div>
									</div>
									<span class="font-12 head-font txt-dark">Speed to Hire (Days)<span class="pull-right">80%</span></span>
									<div class="progress mt-10 mb-30">
										<div class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 80%" role="progressbar"> <span class="sr-only">85% Complete (success)</span> </div>
									</div>
									<span class="font-12 head-font txt-dark">Promotion Rates<span class="pull-right">70%</span></span>
									<div class="progress mt-10 mb-30">
										<div class="progress-bar progress-bar-danger" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 70%" role="progressbar"> <span class="sr-only">85% Complete (success)</span> </div>
									</div>
									<span class="font-12 head-font txt-dark">Success Rate<span class="pull-right">45%</span></span>
									<div class="progress mt-10 mb-30">
										<div class="progress-bar progress-bar-inverse" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%" role="progressbar"> <span class="sr-only">85% Complete (success)</span> </div>
									</div>
									<span class="font-12 head-font txt-dark">Performance<span class="pull-right">80%</span></span>
									<div class="progress mt-10 mb-30">
										<div class="progress-bar progress-bar-success" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%" role="progressbar"> <span class="sr-only">80% Complete (success)</span> </div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Employee Churn </h6>
								</div>
								<div class="pull-right">
									<a href="#" class="pull-left inline-block refresh">
										<i class="zmdi zmdi-replay"></i>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div id="e_chart_2" class="" style="height:330px;"></div>
								</div>
							</div>
						</div>
					</div> -->
				<!-- 	<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Yellow Card Issued</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table display product-overview border-none" id="employee_table">
												<thead>
													<tr>
														<th>Employee ID</th>
														<th>Name</th>
														<th>Reason</th>
														<th>Date</th>
														<th>Status</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>#85457896</td>
														<td>Anthony Davie</td>
														<td>Cinnabar</td>
														<td>Oct 25</td>
														<td>
															<span class="label label-success ">done</span>
														</td>
														<td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
													</tr>
													<tr>
														<td>#85457895</td>
														<td>David Perry</td>
														<td>Felix PSD</td>
														<td>Oct 25</td>
														<td>
															<span class="label label-danger">pending</span>
														</td>
														<td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
													</tr>
													<tr>
														<td>#85457896</td>
														<td>Anthony Davie</td>
														<td>Cinnabar</td>
														<td>Oct 25</td>
														<td>
															<span class="label label-success ">done</span>
														</td>
														<td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
													</tr>
													<tr>
														<td>#85457894</td>
														<td>Davie</td>
														<td>iphone</td>
														<td>Oct 25</td>
														<td>
															<span class="label label-success ">done</span>
														</td>
														<td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
													</tr>
													<tr>
														<td>#85457896</td>
														<td>Anthony</td>
														<td>Cinnabar</td>
														<td>Nov 25</td>
														<td>
															<span class="label label-success ">done</span>
														</td>
														<td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
													</tr>
													<tr>
														<td>#85457898</td>
														<td>Anthony Davie</td>
														<td>Doodle</td>
														<td>Dec 25</td>
														<td>
															<span class="label label-success ">done</span>
														</td>
														<td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>	
								</div>	
							</div>
						</div>
					</div> -->
				</div>
				<!-- /Row -->

			</div>
			
				<?php
include('../includes/admin_footer.php');?>			