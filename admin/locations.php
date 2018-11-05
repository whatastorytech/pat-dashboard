<?php
/*********************************************************************
*	File	:	Locations.php
*	Created	:	By  What a Story
*	Prupose	:	To Display  Location   and   Information  about Location
**********************************************************************/
// include required files

include('../includes/config.php');
include('../includes/connect.php');
include('../includes/functions.php');

if(!isset($_SESSION['login']))
{ 
header('location:index.php');
}
else
{ 
if(isset($_GET['del']))
{
$location_id=$_GET['del'];
$sql = "delete from location  WHERE location_id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$location_id, PDO::PARAM_STR);
$query -> execute();
$_SESSION['delmsg']="Category deleted scuccessfully ";
header('location:locations.php');

}
}
$sql ="SELECT location_id,location_name,location_status FROM location ORDER BY  location_id desc";
$query=$dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
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
					  <h5 class="txt-dark">Trees Location</h5>
					</div>

					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="index.html">Dashboard</a></li>
						<li><a href="#"><span>trees Location</span></a></li>
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
									<h6 class="panel-title txt-dark">Trees location</h6>
								</div>
									<a href="add_locations.php" class="pull-right btn btn-primary btn-xs mr-15">Add New</a>
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
														<th>Name</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>												
												<tbody>
												<?php 	
													$cnt=1;
													if($query->rowCount() > 0)
													{
													foreach($results as $result)
													{               ?>   
													<tr>
														 <td class="center"><?php echo htmlentities($cnt);?></td>
														<td class="center"><?php echo htmlentities($result->location_name);?></td>
																	 <td class="center"><?php if($result->location_status==1) {?>
			                                            <a href="#" class="btn btn-success btn-xs"><span class="label label-success">Active</a>
			                                            <?php } else {?>
			                                            <a href="#" class="btn btn-danger btn-xs"><span class="label label-danger">Inactive</a>
			                                            <?php } ?></td>
														<td class="text-nowrap"><a href="edit_location.php?location_id=<?php echo $result->location_id;?>" class="mr-25" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i> </a> <a href="locations.php?del=<?php echo htmlentities($result->location_id);?>" onclick="return confirm('Are you sure you want to delete?');"" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td>

													</tr>
													 <?php $cnt=$cnt+1;}} ?>    													
												</tbody>
											
												<tfoot>
													<tr>
														<th>#</th>
														<th>Name</th>
														<th>Status</th>
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
				<!-- /Row -->
			
			</div>
<?php
include('../includes/admin_footer.php');?>	
