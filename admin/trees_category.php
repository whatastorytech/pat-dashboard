<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/admin_header.php');
include('includes/admin_sidebar.php');

$sql ="SELECT DISTINCT(planted_trees.tree_category_id) as trees ,tree_category_name,tree_category_desc,Status,SUM(planted_trees.number_of_trees) as count FROM tree_category  LEFT JOIN planted_trees ON  tree_category.tree_category_id = planted_trees.tree_category_id GROUP BY  tree_category.tree_category_id  ORDER BY  tree_category.tree_category_id  desc";
$query=$dbh->prepare($sql);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$tree_category_id=8;
$status = 1;
$sql ="SELECT * FROM planted_trees LEFT JOIN location ON  planted_trees.location_id = location.location_id
        LEFT JOIN  tree_category ON planted_trees.tree_category_id = tree_category.tree_category_id where planted_trees.tree_category_id = :tree_category_id ";
     
$query = $dbh -> prepare($sql);
$query->bindParam(':tree_category_id',$tree_category_id,PDO::PARAM_STR);
$query->execute();
$planted_trees=$query->fetchAll(PDO::FETCH_OBJ);
?>
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

?>
        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid">				
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">Trees Category</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="index.html">Dashboard</a></li>
						<li><a href="#"><span>trees category</span></a></li>
						<!-- <li class="active"><span>RSPV DataTable</span></li> -->
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->				
				<!-- Row -->
				<div class="row">
					<div class="col-sm-6">
						<div class="row">
							<?php 	$cnt=1;
													if($query->rowCount() > 0)
													{
													foreach($results as $result)
													{               ?>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 category">
									<div class="panel panel-default card-view pa-0 bg-gradient">
										<div class="panel-wrapper collapse in">
											<div class="panel-body pa-0">
												<a href="#"><div class="sm-data-box" id="category">
													<div class="container-fluid">
														<div class="row">
													        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
																<span class="txt-light block counter"><span class="counter-anim"><?php echo $result->trees;?></span></span>
																<span class="weight-500 uppercase-font block font-13 txt-light"><?php echo $result->tree_category_name;?></span>
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
<?php }}?>

				        </div>
					</div>
					<div class="col-sm-6">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Trees category</h6>
								</div>
									<a href="add_trees_category.php" class="pull-right btn btn-primary btn-xs mr-15">Add New</a>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="">
											<table id="myTable1" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th>#</th>
														<th>Tree Code</th>
														<th>Age</th>
														<th>Status</th>
														<th>Updates</th>
													</tr>
												</thead>												
												<tbody>
													<?php 	
													$cnt=1;
													if($query->rowCount() > 0)
													{
													foreach($planted_trees as $result)
													{               ?>   
													<tr>
														 <td class="center"><?php echo htmlentities($cnt);?></td>
														<td class="center"><?php echo htmlentities($result->tree_code);?></td>
														<?php 
                                                        $from = new DateTime($result->added_at);
														$to   = new DateTime('today');

														?>
														<td class="center"><?php echo $from->diff($to)->d;?> days</td>
													
														<td class="center"><?php echo htmlentities($result->tree_status);?></td>
													   <!--  <td class="center"><?php if($result->location_status==1) {?>
			                                            <a href="#" class="btn btn-success btn-xs"><span class="label label-success">Active</a>
			                                            <?php } else {?>
			                                            <a href="#" class="btn btn-danger btn-xs"><span class="label label-danger">Inactive</a>
			                                            <?php } ?></td> -->
													</tr>
													 <?php $cnt=$cnt+1;}} ?> 												
												</tbody>
											
												<tfoot>
													<tr>
														<th>#</th>
														<th>Tree Code</th>
														<th>Age</th>
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
					</div>
				</div>
				<!-- /Row -->
			
			</div>
<?php
include('includes/admin_footer.php');?>	