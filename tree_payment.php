<?php 
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/header.php');
include('includes/sidebar.php');
if(!isset($_SESSION['login']))
{ 
echo "<script type='text/javascript'> document.location ='login.php'; </script>";
}?>
			<div class="contents-wrapper">
				<div class="main-contents">
					<div class="section check-out">

						<h1 class="sec-title">Plant a Tree</h1>
						<p class="sec-info">You have selected Apple Tree to plant in Bangalore</p>
						<a href="index.html" class="link">Change your Tree or Location</a>

						<div class="check-out-card">
							<div class="has-shadow">
								<div class="image">
									<img src="img/trees/apple.svg">
								</div>
								<div class="content">
									<h2 class="title">Apple Tree in Mumbai</h2>
									<div class="fee">
										<div class="info">
											<h3>Watering Fee</h3>
											<p>2 x Apple Tree for 12 months</p>
											<p>Total Billing amount for 2 trees for a Year</p>
										</div>
										<div class="rate">
											<h3>₹ 1998</h3>
											<h4>2 x ₹999</h4>
										</div>
									</div>
									<div class="bill">
										<h2>1 Apple Tree will be named <b>Abhishek</b></h2>
									</div>
								</div>
							</div>
						</div>

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