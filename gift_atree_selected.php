<?php
include('includes/config.php');
include('includes/connect.php');
if(!isset($_SESSION['login']))
{ 
echo "<script type='text/javascript'> document.location ='login.php'; </script>";
}
$status = 1;
$tree_category_id= intval($_GET['tree_category']);
$user_id = $_SESSION['user_id'];
$giftted_to = Null;
$sql ="SELECT planted_trees.tree_category_id,planted_trees.plant_id,planted_trees.number_of_trees,planted_trees.added_at,location.location_name,location.location_id,tree_category.tree_category_name,planted_trees.tree_name,planted_trees.tree_code,tree_category.category_image,planted_trees.tree_planted_at,planted_trees.tree_category_id FROM planted_trees  LEFT JOIN location ON  planted_trees.location_id = location.location_id  LEFT JOIN tree_category ON  planted_trees.tree_category_id = tree_category.tree_category_id  WHERE planted_trees.user_id = :user_id  AND planted_trees.tree_category_id= :tree_category_id AND planted_trees.gifted_to IS NULL";
$query=$dbh->prepare($sql);
$query->bindParam(':user_id',$user_id, PDO::PARAM_STR);
$query->bindParam(':tree_category_id',$tree_category_id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$count = count($results);
$sql ="SELECT tree_category_name,tree_category_desc,Status,tree_category_id,category_image FROM tree_category where tree_category_id = :tree_category_id AND Status = :status ORDER BY tree_category_id desc";
$catquery = $dbh->prepare($sql);
$catquery->bindParam(':tree_category_id',$tree_category_id,PDO::PARAM_STR);
$catquery->bindParam(':status',$status,PDO::PARAM_STR);
$catquery->execute();
$cate=$catquery->fetchAll(PDO::FETCH_OBJ);
include('includes/header.php');
include('includes/sidebar.php');
?>
			<div class="contents-wrapper">
				<div class="main-contents">
					<div class="tab-contents mytrees">
						<div class="title-block">
							<div class="group">
								<h2>Gift a Tree</h2>
							</div>
							<div class="sub-info">
								<div class="left">
									<p>Select the tree that you want to gift to someone You can plant a new tree from <a href="index.php">here</a>
									<br>or</p>
					<input type="text" name="treecode" placeholder="Enter Tree Code" id="myInput" oninput="myFunction()">
								</div>
								<div class="right">
									<span id="text"></span>
									<div class="link">
										<a href="send_agift.php" class="bordered-btn">Proceed</a>
									</div>
								</div>
							</div>
						</div>
						<div class="group plantation-details">
							<div class="tree-info">
								<div class="tree-block">
							<?php foreach ($cate as  $result){?>
									<a href="giftatree.html"><h2><?php echo  $result->tree_category_name;?></h2></a>

									<div class="tree-img">
										<img src="<?php echo BASE_URL;?>uploads/tree_category_picture/<?php echo $result->category_image;?>">
									</div>
									<p class="howmany">Planted <?php echo $count;?> Trees</p>
									<!-- <p><a href="#">Bangalore ></a></p>
									<p><a href="#">Mumbai ></a></p> -->
									<div class="select">
										<a href="<?php echo BASE_URL;?>index.php">Select another tree</a>
									</div>
									<?php }?>
								</div>
							</div>
							<div class="plantation-info">
								<div class="block">
									<!-- <p class="p-title">10 trees Planted in Bangalore</p> -->
									<div class="planted-tree" id="plantatree">
										<?php foreach ($results as  $result){?>
										<div class="tree">
											<a href="#" class="gift" data-id="<?php echo $result->plant_id;?>">
												<img src="<?php echo BASE_URL;?>uploads/tree_category_picture/<?php echo $result->category_image;?>">
												<?php if($result->tree_name != '')
									{?>
                                       <h4><?php echo  $result->tree_name;?></h4>
									<?php } else {?>
                                       
                                         <h4>class="person-name"><?php echo  $result->tree_code;?></h4>
									   <?php } ?>
											<h6><?php echo $result->tree_code;?></h6>
											</a>
										</div>
										<?php }?>
										
									</div>
								</div>
								
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<script>
function myFunction() {
    var search = document.getElementById("myInput").value;
      $.ajax({
		            url: "<?php echo BASE_URL;?>get_plant.php",
		            type: 'POST',
		            data: {
		                search:search,
		            },
		            error: function() 
		            {
		                
		            },
		            success: function(data)
		            {   
		            	
		              if(data != 0)
		              {
                           
		                  $('#plantatree').html(data);
		              }
		              else
		              {
		              	 $('#plantatree').empty();
		              }
		            }
		        });
}
</script>

<?php 		
include('includes/footer.php');?>
<script>
	 $('body').on('click', '.gift', function (e)
      {  
			 	 e.preventDefault();
			 	 $('#text').text('You have selected one tree');
			 	 var tree_id = $(this).data('id');
		       var count = $('#fee').val();		       
		       	 var count = ++count;
		       	 $.ajax({
				url: "select_gift_tree.php",
				type: "POST",
				data:{
                 count:count,
                 tree_id :  tree_id
				},
				success: function(data){
					if(data == 0)
					{
						alert('Please reduce the amount of tree ! There are only '  + --count+ ' trees availabel in garden');
					}
					else
					{
                          var amount = count*999;
				       	 $('#rate').val(amount);
				         $('#fee').val(count);
					}
					
				}        
		   });
		      
			});
	</script>
	
		