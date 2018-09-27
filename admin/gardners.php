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
					  <h5 class="txt-dark">Gardner's</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="index.html">Dashboard</a></li>
						<li><a href="#"><span>Gardner's</span></a></li>
						<!-- <li class="active"><span>RSPV DataTable</span></li> -->
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->
				
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Gardner's</h6>
								</div>
								<a href="javascript:void(0)" class="pull-right btn btn-primary btn-xs mr-15">Add New</a>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="">
											<table id="myTable1" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th>Gardner Name</th>
														<th>Plantation</th>
														<th>Phone number</th>
														 <th>Updates</th>
													</tr>
												</thead>												
												<tbody>
													<tr>
														<td>Tiger Nixon</td>
														<td>Full garden, Pune</td>
														<td>1234567890</td>
														<td>13 verification pending</td>
													</tr>
													<tr>
														<td>Lion Nixon</td>
														<td>Half garden,Mumbai</td>
														<td>1234567890</td>
														<td>10 verification pending</td>
													</tr>												
												</tbody>
											
												<tfoot>
													<tr>
														<th>Gardner Name</th>
														<th>Plantation</th>
														<th>Phone number</th>
														 <th>Updates</th>
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
				<!-- /Row -->
			
			</div>	
	
<?php
include('includes/admin_footer.php');?>	