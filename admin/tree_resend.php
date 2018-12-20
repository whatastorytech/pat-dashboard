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
$plant_id=intval($_GET['plant_id']);
#	Variables
$arrErrors	=	array();
$tree_updates = 'verify';
$resend = 'resend';
	           
                           
                           $sql ="SELECT * FROM  tree_updates  WHERE plant_id=:plant_id";
							$query=$dbh->prepare($sql);
							$query->bindParam(':plant_id',$plant_id,PDO::PARAM_STR);
							$query->execute();
					        $results=$query->fetchAll(PDO::FETCH_OBJ);
                             if($query->rowCount() > 0)
						    {  
                                
		                                $sql ="SELECT * FROM  old_tree_updates  WHERE plant_id=:plant_id ";
									$query=$dbh->prepare($sql);
									$query->bindParam(':plant_id',$plant_id,PDO::PARAM_STR);
									$query->execute();
							        $results=$query->fetchAll(PDO::FETCH_OBJ);
							         if($query->rowCount() > 0)
								    {
								        
		                                    $sql="update tree_updates set update_status=:update_status where plant_id=:plant_id";
											$query = $dbh->prepare($sql);
											$query->bindParam(':plant_id',$plant_id,PDO::PARAM_STR);
											$query->bindParam(':update_status',$resend,PDO::PARAM_STR);
											$query->execute();
					                        echo "1";
					                        die;
		                            }
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
                                   

                                     }        
                             }     
						   

						  
						
						