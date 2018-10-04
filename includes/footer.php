<<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/plugins.js"></script>
		<script src="assets/js/custom.js"></script>
		
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
		       	 ++count;
		       	 var amount = count*999;
		       	 $('#rate').val(amount);
		         $('#fee').val(count);
			}
		
		</script>

	</body>
</html>

