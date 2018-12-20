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
if(!isset($_SESSION['login']))
{ 
header('location:index.php');
}

$garden_id = $_GET['garden_id'];
$sql ="SELECT garden.garden_id,garden.garden_name,garden.garden_address,location.location_name,gardner.gardner_fname,gardner.gardner_lname,garden.garden_status,gardner.gardner_pnumber FROM garden  
        LEFT JOIN   gardner ON garden.garden_id = gardner.garden_id  LEFT JOIN location ON  garden.location_id = location.location_id  WHERE garden.garden_id = :garden_id ORDER BY garden.garden_id desc";
$query=$dbh->prepare($sql);
$query->bindParam(':garden_id',$garden_id,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$sql ="SELECT plant_id,tree_code,tree_status,planted_trees.added_at,tree_category_name,user_fname,user_lname,plant_tree_status,number_of_trees,location.location_id,location_name,tree_planted_at FROM planted_trees  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id LEFT JOIN garden ON  planted_trees.garden_id = garden.garden_id LEFT JOIN location ON  garden.location_id = location.location_id  LEFT JOIN users ON  planted_trees.user_id = users.user_id  WHERE planted_trees.garden_id = :garden_id ORDER BY plant_id desc";
$query2=$dbh->prepare($sql);
$query2->bindParam(':garden_id',$garden_id,PDO::PARAM_STR);
$query2->execute();
$plant_tree=$query2->fetchAll(PDO::FETCH_OBJ);
$sql = 'SELECT COUNT(CASE WHEN  tree_status = "adopted" then 1 ELSE NULL END) as adopted_trees,
    COUNT(CASE WHEN tree_status = "planted" then  1 ELSE NULL END) as planted_trees,
    COUNT(CASE WHEN tree_status = "gifted" then  1 ELSE NULL END) as gifted_trees
from planted_trees WHERE garden_id = :garden_id ';
$query_count=$dbh->prepare($sql);
$query_count->bindParam(':garden_id',$garden_id,PDO::PARAM_STR);
$query_count->execute();
$count=$query_count->fetchAll(PDO::FETCH_OBJ);
$sql ="SELECT COUNT(plant_id) as count,tree_category.tree_category_name FROM planted_trees LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id   WHERE planted_trees.garden_id = :garden_id GROUP BY planted_trees.tree_category_id";
$query_cat=$dbh->prepare($sql);
$query_cat->bindParam(':garden_id',$garden_id,PDO::PARAM_STR);
$query_cat->execute();
$cat=$query_cat->fetchAll(PDO::FETCH_OBJ);
include('../includes/admin_header.php');
include('../includes/admin_sidebar.php');
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
									<a href="add_tree_in_garden.php?garden_id=<?php echo $result->garden_id;?>" class="pull-right btn btn-primary btn-xs mr-15">Add New Tree</a>
									<a href="print_qrcode.php?garden_id=<?php echo $result->garden_id;?>" class="pull-right btn btn-primary btn-xs mr-15">Get QR CODE</a>
									<a href="tree_updates.php?garden_id=<?php echo $result->garden_id;?>" class="pull-right btn btn-primary btn-xs mr-15">Send Tree Updates</a>
									<a href="update_verification.php?garden_id=<?php echo $result->garden_id;?>" class="pull-right btn btn-primary btn-xs mr-15">Verify Updates</a>
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
																<p class="form-control-static"><?php echo $result->location_name;?></p>
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
														        <?php 				
												                    if($query_count->rowCount() > 0)
											                    {
												                      foreach($count as $result)
											                    {?>   							
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
																			<p class="form-control-static"><?php echo $result->planted_trees;?></p>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Adopted Trees:</label>
																		<div class="col-md-9">
												    <p class="form-control-static"><?php echo $result->adopted_trees;?></p>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3">Gifted Trees:</label>
																		<div class="col-md-9">
													<p class="form-control-static"><?php echo $result->gifted_trees;?></p>
																		</div>
																	</div>
																</div>
																<?php }}?>
															</div>

															<!-- /Row -->
															<div class="row">
							        <?php 	
								         if($query_cat->rowCount() > 0)
									{
										foreach($cat as $cat)
									{?>   
																<div class="col-md-4">
																	<div class="form-group">
																		<label class="control-label col-md-3"><?php echo $cat->tree_category_name;?>:</label>
																		<div class="col-md-9">
																		<p class="form-control-static"><?php echo $cat->count;?></p>
																		</div>
																	</div>
																</div>
									<?php }} ?>
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