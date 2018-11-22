<?php
include('includes/config.php');
include('includes/connect.php');
if(!isset($_SESSION['login']))
{ 
echo "<script type='text/javascript'> document.location ='login.php'; </script>";
}
$user_id = $_SESSION['user_id'];
$sql ="SELECT DISTINCT(planted_trees.tree_category_id) as trees,SUM(planted_trees.number_of_trees) as count,planted_trees.added_at,location.location_name,tree_category.tree_category_name,tree_category.category_image,planted_trees.tree_planted_at,planted_trees.tree_category_id FROM planted_trees  LEFT JOIN location ON  planted_trees.location_id = location.location_id  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id WHERE planted_trees.user_id = :user_id GROUP BY planted_trees.tree_category_id ORDER BY planted_trees.added_at desc";
$query=$dbh->prepare($sql);
$query -> bindParam(':user_id',$user_id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
include('includes/header.php');
include('includes/sidebar.php');

?>
			<div class="contents-wrapper">
				<div class="main-contents">
					<div class="tab-contents mytrees">
						<div class="title-block">
							<div class="group">
								<h2>Gift a Tree</h2>
								<div class="link">
									<a href="index.html">View List of Gifts Sent ></a>
								</div>
							</div>
							<!-- <div class="sub-info">
								<div class="left">
									<p>Select the tree that you want to gift to someone You can plant a new tree from <a href="index.html">here</a>
									<br>or</p>
									<input type="treecode" name="treecode" placeholder="Enter Tree Code">
								</div>
							</div> -->
						</div>
						<div class="tab">
							<?php if($query->rowCount() > 0)
				    {
						foreach($results as $result)
							{   ?>
							<a href="gift_atree_selected.php?tree_category=<?php echo $result->tree_category_id;?>" class="tree-block">
								<h2><?php echo $result->tree_category_name;?></h2>
								<div class="tree-img">
									<img src="<?php echo BASE_URL;?>uploads/tree_category_picture/<?php echo $result->category_image;?>">
								</div>
								<p class="howmany">Planted <?php echo $result->count;?> Trees</p>
					<?php }}?>		</a>

						</div>
					</div>
				</div>
			</div>
		</div>
<?php
include('includes/footer.php');?>
		