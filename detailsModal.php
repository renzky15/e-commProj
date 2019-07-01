<?php
require_once 'core/init.php';
$id = $_POST['id'];
$id = (int)$id;
$sql = "SELECT * FROM products WHERE id = '$id' ";
$result = $connection->query($sql);
$product = mysqli_fetch_assoc($result);
$brand_id = $product['brand'];
$sql = "SELECT brand FROM brand WHERE id = '$brand_id' ";
$brand_query = $connection->query($sql);
$brand = mysqli_fetch_assoc($brand_query);			
$sizeString = $product['sizes'];
$sizeString = rtrim($sizeString,',');
$size_array = explode(',', $sizeString);	

?>	

<?php  ob_start(); ?>
<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" onclick="closeModal()" data-dismiss="modal" arial-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title text-center"><?= $product['title']; ?></h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<div class="center-block fotorama" data-autoplay="true">
								<?php $photos = explode(',',$product['image']);
								foreach($photos as $photo): ?>
									<img src="<?= $photo; ?>" alt="<?= $product['title']; ?>" class="details img-responsive">
								<?php endforeach;  ?>
								<!-- <?php var_dump($sql); ?> -->
							</div>						
						</div>
						<!-- another column -->
						<div class="col-sm-6">
							<h4>Details</h4>
							<p><?= nl2br($product['description']); ?></p>
							<hr/>
							<p>Price: $<?= $product['price']; ?></p>
							<p>Brand: <?= $brand['brand']; ?></p>
							<br>
							<form action="admin/parsers/addCart.php" method="post" id="add_product_form">
								<input type="hidden" id="product_id" name="product_id" value="<?= $id; ?>">
								<input type="hidden" name="available" id="available" value="">
								<div class="form-group row">
									<label for="quantity" class="col-sm-2 form-control-label">Quantity: </label>
									<div class="col-sm-10">
										<input style="width: 100px;" type="text" class="form-control" id="quantity" name="quantity" placeholder="Qty" min="0">
									</div>
								</br>
								<div class="col-xs-9">
									&nbsp;
								</div>
							</div>
							<div class="form-group row">
								<label for="size" class="col-sm-2 form-control-label">Size: </label>
								<div class="col-sm-10">
									<select style="width: 100px;" class="form-control" id="size" placeholder="Size" name="size">
										<option value=""></option>
										<?php foreach($size_array as $string){
											$string_array = explode(':', $string);
											$size = $string_array[0];
											$available = $string_array[1];
											if ($available > 0) {
												echo '<option value="'.$size.'" data-available="'.$available.'">'.$size.' ('.$available.' Available)</option>';
											}
										}
										?>
									</select>
								</div>	
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-danger" onclick="closeModal()" data-dismiss="modal">Cancel</button>
					<button type="submit" id="addCart" onclick="add_to_cart();return false;" class="btn btn-warning"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</button>
				</div>
			</div>

		</div>						
	</div>

</div>

</div>

<script>
	$(function () {
		$('.fotorama').fotorama({'loop':true});
	});
	JQuery('#size').change(function(){
		var available = JQuery('#size option:selected').data("available");
	});

	function closeModal(){
		jQuery().modal('hide');
		setTimeout(function(){
			jQuery('#details-modal').remove();
			jQuery('.modal-backdrop').remove();
		},500);
	}
	function test(){
		$('#addCart').click(function() {
			var fieldValue = $('#quantity').val();
			doAjax(fieldValue);
		});
	}

	// function add_to_cart(){
	// 	jQuery('#modal_errors').html("");
	// 	var size = jQuery('#size').val();
	// 	var quantity = jQuery('#quantity').val();
	// 	var available = jQuery('#available').val();
	// 	var error = '';
	// 	var data = jQuery('#add_product_form').val();
	// 	if(size == '' || quantity == '' || quantity == 0){
	// 		error += '<p class="text-danger text-center">You must choose a size and quantity.</p>';
	// 		jQuery('#modal_errors').html(error);
	// 		return;
	// 	}else if(quantity > available){
	// 		error += '<p class="text-danger text-center">There are only '+available+' available.</p>';
	// 		jQuery('#modal_errors').html(error);
	// 		return;
	// 	}else{
	// 		jQuery.ajax({
	// 			url : '/E-COMM/admin/parsers/addCart.php',
	// 			method : 'post',
	// 			data : data,
	// 			success : function(){
	// 				location.reload();
	// 			},
	// 			error : function(){alert("Errorrrr.");}
	// 		});
	// 	}
	// }

</script>
<?php echo ob_get_clean(); ?>
