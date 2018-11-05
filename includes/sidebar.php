<body>
		<div class="outer-wrapper">
			<div class="sidebar">
				<div class="sidebar-section header-section">
					<div class="logo">
						<span><a href="index.php">urearth.org</a></span>
						<h2><a href="index.php"><img src="<?php echo BASE_URL ;?>img/logo@2x.png" alt="UrEarth"></a></h2>
					</div>
				</div>
				<div class="sidebar-section notifyme">
					<div class="user-info">
						<a class="user-avatar">
							<img src="<?php echo BASE_URL ;?>uploads/user_profile_picture/<?php echo $_SESSION['user_image'];?>" alt="Jane Doe">
						</a>
						<h3>Hi, <?php echo $_SESSION['user_name'];?></h3>
						<span class="notifies">N</span>
					</div>
					<div class="notifies-container">
						<span class="back">< Notifications</span>
						<ul>
							<li>
								<a href="#" class="unread">
									<img src="">
									<p>John Does planted 500 Mango trees in Arravali hills, Delhi</p>
								</a>
							</li>
							<li>
								<a href="#">
									<img src="">
									<p>John Does planted 500 Mango trees in Arravali hills, Delhi</p>
								</a>
							</li>
							<li>
								<a href="#">
									<img src="">
									<p>John Does planted 500 Mango trees in Arravali hills, Delhi</p>
								</a>
							</li>
							<li>
								<a href="#">
									<img src="">
									<p>John Does planted 500 Mango trees in Arravali hills, Delhi</p>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="sidebar-section">
					<span><a href="logout.php">Log out?</a></span>
					<div class="stats-block">
						<div class="stat-info">
							<p>You have contributed <em>16 tonnes Oxygen</em> in 654 days</p>
						</div>
						<div class="stat-share-btn">
							<a href="#">Share Your Contribution</a>
						</div>
					</div>
				</div>
				<div class="sidebar-section">
					<ul class="menu list">
						<li><a href="my_trees.php" class="active">My Trees</a></li>
						<li><a href="gift_atree.php">Gift a free</a></li>
						<li><a href="index.php">Plant a Tree</a></li>
						<li><a href="#">Start A Campaign</a></li>
						<li><a href="#">Cause</a></li>
					</ul>	
				</div>
			</div>