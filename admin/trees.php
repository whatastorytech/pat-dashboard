<?php
/*********************************************************************
*	File	:	Trees.php
*	Created	:	By  What a Story
*	Prupose	:	To Display  Listing   and   basic information of Trees
**********************************************************************/
// include required files

include('../includes/config.php');
include('../includes/connect.php');
include('../includes/functions.php');


if(!isset($_SESSION['login']))
{ 
header('location:index.php');
}
$planted= 'planted';
$adopted = 'adopted';
$sql ="SELECT plant_id,tree_name,tree_code,tree_status,planted_trees.added_at,tree_category_name,user_fname,user_lname,plant_tree_status,number_of_trees,location.location_id,location_name ,tree_planted_at FROM planted_trees  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id LEFT JOIN garden ON  planted_trees.garden_id = garden.garden_id LEFT JOIN location ON  garden.location_id = location.location_id  LEFT JOIN users ON  planted_trees.user_id = users.user_id  WHERE planted_trees.tree_status = :planted  ORDER BY plant_id desc";

$query1=$dbh->prepare($sql);
$query1->bindParam(':planted',$planted,PDO::PARAM_STR);
$query1->execute();
$results=$query1->fetchAll(PDO::FETCH_OBJ);




$sql ="SELECT plant_id,tree_name,tree_code,tree_status,planted_trees.added_at,tree_category_name,user_fname,user_lname,plant_tree_status,number_of_trees,location.location_id,location_name ,tree_planted_at FROM planted_trees  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id LEFT JOIN garden ON  planted_trees.garden_id = garden.garden_id LEFT JOIN location ON  garden.location_id = location.location_id  LEFT JOIN users ON  planted_trees.user_id = users.user_id  WHERE planted_trees.tree_status = :adopted  ORDER BY plant_id desc";

$query=$dbh->prepare($sql);
$query->bindParam(':adopted',$adopted,PDO::PARAM_STR);
$query->execute();
$adopted=$query->fetchAll(PDO::FETCH_OBJ);

include('../includes/admin_header.php');
include('../includes/admin_sidebar.php');
?>

        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid">
                         <div class="row">
								<?php if($_SESSION['error']!="")
								{?>
								<div class="col-md-6">
								<div class="alert alert-danger" >
								 <strong>Error :</strong> 
								 <?php echo htmlentities($_SESSION['error']);?>
								<?php echo htmlentities($_SESSION['error']="");?>
								</div>
								</div>
								<?php } ?>
								<?php if($_SESSION['msg']!="")
								{?>
								<div class="col-md-6">
								<div class="alert alert-success" >
								 <strong>Success :</strong> 
								<?php echo htmlentities($_SESSION['msg']);?>
								<?php echo htmlentities($_SESSION['msg']="");?>
								</div>
								</div>
								<?php } ?>
								<?php if($_SESSION['updatemsg']!="")
								{?>
								<div class="col-md-6">
								<div class="alert alert-success" >
								 <strong>Success :</strong> 
								 <?php echo htmlentities($_SESSION['updatemsg']);?>
								<?php echo htmlentities($_SESSION['updatemsg']="");?>
								</div>
								</div>
								<?php } ?>


								<?php if($_SESSION['delmsg']!="")
								 {?>
								<div class="col-md-6">
								<div class="alert alert-success" >
								 <strong>Success :</strong> 
								 <?php echo htmlentities($_SESSION['delmsg']);?>
								<?php echo htmlentities($_SESSION['delmsg']="");?>
								</div>
								</div>
								<?php } ?>

								</div>
				
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">Trees</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="index.html">Dashboard</a></li>
						<li><a href="#"><span>trees</span></a></li>
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
											<li class="active" role="presentation"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>Planted Trees</span></a></li>
											<li  role="presentation" class="next"><a aria-expanded="true"  data-toggle="tab" role="tab" id="follo_tab_8" href="#follo_8"><span>Adopted Trees<span class="inline-block">&nbsp;(<?php echo $query->rowCount();?>)</span></span></a></li>										
										</ul>
										<div class="tab-content" id="myTabContent_8">
											<div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
												<div class="col-md-12">
													<div class="pt-20">
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
													if($query1->rowCount() > 0)
													{
													foreach($results as $result)
													{               ?>   
													<tr>
														 <td class="center"><?php echo htmlentities($cnt);?></td>
														<td class="center"><?php echo htmlentities($result->tree_code);?></td>
														<td class="center"><?php echo htmlentities($result->tree_category_name);?></td>
														<td class="center"><?php echo htmlentities($result->location_name);?></td>
														<?php 
                                                        $from = new DateTime($result->tree_planted_at);
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
											
											<div  id="follo_8" class="tab-pane fade" role="tabpanel">
												<div class="row">
													<div class="col-lg-12">
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
													foreach($adopted as $result)
													{               ?>   
													<tr>
														 <td class="center"><?php echo htmlentities($cnt);?></td>
														<td class="center"><?php echo htmlentities($result->tree_code);?></td>
														<td class="center"><?php echo htmlentities($result->tree_category_name);?></td>
														<td class="center"><?php echo htmlentities($result->location_name);?></td>
														<?php 
                                                        $from = new DateTime($result->tree_planted_at);
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
						
								</div>
							</div>
						</div>	
					</div>
				</div>
				<!-- /Row -->
			
			</div>	
	
<?php
include('../includes/admin_footer.php');?>	