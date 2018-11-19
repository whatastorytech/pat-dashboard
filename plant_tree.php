<?php 
/*********************************************************************
* File  : Plant a tree.php
* Created : By  What a Story
* Prupose : For  User can select the Garden from choosen City
**********************************************************************/
// include required files
include('includes/config.php');
include('includes/connect.php');
		if(!isset($_SESSION['login']))
		{ 
		echo "<script type='text/javascript'> document.location ='login.php'; </script>";
		}
$status=1;
$location_id = $_GET['location'];
$tree_category_id = $_GET['tree'];
$sql ="SELECT tree_category_name,tree_category_desc,Status,tree_category_id,category_image FROM tree_category where tree_category_id = :tree_category_id AND Status = :status ORDER BY tree_category_id desc";
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
$sql = "SELECT garden_id,garden_name from garden where location_id = :location_id";
$query = $dbh->prepare($sql);
$query->bindParam(':location_id',$location_id,PDO::PARAM_STR);
$query->execute();
$gardens=$query->fetchAll(PDO::FETCH_OBJ);
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
	
$user_id = $_SESSION['user_id'];
$address=$_POST['address1'].''.$_POST['address2'].''.$_POST['address3'];
$sql="update users set user_address=:user_address where user_id=:user_id";
$query = $dbh->prepare($sql);
$query->bindParam(':user_address',$address,PDO::PARAM_STR);
$query->bindParam(':user_id',$user_id,PDO::PARAM_STR);
$query->execute();

 $_SESSION['location_id']=$_POST['location_id'];
 $_SESSION['garden_id']=$_POST['garden'];
 $_SESSION['tree_name']=$_POST['tree_name'];
 $number_of_trees = $_POST['fee'];
 $tree_category_id=$_POST['tree_category_id'];

 echo "<script type='text/javascript'> document.location ='tree_payment.php?tree_id=$tree_category_id&number=$number_of_trees'; </script>";
		

}
include('includes/header.php');
include('includes/sidebar.php');
?>
			<div class="contents-wrapper">
				<div class="main-contents">
					<div class="section pre-checkout check-out ">
                   
						<h1 class="sec-title">Plant a Tree</h1>
                    <?php foreach($location as $loc){?>
						<p class="sec-info">You have selected Apple Tree to plant in <?php echo $loc->location_name;?></p>
					
						<a href="index.php" class="link">Change your Tree or Location</a>
						<div class="line"></div>
						<a  class="link">Select the Garden name from <?php echo $loc->location_name;?></a>
                        <?php }?>
                    <?php  foreach($gardens as $garden)
			    {?>    
			    	<form action=" "  method="POST">
                        <div class="group">
								<div class="select radios">
								
							
									<label>
										<input type="radio" name="garden" value="<?php echo $garden->garden_id;?>" checked="checked"><?php echo $garden->garden_name;?>
										<span></span>
									</label>
							</div>
								
						</div>

                <?php }?>		
						
						<div class="check-out-card">
							<div class="">
								<div class="image">
									 <?php foreach($results as $res){?>

									<img src="<?php echo BASE_URL;?>uploads/tree_category_picture/<?php echo $res->category_image;?>">
								</div>
								<div class="content">
		
									<h2 class="title"><?php echo $res->tree_category_name;?></h2>
									
									<div class="info">
										<p><?php echo $res->tree_category_desc;?></p>
									</div>	
									<?php }?>
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
									<input type="text" name="address1" id="address" placeholder="Street and city" required>
									<input type="text" name="address2" id="address"  placeholder="State" required>
									<input type="text" name="address3" id="address" placeholder="Country" required>
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
								<div class="name">
									<input type="text" name="tree_name" placeholder="Enter the Name for Your Tree">
								</div>
							</div>
							<?php }}?>
							<div class="group txt-center">
								<input  type="submit"  class="form-btn btn" name="create" value="Proceed to Plant a Tree" />
							</div>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>

<?php 		
include('includes/footer.php');?>