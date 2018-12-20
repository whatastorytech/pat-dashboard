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

$garden_id = $_GET['garden_id'];
$sql ="SELECT garden.garden_id,garden.garden_name,garden.garden_address,location.location_name,gardner.gardner_fname,gardner.gardner_lname,garden.garden_status,gardner.gardner_pnumber FROM garden  
        LEFT JOIN   gardner ON garden.garden_id = gardner.garden_id  LEFT JOIN location ON  garden.location_id = location.location_id  WHERE garden.garden_id = :garden_id ORDER BY garden.garden_id desc";
$query=$dbh->prepare($sql);
$query->bindParam(':garden_id',$garden_id,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$sql ="SELECT plant_id,tree_code,tree_status,planted_trees.added_at,tree_category_name,user_fname,user_lname,plant_tree_status,number_of_trees,tree_qr_code,location.location_id,location_name,tree_planted_at FROM planted_trees  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id LEFT JOIN garden ON  planted_trees.garden_id = garden.garden_id LEFT JOIN location ON  garden.location_id = location.location_id  LEFT JOIN users ON  planted_trees.user_id = users.user_id  WHERE planted_trees.garden_id = :garden_id ORDER BY plant_id desc";
$query2=$dbh->prepare($sql);
$query2->bindParam(':garden_id',$garden_id,PDO::PARAM_STR);
$query2->execute();
$plant_tree=$query2->fetchAll(PDO::FETCH_OBJ);
include('../includes/admin_header.php');
?>

            <div class="page-wrapper">
				<div class="container-fluid">
					<?php 	
							$cnt=1;
								if($query->rowCount() > 0)
									{
										foreach($results as $result)
									{?>   
					<!-- Row -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									 <div class="pull-left">
										<h6 class="panel-title txt-dark"><?php echo $result->garden_name;?> QR CODE's</h6>
									</div> 
									<!-- <a href="add_tree_in_garden.php?garden_id=<?php echo $result->garden_id;?>" class="pull-right btn btn-primary btn-xs mr-15">Add New Tree</a>
									<a href="add_tree_in_garden.php?garden_id=<?php echo $result->garden_id;?>" class="pull-right btn btn-primary btn-xs mr-15">Get QR CODE</a> -->
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										

                           <div class="seprator-block"></div>

															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account-box mr-10"></i>Information</h6>
															<hr class="light-grey-hr"/>
														
															
					    <div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="">
											<table id="myTable"  class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th>#</th>
														<th>Tree Code</th>
														<th>Tree Category</th>
														<th>Tree  QR Code</th>
													</tr>
												</thead>												
												<tbody>
													<?php 	
													$cnt=1;
													if($query2->rowCount() > 0)
													{
													foreach($plant_tree as $result)
													{               ?>   
													<tr>
														 <td class="center"><?php echo htmlentities($cnt);?></td>
														<td class="center"><?php echo htmlentities($result->tree_code);?></td>
														<td class="center"><?php echo htmlentities($result->tree_category_name);?></td>
														 <td><img src="<?php echo BASE_URL;?>admin/gardnerQR/<?php echo $result->tree_qr_code;?>"</td>
													</tr>
													 <?php $cnt=$cnt+1;}} ?> 												
												</tbody>
											
												<tfoot>
													<tr>
														<th>#</th>
														<th>Tree Code</th>
														<th>Tree Category</th>
														<th>Tree QR Code</th>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
							</div>
															
														</div>
														
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php }}?>
					</div>
					<!-- /Row -->	
					
				
				
<?php 
include('../includes/admin_footer.php');?>