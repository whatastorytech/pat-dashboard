<?php
/*********************************************************************
* File  : Login.php
* Created : By  What a Story
* Prupose : To  Login 
**********************************************************************/
// include required files
include('includes/config.php');
include('includes/connect.php');
include('includes/functions.php');

# Variables
$arrErrors  = array();
$user_id  = 0;

if( !isset($_SESSION['login']))
{
   $_SESSION['login']='';
}
if(isset($_POST['login']))
{

 // Get all values
    $email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $agree = $_POST['agree'];


    //Validation
  if($email == '')
  {
    $arrErrors['user_email'] = 'Please enter Email';
  }
  if($user_password == '')
  {
    $arrErrors['user_password'] = 'Please provide password';
  }
   if($agree == '')
  {
    $arrErrors['agree'] = 'Please Check Terms and Condition';
  }
  
  if(empty($arrErrors))
  {
      $password = md5($user_password);
      $sql ="SELECT user_email,user_password,user_id,user_status,user_image,user_fname,user_lname FROM users WHERE user_email=:email and user_password=:password";
      $query=$dbh->prepare($sql);
      $query-> bindParam(':email', $email, PDO::PARAM_STR);
      $query-> bindParam(':password',$password, PDO::PARAM_STR);
      $query-> execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);


if($query->rowCount() > 0)
{

 foreach ($results as $result)
  {
       $_SESSION['user_id']=$result->user_id;
       $_SESSION['user_name']=$result->user_fname.'&nbsp;'.$result->user_lname;
       $_SESSION['user_image']=$result->user_image;
      if($result->user_status==1)
        {
          $_SESSION['login']=$_POST['user_email'];
          echo "<script type='text/javascript'> document.location ='index.php'; </script>";
        }
    
      else 
        {
        echo "<script>alert('Your Account Has been blocked .Please contact admin');</script>";

        }

   } 
}   

else
{
echo "<script>alert('Invalid Details');</script>";
}
}
else
{
  //Show Error
}
}
?>

<!DOCTYPE html>
<head>
<title>PAT Login From</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="<?php echo BASE_URL ;?>assets/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo BASE_URL ;?>assets/css/login.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
 <style>
    .error
    {
      color:red;
      font-size: 16px;
    }
  </style>
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>PAT Login Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="#" method="post" id="user_login_form">
					 <input class="pass" type="email" name="user_email" placeholder="Email" 
          value="<?php echo isset($user_email)? $user_email : '';?>" > 
          <label id="email-error" class="error" for="email"><?php echo get_error('user_email');?></label>
					<input class="pass" type="password" name="user_password" placeholder="Password" 
          value="<?php echo isset($user_password)? $user_password : '';?>"  > 
      <label id="password-error" class="error" for="password"><?php echo get_error('user_password');?></label>
					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox"  name="agree" >
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" value="LOGIN"  name="login">
				</form>
				<p>Don't have an Account? <a href="signup.php"> Signup Now!</a></p>
			</div>
		</div>
		<!-- copyright -->
		<div class="colorlibcopy-agile">
			<p>© 2018 PAT Signup Form. All rights reserved | Design by <a href="" target="_blank">PAT</a></p>
		</div>
		<!-- //copyright -->
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
</body>
</html>
<script src="<?php echo BASE_URL;?>assets/js/jquery.min.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/plugins.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/custom.js"></script>
<script src="<?php echo BASE_URL ;?>assets/as_assets/dist/js/jquery.validate.min.js "></script>
<script src="<?php echo BASE_URL ;?>assets/as_assets/dist/js/additional-methods.min.js"></script>
  <script>
  
  // When the browser is ready...
  $(function() {
  
    // Setup form validation on the #register-form element
    $("#user_login_form").validate({
    
        // Specify the validation rules
        rules: {
            
            user_email: {
                required: true,
                email: true
            },
            user_password: {
                required: true,
            },
            agree: "required",
      
        },
        
        // Specify the validation error messages
        messages: {
            user_email: "Please enter Email",
            
            user_password: {
                required: "Please provide a password",
             /*   minlength: "Your password must be at least 5 characters long"*/
            },
      
      agree: "Please accept our policy"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
  </script>