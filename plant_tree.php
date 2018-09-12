<?php
error_reporting(0);
include('includes/config.php');
include('includes/header.php');
include('includes/sidebar.php');?>
			<div class="contents-wrapper">
				<div class="main-contents">
					<div class="section pre-checkout check-out ">

						<h1 class="sec-title">Plant a Tree</h1>
						<p class="sec-info">You have selected Apple Tree to plant in Bangalore</p>
						<a href="index.html" class="link">Change your Tree or Location</a>

						<div class="check-out-card">
							<div class="">
								<div class="image">
									<img src="img/trees/mango.svg">
								</div>
								<div class="content">
									<h2 class="title">Mango</h2>
									<div class="info">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
										<p>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									</div>	
									<div class="promise">
										<h4>Our Promise to you</h4>
										<p>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
									</div>
								</div>
							</div>
						</div>

						<div class="line"></div>

						<div class="group place-info">
							<div class="content">
								<h3 class="light-title">Planting in <span class="mud">Mumbai</span></h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

								<h4 class="mini-title">Why should you plant here?</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							</div>
							<div class="preview">
								<img src="img/places/mumbai.png" alt="Mumbai">
							</div>
						</div>

						<div class="line"></div>

						<div class="group fee-calc">
							<h3 class="light-title mud">Watering Fee</span></h3>
							<div class="fee-block">
								<div class="singlefee">
									<p>₹ 99</p>
									<span>per/month</span>
								</div>
								<div class="multi-fee incdnc">
									<span>Select Number of Trees You want to plant</span>
									<button class="minus">-</button>
									<input type="text" name="fee" value="1">
									<button class="plus">+</button>
								</div>
								<div class="total-fee">
									<span>Total Billing amount for a year</span>
									<p>₹ <em class="rate">999</em></p>
									<span>You will recieve updates of your tree till 1 year</span>
								</div>
							</div>
						</div>

						<div class="line"></div>

						<div class="group personal-info">
							<div class="group">
								<label>Name</label>
								<input type="text" name="name" id="name">
							</div>
							<div class="group">
								<label>Address</label>
								<div class="input">
									<input type="text" name="address" id="address">
									<input type="text" name="address" id="address">
									<input type="text" name="address" id="address">
								</div>
								
							</div>
							<div class="group has2">
								<div>
									<label>Email</label>
									<input type="text" name="email">	
								</div>
								<div>
									<label>Phone Number</label>
									<input type="text" name="phone">	
								</div>
							</div>
							<div class="group">
								<div class="select radios">
									<label>
										<input type="radio" name="nameorgift" checked="checked"> Name Your Tree
										<span></span>
									</label>
									<label>
										<input type="radio" name="nameorgift"> Gift Tree
										<span></span>
									</label>
								</div>
								
								<div class="name">
									<input type="text" name="treename" placeholder="Enter the Name for Your Tree">
								</div>
							</div>
							<div class="group txt-center">
								<a href="tree_payment.php" class="form-btn btn">Proceed to Plant a Tree</a>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

<?php 		
include('includes/footer.php');?>