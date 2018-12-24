<?php
/*********************************************************************
*	File	:	Trees_category.php
*	Created	:	By  What a Story
*	Prupose	:	To Display  Listing   and   basic information of Tree Category
**********************************************************************/
// include required files

include('../includes/config.php');
include('../includes/connect.php');
include('../includes/functions.php');

if(!isset($_SESSION['login']))
{ 
header('location:index.php');
}

$sql ="SELECT tree_category.tree_category_name,tree_category.tree_category_id,COUNT(planted_trees.tree_category_id)  as count ,tree_category.category_image FROM tree_category  LEFT JOIN  planted_trees on   tree_category.tree_category_id  =  planted_trees.tree_category_id GROUP BY tree_category.tree_category_id ORDER BY  tree_category.tree_category_id desc";
$query=$dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$tree_category_id=2;
$status = 1;
$sql ="SELECT * FROM planted_trees LEFT JOIN location ON  planted_trees.location_id = location.location_id
        LEFT JOIN  tree_category ON planted_trees.tree_category_id = tree_category.tree_category_id where planted_trees.tree_category_id = :tree_category_id ";
     
$plann_query = $dbh -> prepare($sql);
$plann_query->bindParam(':tree_category_id',$tree_category_id,PDO::PARAM_STR);
$plann_query->execute();
$planted_trees=$plann_query->fetchAll(PDO::FETCH_OBJ);
include('../includes/admin_header.php');
include('../includes/admin_sidebar.php');
?>

        <!-- Main Content -->
		<div class="page-wrapper">
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

            <div class="container-fluid">				
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">Trees Category</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="index.html">Dashboard</a></li>
						<li><a href="#"><span>trees category</span></a></li>
						<!-- <li class="active"><span>RSPV DataTable</span></li> -->
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->				
				<!-- Row -->
				<div class="row">
					<div class="col-sm-6">
						<div class="row">
							<?php 	$cnt=1;
													if($query->rowCount() > 0)
													{
													foreach($results as $result)
													{               ?>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 category">
									<div class="panel panel-default card-view pa-0 bg-gradient">
										<div class="panel-wrapper collapse in">
											<div class="panel-body pa-0">
							<a href="#"><div class="sm-data-box" id="category">
													<div class="container-fluid" class="cate" data-id="<?php echo $result->tree_category_id;?>">
														<div class="row">
													        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left cate" data-id="<?php echo $result->tree_category_id;?>">
																<span class="txt-light block counter"><span class="counter-anim"><?php echo $result->count;?></span></span>
																<span class="weight-500 uppercase-font block font-13 txt-light"><?php echo $result->tree_category_name;?></span>
															</div></a>
															<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
																<img src="../uploads/tree_category_picture/<?php echo $result->category_image;?>" />
															</div>
														</div>	
													</div>
												</div>
											</a>
											</div>
										</div>
									</div>
								</div>
<?php }}?>

				        </div>
					</div>
					<div class="col-sm-6">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Trees category</h6>
								</div>
									<a href="add_trees_category.php" class="pull-right btn btn-primary btn-xs mr-15">Add New</a>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="">
											<table id="cat_tabel" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th>#</th>
														<th>Tree Code</th>
														<th>Tree Category</th>
														<th>Age</th>
														<th>Status</th>
														<th>Updates</th>
													</tr>
												</thead>												
												<tbody >
													<?php 	
													$cnt=1;
													if($query->rowCount() > 0)
													{
													foreach($planted_trees as $result)
													{               ?>   
													<tr>

												    <td class="center"><?php echo htmlentities($cnt);?></td>
													<td class="center"><?php echo htmlentities($result->tree_code);?></td>
													<td class="center"><?php echo htmlentities($result->tree_category_name);?></td>
														<?php 
                                                        $from = new DateTime($result->tree_planted_at);
														$to   = new DateTime('today');
														?>
													<td class="center"><?php echo $from->diff($to)->d;?> days</td>
													
													<td class="center"><?php echo htmlentities($result->tree_status);?></td>
													</tr>
													 <?php $cnt=$cnt+1;}} ?> 												
												</tbody>
											
												<tfoot>
													<tr>
														<th>#</th>
														<th>Tree Code</th>
														<th>Tree Category</th>
														<th>Age</th>
														<th>Status</th>
														<th>Updates</th>
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
			<script>
$('body').on('click', '.cate', function (e)
      {
               event.preventDefault();
		       var cat_id = $(this).data('id');	
		        $.ajax({
				url: "tree_category.php",
				type: "POST",
				data:{
                 cat_id:cat_id,
				},
				success: function(data){
					if(data != '')
					{

						$('#cat_tabel').empty();
						$('#cat_tabel').html(data);
					}
					
					
				}        
		   });       
      }); 

</script>
<?php
include('../includes/admin_footer.php');?>	
