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
$status='planted';
$count = $_POST['count'];
$tree_category_id = $_POST['tree_id'];
$sql ="SELECT *  FROM planted_trees where tree_category_id = :tree_category_id AND tree_status = :status";
$query = $dbh -> prepare($sql);
$query->bindParam(':tree_category_id',$tree_category_id,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$re_count = count($results);

  if($re_count  >= $count)
  {
    
     echo '1';
  }
  else
  {
  	echo '0';
  }