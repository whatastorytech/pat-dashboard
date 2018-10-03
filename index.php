<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/header.php');
include('includes/sidebar.php');
if(!isset($_SESSION['login']))
{ 
echo "<script type='text/javascript'> document.location ='login.php'; </script>";
}
$sql ="SELECT tree_category_name,tree_category_desc,Status FROM tree_category ORDER BY  tree_category_id desc";
$query=$dbh->prepare($sql);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$status=1;
$sql = "SELECT location_id,location_name from  location where location_status=:status";
$query = $dbh -> prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query->execute();
$location=$query->fetchAll(PDO::FETCH_OBJ);
		 
?>
	
			<div class="contents-wrapper">
				<div class="main-contents">
					<div class="container">
						<div class="section locations-section">				
							<h1 class="sec-title">Plant a Tree</h1>

							<div class="trees-tab">
								<p class="sec-info">Select the tree that you want to plant</p>
								<div class="image-grid">
									<?php 
                                    if($query->rowCount() > 0)
									{
										foreach($results as $result)
										{ ?>
									<div class="image__cell is-collapsed">
										<div class="image--basic">
											<a href="javascript:void(0);">
												<h2><?php echo $result->tree_category_name;?></h2>
												<img class="basic__img" src="img/trees/mango.svg" alt="Bangalore" />
											</a>
										</div>
										<div class="image--expand">
											<a href="#" class="expand__close"></a>
											<div class="info">
												<div class="content">
													<p><?php echo $result->tree_category_desc;?></p>

													<div class="trees-list">
														<h4>Planting In these locations </h4>
														<div class="plist">
															<?php 
															foreach($location as $resul)
										{ ?>
															<div class="place-item">
																<h3><?php echo $resul->location_name;?></h3>
																<a href="selectedtree.html">Plant here ></a>
															</div>
															<?php }?>
														</div>
													</div>
												</div>												
												<div class="place right">
													<h2><?php echo $result->tree_category_name;?></h2>
													<img src="img/trees/mango.svg" alt="Bangalore" />
												</div>
											</div>

										</div>
									</div>

								<?php


							}}?>

								

									
								
									

								

								

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php 
include('includes/footer.php');?>
	