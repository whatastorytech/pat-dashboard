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

if(isset($_POST['create']))
{
	
$category=$_POST['category'];
$status=$_POST['category_desc'];
$sql="INSERT INTO  tree_category (tree_category_name,tree_category_desc) VALUES(:category,:cat_desc)";
$query = $dbh->prepare($sql);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':cat_desc',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{

  $_SESSION['msg']="Category Listed successfully";
  echo "<script type='text/javascript'> document.location ='trees_category.php'; </script>";
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
echo "<script type='text/javascript'> document.location ='trees_category.php'; </script>";
}

}
?>

    <div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">Add Tree Category</h5>
						</div>
					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<li><a href="index.html">Dashboard</a></li>
								<li><a href="#"><span>tree</span></a></li>
								<li class="active"><span>tree category</span></li>
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
										<h6 class="panel-title txt-dark">Tree category form </h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
													<form   method="POST" action="">
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Category Name</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="Tree Category" name="category"">
															</div>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputEmail_1">Discription</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																<textarea class="form-control" id="exampleInputuname_1" placeholder="tree Category discription" name="category_desc"></textarea>
															</div>
														</div>
														<button type="submit"  name="create" class="btn btn-success mr-10">Submit</button>
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