<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/admin_header.php');
include('includes/admin_sidebar.php');
if(!isset($_SESSION['login']))
{ 
echo "<script type='text/javascript'> document.location ='login.php'; </script>";
}
$status = 1;
$tree_id = intval($_GET['tree_id']);
$number_of_trees = intval($_GET['number']);
$sql ="SELECT * FROM planted_trees LEFT JOIN location ON  planted_trees.location_id = location.location_id
        LEFT JOIN  tree_category ON planted_trees.tree_category_id = tree_category.tree_category_id where planted_trees.plant_id = :plant_id AND planted_trees.plant_tree_status = :tree_status ORDER BY planted_trees.plant_id desc";
     
$query = $dbh -> prepare($sql);
$query->bindParam(':plant_id',$tree_id,PDO::PARAM_STR);
$query->bindParam(':tree_status',$status,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
?>
        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid">				
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">Trees</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="index.html">Dashboard</a></li>
						<li><a href="#"><span>Planted trees</span></a></li>
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
									<h6 class="panel-title txt-dark">Planted Trees</h6>
								</div>
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
														<th>Tree Category</th>
														<th>Plantation</th>
														<th>Age</th>
														<th>User</th>
														<th>Status</th>
														<th>Updates</th>
													</tr>
												</thead>												
												<tbody>
													<tr>
														
													</tr>													
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
					</div>
				</div>
				<!-- /Row -->
			
			</div>	
	
<?php
include('includes/admin_footer.php');?>	