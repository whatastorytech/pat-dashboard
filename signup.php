
<?php 
/*********************************************************************
* File  : Sign-Up.php
* Created : By  What a Story
* Prupose : For Add User Details
**********************************************************************/
// include required files
include('includes/config.php');
include('includes/connect.php');
include('includes/functions.php');

# Variables
$arrErrors  = array();
$agree = '';


if(isset($_POST['signup']))
{  


     if(isset($_FILES['user_image'])){

      
      $errors= array();
      $file_name = $_FILES['user_image']['name'];
      $file_size =$_FILES['user_image']['size'];
      $file_tmp =$_FILES['user_image']['tmp_name'];
      $file_type=$_FILES['user_image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['user_image']['name'])));
      
      $expensions= array("jpeg","jpg","png","svg");
      
      if(in_array($file_ext,$expensions)=== false)
      {
          $errors [] = 1;
          echo "<script>alert('extension not allowed, please choose a JPEG ,SVG or PNG file.!');</script>";
        /* $_SESSION['error']="";
         echo "<script type='text/javascript'> document.location ='trees_category.php'; </script>";*/

      }
      
      if($file_size > 2097152)
      {
          $errors [] = 2;
         $_SESSION['error']="File size must be excately 2 MB";
         echo "<script>alert('File size must be excately 2 MB');</script>";
         /*echo "<script type='text/javascript'> document.location ='trees_category.php'; </script>";*/
      }
      
           // Get all values
          $user_fname=$_POST['user_fname'];
          $user_lname=$_POST['user_lname'];
          $user_email=$_POST['user_email'];
          $user_password=$_POST['user_password'];
          $user_pnumber=$_POST['user_pnumber'];
    
    if(isset($_POST['agree']))
    {
        $agree = $_POST['agree']; 
    } 

    $status=1;
    
    //Validation
  if($user_fname == '')
  {
    $arrErrors['user_fname'] = 'Please Enter First Name';
  }
  if($user_lname == '')
  {
    $arrErrors['user_lname'] = 'Please Enter Last Name ';
  }
   if($user_email == '')
  {
    $arrErrors['user_email'] = 'Please Enter Valid Email';
  }
  if($user_password == '')
  {
    $arrErrors['user_password'] = 'Please Enter Password';
  }
   if($user_pnumber == '')
  {
    $arrErrors['user_pnumber'] = 'Please Enter Phone Number';
  }
   if($agree == '')
  {
    $arrErrors['agree'] = 'Please Check Terms and Condition';
  }

  $user_email=$_POST['user_email'];
  $sql ="SELECT * FROM users  WHERE user_email =:user_email ORDER BY  user_id desc";
  $query=$dbh->prepare($sql);
  $query->bindParam(':user_email',$user_email,PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);

  if($query->rowCount() > 0)
  {  
    
    echo "<script>alert('The  Email you have chosen already exists!');</script>";
   /* $_SESSION['error']="The  Email you have chosen already exists!";
    header('location:signup.php');*/

  }
  
  else if(empty($arrErrors) && empty($errors)==true)
  { 

         $file_name = time().'.'.$file_ext;
         $da = move_uploaded_file($file_tmp,"uploads/user_profile_picture/".$file_name);
         if($da)
         {

  $password = md5($user_password);
  $sql="INSERT INTO  users (user_fname,user_lname,user_email,user_pnumber,user_password,user_status,user_image) VALUES(:user_fname,:user_lname,:user_email,:user_pnumber,:user_password,:status,:user_image)";
$query = $dbh->prepare($sql);
$query->bindParam(':user_fname',$user_fname,PDO::PARAM_STR);
$query->bindParam(':user_lname',$user_lname,PDO::PARAM_STR);
$query->bindParam(':user_email',$user_email,PDO::PARAM_STR);
$query->bindParam(':user_password',$password,PDO::PARAM_STR);
$query->bindParam(':user_pnumber',$user_pnumber,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':user_image',$file_name,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo '<script>alert("Your Registration successfull and your User id is  "+"'.$lastInsertId.'")</script>';
/* $_SESSION['error']="The  Email you have chosen already exists!";
  header('location:signup.php');*/
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}
else
{
  echo "<script>alert('Something went wrong. Please try again');</script>";
}

}
}
}

?>
<!DOCTYPE html>
<title>PAT SignUp Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="<?php echo BASE_URL ;?>assets/css/login.css" rel="stylesheet" type="text/css" media="all" />
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
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
		<h1>PAT SignUp Form</h1>
     <div class="row">
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="#" method="post" id="user_signup_form" enctype="multipart/form-data">
					<input class="pass" type="text" name="user_fname" placeholder="User First Name" value="<?php echo isset($user_fname)? $user_fname : '';?>" > 
          <label id="email-error" class="error" for="email"><?php echo get_error('user_fname');?></label>

          <input class="pass" type="text" name="user_lname" placeholder="User Last Name" value="<?php echo isset($user_lname)? $user_lname : '';?>" > 
          <label id="email-error" class="error" for="email"><?php echo get_error('user_lname');?></label>

					<input class="pass" type="email" name="user_email" placeholder="Email"  value="<?php echo isset($user_email)? $user_email : '';?>" > 
          <label id="email-error" class="error" for="email"><?php echo get_error('user_email');?></label>

					<input class="pass " type="password" name="user_password" placeholder="Password" value="<?php echo isset($user_password)? $user_password : '';?>" > 
          <label id="email-error" class="error" for="email"><?php echo get_error('user_password');?></label>

          <input class="pass" type="text" name="user_pnumber" placeholder="Mobile number" value="<?php echo isset($user_pnumber)? $user_pnumber : '';?>" > 
          <label id="email-error" class="error" for="email"><?php echo get_error('user_pnumber');?></label>
          <input class="pass" type="file" name="user_image" placeholder="Upload Picture" value="<?php echo isset($category_image)? $category_image : '';?>" > 
          <label id="email-error" class="error" for="email"><?php echo get_error('user_image');?></label> 
					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox pass" name="agree">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
          <label id="email-error" class="error" for="email"><?php echo get_error('agree');?></label> 
					<input type="submit" value="SIGNUP" name="signup">
				</form>
				<p>Don't have an Account? <a href="login.php"> Login Now!</a></p>
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
    $("#user_signup_form").validate({
    
        // Specify the validation rules
        rules: {
            
            user_email: {
                required: true,
                email: true
            },
            user_password: {
                required: true,
            },
             user_fname: {
                required: true,
            },
             user_lname: {
                required: true,
            },
             user_pnumber: {
                required: true,
            },
            agree: "required",
      
        },
        
        // Specify the validation error messages
        messages: {
            user_email: "Please Enter Valid Email",
            user_fname: "Please Enter First Name",
            user_lname: "Please Enter Last Name",
            user_pnumber: "Please enter Phone Number",            
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