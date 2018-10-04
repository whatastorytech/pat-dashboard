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
$status=1;
$location_id = intval($_GET['location']);
$tree_category_id = intval($_GET['tree']);
$sql ="SELECT tree_category_name,tree_category_desc,Status,tree_category_id FROM tree_category where tree_category_id = :tree_category_id AND Status = :status ORDER BY tree_category_id desc";
$query = $dbh -> prepare($sql);
$query->bindParam(':tree_category_id',$tree_category_id,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$status=1;
$sql = "SELECT location_id,location_name from location where  location_id = :location_id";
$query = $dbh->prepare($sql);
$query->bindParam(':location_id',$location_id,PDO::PARAM_STR);
$query->execute();
$location=$query->fetchAll(PDO::FETCH_OBJ);
$status=1;
$sql = "SELECT location_name,location_id,location_desc,why_we_plant_here
FROM location 
WHERE location_id !=  :location_id
AND location_status = :status
ORDER BY RAND()
LIMIT 1";
$query = $dbh -> prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> bindParam(':location_id',$location_id, PDO::PARAM_STR);
$query->execute();
$random_location=$query->fetchAll(PDO::FETCH_OBJ);
$status=1;
$user_id = $_SESSION['user_id'];
$sql = "SELECT user_id,user_fname,user_lname,user_email,user_pnumber from users where  user_id = :user_id";
$query1 = $dbh->prepare($sql);
$query1->bindParam(':user_id',$user_id,PDO::PARAM_STR);
$query1->execute();
$user=$query1->fetchAll(PDO::FETCH_OBJ);

if(isset($_POST['create']))
{
	
$location_id=$_POST['location_id'];
$tree_category_id=$_POST['tree_category_id'];
$address=$_POST['address1'].''.$_POST['address2'].''.$_POST['address3'];
$rate= $_POST['rate'];
$number_of_trees = $_POST['fee'];
$tree_name = $_POST['tree_name'];
$added_at = date('Y-m-d H:i:s');
$user_id = $_SESSION['user_id'];
for($i=1; $i <=  $number_of_trees; $i++)
{
$sql="INSERT INTO  planted_trees (location_id,tree_name,tree_category_id,user_id,tree_payment,added_at) VALUES(:location_id,:tree_name,:tree_category_id,:user_id,:tree_payment,:added_at)";
$query = $dbh->prepare($sql);
$query->bindParam(':location_id',$location_id,PDO::PARAM_STR);
$query->bindParam(':tree_name',$tree_name,PDO::PARAM_STR);
$query->bindParam(':tree_category_id',$tree_category_id,PDO::PARAM_STR);
$query->bindParam(':user_id',$user_id,PDO::PARAM_STR);
$query->bindParam(':added_at',$added_at,PDO::PARAM_STR);
$query->bindParam(':tree_payment',$rate,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
}
if($lastInsertId)
{

  $_SESSION['msg']="Planted successfully";
  echo "<script type='text/javascript'> document.location ='tree_payment.php?tree_id=$lastInsertId&number=$number_of_trees'; </script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";

}

}
?>
			<div class="contents-wrapper">
				<div class="main-contents">
					<div class="section pre-checkout check-out ">
                   
						<h1 class="sec-title">Plant a Tree</h1>
                    <?php foreach($location as $loc){?>
						<p class="sec-info">You have selected Apple Tree to plant in <?php echo $loc->location_name;?></p>
					<?php }?>
						<a href="index.php" class="link">Change your Tree or Location</a>
						<div class="check-out-card">
							<div class="">
								<div class="image">
									<img src="img/trees/mango.svg">
								</div>
								<div class="content">
									  <?php foreach($results as $res){?>
									<h2 class="title"><?php echo $res->tree_category_name;?></h2>
									<?php }?>
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
                <?php foreach($random_location as $rand_loc){?>
						<div class="group place-info">
							<div class="content">
								<h3 class="light-title">Planting in <span class="mud"><?php echo $rand_loc->location_name;?></span></h3>
								<p><?php echo $rand_loc->location_desc;?></p>

								<h4 class="mini-title">Why should you plant here?</h4>
								<p><?php echo $rand_loc->why_we_plant_here;?></p>
							</div>

							<div class="preview">
								<img src="img/places/mumbai.png" alt="Mumbai">
							</div>
						</div>
				<?php }?>

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
									<button class="minus" id="minus">-</button>
						<form action=" "  method="POST">
									<?php 
							if($query1->rowCount() > 0)
								{
								foreach($user as $user)
								{  ?>
									<input type="text" name="fee" id="fee" value="1">
									<button class="plus" id="plus">+</button>
								</div>
								<input type="hidden" name="location_id"  value="<?php echo $location_id;?>">
								<input type="hidden" name="tree_category_id"  value="<?php echo $tree_category_id;?>">
								<div class="total-fee multi-fee incdnc">
									<span>Total Billing amount for a year</span>
									<p>₹<input type="text" name="rate" id="rate" value="999"></p>
									<span>You will recieve updates of your tree till 1 year</span>
								</div>
							</div>
						</div>

						<div class="line"></div>
						<div class="group personal-info">
							<div class="group">
								<label>Name</label>
								<input type="text" name="name" id="name" value="<?php echo htmlentities($user->user_fname);?>&nbsp;<?php echo htmlentities($user->user_lname);?>" readonly>
							</div>
							<div class="group">
								<label>Address</label>
								<div class="input">
									<input type="text" name="address1" id="address">
									<input type="text" name="address2" id="address">
									<input type="text" name="address3" id="address">
								</div>
								
							</div>
							<div class="group has2">
								<div>
									<label>Email</label>
									<input type="text" name="email" value="<?php echo htmlentities($user->user_email);?>" readonly>	
								</div>
								<div>
									<label>Phone Number</label>
									<input type="text" name="phone" value="<?php echo htmlentities($user->user_pnumber);?>" readonly>	
								</div>
							</div>
							<div class="group">
								<div class="select radios">
									<label>
										<input type="radio" name="nameorgift" checked="checked">Name Your Tree
										<span></span>
									</label>
									<label>
										<input type="radio" name="nameorgift"> Gift Tree
										<span></span>
									</label>
								</div>
								
								<div class="name">
									<input type="text" name="tree_name" placeholder="Enter the Name for Your Tree">
								</div>
							</div>
							<?php }}?>
							<div class="group txt-center">
								<button type="submit"  class="form-btn btn" name="create">Proceed to Plant a Tree</a>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

<?php 		
include('includes/footer.php');?>