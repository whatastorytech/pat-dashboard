
		<script src="<?php echo BASE_URL;?>assets/js/plugins.js"></script>
		<script src="<?php echo BASE_URL;?>assets/js/custom.js"></script>
		
		<script type="text/javascript">
			
			$(document).ready(function () {

				$(".notifyme").notify({
					triggerEl : ".notifies"
				});

				$('.image-grid').gridder();

			});

		</script>
		<script>
			 document.getElementById('minus').onclick = function() {
			  event.preventDefault();
		       var count = $('#fee').val();
		       if(count != 1 )
		       {
		       	 --count;
		       	 var amount = count*999;
		       	 $('#rate').val(amount);
		       }
		       $('#fee').val(count);
			}
			 document.getElementById('plus').onclick = function() {
			 	 event.preventDefault();
		       var count = $('#fee').val();		       
		       	 var count = ++count;
		       	 $.ajax({
				url: "check_tree.php",
				type: "POST",
				data:{
                 count:count,
                 tree_id :<?php echo $tree_category_id;?>
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
		      
			}
		
		</script>
		
	</body>
</html>

