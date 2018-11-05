<?php
/*********************************************************************
* File  : index.php
* Created : By  What a Story
* Prupose : This is the user dashboard page wehre user can select the tree  and location for plantation  
**********************************************************************/
// include required files

include('includes/config.php');
include('includes/connect.php');
if(!isset($_SESSION['login']))
{ 
echo "<script type='text/javascript'> document.location ='login.php'; </script>";
}
$sql ="SELECT tree_category_name,tree_category_desc,Status,tree_category_id,category_image FROM tree_category ORDER BY  tree_category_id desc";
$query=$dbh->prepare($sql);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$status=1;
$sql ="SELECT * FROM garden  INNER JOIN location ON  garden.location_id = location.location_id GROUP BY  location.location_id";
$query=$dbh->prepare($sql);
$query->bindParam(':status',$status, PDO::PARAM_STR);
$query->execute();
$location=$query->fetchAll(PDO::FETCH_OBJ);	
include('includes/header.php');
include('includes/sidebar.php');	 
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
												<img class="basic__img" src="<?php echo BASE_URL;?>uploads/tree_category_picture/<?php echo $result->category_image;?> " alt="Bangalore" />
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
																<a href="<?php echo BASE_URL;?>plant_tree.php?location=<?php echo $resul->location_id;?>&tree=<?php echo $result->tree_category_id;?>">Plant here ></a>
															</div>
														<?php }?>
														</div>
													</div>
												</div>												
												<div class="place right">
													<h2><?php echo $result->tree_category_name;?></h2>
													<img src="<?php echo BASE_URL;?>uploads/tree_category_picture/<?php echo $result->category_image;?>" alt="Bangalore" />
												</div>
											</div>

										</div>
									</div>

								<?php }   } ?>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php 
include('includes/footer.php');?>
	