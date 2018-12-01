<?php
include('includes/config.php');
include('includes/connect.php');
if(!isset($_SESSION['login']))
{ 
echo "<script type='text/javascript'> document.location ='login.php'; </script>";
}
$tree_id = $_SESSION['tree_id'];
$sql ="SELECT * FROM planted_trees  LEFT JOIN location ON  planted_trees.location_id = location.location_id  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id WHERE planted_trees.plant_id = :plant_id GROUP BY planted_trees.tree_category_id ORDER BY planted_trees.added_at desc";
$query=$dbh->prepare($sql);
$query -> bindParam(':plant_id',$tree_id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if(isset($_POST['name']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$added_at = date('Y-m-d H:i:s');
	$sql="update planted_trees set gifted_to=:gifted_to,gifted_email = :gifted_email ,gifted_at = :added_at where plant_id=:tree_id";
	$query = $dbh->prepare($sql);
	$query->bindParam(':gifted_to',$name,PDO::PARAM_STR);
	$query->bindParam(':gifted_email',$email,PDO::PARAM_STR);
	$query->bindParam(':tree_id',$tree_id,PDO::PARAM_STR);
	$query->bindParam(':added_at',$added_at,PDO::PARAM_STR);
	$query->execute();
    echo "0";
	die;

}
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
								<form method="post"  action="" id="send_gift">
									<div class="group">
										<input type="text" name="name" placeholder="Name of the person" class="wid80" id="name">
										<label class="error"></label>
									</div>
									<div class="group">
										<input type="email" name="email" placeholder="Email (if any)" id="email">
										<label class="error"></label>
										<span class="terms">We will directly mail the certificate on that mail, We will also provide you a certificate that you can print later!</span>		
									</div>
								</div>
								<div class="right">
									<span>Just one step to go !</span>
									<div class="link">
										<a href="#" class="bordered-btn" ><button type="submit" name="submit">Send your Gift!</button></a>
									</div>
								</div>
							</form>
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
									<?php  foreach ($results as $result) {?>
									<li>
										<div class="box">
											<div class="img">
												<img src="img/trees/mango.svg">
											</div>
											<div class="content">
												<h4><?php echo $result->tree_name;?></h4>
												<p>This tree is planted in <?php echo $result->location_name;?></p>
										<?php  
												$date1 = $result->tree_planted_at;
												$date2 =  date('Y-m-d');
												$diff = abs(strtotime($date2) - strtotime($date1));
												$years = floor($diff / (365*60*60*24));
												$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
												$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));?>

												<span><?php printf("%d years, %d months, %d days\n", $years, $months, $days);
  ?> Old</span>
											</div>
										</div>
										<div class="navi">
											<span class="close">X</span>
											<a  href="<?php echo BASE_URL;?>gift_atree.php" class="change">Change Tree</a>
										</div>
									</li>
									<?php }?>
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
				<h2 id="gift_sent_to"><b></b></h2>
				<p id="mail_to"></p>
				<a class="download">Download Certificate</a>
			</div>
		</div>
		
<?php 		
include('includes/footer.php');?>		
<script>
  /*  jQuery.validator.addMethod("laxEmail", function(value, element) {
     // allow any non-whitespace characters as the host part
  return this.optional( element ) ||/[a-zA-Z0-9_\.+]+@(gmail|yahoo|hotmail)(\.[a-z]{2,3}){1,2}/.test( value );
}, 'Please enter a valid email address of Gmail Or Yahoo .');*/
 $("#send_gift").validate({
            rules: {
               /* mobile_number: {
                    required: true,
                    number: true,
                     maxlength: 10
                },*/
                email: {
                    required: true,
                    email: true,
                },
                  name: {
                    required: true,
                },

                  /*last_name: {
                    required: true,
                },
*/
   
            },
        messages: {
                
              /*  mobile_number: {
                    required: "Please Provide a Mobile Number",
                },*/
                email: "Please Enter a Valid Email Address",
                name: "Please Enter a  Name",
               /* last_name: "Please Enter a Last Name",*/

            },
            submitHandler: function(form) {
            $(this).children('input[type=submit]').prop('disabled', true);
            $(form).hide();
            $('#loader').show();
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                 if(response)
                 {   

                    var name =  $("#name").val();
                    var email = $("#email").val();    
                    $(".checkout-success").addClass("active");
                    $("#gift_sent_to").html('<h2>your gift is sent to<b>'+name+'</b></h2>');
                    
                    $("#mail_to").html('<p>we have sent a mail to '+email+'</p>');
                    
 
                 
                 }
                 else
                 {
                     $(form).show();
                     $('#loader').hide();
                     $('#message').html('<div class="alert alert-danger">'+obj.error+'</div>');
                 }
                
            }      
        });
    }
});
$(".checkout-success").click(function(e) 
{
        $(".checkout-success").removeClass("active");
        document.location ='index.php';
});
</script>
