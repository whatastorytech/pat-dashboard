 <?php
/*********************************************************************
*	File	:	Gardners Profile.php
*	Created	:	By  What a Story
*	Prupose	:	To Display  gardners Profile
**********************************************************************/
// include required files
include('../includes/config.php');
include('../includes/connect.php');
include('../includes/functions.php');

if(!isset($_SESSION['login']))
{ 
header('location:index.php');
}
$user_id = $_SESSION['admin_id'];
$gardner_id = intval($_GET['gardner']);
$sql ="SELECT * FROM gardner  
        LEFT JOIN   garden ON gardner.garden_id = garden.garden_id  LEFT JOIN location ON  garden.location_id = location.location_id  WHERE gardner_id = :gardner_id ORDER BY gardner.gardner_id desc";
$query=$dbh->prepare($sql);
$query->bindParam(':gardner_id',$gardner_id,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$sql ="SELECT plant_id,tree_code,tree_status,planted_trees.added_at,tree_category_name,user_fname,user_lname,plant_tree_status,number_of_trees,location.location_id,location_name,tree_planted_at,gardner_fname,gardner_lname,gardner_pnumber FROM planted_trees  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id LEFT JOIN garden ON  planted_trees.garden_id = garden.garden_id LEFT JOIN gardner ON  planted_trees.garden_id = gardner.garden_id LEFT JOIN location ON  garden.location_id = location.location_id  LEFT JOIN users ON  planted_trees.user_id = users.user_id  WHERE garden.garden_id = :garden_id ORDER BY plant_id desc";
$query2=$dbh->prepare($sql);
$query2->bindParam(':garden_id',$gardner_id,PDO::PARAM_STR);
$query2->execute();
$plant_tree=$query2->fetchAll(PDO::FETCH_OBJ);
include('../includes/admin_header.php');
include('../includes/admin_sidebar.php');
?>


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
														<th>Tree Code</th>
														<th>Tree Category</th>
														<th>Plantation</th>
														<th>Age</th>
														<th>User</th>
														<th>Status</th>
														<th>Updates</th>
													</tr>
												</thead>												
												<tbody>
													<?php 	
													$cnt=1;
													if($query2->rowCount() > 0)
													{
													foreach($plant_tree as $result)
													{               ?>   
													<tr>
														 <td class="center"><?php echo htmlentities($cnt);?></td>
														<td class="center"><?php echo htmlentities($result->tree_code);?></td>
														<td class="center"><?php echo htmlentities($result->tree_category_name);?></td>
														<td class="center"><?php echo htmlentities($result->location_name);?></td>
														<?php 
                                                        $from = new DateTime($result->added_at);
														$to   = new DateTime('today');

														?>
														<td class="center"><?php echo $from->diff($to)->d;?> days</td>
														<td class="center"><?php echo htmlentities($result->user_fname);?>&nbsp;<?php echo htmlentities($result->user_lname);?></td>
														<td class="center"><?php echo htmlentities($result->tree_status);?></td>
														<td>---</td>
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
include('../includes/admin_footer.php');?>