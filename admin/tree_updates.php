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
if(isset($_GET['plant_id']))
{
  $plant_id=intval($_GET['plant_id']);
}

if(isset($_POST['plant_id']))
{
$plant_id = $_POST['plant_id'];
}

#	Variables
$arrErrors	=	array();


if(isset($_POST['create']))
{
	
  	

  if(isset($_FILES['map_image']) && !empty($_FILES['map_image']['name']))
  {
      $total = $_FILES['map_image']['tmp_name'];
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
        
        

      
      
	      if(empty($arrErrors)==true && !empty($_FILES['map_image']['name']))
	    {  
	           

	      	 $file_name = time().'.'.$file_ext;
	         $da = move_uploaded_file($file_tmp,"../uploads/tree_updates/".$file_name);
			         if($da)
	            {    
                    $tree_updates = 'unverify';
                    $resend = 'resend';
	            	$sql ="SELECT * FROM  tree_updates WHERE plant_id=:plant_id AND tree_updates=:update_status";
					$query=$dbh->prepare($sql);
					$query->bindParam(':plant_id',$plant_id,PDO::PARAM_STR);
					$query->bindParam(':update_status',$tree_updates,PDO::PARAM_STR);
					$query->execute();
					$results=$query->fetchAll(PDO::FETCH_OBJ);
					 if($query->rowCount() > 0)
						{  
							
                              echo '<script>alert("already updated for this month")</script>';
						
						}

						else
						{

							
                           $sql ="SELECT * FROM  tree_updates  WHERE plant_id=:plant_id AND update_status !=:resend";
							$query=$dbh->prepare($sql);
							$query->bindParam(':plant_id',$plant_id,PDO::PARAM_STR);
							$query->bindParam(':resend',$resend,PDO::PARAM_STR);
							$query->execute();
					        $results=$query->fetchAll(PDO::FETCH_OBJ);
                             if($query->rowCount() > 0)
						    {
                                     
                                    $sql="update tree_updates set pictures=:pictures,added_at=:added_at,update_status=:update_status where plant_id=:plant_id";
									$query = $dbh->prepare($sql);
									$query->bindParam(':tree_id',$plant_id,PDO::PARAM_STR);
									$query->bindParam(':pictures',$file_name,PDO::PARAM_STR);
									$query->bindParam(':update_status',$tree_updates,PDO::PARAM_STR);
									$query->bindParam(':added_at',$added_at,PDO::PARAM_STR);
									$query->execute();
			                        header('location:tree_updates.php');
						    }

						    else
						    {
                                
                                  $added_at = date('Y-m-d');
					            $sql="INSERT INTO  tree_updates (plant_id,pictures,added_at) VALUES(:tree_id,:pictures,:added_at)";
								$query = $dbh->prepare($sql);
								$query->bindParam(':tree_id',$plant_id,PDO::PARAM_STR);
								$query->bindParam(':pictures',$file_name,PDO::PARAM_STR);
								$query->bindParam(':added_at',$added_at,PDO::PARAM_STR);
								$query->execute();
								$lastInsertId = $dbh->lastInsertId();
						    }
						

		}
						}

	
        
        
       
	   
	}	

	}	
		
		
}

$garden_id = $_GET['garden_id'];
$sql ="SELECT plant_id,tree_code,tree_status,planted_trees.added_at,tree_category_name,user_fname,user_lname,plant_tree_status,number_of_trees,location.location_id,location_name,tree_planted_at,tree_qr_code,category_image FROM planted_trees  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id LEFT JOIN garden ON  planted_trees.garden_id = garden.garden_id LEFT JOIN location ON  garden.location_id = location.location_id  LEFT JOIN users ON  planted_trees.user_id = users.user_id  WHERE planted_trees.garden_id = :garden_id ORDER BY plant_id desc";
$query=$dbh->prepare($sql);
$query->bindParam(':garden_id',$garden_id,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
include('../includes/admin_header.php');
include('../includes/admin_sidebar.php');
?>
              <div class="page-wrapper">
				<div class="container-fluid">					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">Add Updates</h5>
						</div>					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<li><a href="index.html">Dashboard</a></li>
								<li class="active"><a href="#"><span>Tree Updates</span></a></li>
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
										<h6 class="panel-title txt-dark">Tree Form</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
													 <div id="container">
      <div class="main-slider-container">
         <div class="prev crousel-navigation"></div>
        <div class="next crousel-navigation"></div>
        <div class="slider-container" id="slider_data">
          <ul>
          	<?php 	
													$cnt=1;
													if($query->rowCount() > 0)
													{
													foreach($results as $result)
													{  ?>
            <li>
              <h3><?php echo $result->tree_code;?></h3>
              <p><img src="<?php echo BASE_URL;?>admin/gardnerQR/<?php echo $result->tree_qr_code;?>" alt="1" width="200" height="200" /></p>
            <div class="crousel-image-outer"> <img src="<?php echo BASE_URL;?>uploads/tree_category_picture/<?php echo $result->category_image;?>" alt="1" width="200" height="200" /> </div
	  			>
	  		<form method="POST" action="" id="add_garden" enctype="multipart/form-data">
	  		    <div class="form-group">
					<label class="control-label mb-10" for="exampleInputEmail_1">Tree Images</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
								<input class="form-control"  type="file" exampleInputuname_1" placeholder="Map Image" name="map_image" multiple="multiple">
							</div>
						    <label id="email-error" class="error" for="email"><?php echo get_error('map_image');?></label>
					    </div>
						<input class="form-control"  type="hidden" exampleInputuname_1" placeholder="" name="plant_id" value="<?php echo $result->plant_id;?>">
						<button type="submit" class="btn btn-success mr-10" name="create">Submit</button>
			</form>									
		  </li>
            <?php }}?>
          </ul>
        </div>
      </div>
    </div>		
												
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
					<!-- /Row -->	
					
		 <script type="text/javascript">
	$(document).ready(function() {
		$(".main-slider-container").basicSlider();
	});
	</script>		
				
<?php 
include('../includes/admin_footer.php');?>
 <!-- <script>
  //javascript validation for change password
  $("#add_garden").validate({
      rules: {
        garden_name: {
          required: true,
      },
      garden_address:{
      	required:true,
      }
     
  },
    messages: {
        
        garden_name: {
          required: "Please Enter a Garden Name",
        },
        garden_address:{
         
         required:"Please Enter a Garden Address"
        
      }
        }
    });
  
  </script> -->