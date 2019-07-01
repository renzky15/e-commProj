<div class="text-center" id="footer">
	<span id="titleFooter">
		@2018 Ecommerce Shop
	</span>
</div>
</body>

</html>

<script>
	function add_to_cart(){
		jQuery('#modal_errors').html("");
		var product_id = jQuery('#product_id').val();
		var size = jQuery('#size').val();
		var quantity = jQuery('#quantity').val();
		var available = jQuery('#available').val();
		var error = '';
		var data = jQuery('#add_product_form').serialize();
		// var data = {
		// 	'product_id' : product_id,
		// 	'size'	: size,
		// 	'quantity' : quantity,
		// 	'available' : available
		// };
		$(document).ready(function(){
		jQuery.ajax({
				method : 'POST',
				data : data,
				url : '/E-COMM/admin/parsers/addCart.php',
				// dataType : 'html',
				success : function(){
					location.reload();
					alert("Your item added to cart!");
					alert(data);
				},
				error : function(){alert("Something went wrong");}
			});
			});
		// if(size == '' || quantity == '' || quantity == 0){
		// 	error += '<p class="text-danger text-center">You must choose a size and quantity.</p>';
		// 	jQuery('#modal_errors').html(error);
		// 	return;
		// }else if(quantity > available){
		// 	error += '<p class="text-danger text-center">There are only '+available+' available.</p>';
		// 	jQuery('#modal_errors').html(error);
		// 	return;
		// }
		// else{
		// 	jQuery.ajax({
		// 		url : '/E-COMM/admin/parsers/addCart.php',
		// 		method : 'post',
		// 		data : data,
		// 		success : function(){
		// 			location.reload();
		// 		},
		// 		error : function(){alert("Something went wrong");}
		// 	});
		// }
	}
	function detailsModal(id) {
		var data = {'id' : id};
		jQuery.ajax({
			url: '/E-COMM/detailsModal.php',
			method	: "POST",
			data: data,
			success: function(data){
				jQuery('body').append(data);
				jQuery('#details-modal').modal('toggle');
			},
			error: function(){
				alert("Something went wrong!");
			}
		});
	}
	function update_cart(mode,edit_id,edit_size) {
		// body...
		var data =  {"mode" : mode, "edit_id" : edit_id, "edit_size" : edit_size};
		jQuery.ajax({
			url : '/E-COMM/admin/parsers/update_cart.php',
			method : "POST",
			data : data,
			success : function(){location.reload();},
			error : function(){alert("Errorrrr.");},

		});
	}

   // Any code that should be run when the DOM is ready




</script>

