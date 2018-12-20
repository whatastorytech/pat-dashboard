<?php
include('includes/config.php');
include('includes/connect.php');
if(!isset($_SESSION['login']))
{ 
echo "<script type='text/javascript'> document.location ='login.php'; </script>";
}
$status = 1;
$tree_category_id= intval($_GET['tree_category']);
$user_id = $_SESSION['user_id'];
$sql ="SELECT planted_trees.tree_category_id,planted_trees.number_of_trees,planted_trees.added_at,location.location_name,location.location_id,tree_category.tree_category_name,planted_trees.tree_name,planted_trees.tree_code,tree_category.category_image,planted_trees.tree_planted_at,planted_trees.tree_category_id FROM planted_trees  LEFT JOIN location ON  planted_trees.location_id = location.location_id  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id WHERE planted_trees.user_id = :user_id AND planted_trees.tree_category_id= :tree_category_id AND planted_trees.gifted_to IS NOT NULL";
$query=$dbh->prepare($sql);
$query -> bindParam(':user_id',$user_id, PDO::PARAM_STR);
$query -> bindParam(':tree_category_id',$tree_category_id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$sql ="SELECT tree_category_name,tree_category_desc,Status,tree_category_id,category_image FROM tree_category where tree_category_id = :tree_category_id AND Status = :status ORDER BY tree_category_id desc";
$catquery = $dbh -> prepare($sql);
$catquery->bindParam(':tree_category_id',$tree_category_id,PDO::PARAM_STR);
$catquery->bindParam(':status',$status,PDO::PARAM_STR);
$catquery->execute();
$cate=$catquery->fetchAll(PDO::FETCH_OBJ);
$sql ="SELECT SUM(planted_trees.number_of_trees) as count,planted_trees.added_at,location.location_name,tree_category.tree_category_name,tree_category.category_image,planted_trees.tree_code,planted_trees.tree_planted_at,planted_trees.tree_category_id FROM planted_trees LEFT JOIN location ON  planted_trees.location_id = location.location_id  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id WHERE planted_trees.user_id = :user_id AND planted_trees.tree_category_id = :tree_category_id  AND planted_trees.gifted_to IS NOT NULL ORDER BY planted_trees.added_at desc";
$ctquery=$dbh->prepare($sql);
$ctquery -> bindParam(':user_id',$user_id, PDO::PARAM_STR);
$ctquery -> bindParam(':tree_category_id',$tree_category_id, PDO::PARAM_STR);
$ctquery->execute();
$count=$ctquery->fetchAll(PDO::FETCH_OBJ);
include('includes/header.php');
include('includes/sidebar.php');
?>
			<div class="contents-wrapper tree-list">
				<div class="main-contents">
					<div class="tree-category-header">
							 <?php foreach ($cate as  $result){?>
						<div class="tree-category-title">
							<span class="back"></span>
							<h1><?php echo  $result->tree_category_name;?></h1>
						</div>
						<div class="navigation-detail"><a href="#">Home</a> > <a href="#"><?php echo  $result->tree_category_name;?></a></div>
						<div class="tree-category-avatar">
							<img src="<?php echo BASE_URL;?>uploads/tree_category_picture/<?php echo $result->category_image;?>">
						</div>
						<?php }?>
					</div>
					 <!-- <?php foreach ($count as  $count){?>
					<div class="tree-category-info">
						<p class="count">Planted <?php echo $count->count;?> Trees</p>
						<span class="date">Last Planted on : <?php echo  DateTime::createFromFormat("Y-m-d H:i:s", $count->tree_planted_at)->format("d/m/Y");?> | <?php echo $count->location_name;?></span>
					</div>
					<?php }?> -->
					<?php 
					$previousId = '';
					$cnt = 0;?>			
                    
					<div class="tree-category-placewise">
						<div class="tree-place">
					<div class="place-content">
					    <?php foreach ($results as  $result){?>
								<div class="tree-block">
									<div class="preview">
										<img src="<?php echo BASE_URL;?>uploads/tree_category_picture/<?php echo $result->category_image;?>">
									</div>
									<?php if($result->tree_name != '')
									{?>
                                       <p class="person-name"><?php echo  $result->tree_name;?></p>
									<?php } else {?>
                                       
                                         <p class="person-name"><?php echo  $result->tree_code;?></p>
									<?php }?>
							
									<p class="category">Category : <?php echo  $result->tree_category_name;?></p>
									<div class="infoshare">
										<ul>
											<li><a href="#" class="navigate"></a></li>
											<li><a href="#" class="sahare"></a></li>
										</ul>
										<span>Get direction to your tree</span>
									</div>
								</div>								
							<?php }?>	
					</div>
					


						</div>
				
				</div>
			</div>
		</div>
<?php
include('includes/footer.php');?>