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
$status = 1;
$tree_id = intval($_GET['tree_id']);
$number_of_trees = intval($_GET['number']);
$sql ="SELECT * FROM planted_trees LEFT JOIN location ON  planted_trees.location_id = location.location_id
        LEFT JOIN  tree_category ON planted_trees.tree_category_id = tree_category.tree_category_id where planted_trees.plant_id = :plant_id AND planted_trees.plant_tree_status = :tree_status ORDER BY planted_trees.plant_id desc";
     
$query = $dbh -> prepare($sql);
$query->bindParam(':plant_id',$tree_id,PDO::PARAM_STR);
$query->bindParam(':tree_status',$status,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
?>
			<div class="contents-wrapper">
				<div class="main-contents">
					<div class="section check-out">
						<?php 
                if($query->rowCount() > 0)
				    {
						foreach($results as $result)
							{   ?> 
						<h1 class="sec-title">Plant a Tree</h1>
						<p class="sec-info">You have selected Apple Tree to plant in <?php echo $result->location_name;?></p>
						<a href="#" class="link">Change your Tree or Location</a>

						<div class="check-out-card">
							<div class="has-shadow">
								<div class="image">
									<img src="img/trees/apple.svg">
								</div>
								<div class="content">
									<h2 class="title"><?php echo $result->tree_category_name;?> Tree in <?php echo $result->location_name;?></h2>
									<div class="fee">
										<div class="info">
											<h3>Watering Fee</h3>
											<p><?php echo $number_of_trees;?>x <?php echo $result->tree_category_name;?> Tree for 12 months</p>
											<p>Total Billing amount for 2 trees for a Year</p>
										</div>
										<?php 
										  $amount = $number_of_trees * 999;

										?>
										<div class="rate">
											<h3>₹ <?php echo $amount;?></h3>
											<h4><?php echo $number_of_trees;?> x ₹999</h4>
										</div>
									</div>
									<div class="bill">
										<h2><?php echo $result->tree_category_name;?> Tree will be named <b><?php echo $result->tree_name;?></b></h2>
									</div>
								</div>
							</div>
						</div>
<?php }}?>
						<div class="line"></div>

						<div class="payment">
							<h3 class="sec-title">Pay Via</h3>
							<form class="checkout-form">
								<label>
									<input type="radio" name="payvia" checked="checked"> Wallet
									<span></span>
								</label>
								<label>
									<input type="radio" name="payvia"> Credit Card
									<span></span>
								</label>
								<label>
									<input type="radio" name="payvia"> Debit Card
									<span></span>
								</label>
								<label>
									<input type="radio" name="payvia"> Net Banking
									<span></span>
								</label>
								<div class="form-btn btn" data-popup-target="cardpopup">This is the Last Step</div>
							</form>
						</div>

					</div>
				</div>
			</div>


		</div>

		<div class="checkout-success" id="cardpopup">
			<div class="success-card">
				<div class="image">
					<img src="img/trees/success.svg">
				</div>
				<h1>Congratulations</h1>
				<h2>You have planted a tree</h2>
				<a class="download">Download a copy of Proof</a>
			</div>
		</div>

		<script src="js/jquery.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/custom.js"></script>

<?php 		
include('includes/footer.php');?>		