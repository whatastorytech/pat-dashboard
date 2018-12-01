<?php
/*********************************************************************
*	File	:	Users.php
*	Created	:	By  What a Story
*	Prupose	:	To Display  Listing   and   basic information of Users
**********************************************************************/
// include required files

include('../includes/config.php');
include('../includes/connect.php');
include('../includes/functions.php');
if(!isset($_SESSION['login']))
{ 
header('location:index.php');
}

$Credit = 'Credit';
$sql ="SELECT * ,COUNT(planted_trees.user_id) as count FROM users  INNER JOIN  planted_trees on users.user_id = planted_trees.user_id  where payment_status =:credit ORDER BY users.user_id desc";
$query=$dbh->prepare($sql);
$query->bindParam(':credit',$Credit,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$sql ="SELECT * FROM users  LEFT JOIN  planted_trees on users.user_id = planted_trees.user_id  WHERE  planted_trees.user_id IS NULL GROUP BY users.user_id ORDER BY users.user_id desc";
$unpaid_query=$dbh->prepare($sql);$unpaid_query->bindParam(':credit',$Credit,PDO::PARAM_STR);
$unpaid_query->execute();
$unpaid=$unpaid_query->fetchAll(PDO::FETCH_OBJ);
include('../includes/admin_header.php');
include('../includes/admin_sidebar.php');
?>
        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid">	

				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">Users</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="index.html">Dashboard</a></li>
						<li><a href="#"><span>users</span></a></li>
						<!-- <li class="active"><span>RSPV DataTable</span></li> -->
					  </ol>
					</div>
					<!-- /Breadcrumb -->



				</div>
				<!-- /Title -->
				
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						    <div class="col-lg-12 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div  class="panel-body pb-0">
									<div  class="tab-struct custom-tab-1">
										<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
											<li class="active" role="presentation"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>Paid users</span></a></li>
											<li  role="presentation" class="next"><a aria-expanded="true"  data-toggle="tab" role="tab" id="follo_tab_8" href="#follo_8"><span>Free users<span class="inline-block">&nbsp;(<?php echo $unpaid_query->rowCount();?>)</span></span></a></li>										
										</ul>
										<div class="tab-content" id="myTabContent_8">
											<div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
												<div class="col-md-12">
													<div class="pt-20">
													 <table id="example" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th>#</th>
														<th>Name</th>
														<th>Email</th>
														<th>Phone</th>
														<th>Planted Trees</th>
														<th>Payment Status</th>
													</tr>
												</thead>												
												<tbody>
												<?php 	
													$cnt=1;
													if($query->rowCount() > 0)
													{
													foreach($results as $result)
													{?>   
													<tr>
														 <td class="center"><?php echo htmlentities($cnt);?></td>
														<td class="center"><?php echo htmlentities($result->user_fname);?>&nbsp;<?php echo htmlentities($result->user_lname);?></td>
														<td class="center"><?php echo htmlentities($result->user_email);?></td>
														<td class="center"><?php echo htmlentities($result->user_pnumber);?></td>
														<td class="center"><?php echo htmlentities($result->count);?></td>
														<?php
														$date = $result->tree_planted_at;
														$date =  date('F, Y', strtotime("+12 months $date"));
														?>
														<td>till  <?php echo $date;?></td>
														<!-- <td class="text-nowrap"><a href="#" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> <a href="#" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td> -->
													</tr>
													 <?php $cnt=$cnt+1;}} ?>    
																										
												</tbody>
											
												<tfoot>
													<tr>
														<th>#</th>
														<th>Name</th>
														<th>Email</th>
														<th>Phone</th>
														<th>Planted Trees</th>
														<th>Payment Status</th>
												</tfoot>
											</table>
													</div>
												</div>
											</div>
											
											<div  id="follo_8" class="tab-pane fade" role="tabpanel">
												<div class="row">
													<div class="col-lg-12">
														 <table id="example_1" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th></th>
														<th>Name</th>
														<th>Email</th>
														<th>Phone</th>
														<!-- <th>action</th> -->
													</tr>
												</thead>												
												<tbody>
													<?php 	
													$cnt=1;
													if($unpaid_query->rowCount() > 0)
													{
													foreach($unpaid as $result)
													{?>   
													<tr>
														 <td class="center"><?php echo htmlentities($cnt);?></td>
														<td class="center"><?php echo htmlentities($result->user_fname);?>&nbsp;<?php echo htmlentities($result->user_lname);?></td>
														<td class="center"><?php echo htmlentities($result->user_email);?></td>
														<td class="center"><?php echo htmlentities($result->user_pnumber);?></td>
														<!-- <td class="text-nowrap"><a href="#" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> <a href="#" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td> -->
													</tr>
													 <?php $cnt=$cnt+1;}} ?>  												
												</tbody>
											
												<tfoot>
													<tr>
														<th></th>
														<th>Name</th>
														<th>Email</th>
														<th>Phone</th>
														<!-- <th>action</th> -->
													</tr>
												</tfoot>
											</table>
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
				<!-- /Row -->
			
			</div>	
	
<?php
include('../includes/admin_footer.php');?>	