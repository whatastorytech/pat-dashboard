<?php
/*********************************************************************
*	File	:	Gardners.php
*	Created	:	By  What a Story
*	Prupose	:	To Display  Listing   and   basic information of Gardners
**********************************************************************/
// include required files

include('../includes/config.php');
include('../includes/connect.php');
include('../includes/functions.php');

if(!isset($_SESSION['login']))
{ 
header('location:index.php');
}
$plant_id=intval($_POST['plant_id']);
#	Variables
$arrErrors	=	array();
$tree_updates = 'unverify';
$resend = 'resend';
	            	$sql ="SELECT * FROM  tree_updates  WHERE plant_id=:plant_id AND update_status=:update_status";
					$query=$dbh->prepare($sql);
					$query->bindParam(':plant_id',$plant_id,PDO::PARAM_STR);
					$query->bindParam(':update_status',$tree_updates,PDO::PARAM_STR);
					$query->execute();
					$results=$query->fetchAll(PDO::FETCH_OBJ);  
					if($query->rowCount() > 0)
						{
							
							foreach($results as $result){
			                    $sql ="SELECT * FROM  old_tree_updates  WHERE plant_id=:plant_id";
								$query=$dbh->prepare($sql);
								$query->bindParam(':plant_id',$plant_id,PDO::PARAM_STR);
								$query->execute();
								$old_tree=$query->fetchAll(PDO::FETCH_OBJ);
								if($query->rowCount() > 0)
							    {	
	                              $added_at = date('Y-m-d');
	                              foreach($old_tree as $data)	
	                              {
	                              	$plant_id = $data->plant_id;
	                              	$pictures = explode(',',$data->pictures);
	                              	$picture  = array();
	                              	$picture[0] = $result->pictures;
	                              	$new_pictures = array_merge($pictures,$picture);	
	                              	$new_pictures = implode(',',$new_pictures);      
	                              	$added_at = explode(',',$data->added_at);
	                              	$new_added  = array();
	                              	$new_added[0] = $result->added_at;
	                              	$new_added = array_merge($added_at,$new_added);
	                              	$new_added = implode(',',$new_added);
	                              }					          
								  $sql="update old_tree_updates set pictures = :pictures,added_at=:added_at where plant_id=:plant_id";
										$query = $dbh->prepare($sql);
										$query->bindParam(':pictures',$new_pictures,PDO::PARAM_STR);
										$query->bindParam(':added_at',$new_added,PDO::PARAM_STR);
										$query->bindParam(':plant_id',$plant_id,PDO::PARAM_STR);
										$query->execute();

								}	
	                             
							     else 
							    {
	                                 
	                                $sql="INSERT INTO  old_tree_updates (plant_id,pictures,added_at) VALUES(:tree_id,:pictures,:added_at)";
									$query = $dbh->prepare($sql);
									$query->bindParam(':tree_id',$result->plant_id,PDO::PARAM_STR);
									$query->bindParam(':pictures',$result->pictures,PDO::PARAM_STR);
									$query->bindParam(':added_at',$result->added_at,PDO::PARAM_STR);
									$query->execute();
									$lastInsertId = $dbh->lastInsertId();
				                       
				                }
						} 

					}

					$sql = "delete from tree_updates  WHERE plant_id=:plant_id";
					$query = $dbh->prepare($sql);
					$query -> bindParam(':plant_id',$plant_id, PDO::PARAM_STR);
					$query -> execute();
						
						