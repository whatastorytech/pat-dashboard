<?php
error_reporting(0);
include('includes/config.php');
include('includes/header.php');
include('includes/sidebar.php');
if(!isset($_SESSION['login']))
{ 
echo "<script type='text/javascript'> document.location ='login.php'; </script>";
}
$sql ="SELECT tree_category_name,tree_category_desc,Status,tree_category_id,category_image FROM tree_category where tree_category_id = :tree_category_id AND Status = :status ORDER BY tree_category_id desc";
$query = $dbh -> prepare($sql);
$query->bindParam(':tree_category_id',$tree_category_id,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

?>
			<div class="contents-wrapper tree-list">
				<div class="main-contents">
					<div class="tree-category-header">
						<div class="tree-category-title">
							<span class="back"></span>
							<h1>Mango Tree</h1>
						</div>
						<div class="navigation-detail"><a href="#">Home</a> > <a href="#">Manesar</a> > <a href="#">Mango</a></div>
						<div class="tree-category-avatar">
							<img src="img/trees/mango.svg" alt="Mango">
						</div>
					</div>
					<div class="tree-category-info">
						<p class="count">Planted 10 Trees</p>
						<span class="date">Last Planted on : 30-12-2017 | Mumbai</span>
					</div>
					<div class="tree-category-placewise">
						<div class="tree-place">
							<div class="place-header">
								<h2>Mumbai</h2>
								<a href="#">View details</a>
								<span class="counts">4 trees planted</span>
							</div>
							<div class="place-content">
								<div class="tree-block">
									<div class="preview">
										<img src="img/trees/mango.svg" alt="Mango">
									</div>
									<p class="person-name">Abhishek</p>
									<p class="category">Category : Mango Tree</p>
									<div class="infoshare">
										<ul>
											<li><a href="#" class="navigate"></a></li>
											<li><a href="#" class="sahare"></a></li>
										</ul>
										<span>Get direction to your tree</span>
									</div>
								</div>
								<div class="tree-block">
									<div class="preview">
										<img src="img/trees/mango.svg" alt="Mango">
									</div>
									<p class="person-name">BENG2001MN</p>
									<p class="category">Category : Mango Tree</p>
									<div class="infoshare">
										<ul>
											<li><a href="#" class="navigate"></a></li>
											<li><a href="#" class="sahare"></a></li>
										</ul>
										<span>celebrate your bond</span>
									</div>
								</div>
								<div class="tree-block">
									<div class="preview">
										<img src="img/trees/mango.svg" alt="Mango">
									</div>
									<p class="person-name">BENG2001MN</p>
									<p class="category">Category : Mango Tree</p>
									<div class="infoshare">
										<ul>
											<li><a href="#" class="navigate"></a></li>
											<li><a href="#" class="sahare"></a></li>
										</ul>
										<span>celebrate your bond</span>
									</div>
								</div>
								<div class="tree-block">
									<div class="preview">
										<img src="img/trees/mango.svg" alt="Mango">
									</div>
									<p class="person-name">Abhishek</p>
									<p class="category">Category : Mango Tree</p>
									<div class="infoshare">
										<ul>
											<li><a href="#" class="navigate"></a></li>
											<li><a href="#" class="sahare"></a></li>
										</ul>
										<span>celebrate your bond</span>
									</div>
								</div>
								<div class="tree-block">
									<div class="preview">
										<img src="img/trees/mango.svg" alt="Mango">
									</div>
									<p class="person-name">Abhishek</p>
									<p class="category">Category : Mango Tree</p>
									<div class="infoshare">
										<ul>
											<li><a href="#" class="navigate"></a></li>
											<li><a href="#" class="sahare"></a></li>
										</ul>
										<span>celebrate your bond</span>
									</div>
								</div>
							</div>
						</div>
						<div class="tree-place">
							<div class="place-header">
								<h2>Bengaluru</h2>
								<a href="#">View details</a>
								<span class="counts">7 trees planted</span>
							</div>
							<div class="place-content">
								<div class="tree-block">
									<div class="preview">
										<img src="img/trees/mango.svg" alt="Mango">
									</div>
									<p class="person-name">Abhishek</p>
									<p class="category">Category : Mango Tree</p>
									<div class="infoshare">
										<ul>
											<li><a href="#" class="navigate"></a></li>
											<li><a href="#" class="sahare"></a></li>
										</ul>
										<span>celebrate your bond</span>
									</div>
								</div>
								<div class="tree-block">
									<div class="preview">
										<img src="img/trees/mango.svg" alt="Mango">
									</div>
									<p class="person-name">BENG2001MN</p>
									<p class="category">Category : Mango Tree</p>
									<div class="infoshare">
										<ul>
											<li><a href="#" class="navigate"></a></li>
											<li><a href="#" class="sahare"></a></li>
										</ul>
										<span>celebrate your bond</span>
									</div>
								</div>
								<div class="tree-block">
									<div class="preview">
										<img src="img/trees/mango.svg" alt="Mango">
									</div>
									<p class="person-name">BENG2001MN</p>
									<p class="category">Category : Mango Tree</p>
									<div class="infoshare">
										<ul>
											<li><a href="#" class="navigate"></a></li>
											<li><a href="#" class="sahare"></a></li>
										</ul>
										<span>celebrate your bond</span>
									</div>
								</div>
							</div>
							<div class="onemore">
								<a href="#">Place Another Mango Tree</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
include('includes/footer.php');?>

	
