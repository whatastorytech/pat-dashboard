<?php        
/*********************************************************************
*   File    :   add_tre.php
*   Created :   By  What a Story
*   Prupose :   To Display  Listing   and   basic information of Gardners
**********************************************************************/
// include required files

include('../includes/config.php');
include('../includes/connect.php');
include('../includes/functions.php');

if(!isset($_SESSION['login']))
{ 
header('location:index.php');
}

if(isset($_POST['create']))
{

$the_number_of_tree=$_POST['tree_number'];
$tree_category_id = $_POST['tree_category_id'];
$garden_id = $_POST['garden_id'];
$added_at = date('Y-m-d H:i:s');
//set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'gardnerQR'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'gardnerQR/';

    include "../qrlib.php"; 
for($i=0;$i<$the_number_of_tree;$i++)
{
    $unique_code = 'PTA'.rand(1,1111);

$sql="INSERT INTO  planted_trees (tree_category_id,tree_code,tree_planted_at,garden_id) VALUES(:tree_category_id,:tree_code,:tree_planted_at,:garden_id)";
$query = $dbh->prepare($sql);
$query->bindParam(':tree_category_id',$tree_category_id,PDO::PARAM_STR);
$query->bindParam(':tree_planted_at',$added_at,PDO::PARAM_STR);
$query->bindParam(':tree_code',$unique_code,PDO::PARAM_STR);
$query->bindParam(':garden_id',$garden_id,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();


   
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    $errorCorrectionLevel = 'L';
    $matrixPointSize = 4;
            
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($lastInsertId.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        $file = 'test'.md5($lastInsertId.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        $custome_URL = "http://plantatree.com/qrcode_scanneddata.php?id=$lastInsertId ";
        QRcode::png( $custome_URL, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 

        $sql="update planted_trees set tree_qr_code = :qr_code where plant_id=:plant_id";   
        $query = $dbh->prepare($sql);
        $query->bindParam(':qr_code',$file,PDO::PARAM_STR);
        $query->bindParam(':plant_id',$lastInsertId,PDO::PARAM_STR);
        $query->execute();

}   
if($lastInsertId)
{

  $_SESSION['msg']="Tree Listed successfully";
  echo "<script type='text/javascript'> document.location ='trees.php'; </script>";
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";

}


}
    
   

    