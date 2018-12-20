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
$gardner_id=intval($_GET['gardner_id']);
#	Variables
$arrErrors	=	array();
$imgErrors  = array();



if(isset($_POST['create']))
{
	

	     // Get all values
		$gardner_fname=$_POST['gardner_fname'];
		$gardner_lname=$_POST['gardner_lname'];
		$gardner_email=$_POST['gardner_email'];
		$gardner_pnumber=$_POST['gardner_pnumber'];
		$updated_at = date('Y-m-d H:i:s');


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



}      
      
      if(empty($arrErrors)==true && isset($_FILES['id_image']) && !empty($_FILES['id_image']['name']) )
    {  
                     

        $file_name = time().'.'.$file_ext;
         $da = move_uploaded_file($file_tmp,"../uploads/gardner_id_proof/".$file_name);
         if($da)
         {     
         	      

					$sql = "update gardner set gardner_fname=:gardner_fname,gardner_lname=:gardner_lname,gardner_email=:gardner_email,gardner_pnumber=:gardner_pnumber,updated_at =:updated_at,id_proof=:id_proof where gardner_id=:gardner_id";
					$query = $dbh->prepare($sql);
					$query->bindParam(':gardner_fname',$gardner_fname,PDO::PARAM_STR);
					$query->bindParam(':gardner_lname',$gardner_lname,PDO::PARAM_STR);
					$query->bindParam(':gardner_email',$gardner_email,PDO::PARAM_STR);
					$query->bindParam(':gardner_pnumber',$gardner_pnumber,PDO::PARAM_STR);
					$query->bindParam(':updated_at',$updated_at,PDO::PARAM_STR);
					$query->bindParam(':gardner_id',$gardner_id,PDO::PARAM_STR);
					$query->bindParam(':id_proof',$file_name,PDO::PARAM_STR);
					$query->execute();
					$lastInsertId = $dbh->lastInsertId();
			   

					  $_SESSION['msg']="Gardners Updated successfully";
					  echo "<script type='text/javascript'> document.location ='gardners.php'; </script>";
					
	     }
	     else
	     {
            $_SESSION['error']="Something went wrong. Please try again";
		    echo "<script type='text/javascript'> document.location ='gardners.php'; </script>";
	     }				

    }
		else if(empty($arrErrors)==true)
		{    
			 
			
					$sql = "update gardner set gardner_fname=:gardner_fname,gardner_lname=:gardner_lname,gardner_email=:gardner_email,gardner_pnumber=:gardner_pnumber,updated_at =:updated_at where gardner_id=:gardner_id";
					$query = $dbh->prepare($sql);
					$query->bindParam(':gardner_fname',$gardner_fname,PDO::PARAM_STR);
					$query->bindParam(':gardner_lname',$gardner_lname,PDO::PARAM_STR);
					$query->bindParam(':gardner_email',$gardner_email,PDO::PARAM_STR);
					$query->bindParam(':gardner_pnumber',$gardner_pnumber,PDO::PARAM_STR);
					$query->bindParam(':updated_at',$updated_at,PDO::PARAM_STR);
					$query->bindParam(':gardner_id',$gardner_id,PDO::PARAM_STR);
					$query->execute();
					
			    

					  $_SESSION['msg']="Gardners Updated successfully";
					  echo "<script type='text/javascript'> document.location ='gardners.php'; </script>";
					
		}

		
}		

if(isset($_GET['gardner_id']))
{  

    $sql = "SELECT * from  gardner where gardner_id =:gardner_id";
    $gardner_query = $dbh->prepare($sql);
    $gardner_query->bindParam(':gardner_id',$gardner_id,PDO::PARAM_STR);
    $gardner_query->execute();
    $gardner=$gardner_query->fetchAll(PDO::FETCH_OBJ);
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
													 <?php 
                                                           
                                                            if($gardner_query->rowCount() > 0)
                                                        {
                                                            foreach($gardner as $result)
                                                        { ?>  
													<form method="POST"  action=""  enctype="multipart/form-data" id="gardner_form">
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Gardner First Name</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="First name" name="gardner_fname"  value="<?php echo htmlentities($result->gardner_fname);?>">
															</div>
															 <label id="email-error" class="error" for="email"><?php echo get_error('gardner_fname');?></label>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Gardner last Name</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="Last name" name="gardner_lname" value="<?php echo htmlentities($result->gardner_lname);?>">
															</div>
															 <label id="email-error" class="error" for="email"><?php echo get_error('gardner_lname');?></label>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Gardner phone number</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="Phone Number" name="gardner_pnumber" value="<?php echo htmlentities($result->gardner_pnumber);?>">
															</div>
															<label id="email-error" class="error" for="email"><?php echo get_error('gardner_pnumber');?></label>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Gardner email</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="icon-user"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="Email" name="gardner_email"
																value="<?php echo htmlentities($result->gardner_email);?>">
															</div>
															<label id="email-error" class="error" for="email"><?php echo get_error('gardner_email');?></label>
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
																foreach($results as $resul)
																{    ?>   

																	 
														     <option value="<?php echo htmlentities($resul->garden_id);?>"
                                                               <?php if($resul->garden_id == $result->garden_id) {echo 'selected' ; }?>><?php echo htmlentities($resul->garden_name);?></option>
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
														<div class="form-group">
															<img src="<?php echo BASE_URL;?>uploads/gardner_id_proof/<?php echo $result->id_proof;?>" alt="UrEarth" style="height:200px;width:200px;">
														</div>
														<?php }}?>
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
<script>
  //javascript validation for change password
  $("#gardner_form").validate({
      rules: {
        gardner_fname: {
          required: true,
      },
       gardner_lname: {
          required: true,
      },
       gardner_email: {
          required: true,
          email:true,
      },
       gardner_pnumber: {
          required: true,
          number:true
    
      },

  },
    messages: {
        
        gardner_fname: {
          required: "Please Enter a  First  Name",
        },
        gardner_lname: {
          required: "Please Enter a  Second  Name",
        },
         gardner_email: {
          required: "Please Enter a  Valid Email",
        },
         gardner_pnumber: {
          required: "Please Enter a  Phone Number",
        },
      }
    });
  
  </script>