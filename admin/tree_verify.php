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
$tree_updates = 'verifed';
$resend = 'resend';
	            	/*$sql ="SELECT * FROM  tree_updates  WHERE plant_id=:plant_id AND tree_updates=:update_status AND tree_updates !=:resend";
					$query=$dbh->prepare($sql);
					$query->bindParam(':plant_id',$plant_id,PDO::PARAM_STR);
					$query->bindParam(':update_status',$tree_updates,PDO::PARAM_STR);
					$query->bindParam(':resend',$resend,PDO::PARAM_STR);
					$query->execute();
					$results=$query->fetchAll(PDO::FETCH_OBJ);
					if($query->rowCount() > 0)
						{
                           
                           $sql ="SELECT * FROM  tree_updates  WHERE plant_id=:plant_id AND update_status=:update_status AND update_status =:resend ";
							$query=$dbh->prepare($sql);
							$query->bindParam(':plant_id',$plant_id,PDO::PARAM_STR);
							$query->bindParam(':tree_updates',$tree_updates,PDO::PARAM_STR);
							$query->bindParam(':resend',$resend,PDO::PARAM_STR);
							$query->execute();
					        $results=$query->fetchAll(PDO::FETCH_OBJ);
                             if($query->rowCount() > 0)
						    {*/
                                     
                                    $sql="update tree_updates set update_status=:update_status where plant_id=:plant_id";
									$query = $dbh->prepare($sql);
									$query->bindParam(':plant_id',$plant_id,PDO::PARAM_STR);
									$query->bindParam(':update_status',$tree_updates,PDO::PARAM_STR);
									$query->execute();
			                        echo "1";
			                        die;
						   /* }

						    else
						    {
                                $added_at = date('Y-m-d');
					          $sql="INSERT INTO  tree_updates (plant_id,pictures,added_at) VALUES(:tree_id,:pictures,:added_at)";
								$query = $dbh->prepare($sql);
								$query->bindParam(':tree_id',$plant_id,PDO::PARAM_STR);
								$query->bindParam(':pictures',$file_name,PDO::PARAM_STR);
								$query->bindParam(':added_at',$added_at,PDO::PARAM_STR);
								$query->execute();
								$lastInsertId = $dbh->lastInsertId();
						    }*/
						
						