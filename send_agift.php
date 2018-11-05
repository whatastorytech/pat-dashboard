<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/header.php');
include('includes/sidebar.php');?>
			<div class="contents-wrapper">
				<div class="main-contents">
					<div class="tab-contents mytrees">
						<div class="title-block">
							<div class="group">
								<h2>Gift a Tree</h2>
							</div>
							<div class="sub-info">
								<div class="left">
									<p>Enter Name to whom you want to gift this tree</p>
									<div class="group">
										<input type="treecode" name="treecode" placeholder="Name of the person" class="wid80">
									</div>
									<div class="group">
										<input type="treecode" name="treecode" placeholder="Email (if any)">
										<span class="terms">We will directly mail the certificate on that mail, We will also provide you a certificate that you can print later!</span>		
									</div>
								</div>
								<div class="right">
									<span>Just one step to go !</span>
									<div class="link">
										<a href="index.html" class="bordered-btn" data-popup-target="cardpopup">Send your Gift!</a>
									</div>
								</div>
							</div>
						</div>
						<div class="group selection-info">
							<a href="#" class="backtotrees"><</a>
							<div class="selected-list">
								<div class="s-header">
									<p>You have selected one Tree</p>
									<span>Please check the details of the tree, after this we will give this tree’s acess to the above provided email ( if any ) and you won’t be able to make any changes after this step.</span>
								</div>
								<ul class="s-list">
									<li>
										<div class="box">
											<div class="img">
												<img src="img/trees/mango.svg">
											</div>
											<div class="content">
												<h4>BENG2001MN</h4>
												<p>This tree is planted in Bangalore</p>
												<span>1year, 2 months and 23 days old</span>
											</div>
										</div>
										<div class="navi">
											<span class="close">X</span>
											<a class="change">Change Tree</a>
										</div>
									</li>
									<li>
										<div class="box more">
											<p>+ Add More Tree</p>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="checkout-success gift-success" id="cardpopup">
			<div class="success-card">
				<div class="image">
					<img src="img/trees/mango.svg">
				</div>
				<h1>Congratulations !</h1>
				<h2>your gift is sent to<b>Abhilash Verma</b></h2>
				<p>we have sent a mail to abhilash@gmail.com</p>
				<a class="download">Download Certificate</a>
			</div>
		</div>

		<script src="js/jquery.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/custom.js"></script>
		
<?php 		
include('includes/footer.php');?>		