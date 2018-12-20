<?php 
include('includes/config.php');
include('includes/connect.php');
if(!isset($_SESSION['login']))
{ 
echo "<script type='text/javascript'> document.location ='login.php'; </script>";
}
$status = '1';
$tree_id = intval($_GET['tree_id']);
$number_of_trees = intval($_GET['number']);
$amount = $number_of_trees * 999;

$sql ="SELECT tree_category_name,tree_category_desc,Status,tree_category_id,category_image FROM  tree_category where tree_category_id = :tree_category_id AND Status = :status";
$query = $dbh -> prepare($sql);
$query->bindParam(':tree_category_id',$tree_id,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$garden_id = $_SESSION['garden_id'];


$sql ="SELECT * FROM garden LEFT JOIN location on garden.location_id = location.location_id  WHERE garden_id=:garden_id AND garden_status = :garden_status";
$garden_query = $dbh -> prepare($sql);
$garden_query->bindParam(':garden_id',$garden_id,PDO::PARAM_STR);
$garden_query->bindParam(':garden_status',$status,PDO::PARAM_STR);
$garden_query->execute();
$garden=$garden_query->fetchAll(PDO::FETCH_OBJ);
 
$user_id = $_SESSION['user_id'];
$sql = "SELECT user_id,user_fname,user_lname,user_email,user_pnumber from users where  user_id = :user_id";
$query1 = $dbh->prepare($sql);
$query1->bindParam(':user_id',$user_id,PDO::PARAM_STR);
$query1->execute();
$user=$query1->fetchAll(PDO::FETCH_OBJ);

include('Instamojo.php');
$api = new Instamojo\Instamojo('test_cae2968fb1e4b64719904a3921d','test_decb2f0528b832e0ea79e606460');

if (isset($_POST['submit']))
{
try {
	 foreach($user as $result)
		{ 
    $response = $api->paymentRequestCreate(array(
        "purpose" => "PLANT A TREE",
        "amount" =>  $amount,
        "buyer_name"=>$result->user_fname . ' ' . $result->user_lname,
        'buyer_phone'=>$result->user_pnumber,
        "send_email" => true, 
        "email" =>$result->user_email,
        "redirect_url" => BASE_URL."/payment.php?tree_id=".$tree_id."&number=".$number_of_trees."",
        ));
     }
  header('location:'.$response['longurl'].'');    
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
    die;
}
}
include('includes/header.php');
include('includes/sidebar.php');
?>

			<div class="contents-wrapper">
				<div class="main-contents">
					<div class="section check-out">
						<?php 
                if($query->rowCount() > 0)
				    {
						foreach($garden as $garden)
							{   
								foreach($results as $result)
							{   ?> 
						<h1 class="sec-title">Plant a Tree</h1>
						<p class="sec-info">You have selected Apple Tree to plant in <?php echo $garden->location_name;?></p>
						<!-- <a href="#" class="link">Change your Tree or Location</a> -->

						<div class="check-out-card">
							<div class="has-shadow">
								<div class="image">
									<img src="img/trees/apple.svg">
								</div>
								<div class="content">
									<h2 class="title"><?php echo $result->tree_category_name;?> Tree in <?php echo $garden->location_name;?></h2>
									<div class="fee">
										<div class="info">
											<h3>Watering Fee</h3>
											<p><?php echo $number_of_trees;?>x <?php echo $result->tree_category_name;?> Tree for 12 months</p>
											<p>Total Billing amount for 2 trees for a Year</p>
										</div>
										
										<div class="rate">
											<h3>₹ <?php echo $amount;?></h3>
											<h4><?php echo $number_of_trees;?> x ₹999</h4>
										</div>
									</div>
									<div class="bill">
										<?php if(isset($_SESSION['tree_name']) && $_SESSION['tree_name'] != '')
										{?>
                                        
                                        <h2><?php echo $result->tree_category_name;?> Tree will be named <b><?php echo  $_SESSION['tree_name'];?></b></h2>
										<?php }?>
										
									</div>
								</div>
							</div>
						</div>
<?php }}}?>
						<div class="line"></div>

						<!-- <div class="payment">
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
								
							</form>
						</div> -->
						<form action=""  method="POST">
                    <button class="form-btn btn" type="submit" name="submit">Make a Payment</button>
                </form>
                    <a href="<?php echo BASE_URL;?>index.php"><div class="form-btn btn">Cancel</div></a>
					</div>
				</div>
			</div>


		</div>
		
