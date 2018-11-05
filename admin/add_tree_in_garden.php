 <?php
/*********************************************************************
*	File	:	Add_tree_in_garden.php
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

if(isset($_POST['create']))
{
	
$garden_name=$_POST['garden_name'];
$garden_address=$_POST['garden_address'];
$location_id=$_POST['location_id'];
$added_at = date('Y-m-d H:i:s');
$sql="INSERT INTO  garden (location_id,garden_name,garden_address,added_at) VALUES(:location_id,:garden_name,:garden_address,:added_at)";
$query = $dbh->prepare($sql);
$query->bindParam(':garden_name',$garden_name,PDO::PARAM_STR);
$query->bindParam(':garden_address',$garden_address,PDO::PARAM_STR);
$query->bindParam(':location_id',$location_id,PDO::PARAM_STR);
$query->bindParam(':added_at',$added_at,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{

  $_SESSION['msg']="Category Listed successfully";
  echo "<script type='text/javascript'> document.location ='gardens.php'; </script>";
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
echo "<script type='text/javascript'> document.location ='gardens.php'; </script>";
}

}
include('../includes/admin_header.php');
include('../includes/admin_sidebar.php');
?>
              <div class="page-wrapper">
				<div class="container-fluid">					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">Add Tree into the Garden</h5>
						</div>					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<li><a href="index.html">Dashboard</a></li>
								<li class="active"><a href="#"><span>Garden</span></a></li>
							</ol>
						</div>
						<!-- /Breadcrumb -->					
					</div>
					<!-- /Title -->					
					<!-- Row -->
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Tree Garden form </h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
													<form method="POST" action="add_tre.php">
														<div class="form-group">
															 <?php 
																$status=1;
																$garden_id = $_GET['garden_id'];
																$sql = "SELECT garden_name  from garden where garden_id=:garden_id";
																$query = $dbh ->prepare($sql);
																$query -> bindParam(':garden_id',$garden_id, PDO::PARAM_STR);
																$query->execute();
																$results=$query->fetchAll(PDO::FETCH_OBJ);?>
															<label class="control-label mb-10" for="exampleInputuname_1">Garden Name</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																<?php foreach($results as $result)
																{ ?>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="Garden name" name="garden_name" value="<?php echo htmlentities($result->garden_name);?>" disabeld>
																<?php }?>
															</div>
															<input type="hidden" name="garden_id" value="<?php echo  htmlentities($_GET['garden_id']);?>" />
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputEmail_1">Tree Category</label>
																<select class="form-control" id="exampleInputuname_1" name="tree_category_id">
																   <?php 
																$status=1;
																$sql = "SELECT tree_category_id,tree_category_name from  tree_category where Status=:status";
																$query = $dbh -> prepare($sql);
																$query -> bindParam(':status',$status, PDO::PARAM_STR);
																$query->execute();
																$results=$query->fetchAll(PDO::FETCH_OBJ);
																$cnt=1;
																if($query->rowCount() > 0)
																{
																foreach($results as $result)
																{               ?>  
																<option value="<?php echo htmlentities($result->tree_category_id);?>"><?php echo htmlentities($result->tree_category_name);?></option>
																 <?php }} ?>
																</select>
														</div>
													    <div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Number of Trees </label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="Number of Trees" name="tree_number">
															</div>
														</div>
														<button type="submit" class="btn btn-success mr-10" name="create">Submit</button>
														<button type="submit" class="btn btn-default">Cancel</button>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
					<!-- /Row -->	
					
				
				
<?php 
include('../includes/admin_footer.php');?>