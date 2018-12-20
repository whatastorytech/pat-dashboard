  <?php
/*********************************************************************
*   File    :   add_gardner.php
*   Created :   By  What a Story
*   Prupose :   To add a gardner to the particular location
**********************************************************************/
// include required files

include('../includes/config.php');
include('../includes/connect.php');
include('../includes/functions.php');
#   Variables
$arrErrors  =   array();
if(!isset($_SESSION['login']))
{ 
header('location:index.php');
}
else
{ 
if(isset($_POST['create']))
{
$location_id=intval($_GET['location_id']);
$location=$_POST['location'];
$location_name=$_POST['location_name'];
$sql ="SELECT * FROM location  WHERE location_name=:location_name ORDER BY  location_id desc";
$query=$dbh->prepare($sql);
$query->bindParam(':location_name',$location_name,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{

$_SESSION['error']="The Location you have chosen already exists!";
header('location:locations.php');
} 
else 
{
$sql="update location set location_name=:location where location_id=:location_id";
$query = $dbh->prepare($sql);
$query->bindParam(':location',$location,PDO::PARAM_STR);
$query->bindParam(':location_id',$location_id,PDO::PARAM_STR);
$query->execute();
$_SESSION['updatemsg']="Location info updated successfully";
header('location:locations.php');
}

}
}
include('../includes/admin_header.php');
include('../includes/admin_sidebar.php');
?>
  <div class="page-wrapper">
                <div class="container-fluid">
                    
                    <!-- Title -->
                    <div class="row heading-bg">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h5 class="txt-dark">Edit Tree Locations</h5>
                        </div>
                    
                        <!-- Breadcrumb -->
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="index.html">Dashboard</a></li>
                                <li><a href="#"><span>tree</span></a></li>
                                <li class="active"><span>tree location</span></li>
                            </ol>
                        </div>
                        <!-- /Breadcrumb -->
                    
                    </div>
                    <!-- /Title -->
                    
                    <!-- Row -->
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">Tree Location form </h6>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12">
                                                <div class="form-wrap">
                                                    <form   method="POST" action="" id="location_form">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="exampleInputuname_1">Location Name</label>
                                                            <?php 
                                                            $location_id=intval($_GET['location_id']);
                                                            $sql = "SELECT * from  location where location_id =:location_id";
                                                            $query = $dbh -> prepare($sql);
                                                            $query->bindParam(':location_id',$location_id,PDO::PARAM_STR);
                                                            $query->execute();
                                                            $location=$query->fetchAll(PDO::FETCH_OBJ);
                                                            $cnt=1;
                                                            if($query->rowCount() > 0)
                                                            {
                                                            foreach($location as $result)
                                                            {               ?>   
                                                            <div class="input-group">
                                                                <div class="input-group-addon"><i class="icon-user"></i></div>
                                                                <input type="text" class="form-control" id="exampleInputuname_1" placeholder="Tree Location" name="location_name" required  value="<?php echo htmlentities($result->location_name);?>">
                                                            </div>
                                                             
                                                        </div>
                                                         <?php }} ?>
                                                        <button type="submit"  name="create" class="btn btn-success mr-10">Submit</button>
                                                        <button type="submit" class="btn btn-default">Cancel</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- /Row -->   
                    
                
                
<?php 
include('../includes/admin_footer.php');?>
 <script>
  
  // When the browser is ready...
  $(function() {
  
    // Setup form validation on the #register-form element
    $("#location_form").validate({
    
        // Specify the validation rules
        rules: {
            
            location_name: {
                required: true,
            },
            
        },
        
        // Specify the validation error messages
        messages: {
            location_name : "Please enter Location Name",
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
  </script>