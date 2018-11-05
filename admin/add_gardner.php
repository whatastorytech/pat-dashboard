  <?php
/*********************************************************************
*	File	:	add_gardner.php
*	Created	:	By  What a Story
*	Prupose	:	To add a gardner to the particular location
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
		$garden_id=$_POST['garden_id'];
		$gardner_fname=$_POST['gardner_fname'];
		$gardner_lname=$_POST['gardner_lname'];
		$gardner_email=$_POST['gardner_email'];
		$gardner_pnumber=$_POST['gardner_pnumber'];
		$gardner_password=$_POST['gardner_password'];
		$unique_id = rand(10,1000);
		$added_at = date('Y-m-d H:i:s');


		 //Validation
		if($gardner_fname == '')
		{
			$arrErrors['gardner_fname'] = 'Please Enter Gardner First Name';
		}
		if($gardner_lname == '')
		{
			$arrErrors['gardner_lname'] = 'Please Enter Gardner Last Name';
		}
		if($gardner_email == '')
		{
			$arrErrors['gardner_email'] = 'Please Enter Gardner Email';
		}
		if($gardner_pnumber == '')
		{
			$arrErrors['gardner_pnumber'] = 'Please Enter Gardner Phone Number';
		}
		if($gardner_password == '')
		{
			$arrErrors['gardner_password'] = 'Please Enter Gardner Password';
		}


  if(isset($_FILES['id_image']) && !empty($_FILES['id_image']['name']))
  {

  	 
      $file_name = $_FILES['id_image']['name'];
      $file_size =$_FILES['id_image']['size'];
      $file_tmp =$_FILES['id_image']['tmp_name'];
      $file_type=$_FILES['id_image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['id_image']['name'])));      
      $expensions= array("jpeg","jpg","png","svg","gif");
	      
	    if(in_array($file_ext,$expensions)=== false)
	    {
	      	 
	        $arrErrors['id_image'] ="extension not allowed, please choose a JPEG or PNG file.";	       

	    }
	      
	    if($file_size > 2097152)
	    {
	    
	        $arrErrors['id_image'] ="File size must be excately 2 MB";
	        
	    }



      
      
      if(empty($arrErrors)==true )
      {  
                     

            $file_name = time().'.'.$file_ext;
         $da = move_uploaded_file($file_tmp,"../uploads/gardner_id_proof/".$file_name);
         if($da)
         {         
                    $gardner_password = md5($gardner_password);
					$sql="INSERT INTO  gardner (garden_id,gardner_fname,gardner_lname,gardner_email,gardner_pnumber,gardner_password,gardner_unique_id,added_at,id_proof) VALUES(:garden_id,:gardner_fname,:gardner_lname,:gardner_email,:gardner_pnumber,:gardner_password,:gardner_unique_id,:added_at,:id_proof)";
					$query = $dbh->prepare($sql);
					$query->bindParam(':garden_id',$garden_id,PDO::PARAM_STR);
					$query->bindParam(':gardner_fname',$gardner_fname,PDO::PARAM_STR);
					$query->bindParam(':gardner_lname',$gardner_lname,PDO::PARAM_STR);
					$query->bindParam(':gardner_email',$gardner_email,PDO::PARAM_STR);
					$query->bindParam(':gardner_pnumber',$gardner_pnumber,PDO::PARAM_STR);
					$query->bindParam(':gardner_password',$gardner_password,PDO::PARAM_STR);
					$query->bindParam(':gardner_unique_id',$unique_id,PDO::PARAM_STR);
					$query->bindParam(':added_at',$added_at,PDO::PARAM_STR);
					$query->bindParam(':id_proof',$file_name,PDO::PARAM_STR);
					$query->execute();
					$lastInsertId = $dbh->lastInsertId();
			    if($lastInsertId)
					{

					  $_SESSION['msg']="Gardners Listed successfully";
					  echo "<script type='text/javascript'> document.location ='gardners.php'; </script>";
					}
					else 
					{
					$_SESSION['error']="Something went wrong. Please try again";
					echo "<script type='text/javascript'> document.location ='gardners.php'; </script>";
					}
	     }
	     else
	     {
            $_SESSION['error']="Something went wrong. Please try again";
		    echo "<script type='text/javascript'> document.location ='gardners.php'; </script>";
	     }				

		}
		else
		{
			//show error
		}
}		
else
{
	                $arrErrors['id_image'] = 'Please Upload a Image';
					
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
							<h5 class="txt-dark">Add Gardner</h5>
						</div>
					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<li><a href="index.html">Dashboard</a></li>
								<li><a href="#"><span>Gardner</span></a></li>
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
										<h6 class="panel-title txt-dark">Gardner form </h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
													<form method="POST"  action=""  enctype="multipart/form-data">
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Gardner First Name</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="First name" name="gardner_fname">
															</div>
															 <label id="email-error" class="error" for="email"><?php echo get_error('gardner_fname');?></label>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Gardner last Name</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="Last name" name="gardner_lname">
															</div>
															 <label id="email-error" class="error" for="email"><?php echo get_error('gardner_lname');?></label>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Gardner phone number</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="Phone Number" name="gardner_pnumber">
															</div>
															<label id="email-error" class="error" for="email"><?php echo get_error('gardner_pnumber');?></label>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Gardner email</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="Email" name="gardner_email">
															</div>
															<label id="email-error" class="error" for="email"><?php echo get_error('gardner_email');?></label>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Gardner password</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																<input type="password" class="form-control" id="exampleInputuname_1" placeholder="password" name="gardner_password">
															</div>
															<label id="email-error" class="error" for="email"><?php echo get_error('gardner_password');?></label>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputEmail_1">Garden Assign</label>
																<select class="form-control" id="exampleInputuname_1" name="garden_id">
																   <?php 
																$status=1;
																$sql = "SELECT garden_id,garden_name from garden where garden_status=:status";
																$query = $dbh -> prepare($sql);
																$query -> bindParam(':status',$status, PDO::PARAM_STR);
																$query->execute();
																$results=$query->fetchAll(PDO::FETCH_OBJ);
																$cnt=1;
																if($query->rowCount() > 0)
																{
																foreach($results as $result)
																{               ?>  
																<option value="<?php echo htmlentities($result->garden_id);?>"><?php echo htmlentities($result->garden_name);?></option>
																 <?php }} ?>
																</select>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputEmail_1">Gardner ID Proof</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																<input class="form-control"  type="file" exampleInputuname_1" placeholder="ID Proof" name="id_image">
															</div>
															 <label id="email-error" class="error" for="email"><?php echo get_error('id_image');?></label>
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