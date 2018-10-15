 <?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/admin_header.php');
include('includes/admin_sidebar.php');
if(!isset($_SESSION['login']))
{  
header('location:index.php');
}
$user_id = $_SESSION['user_id'];
$garden_id = $_GET['garden_id'];
$sql ="SELECT * FROM garden  
        LEFT JOIN   gardner ON garden.garden_id = gardner.garden_id  LEFT JOIN location ON  garden.location_id = location.location_id  WHERE garden.garden_id = :garden_id ORDER BY garden.garden_id desc";
$query=$dbh->prepare($sql);
$query->bindParam(':garden_id',$garden_id,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);


$sql ="SELECT plant_id,tree_code,tree_status,planted_trees.added_at,tree_category_name,user_fname,user_lname,plant_tree_status,number_of_trees,location.location_id,location_name FROM planted_trees  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id LEFT JOIN garden ON  planted_trees.garden_id = garden.garden_id LEFT JOIN location ON  garden.location_id = location.location_id  LEFT JOIN users ON  planted_trees.user_id = users.user_id  WHERE planted_trees.garden_id = :garden_id ORDER BY plant_id desc";
$query=$dbh->prepare($sql);
$query->bindParam(':garden_id',$garden_id,PDO::PARAM_STR);
$query->execute();
$plant_tree=$query->fetchAll(PDO::FETCH_OBJ);
?>

            <div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">Garden</h5>
						</div>
					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<li><a href="index.html">Dashboard</a></li>
								<li><a href="#"><span>Garden</span></a></li>
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
									{?>   
					<!-- Row -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									 <div class="pull-left">
										<h6 class="panel-title txt-dark"><?php echo $result->garden_name;?></h6>
									</div> 
									<a href="add_tree_in_garden.php?garden_name=<?php echo $result->garden_name;?>&garden_id=<?php echo $result->garden_id;?>" class="pull-right btn btn-primary btn-xs mr-15">Add New</a>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-wrap">
													<form class="form-horizontal" role="form">
														<div class="form-body">
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Garden's Info</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Garden Name:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"><?php echo $result->garden_name;?></p>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Garden Address:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"><?php echo $result->garden_address;?></p>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Location:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"> <?php echo $result->location_name;?> </p>
																		</div>
																	</div>
																</div>
																<!--/span--
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Gardner Name:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"> <?php echo $result->gardner_fname;?>&nbsp;<?php echo $result->gardner_lname;?></p>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Number:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"> <?php echo $result->gardner_pnumber;?></p>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">ID TYPE:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">Adhar</p>
																		</div>
																	</div>
																</div>
																<!--/span-->
																
																<!--/span-->
															</div>
															<div class="seprator-block"></div>

															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account-box mr-10"></i>MY Stat</h6>
															<hr class="light-grey-hr"/>																									
															<div class="row">
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Total Trees:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"><?php echo Count($plant_tree);?></p>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Planted Trees:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">70</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Adopted Trees:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">50 </p>
																		</div>
																	</div>
																</div>
																<!--/span--
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Gifted Trees:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">30 </p>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Mango:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">10</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Bamboo:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">50</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Apple:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">30</p>
																		</div>
																	</div>
																</div>
															</div>
										                </div>
									                </div>
								                </div>
							                </div>

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
														<th>Tree Code</th>
														<th>Tree Category</th>
														<th>Plantation</th>
														<th>Age</th>
														<th>User</th>
														<th>Status</th>
														<th>Updates</th>
														<th>Action</th>
													</tr>
												</thead>												
												<tbody>
													<?php 	
													$cnt=1;
													if($query->rowCount() > 0)
													{
													foreach($plant_tree as $result)
													{               ?>   
													<tr>
														 <td class="center"><?php echo htmlentities($cnt);?></td>
														<td class="center"><?php echo htmlentities($result->tree_code);?></td>
														<td class="center"><?php echo htmlentities($result->tree_category_name);?></td>
														<td class="center"><?php echo htmlentities($result->location_name);?></td>
														<?php 
                                                        $from = new DateTime($result->planted_added_at);
														$to   = new DateTime('today');

														?>
														<td class="center"><?php echo $from->diff($to)->d;?> days</td>
														<td class="center"><?php echo htmlentities($result->user_fname);?>&nbsp;<?php echo htmlentities($result->user_lname);?></td>
														<td class="center"><?php echo htmlentities($result->tree_status);?></td>
														<td>---</td>
													   <!--  <td class="center"><?php if($result->location_status==1) {?>
			                                            <a href="#" class="btn btn-success btn-xs"><span class="label label-success">Active</a>
			                                            <?php } else {?>
			                                            <a href="#" class="btn btn-danger btn-xs"><span class="label label-danger">Inactive</a>
			                                            <?php } ?></td> -->
														<td class="text-nowrap"><a href="#" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> <a href="#" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td>
													</tr>
													 <?php $cnt=$cnt+1;}} ?> 												
												</tbody>
											
												<tfoot>
													<tr>
														<th>#</th>
														<th>Tree Code</th>
														<th>Tree Category</th>
														<th>Plantation</th>
														<th>Age</th>
														<th>User</th>
														<th>Status</th>
														<th>Updates</th>
														<th>Action</th>
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