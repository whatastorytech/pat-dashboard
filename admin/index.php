<?php
/*********************************************************************
*	File	:	Index.php
*	Created	:	By  What a Story
*	Prupose	:	To  Login in Admin Panel 
**********************************************************************/
// include required files
include('../includes/config.php');
include('../includes/connect.php');
include('../includes/functions.php');

#	Variables
$arrErrors	=	array();
$user_id	=	0;

if( !isset($_SESSION['login']))
{
$_SESSION['login']='';
}
if(isset($_POST['login']))
{

    // Get all values
    $email=$_POST['emailid'];
    $password=$_POST['password'];


    //Validation
	if($email == '')
	{
		$arrErrors['emailid'] = 'Please enter Email';
	}
	if($password == '')
	{
		$arrErrors['password'] = 'Please provide password';
	}
	
	if(empty($arrErrors))
	{

$sql ="SELECT AdminEmail,Password,AdminId,Status FROM admin WHERE AdminEmail=:email and Password=:password";
$query=$dbh->prepare($sql);
$password = md5($password);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password,PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);


if($query->rowCount() > 0)
{

 foreach ($results as $result) {
 $_SESSION['admin_id']=$result->AdminId;
if($result->Status==1)
{
$_SESSION['login']=$_POST['emailid'];
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else {
echo "<script>alert('Your Account Has been blocked .Please contact admin');</script>";

}
}

} 

else{
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
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>Plat a Tree</title>
		<meta name="description" content="Grandin is a Dashboard & Admin Site Responsive Template by hencework." />
		<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Grandin Admin, Grandinadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
		<meta name="author" content="hencework"/>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<!-- vector map CSS -->
		<link href="<?php echo BASE_URL ;?>assets/as_assets/vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		
		
		
		<!-- Custom CSS -->
		<link href="<?php echo BASE_URL ;?>assets/as_assets/dist/css/style.css" rel="stylesheet" type="text/css">
    <style>
    .error
    {
    	color:red;
    	font-size: 16px;
    }
	</style>
	</head>
	<body>
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
		
		<div class="wrapper box-layout pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="<?php echo BASE_URL;?>admin/index.php">
						<img class="brand-img mr-10" src="../img/logo@2x.png" alt="brand"/>
						<span class="brand-text">Plant a tree</span>
					</a>
				</div>
				<!-- <div class="form-group mb-0 pull-right">
					<span class="inline-block pr-10">Don't have an account?</span>
					<a class="inline-block btn btn-primary  btn-rounded" href="signup.php">Sign Up</a>
				</div> -->
				<div class="clearfix"></div>
			</header>
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float card-view pt-30 pb-30">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Sign in to Plant a  tree</h3>
											<h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
										</div>	
										<div class="form-wrap">
											<form   role="form" method="post" id="login-form" action="">
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2">Email address</label>
													<input type="email" class="form-control" id="exampleInputEmail_2" placeholder="Enter email" name="emailid"  value="<?php echo isset($email)? $email : '';?>" >
    		                                    <label id="email-error" class="error" for="email"><?php echo get_error('emailid');?></label>
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="exampleInputpwd_2">Password</label>
													<div class="clearfix"></div>
													<input type="password" class="form-control"  placeholder="Enter pwd" name="password"
													value="<?php echo isset($password)? $password : '';?>" > 
			<label id="password-error" class="error" for="password"><?php echo get_error('password');?></label>
												</div>
												<div class="form-group text-center">
													<button type="submit" name="login" class="btn btn-primary  btn-rounded">sign in</button>
												</div>
											</form>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->	
				</div>
				
			</div>
			<!-- /Main Content -->
		
		</div>
		
		<!-- jQuery -->
		<script src="<?php echo BASE_URL ;?>assets/as_assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Validation -->
		<script src="<?php echo BASE_URL ;?>assets/as_assets/dist/js/jquery.validate.min.js "></script>
        <script src="<?php echo BASE_URL ;?>as_assets/dist/js/additional-methods.min.js"></script>

		
		<!-- Bootstrap Core JavaScript -->
		<script src="<?php echo BASE_URL ;?>assets/as_assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?php echo BASE_URL ;?>assets/as_assets/vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="<?php echo BASE_URL ;?>assets/as_assets/dist/js/jquery.slimscroll.js"></script>
		
		<!-- Init JavaScript -->
		<script src="<?php echo BASE_URL ;?>assets/as_assets/dist/js/init.js"></script>
	  <script>
  
  // When the browser is ready...
  $(function() {
  
    // Setup form validation on the #register-form element
    $("#login-form").validate({
    
        // Specify the validation rules
        rules: {
            
            emailid: {
                required: true,
                email: true
            },
            password: {
                required: true,
            },
            agree: "required",
			
        },
        
        // Specify the validation error messages
        messages: {
            emailid: "Please enter Email",
            
            password: {
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
   
	</body>
</html>
