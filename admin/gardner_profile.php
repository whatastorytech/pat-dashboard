 <?php
session_start();
error_reporting(E_ALL);
include('includes/config.php');
include('includes/admin_header.php');
include('includes/admin_sidebar.php');
if(!isset($_SESSION['login']))
{  
header('location:index.php');
}
$user_id = $_SESSION['user_id'];
$gardner_id = intval($_GET['gardner']);
$sql ="SELECT * FROM gardner  
        LEFT JOIN   garden ON gardner.garden_id = garden.garden_id  LEFT JOIN location ON  garden.location_id = location.location_id  WHERE gardner_id = :gardner_id ORDER BY gardner.gardner_id desc";
$query=$dbh->prepare($sql);
$query->bindParam(':gardner_id',$gardner_id,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
?>

?>?>

            <div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">Gardner</h5>
						</div>
					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<li><a href="index.html">Dashboard</a></li>
								<li><a href="#"><span>Gardner</span></a></li>
							</ol>
						</div>
						<!-- /Breadcrumb -->
					
					</div>
					<!-- /Title -->
					<?php 	
													$cnt=1;
													if($query->rowCount() > 0)
													{
													foreach($results as $result)
													{               ?>   
					<!-- Row -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Gardner</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-wrap">
													<form class="form-horizontal" role="form">
														<div class="form-body">
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Gardner's Info</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">First Name:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"><?php echo $result->gardner_fname;?>&nbsp;<?php echo $result->gardner_lname;?></p>
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Number:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"> <?php echo $result->gardner_pnumber;?></p>
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">ID TYPE:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">Adhar</p>
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Garden address:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"> <?php echo $result->garden_address;?> </p>
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Location:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"> <?php echo $result->location_name;?> </p>
																		</div>
																	</div>
																</div>
																<!--/span-->
																<!--/span-->
															</div>
															<!-- /Row -->
															
															<div class="seprator-block"></div>
															
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account-box mr-10"></i>Information</h6>
															<hr class="light-grey-hr"/>
														
															
															<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="">
											<table id="myTable1" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th>#</th>
														<th>ID</th>
														<th>Date</th>
														<th>Number of Pictures</th>

														<th>resends</th>
														<th>Status</th>



														<th>Updates</th>
													</tr>
												</thead>												
												<tbody>
													<!-- <?php 	
													$cnt=1;
													if($query->rowCount() > 0)
													{
													foreach($results as $result)
													{               ?>   
													<tr>
														 <td class="center"><?php echo htmlentities($cnt);?></td>
														<td class="center"><a href="gardner_profile.php?gardner=<?php echo $result->gardner_id;?>"><?php echo htmlentities($result->gardner_fname);?><?php echo htmlentities($result->gardner_lname);?></a></td>
															<td class="center"><?php echo htmlentities($result->garden_name);?></td>
															<td class="center"><?php echo htmlentities($result->gardner_pnumber);?></td>
													



														<td class="center"><?php if($result->gardner_status==1) {?>


			                                            <a href="#" class="btn btn-success btn-xs"><span class="label label-success">Active</a>
			                                            <?php } else {?>
			                                            <a href="#" class="btn btn-danger btn-xs"><span class="label label-danger">Inactive</a>
			                                            <?php } ?></td>
														<td class="text-nowrap"><a href="#" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> <a href="#" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td>
													</tr>
													 <?php $cnt=$cnt+1;}} ?>	 -->											
												</tbody>
											
												<tfoot>
													<tr>
														<th>#</th>
														<th>ID</th>
														<th>Date</th>
														<th>Number of Pictures</th>

														<th>resends</th>
														<th>Status</th>



														<th>Updates</th>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
							</div>
															
														</div>
														
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php }}?>
					</div>
					<!-- /Row -->	
					
				
				
<?php 
include('includes/admin_footer.php');?>