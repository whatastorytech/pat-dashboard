 <?php
/*********************************************************************
*	File	:	Gardners.php
*	Created	:	By  What a Story
*	Prupose	:	To Display  Listing   and   basic information of Gardners
**********************************************************************/
// include required files

include('../includes/config.php');
include('../includes/connect.php');
include('../includes/functions.php');

$plant_id = $_GET['plant_id'];
$sql ="SELECT planted_trees.plant_id,planted_trees.tree_code,planted_trees.tree_status,planted_trees.added_at,tree_category.tree_category_name,users.user_fname,users.user_lname,planted_trees.plant_tree_status,planted_trees.number_of_trees,location.location_id,location.location_name,planted_trees.tree_planted_at,planted_trees.tree_name,users.user_fname,users.user_lname,garden.garden_name,garden.garden_address,gardner.gardner_fname,gardner.gardner_lname,gardner.gardner_pnumber FROM planted_trees  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id LEFT JOIN garden ON  planted_trees.garden_id = garden.garden_id LEFT JOIN gardner ON  garden.garden_id = gardner.garden_id LEFT JOIN location ON  garden.location_id = location.location_id  LEFT JOIN users ON  planted_trees.user_id = users.user_id  WHERE planted_trees.plant_id = :garden_id";
$query2=$dbh->prepare($sql);
$query2->bindParam(':garden_id',$plant_id,PDO::PARAM_STR);
$query2->execute();
$plant_tree=$query2->fetchAll(PDO::FETCH_OBJ);
include('../includes/admin_header.php');
/*include('../includes/admin_sidebar.php');*/
?>

            <div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">Tree</h5>
						</div>
					
					</div>
					<!-- /Title -->
					<?php 	
							$cnt=1;
								if($query2->rowCount() > 0)
									{
										foreach($plant_tree as $result)
									{?>   
					<!-- Row -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<!--  <div class="pull-left">
										<h6 class="panel-title txt-dark"><?php echo $result->tree_name;?></h6>
									</div>  -->
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-wrap">
													<form class="form-horizontal" role="form">
														<div class="form-body">
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Tree Info</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Tree Name:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"><?php echo $result->tree_name;?></p>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Tree code:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"><?php echo $result->tree_code;?></p>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Tree Owner:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"><?php echo $result->user_fname;?>&nbsp;<?php echo $result->user_lname;?></p>
																		</div>
																	</div>
																</div>
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
																		<label class="control-label col-md-3">Gardner Name:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"><?php echo $result->gardner_fname;?>&nbsp;<?php echo $result->gardner_lname;?></p>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Gardner Phone Number:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"><?php echo $result->gardner_pnumber;?></p>
																		</div>
																	</div>
																</div>
																<?php 
                                                        $from = new DateTime($result->tree_planted_at);
														$to   = new DateTime('today');

														?>
									
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Tree Age :</label>
																		<div class="col-md-9">
																			<p class="form-control-static"><?php echo $from->diff($to)->d;?> days</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="seprator-block"></div>
															<hr class="light-grey-hr"/>
															<div class="seprator-block"></div>													 												

																				
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