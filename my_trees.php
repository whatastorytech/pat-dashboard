<?php
session_start();
error_reporting(E_ALL);
include('includes/config.php');
include('includes/header.php');
include('includes/sidebar.php');
if(!isset($_SESSION['login']))
{ 
echo "<script type='text/javascript'> document.location ='login.php'; </script>";
}
$user_id = $_SESSION['user_id'];
$sql ="SELECT DISTINCT(planted_trees.tree_category_id) as trees,SUM(planted_trees.number_of_trees) as count,planted_trees.added_at,location.location_name,tree_category.tree_category_name  FROM planted_trees  LEFT JOIN location ON  planted_trees.location_id = location.location_id  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id WHERE planted_trees.user_id = :user_id GROUP BY planted_trees.tree_category_id ORDER BY planted_trees.added_at desc";
$query=$dbh->prepare($sql);
$query -> bindParam(':user_id',$user_id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
?>

			<div class="contents-wrapper">
				<div class="main-contents">
					<div class="tab-contents mytrees">
						<div class="title-block">
							<h2>My Trees</h2>
							<div class="link">
								<a href="index.php" class="bordered-btn">Plant a Tree</a>
							</div>
						</div>
						<div class="tab">
							<?php if($query->rowCount() > 0)
				    {
						foreach($results as $result)
							{   ?> 
							<div class="tree-block">
								<h2><?php echo $result->tree_category_name;?></h2>
								<div class="tree-img">
									<img src="img/trees/mango.svg">
								</div>
								<p class="howmany">Planted <?php echo $result->count;?> Trees</p>
								<p class="date">Last Planted on : <?php echo $result->added_at;?> | <?php echo $result->location_name;?></p>
								<a href="treelist.php" class="showall">Show all trees</a>
							</div>

						<?php }}?>	

							

							

							
							
						</div>
					</div>
					<div class="mystats section">
						<h1 class="sec-title">Your Contribution</h1>
						<p class="stat-count">You have planted 254 trees</p>
						<p class="stat-info">1.02 ton Oxygen has been generated<br>0.95 ton Carbon reduced</p>
						<a class="stat-details">View Details</a>
					</div>
					<div class="toppers section">
						<h1 class="sec-title">Our Top Planters</h1>
						<div class="group planters-cards-list">
							<div class="planters-card">
								<div>
									<div class="planter-header">
										<div class="planter-info">
											<a href="#"><img src="img/user.png"> <p>Rohit Pal</p></a>
										</div>
										<div class="planter-count">
											<span>100</span>
											<p>trees planted</p>
										</div>
									</div>
									<div class="planter-content">More than one in four deaths in children under five is linked to polluted environments, according to two new World Health Organization reports published on Monday…</div>
									<div class="planter-footer">
										<a class="appritiate">Appritiate Rohit</a>
										<span class="appritiate-counts">22 Appritiations</span>	
									</div>
								</div>
							</div>
							<div class="planters-card">
								<div>
									<div class="planter-header">
										<div class="planter-info">
											<a href="#"><img src="img/user.png"> <p>Bruce</p></a>
										</div>
										<div class="planter-count">
											<span>126</span>
											<p>trees planted</p>
										</div>
									</div>
									<div class="planter-content">More than one in four deaths in children under five is linked to polluted environments, according to two new World Health Organization reports published on Monday…</div>
									<div class="planter-footer">
										<a class="appritiate">Appritiate Rohit</a>
										<span class="appritiate-counts">22 Appritiations</span>	
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="news-section section">
						<h1 class="sec-title">whats happening around</h1>
						<div class="filters">
							<ul>
								<li><a href="#">Filter1</a></li>
								<li><a href="#" class="active">Filter2</a></li>
								<li><a href="#">Filter3</a></li>
								<li><a href="#">Filter4</a></li>
							</ul>
						</div>
						<div class="group news-list cards-list">
							<div class="news-card card-item">
								<div>
									<div class="thumbnail">
										<div class="img" style="background-image: url('img/news/1.jpg');">
											<h2>Environmental Risks Kill 1.7 million Kids Under 5 A Year: WHO More than one in four deaths in</h2>
										</div>
									</div>
									<p class="content">More than one in four deaths in children under five is linked to polluted environments, according to two new World Health Organization reports published on Monday…</p>
									<p class="content-info">from <a href="#">NewsMedia</a></p>
									<a class="readmore">Read Full Article</a>
								</div>
							</div>
							<div class="news-card card-item">
								<div>
									<div class="thumbnail">
										<div class="img" style="background-image: url('img/news/2.jpg');">
											<h2>Environmental Risks Kill 1.7 million Kids Under 5 A Year: WHO More than one in four deaths in</h2>
										</div>
									</div>
									<p class="content">More than one in four deaths in children under five is linked to polluted environments, according to two new World Health Organization reports published on Monday…</p>
									<p class="content-info">from <a href="#">NewsMedia</a></p>
									<a class="readmore">Read Full Article</a>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

<?php
include('includes/footer.php');?>