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
$plant_id=intval($_GET['plant_id']);
#	Variables
$arrErrors	=	array();
$sql ="SELECT * FROM  tree_updates LEFT JOIN  planted_trees on  tree_updates.plant_id = planted_trees.plant_id  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id LEFT JOIN garden ON  planted_trees.garden_id = garden.garden_id LEFT JOIN location ON  garden.location_id = location.location_id  LEFT JOIN users ON  planted_trees.user_id = users.user_id  WHERE tree_updates.plant_id=:plant_id";
$query=$dbh->prepare($sql);
$query->bindParam(':plant_id',$plant_id,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$garden_id = $_GET['garden_id'];
$sql ="SELECT planted_trees.plant_id,tree_code,tree_status,planted_trees.added_at,pictures,tree_category_name,user_fname,user_lname,plant_tree_status,number_of_trees,location.location_id,location_name,tree_planted_at,tree_qr_code,category_image FROM planted_trees  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id LEFT JOIN garden ON  planted_trees.garden_id = garden.garden_id LEFT JOIN location ON  garden.location_id = location.location_id  LEFT JOIN users ON  planted_trees.user_id = users.user_id
    LEFT JOIN  tree_updates ON  planted_trees.plant_id = tree_updates.plant_id  WHERE planted_trees.garden_id = :garden_id ORDER BY planted_trees.plant_id desc";
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
							<h5 class="txt-dark">Tree Updates</h5>
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
              <div class="crousel-image-outer"> <img src="<?php echo BASE_URL;?>uploads/tree_updates/<?php echo $result->pictures;?>" alt="NO UPDATES" width="200" height="200" /> </div
	  			>
	  			<button class="verify" data-id="<?php echo $result->plant_id;?>">verify</button>
	  			<button data-id="<?php echo $result->plant_id;?>" class="resend">resend</button>
            </li>
            <?php }}?>
          </ul>
        </div>
      </div>
    </div>
					
 				
				
<?php 
include('../includes/admin_footer.php');?>
<script type="text/javascript">
	$(document).ready(function() {
		$(".main-slider-container").basicSlider();
	});
$('body').on('click', '.verify', function (e)
      {       

      	 
               event.preventDefault();
		       var plant_id = $(this).data('id');	
		        $.ajax({
				url: "<?php echo BASE_URL;?>admin/tree_verify.php",
				type: "POST",
				data:{
                 plant_id:plant_id,
				},
				success: function(data){
					if(data != '')
					{
                       
						alert('verified');
						$(this).attr('disabled',true);
					}
					
					
				}        
		   });       
      }); 

$('body').on('click', '.resend', function (e)
      {       

     
               event.preventDefault();
		       var plant_id = $(this).data('id');	
		        $.ajax({
				url: "<?php echo BASE_URL;?>admin/tree_verify.php",
				type: "POST",
				data:{
                 plant_id:plant_id,
				},
				success: function(data){
					if(data != '')
					{

						alert('resend');
						 $(this).hide();
					}
					
					
				}        
		   });       
      }); 

</script>