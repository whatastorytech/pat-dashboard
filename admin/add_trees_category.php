 <?php
/*********************************************************************
*	File	:	add_trees_category.php
*	Created	:	By  What a Story
*	Prupose	:	To Display  Listing   and   basic information of Category
**********************************************************************/
// include required files

include('../includes/config.php');
include('../includes/connect.php');
include('../includes/functions.php');

if(!isset($_SESSION['login']))
{ 
header('location:index.php');
}

#	Variables
$arrErrors	=	array();
if(isset($_POST['create']))
{
 

  if(isset($_FILES['cat_image']))
  {

  	  
      $errors= array();
      $file_name = $_FILES['cat_image']['name'];
      $file_size =$_FILES['cat_image']['size'];
      $file_tmp =$_FILES['cat_image']['tmp_name'];
      $file_type=$_FILES['cat_image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['cat_image']['name'])));
      
      $expensions= array("jpeg","jpg","png","svg");
      
      if(in_array($file_ext,$expensions)=== false)
      {
      	 $errors [] = 1;
         $_SESSION['error']="extension not allowed, please choose a JPEG or PNG file.";
         echo "<script type='text/javascript'> document.location ='trees_category.php'; </script>";

      }
      
      if($file_size > 2097152)
      {
          $errors [] = 2;
         $_SESSION['error']="File size must be excately 2 MB";
         echo "<script type='text/javascript'> document.location ='trees_category.php'; </script>";
      }
      
      if(empty($errors)==true)
      {  
      	 $file_name = time().'.'.$file_ext;
         $da = move_uploaded_file($file_tmp,"../uploads/tree_category_picture/".$file_name);
         if($da)
         {
         	$category=$_POST['category'];
			$status=$_POST['category_desc'];
			$location_name=$_POST['location_name'];
			$sql ="SELECT * FROM location  WHERE location_name=:location_name ORDER BY location_id desc";
			$query=$dbh->prepare($sql);
			$query->bindParam(':location_name',$location_name,PDO::PARAM_STR);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);

			if($query->rowCount() > 0)
			{

			$_SESSION['error']="The Location you have chosen already exists!";
			header('location:locations.php');
			}
			 else 
			{
			$sql="INSERT INTO  tree_category (tree_category_name,tree_category_desc,category_image) VALUES(:category,:cat_desc,:category_image)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':category',$category,PDO::PARAM_STR);
			$query->bindParam(':cat_desc',$status,PDO::PARAM_STR);
			$query->bindParam(':category_image',$file_name,PDO::PARAM_STR);
			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
			if($lastInsertId)
			{ 
                $_SESSION['msg']="Category Listed successfully";
                header('location:trees_category.php');

            }
		      else
		      {
		         $_SESSION['error']="Something went wrong. Please try again";
		          header('location:trees_category.php');
		      }
            }
        }

  
}


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
												<form   method="POST" action="add_trees_category.php" enctype="multipart/form-data">
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
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputEmail_1">Image</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																<input class="form-control"  type="file" exampleInputuname_1" placeholder="Category Image" name="cat_image">
															</div>
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
include('../includes/admin_footer.php');?>
<script type="text/javascript">
	
</script>