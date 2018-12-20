<?php
/*********************************************************************
* File  : index.php
* Created : By  What a Story
* Prupose : This is the user dashboard page wehre user can select the tree  and location for plantation  
**********************************************************************/
// include required files

include('includes/config.php');
include('includes/connect.php');

unset($_SESSION['tree_id']);
$_SESSION['tree_id'] = $_POST['tree_id'];
if(isset($_SESSION['tree_id']))
{
	echo '1';
}
else
{
	echo '0';
}

if(!isset($_SESSION['login']))
{ 

echo "<script type='text/javascript'> document.location ='login.php'; </script>";
}