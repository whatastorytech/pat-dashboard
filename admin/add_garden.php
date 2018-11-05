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

#	Variables
$arrErrors	=	array();


if(isset($_POST['create']))
{
	

	 // Get all values
		$garden_name=$_POST['garden_name'];
		$garden_address=$_POST['garden_address'];
		$location_id=$_POST['location_id'];
		$added_at = date('Y-m-d H:i:s');
		 //Validation
		if($garden_name == '')
		{
			$arrErrors['garden_name'] = 'Please Enter Garden Name';
		}
		if($garden_address == '')
		{
			$arrErrors['garden_address'] = 'Please Enter Garden Address';
		}

  if(isset($_FILES['map_image']) && !empty($_FILES['map_image']['name']))
  {

  	  
      $errors= array();
      $file_name = $_FILES['map_image']['name'];
      $file_size =$_FILES['map_image']['size'];
      $file_tmp =$_FILES['map_image']['tmp_name'];
      $file_type=$_FILES['map_image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['map_image']['name'])));
      
      $expensions= array("jpeg","jpg","png","svg","gif");
	      
	      if(in_array($file_ext,$expensions)=== false)
	      {
	      	 
	          $arrErrors['map_image'] ="extension not allowed, please choose a JPEG or PNG file.";
	       

	      }
	      
	      if($file_size > 2097152)
	      {
	    
	         $arrErrors['map_image'] ="File size must be excately 2 MB";
	        
	      }



      
      
      if(empty($arrErrors)==true )
      {  

      	 $file_name = time().'.'.$file_ext;
         $da = move_uploaded_file($file_tmp,"../uploads/garden_map_picture/".$file_name);
         if($da)
         {
             $sql="INSERT INTO  garden (location_id,garden_name,garden_address,added_at,garden_map) VALUES(:location_id,:garden_name,:garden_address,:added_at,:garden_map)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':garden_name',$garden_name,PDO::PARAM_STR);
			$query->bindParam(':garden_address',$garden_address,PDO::PARAM_STR);
			$query->bindParam(':location_id',$location_id,PDO::PARAM_STR);
			$query->bindParam(':added_at',$added_at,PDO::PARAM_STR);
			$query->bindParam(':garden_map',$file_name,PDO::PARAM_STR);
			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
					if($lastInsertId)
					{

					  $_SESSION['msg']="Garden Listed successfully";
					  echo "<script type='text/javascript'> document.location ='gardens.php'; </script>";
					}
					else 
					{
					$_SESSION['error']="Something went wrong. Please try again";
					echo "<script type='text/javascript'> document.location ='gardens.php'; </script>";
					}
         }

         else
         {
         	$_SESSION['error']="Something went wrong. Please try again";
		    echo "<script type='text/javascript'> document.location ='gardens.php'; </script>";
         }

		}
		else
		{
			//show error
		}
}		
else
{
	                $arrErrors['map_image'] = 'Please Upload a Image';
					
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
							<h5 class="txt-dark">Add  Garden</h5>
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
										<h6 class="panel-title txt-dark">Garden form </h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
													<form method="POST" action="" id="add_garden" enctype="multipart/form-data">
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Garden Name</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="Garden name" name="garden_name">
															</div>
															 <label class="error" for="email"><?php echo get_error('garden_name');?></label>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputEmail_1">Location</label>
																<select class="form-control" id="exampleInputuname_1" name="location_id">
																   <?php 
																$status=1;
																$sql = "SELECT location_id,location_name from  location where location_status=:status";
																$query = $dbh -> prepare($sql);
																$query -> bindParam(':status',$status, PDO::PARAM_STR);
																$query->execute();
																$results=$query->fetchAll(PDO::FETCH_OBJ);
																$cnt=1;
																if($query->rowCount() > 0)
																{
																foreach($results as $result)
																{               ?>  
																<option value="<?php echo htmlentities($result->location_id);?>"><?php echo htmlentities($result->location_name);?></option>
																 <?php }} ?>
																</select>
														</div>												
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputEmail_1">Garden Address</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																<textarea class="form-control" id="exampleInputuname_1" placeholder="Garden Address" name="garden_address" required></textarea>
															</div>
															<!--  <label  class="error" for="email"><?php echo get_error('garden_address');?></label> -->
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputEmail_1">Garden Map Image</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																<input class="form-control"  type="file" exampleInputuname_1" placeholder="Map Image" name="map_image">
															</div>
															 <label id="email-error" class="error" for="email"><?php echo get_error('map_image');?></label>
														</div>
														<button type="submit" class="btn btn-success mr-10" name="create">Submit</button>
														<button type="submit"   class="btn btn-default">Cancel</button>
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
 <script>
  //javascript validation for change password
  $("#add_garden").validate({
      rules: {
        garden_name: {
          required: true,
      },
      
      map_image:{
      	required:true,
      }
  },
    messages: {
        
        garden_name: {
          required: "Please Enter a Garden Name",
        },
         
        map_image: {
          required: "Please Upload the Map Image",
        },
      }
    });
  
  </script>