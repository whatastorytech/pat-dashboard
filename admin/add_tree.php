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

if(isset($_POST['create']))
{


$tree_category_id=$_POST['tree_category_id'];
$tree_name=$_POST['tree_name'];
$tree_age = date('Y-m-d H:i:s');
$added_at = date('Y-m-d H:i:s');
$sql="INSERT INTO  trees (tree_category_id,tree_name,tree_age,tree_added_at) VALUES(:tree_category_id,:tree_name,:tree_age,:tree_added_at)";
$query = $dbh->prepare($sql);
$query->bindParam(':tree_category_id',$tree_category_id,PDO::PARAM_STR);
$query->bindParam(':tree_name',$tree_name,PDO::PARAM_STR);
$query->bindParam(':tree_age',$tree_age,PDO::PARAM_STR);
$query->bindParam(':tree_added_at',$added_at,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{

  $_SESSION['msg']="Tree Listed successfully";
  echo "<script type='text/javascript'> document.location ='trees.php'; </script>";
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";

}

}
?>?>

            <div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">Add Tree</h5>
						</div>
					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<li><a href="index.html">Dashboard</a></li>
								<li><a href="#"><span>Tree</span></a></li>
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
										<h6 class="panel-title txt-dark">Tree form </h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
													<form method="POST"  action="" >
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Tree  Name</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="Tree name" name="tree_name">
															</div>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputEmail_1">Tree Category</label>
																<select class="form-control" id="exampleInputuname_1" name="tree_category_id">
																   <?php 
																$status=1;
																$sql = "SELECT tree_category_id,tree_category_name from tree_category where Status=:status";
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
include('includes/admin_footer.php');?>