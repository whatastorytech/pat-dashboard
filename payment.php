<?php
include('includes/config.php');
include('includes/connect.php');
if(!isset($_SESSION['login']))
{ 
echo "<script type='text/javascript'> document.location ='login.php'; </script>";
}
include('Instamojo.php');
$number_of_trees = intval($_GET['number']);
$tree_id = intval($_GET['tree_id']);
$api = new Instamojo\Instamojo('test_cae2968fb1e4b64719904a3921d','test_decb2f0528b832e0ea79e606460');
if(isset($_GET['payment_request_id']) && isset($_GET['payment_id']))
{
try {
    $response = $api->paymentRequestPaymentStatus($_GET['payment_request_id'],$_GET['payment_id']);
    if($response['payment']['status'] == 'Credit');
    {   


        $location_id=$_SESSION['location_id'];
        $garden_id=$_SESSION['garden_id'];
        $tree_category_id= intval($_GET['tree_id']);
        $tree_name = $_SESSION['tree_name'];
        $added_at = date('Y-m-d H:i:s');
        $user_id = $_SESSION['user_id'];
        $credit =  'Credit';
        $rate= '999';
        $tree_status = 'adopted';
        $old_tree_status = 'planted';
        $number_of_trees = intval($_GET['number']);
        $tree_id = intval($_GET['tree_id']);



        $sql="update planted_trees  set location_id = :location_id,tree_name=:tree_name,tree_category_id=:tree_category_id,user_id=:user_id,tree_payment=:tree_payment,tree_planted_at=:added_at,number_of_trees=:number_of_trees,payment_status=:payment_status,garden_id=:garden_id,tree_status=:tree_status
        where tree_status=:old_tree_status  LIMIT ".$number_of_trees."";
        $query = $dbh->prepare($sql);
        $query->bindParam(':location_id',$location_id,PDO::PARAM_STR);
        $query->bindParam(':tree_name',$tree_name,PDO::PARAM_STR);
        $query->bindParam(':garden_id',$garden_id,PDO::PARAM_STR);
        $query->bindParam(':tree_category_id',$tree_category_id,PDO::PARAM_STR);
        $query->bindParam(':user_id',$user_id,PDO::PARAM_STR);
        $query->bindParam(':added_at',$added_at,PDO::PARAM_STR);
        $query->bindParam(':number_of_trees',$number_of_trees,PDO::PARAM_STR);
        $query->bindParam(':tree_payment',$rate,PDO::PARAM_STR);
        $query->bindParam(':payment_status',$credit,PDO::PARAM_STR);
        $query->bindParam(':tree_status',$tree_status,PDO::PARAM_STR);
        $query->bindParam(':old_tree_status',$old_tree_status,PDO::PARAM_STR);
        $query->execute();
       
    
       
    
}
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}
}
include('includes/header.php');
include('includes/sidebar.php');
?>
    <div class="contents-wrapper">
                <div class="main-contents">
                    <div class="section check-out">

        <div class="checkout-success" id="cardpopup">
            <div class="success-card">
                <div class="image">
                    <img src="img/trees/success.svg">
                </div>
                <h1>Congratulations</h1>
                <h2>You have planted a tree</h2>
                <a class="download">Download a copy of Proof</a>
            </div>
        </div>

<?php       
include('includes/footer.php');?>  
<script>
    $("document").ready(function() {
    setTimeout(function() {
        alert('payment');
        $(".checkout-success").addClass("active");
    },10);
});
    $(document).click(function(e) 
{
        $(".checkout-success").removeClass("active");
        document.location ='index.php';
});
</script>     