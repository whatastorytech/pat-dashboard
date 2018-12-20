<?php
include('includes/config.php');
include('includes/connect.php');
if(!isset($_SESSION['login']))
{ 
echo "<script type='text/javascript'> document.location ='login.php'; </script>";
}
$status = 1;
$search = $_POST['search'];
$user_id = $_SESSION['user_id'];
$sql ="SELECT planted_trees.tree_category_id,planted_trees.plant_id,planted_trees.number_of_trees,planted_trees.added_at,location.location_name,location.location_id,tree_category.tree_category_name,planted_trees.tree_name,planted_trees.tree_code,tree_category.category_image,planted_trees.tree_planted_at,planted_trees.tree_category_id FROM planted_trees  LEFT JOIN location ON  planted_trees.location_id = location.location_id  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id WHERE planted_trees.tree_code = :search AND planted_trees.user_id = :user_id AND planted_trees.gifted_to IS NULL";
$query=$dbh->prepare($sql);
$query->bindParam(':search',$search, PDO::PARAM_STR);
$query->bindParam(':user_id',$user_id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$user_id = $_SESSION['user_id'];
$sql ="SELECT planted_trees.tree_category_id,planted_trees.plant_id,planted_trees.number_of_trees,planted_trees.added_at,location.location_name,location.location_id,tree_category.tree_category_name,planted_trees.tree_name,planted_trees.tree_code,tree_category.category_image,planted_trees.tree_planted_at,planted_trees.tree_category_id FROM planted_trees  LEFT JOIN location ON  planted_trees.location_id = location.location_id  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id WHERE planted_trees.user_id = :user_id AND planted_trees.gifted_to IS NULL";
$query_2=$dbh->prepare($sql);
$query_2->bindParam(':user_id',$user_id, PDO::PARAM_STR);
$query_2->execute();
$results_2=$query_2->fetchAll(PDO::FETCH_OBJ);
$sql ="SELECT tree_category_name,tree_category_desc,Status,tree_category_id,category_image FROM tree_category where tree_category_id = :tree_category_id AND Status = :status ORDER BY tree_category_id desc";
$catquery = $dbh->prepare($sql);
$catquery->bindParam(':tree_category_id',$tree_category_id,PDO::PARAM_STR);
$catquery->bindParam(':status',$status,PDO::PARAM_STR);
$catquery->execute();
$cate=$catquery->fetchAll(PDO::FETCH_OBJ);
$data = '0';
			
						
						  
							    
							   if($query->rowCount() > 0)
							    {
									foreach ($results as  $result)
									{  
										$data = '';
									    $data.= '<div class="tree"><a href="#" class="gift" data-id="'.$result->plant_id.'"><img src="'.BASE_URL.'uploads/tree_category_picture/' .$result->category_image.'">';
									 if($result->tree_name != '')
									{
                                       $data.= '<h4>' .$result->tree_name.'</h4>';
									}
									 else 
									{
                                       
                                         '<h4>class="person-name">'.$result->tree_code.'</h4>';
								    }
											$data.= '<h6>'.$result->tree_code.'</h6>';
											
										$data.= '</a></div>';
                                    }
                                } 
                                

                                 else if($query_2->rowCount() > 0)
							    {   
							    	$data = '';
									foreach ($results_2 as  $result)
									{  
										
									    $data.= '<div class="tree"><a href="#" class="gift" data-id="'.$result->plant_id.'"><img src="'.BASE_URL.'uploads/tree_category_picture/' .$result->category_image.'">';
									 if($result->tree_name != '')
									{
                                       $data.= '<h4>' .$result->tree_name.'</h4>';
									}
									 else 
									{
                                       
                                         '<h4>class="person-name">'.$result->tree_code.'</h4>';
								    }
											$data.= '<h6>'.$result->tree_code.'</h6>';
											
										$data.= '</a></div>';
                                    }
                                } 
							         echo $data;
							         die;			
									




	