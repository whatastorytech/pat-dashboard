<?php
/*********************************************************************
*	File	:	Trees_category.php
*	Created	:	By  What a Story
*	Prupose	:	To Display  Listing   and   basic information of Tree Category
**********************************************************************/
// include required files

include('../includes/config.php');
include('../includes/connect.php');
include('../includes/functions.php');

if(!isset($_SESSION['login']))
{ 
header('location:index.php');
}


$tree_category_id=$_POST['cat_id'];
$status = 1;
$sql ="SELECT * FROM planted_trees LEFT JOIN location ON  planted_trees.location_id = location.location_id
        LEFT JOIN  tree_category ON planted_trees.tree_category_id = tree_category.tree_category_id where planted_trees.tree_category_id = :tree_category_id ";     
$plann_query = $dbh -> prepare($sql);
$plann_query->bindParam(':tree_category_id',$tree_category_id,PDO::PARAM_STR);
$plann_query->execute();
$planted_trees=$plann_query->fetchAll(PDO::FETCH_OBJ);
?>

       

                                            <thead>
													<tr>
														<th>#</th>
														<th>Tree Code</th>
														<th>Tree Category</th>
														<th>Age</th>
														<th>Status</th>
														<th>Updates</th>
													</tr>
												</thead>
          
															
												<tbody>
													<?php 	
													$cnt=1;
													if($plann_query->rowCount() > 0)
													{
													foreach($planted_trees as $result)
													{               ?>   
													<tr>

												    <td class="center"><?php echo htmlentities($cnt);?></td>
													<td class="center"><?php echo htmlentities($result->tree_code);?></td>
													<td class="center"><?php echo htmlentities($result->tree_category_name);?></td>
														<?php 
                                                        $from = new DateTime($result->tree_planted_at);
														$to   = new DateTime('today');
														?>
													<td class="center"><?php echo $from->diff($to)->d;?> days</td>
													
													<td class="center"><?php echo htmlentities($result->tree_status);?></td>
													</tr>
													 <?php $cnt=$cnt+1;}} ?> 												
												</tbody>
											<tfoot>
													<tr>
														<th>#</th>
														<th>Tree Code</th>
														<th>Tree Category</th>
														<th>Age</th>
														<th>Status</th>
														<th>Updates</th>
													</tr>
												</tfoot>
												
