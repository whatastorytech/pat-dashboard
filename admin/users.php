<?php
include('includes/config.php');
include('includes/admin_header.php');
include('includes/admin_sidebar.php');?>
        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid">				
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">Users</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="index.html">Dashboard</a></li>
						<li><a href="#"><span>users</span></a></li>
						<!-- <li class="active"><span>RSPV DataTable</span></li> -->
					  </ol>
					</div>
					<!-- /Breadcrumb -->



				</div>
				<!-- /Title -->
				
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						    <div class="col-lg-12 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div  class="panel-body pb-0">
									<div  class="tab-struct custom-tab-1">
										<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
											<li class="active" role="presentation"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>Paid users</span></a></li>
											<li  role="presentation" class="next"><a aria-expanded="true"  data-toggle="tab" role="tab" id="follo_tab_8" href="#follo_8"><span>Free users<span class="inline-block">(246)</span></span></a></li>										
										</ul>
										<div class="tab-content" id="myTabContent_8">
											<div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
												<div class="col-md-12">
													<div class="pt-20">
													 <table id="example" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th></th>
														<th>Name</th>
														<th>Email</th>
														<th>Phone</th>
														<th>Planted Trees</th>
														<th>Payment Status</th>
													</tr>
												</thead>												
												<tbody>
													<tr>
														<td><input type="checkbox"></td>
														<td>Tiger Nixon</td>
														<td>Im@gmail.com</td>
														<td>1234567890</td>
														<td>15</td>
														<td>Till 18  March</td>
														
													</tr>
													<tr>
														<td><input type="checkbox"></td>
														<td>Lion Nixon</td>
														<td>demo@gmail.com</td>
														<td>1234567890</td>
														<td>20</td>
														<td>Till 30  March</td>
														
													</tr>													
												</tbody>
											
												<tfoot>
													<tr>
														<th></th>
														<th>Name</th>
														<th>Email</th>
														<th>Phone</th>
														<th>Planted Trees</th>
														<th>Payment Status</th>
													</tr>
												</tfoot>
											</table>
													</div>
												</div>
											</div>
											
											<div  id="follo_8" class="tab-pane fade" role="tabpanel">
												<div class="row">
													<div class="col-lg-12">
														 <table id="example" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th></th>
														<th>Name</th>
														<th>Email</th>
														<th>Phone</th>
														<th>Planted Trees</th>
														<th>Payment Status</th>
													</tr>
												</thead>												
												<tbody>
													<tr>
														<td><input type="checkbox"></td>
														<td>Tiger Nixon</td>
														<td>System Architect</td>
														<td>1234567890</td>
														<td>15</td>
														<td>Till 18  March</td>
														
													</tr>
													<tr>
														<td><input type="checkbox"></td>
														<td>Tiger Nixon</td>
														<td>System Architect</td>
														<td>1234567890</td>
														<td>20</td>
														<td>Till 30  March</td>
														
													</tr>													
												</tbody>
											
												<tfoot>
													<tr>
														<th></th>
														<th>Name</th>
														<th>Email</th>
														<th>Phone</th>
														<th>Planted Trees</th>
														<th>Payment Status</th>
													</tr>
												</tfoot>
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
				</div>
				<!-- /Row -->
			
			</div>	
	
<?php
include('includes/admin_footer.php');?>	